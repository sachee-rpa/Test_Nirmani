<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customer\StoreCustomer;
use App\Model\Admin\Customer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class CustomerController extends Controller
{
    private $name = "";
    private $routeName = "";
    private $viewName = "";
    private $mainTable = "";
    private $data = [];

    public function __construct(Customer $customer)
    {
        $this->name = "Customer" . " ";
        $this->routeName = "customers" . ".";
        $this->viewName = "admin.customer" . ".";
        $this->mainTable = $customer;

        $this->data['main_icon'] = "pe-7s-car";
        $this->data['btn_icon'] = "fa-bus";
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
       
         
        // if ($request->email != "") {
        //     dd($request);
        //    }
              
        $customers =  $this->mainTable;

        if ($request->id != "") {
         $customers = $customers->Where('id',  $request->id);
        }
        if ($request->name != "") {
            $customers = $customers->Where('name',  $request->name);
           }
        if ($request->email != "") {
         $customers =  $customers->Where('email',  $request->email);       
        }
        // $commonSearch  =  ['id','name','email'];
        // foreach($commonSearch as $key) {
           
        //  if ($request->$key != "" && is_numeric($request->$key) &&  $request->$key != 0) {
        //      $customers = $customers->Where($key,  $request->$key);        
             
        //     }
        // }

         
           
        $this->data['objects'] =  $customers->get();
     
        $this->data['page_name'] = $this->name . "Manager";
        $this->data['page_desc'] = $this->name . "Manager";
        $this->data['btn_name'] =  $this->name . "Add";
        $this->data['btn_route'] = route($this->routeName . 'create');       
        $this->data['route_name'] =  $this->routeName;
        $this->data['search'] =  true;
        $this->data['btn_search_name'] = $this->name . 'Search';
        $this->data['btn_reset'] = route($this->routeName . 'index');
        return view($this->viewName . 'index',  $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['object'] =  $this->mainTable;
        $this->data['page_name'] = $this->name . "Add";
        $this->data['page_desc'] = $this->name . "Add";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] = $this->name . 'To System';
        $this->data['route'] = route($this->routeName . 'store');
        $this->data['update'] =  false;      
        //dd($this->data);
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomer $request)
    {
        $this->mainTable::create($request->all());
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        $this->data['page_name'] = $this->name . "Update";
        $this->data['page_desc'] = $this->name . "Update";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] =  $this->name . ' Update';
        $this->data['route'] = route($this->routeName . 'update', $customer);
        $this->data['object'] =  $customer;         
        $this->data['update'] =  true;
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function getDetails(Customer $customer)
    {
        return ['success' => true, 'customer' => $customer];
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
       $customer->name = $request->name;
       $customer->address = $request->address;
       $customer->vat = $request->vat;
       $customer->svat = $request->svat;
       $customer->fixed_line = $request->fixed_line;
       $customer->mobile = $request->mobile;
       $customer->fax = $request->fax;
       $customer->email = $request->email;
       $customer->credit = $request->credit;
       $customer->spare = $request->spare;
       $customer->machinery = $request->machinery;
       $customer->service = $request->service;
       $customer->discount_spare = $request->discount_spare;
       $customer->discount_machinery = $request->discount_machinery;
       $customer->discount_service = $request->discount_service;       
       $customer->remark = $request->remark;   
       $customer->save();
       return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Updates Successfully');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->deleted_by = Auth::id();
        $customer->save();
        $customer->delete();
        return redirect()->route($this->routeName . 'index')->with('status', $this->name . ' Deleted Successfully')->with('delete');
    }
}