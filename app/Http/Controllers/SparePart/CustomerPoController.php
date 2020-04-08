<?php

namespace App\Http\Controllers\SparePart;

use App\Http\Controllers\Controller;
use App\Model\Admin\Customer;
use App\Model\SparePart\CustomerPo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerPoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $name = "";
    private $routeName = "";
    private $viewName = "";
    private $mainTable = "";
    private $data = [];

    public function __construct(CustomerPo $customerPo)
    {
       
        $this->name = "CustomerPo"." ";
        $this->routeName = "customer_pos".".";
        $this->viewName = "spare.customer_po".".";
        $this->mainTable = $customerPo;
       
        $this->data['main_icon'] = "pe-7s-bandaid";
        $this->data['btn_icon'] = "fa-align-right";
        $this->data['customers'] =  Customer::all();

    }

    public function index()
    {
        
        $this->data['page_name'] = $this->name."Manager";
        $this->data['page_desc'] = $this->name."Manager";
        $this->data['btn_name'] =  $this->name."Add";       
        $this->data['btn_route'] = route($this->routeName.'create');
        $this->data['objects'] =  $this->mainTable::all() ;   
        $this->data['route_name'] =  $this->routeName ;       
        // dd($this->data);    
        return view($this->viewName.'index',  $this->data);
        //dd($this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        $this->data['object'] =  $this->mainTable;      
        $this->data['page_name'] = $this->name."Add";
        $this->data['page_desc'] = $this->name."Add";
        $this->data['btn_name'] = $this->name."Manager";       
        $this->data['btn_route'] = route($this->routeName.'index');       
        $this->data['submit_btn'] = $this->name.'To System';
        $this->data['route'] = route($this->routeName.'store');    
        $this->data['update'] =  false;       
        return view($this->viewName.'form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate(['name' => 'required|unique:units']);
        $user  = $this->mainTable::create($request->all());        
        return redirect()->route($this->routeName.'index')->with('status',   $this->name .' Added Successfully.'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SparePart\CustomerPo  $customerPo
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerPo $customerPo)
    {
      // dd($customerPo);
        $this->data['page_name'] = $this->name."Update";
        $this->data['page_desc'] = $this->name."Update";
        $this->data['btn_name'] = $this->name."Manager";       
        $this->data['btn_route'] = route($this->routeName.'index');         
        $this->data['submit_btn'] =  $this->name.' Update';       
        $this->data['route'] = route($this->routeName.'update', $customerPo);         
        $this->data['object'] =  $customerPo;      
        $this->data['update'] =  true;        
        return view($this->viewName.'form', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SparePart\CustomerPo  $customerPo
     * @return \Illuminate\Http\Response
     */
    public function edit(CustomerPo $customerPo)
    {
        //save edited changes
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SparePart\CustomerPo  $customerPo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerPo $customerPo)
    {
        
        $request->validate([
            'name' => 'required|unique:users,name,'.$customerPo->id,
               
                    ]);
                          
        $customerPo->name = $request->name;           
        $customerPo->save();
        return redirect()->route($this->routeName.'index')->with('status',   $this->name .' Updates Successfully');   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SparePart\CustomerPo  $customerPo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerPo $customerPo)
    {
        $customerPo->deleted_by = Auth::id();
        $customerPo->save();
        $customerPo->delete();
        return redirect()->route($this->routeName.'index')->with('status', $this->name .' Deleted Successfully')->with('delete');
    }
}
