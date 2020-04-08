<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Supplier\StoreSupplier;
use App\Model\Admin\Supplier;
use App\Model\Admin\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    private $name = "";
    private $routeName = "";
    private $viewName = "";
    private $mainTable = "";
    private $data = [];

    public function __construct(Supplier $supplier)
    {
        $this->name = "Supplier" . " ";
        $this->routeName = "suppliers" . ".";
        $this->viewName = "admin.supplier" . ".";
        $this->mainTable = $supplier;
        $this->data['main_icon'] = "pe-7s-car";
        $this->data['btn_icon'] = "fa-bus";
    }


    public function index(Request $request)
    {

        $spare_parts =  $this->mainTable;

        if ($request->id != "") {
         $spare_parts = $spare_parts->Where('id',  $request->id);
        }
        if ($request->name != "") {
            $spare_parts = $spare_parts->Where('name',  $request->name);
           }
        if ($request->email != "") {
         $spare_parts =  $spare_parts->Where('email',  $request->email);       
        }
        $commonSearch  =  ['country_id'];
        foreach($commonSearch as $key) {
           
         if ($request->$key != "" && is_numeric($request->$key) &&  $request->$key != 0) {
             $spare_parts = $spare_parts->Where($key,  $request->$key);        
             
            }
        }
        $this->data['objects'] =  $spare_parts->get();
        $this->data['page_name'] = $this->name . "Manager";
        $this->data['page_desc'] = $this->name . "Manager";
        $this->data['btn_name'] =  $this->name . "Add";
        $this->data['btn_route'] = route($this->routeName . 'create');
        $this->data['countries'] =  Country::all();
        $this->data['route_name'] =  $this->routeName;
        $this->data['search'] =  true;


        $this->data['btn_search_name'] = $this->name . 'Search';
        $this->data['btn_reset'] = route($this->routeName . 'index');
          //dd($this->data);
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
        $this->data['countries'] =  Country::all();
        $this->data['selected_brand'] =  0;

        //dd($this->data);
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplier $request)
    {     
        $this->mainTable::create($request->all());
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier )
    {
        
        $this->data['page_name'] = $this->name . "Update";
        $this->data['page_desc'] = $this->name . "Update";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] =  $this->name . ' Update';
        $this->data['route'] = route($this->routeName . 'update', $supplier);
        $this->data['object'] =  $supplier;
        $this->data['countries'] =  Country::all();
        $this->data['update'] =  true;
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSupplier $request, Supplier $supplier)
    {
         
 
        $supplier->name =  $request->name;
        $supplier->address = $request->address;
        $supplier->credit_period = $request->credit_period;
        $supplier->credit_limit = $request->credit_limit;
        $supplier->country_id = $request->country_id;
        $supplier->fixed_line = $request->fixed_line;
        $supplier->mobile =$request->mobile;
        $supplier->fax =$request->fax;
        $supplier->email =$request->email;
        $supplier->vat =$request->vat;
        $supplier->svat =$request->svat;
        $supplier->remark =$request->remark;
        $supplier->save();
       
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Updates Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->deleted_by = Auth::id();
        $supplier->save();
        $supplier->delete();
        return redirect()->route($this->routeName . 'index')->with('status', $this->name . ' Deleted Successfully')->with('delete');
    }
}
