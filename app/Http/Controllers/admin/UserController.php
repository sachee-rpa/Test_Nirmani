<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\user\StoreUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $data = [];

    public function __construct()
    {
        $this->data['main_icon'] = "pe-7s-users";
        $this->data['btn_icon'] = "fa-user";
    }

    public function index()
    {
        $this->data['page_name'] = "User Manager";
        $this->data['page_desc'] = "User Manager";
        $this->data['btn_name'] = "User Add";       
        $this->data['btn_route'] = route('users.create');   
        $userData =  User::all();
        $userData->shift();           
        $this->data['users'] =   $userData ;            
        return view('admin.user.index',  $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['user'] =  new User();      
        $this->data['page_name'] = "User Add";
        $this->data['page_desc'] = "User Add";
        $this->data['btn_name'] = "User Manager";       
        $this->data['btn_route'] = route('users.index');       
        $this->data['submit_btn'] = 'Add User To System';
        $this->data['route'] = route('users.store');    
        $this->data['update'] =  false;            
        return view('admin.user.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
      
        $request->merge(['password' => bcrypt( $request->password)]);
        $user  = User::create($request->all());        
        return redirect()->route('users.show',$user)->with('status', 'User Added Successfully, Please add Privileges');       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //permission Init
        $setRoles = ['super_admin'];
        
        $permissions = config('permissions.data');
        foreach ($permissions as $key => $permission) {
            if (!empty($permission['subs'])) {
                $mainCats = $permission['subs'];
                foreach ($mainCats as $mainCatKey => $mainCat) {       
                   if (
                    $mainCat['role'] != ""
                    ) {
                        $setRoles[] = $mainCat['role'];
                    }
               }  
            }
        }
        if (!empty($setRoles)) {
            foreach ($setRoles as $key => $setRole) {
                if(!Role::all()->contains('name', $setRole)){
                    $role = Role::create(['name'=> $setRole]);
                    $permission = Permission::create(['name' => $setRole.'-index']);
                    $permission->assignRole($role);
                    $permission = Permission::create(['name' => $setRole.'-show']);
                    $permission->assignRole($role);
                    $permission = Permission::create(['name' => $setRole.'-update']);
                    $permission->assignRole($role);
                    $permission = Permission::create(['name' => $setRole.'-destroy']);
                    $permission->assignRole($role);
                }
            }
        }
        //user load
        $allRoles = Role::all()->reject(function($item) {
            return $item->name == 'super_admin';
        });
        
        $userData = User::find($id);
        $this->data['page_name'] = "User Update";
        $this->data['page_desc'] = "User Update";
        $this->data['btn_name'] = "User Manager";       
        $this->data['btn_route'] = route('users.index');         
        $this->data['submit_btn'] = 'Update User';
        $this->data['route'] = route('users.update', $userData); 
        $this->data['user'] =  $userData;      
        $this->data['update'] =  true;  
        $this->data['all_roles'] =  $allRoles;        
        return view('admin.user.modify', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'email' => 'required|unique:users,name,'.$user->id,
            'name' => 'required',
            'designation' => 'required',           
                    ]);                          
        $user->name = $request->name;
        $user->designation = $request->designation;
        $user->email = $request->email;
        $user->spares = $request->spares;
        $user->machine = $request->machine;
        $user->workshop = $request->workshop;
        $user->super_admin = $request->super_admin;      
        $user->save();
        if ($request->super_admin == '1'){
            $user->syncRoles('super_admin');
        }elseif(!empty($request->permissions)){            
            $user->syncRoles($request->permissions);
        }        
              return redirect()->route('users.index')->with('status', 'User Updates Successfully');       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->deleted_by = Auth::id();
        $user->save();
        $user->delete();
        return redirect()->route('users.index')->with('status', 'User Deleted Successfully')->with('delete');
    }
}
