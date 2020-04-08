<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Machinery\StoreMachinery;
use App\Model\Admin\Brand;
use App\Model\Admin\Machine;
use App\Model\Admin\Machinery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MachineryController extends Controller
{
    private $name = "";
    private $routeName = "";
    private $viewName = "";
    private $mainTable = "";
    private $data = [];

    public function __construct(Machinery $machinery)
    {
        $this->name = "Machinery" . " ";
        $this->routeName = "machineries" . ".";
        $this->viewName = "admin.machinerie" . ".";
        $this->mainTable = $machinery;
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



        $machineries =  $this->mainTable;

        if ($request->id != "") {
         $machineries = $machineries->Where('id',  $request->id);
        }
        if ($request->name != "") {
            $machineries = $machineries->Where('name',  $request->name);
           }
        if ($request->email != "") {
         $machineries =  $machineries->Where('part_number',  $request->part_number);       
        }
        $commonSearch  =  ['brand_id','machine_id'];
        foreach($commonSearch as $key) {
           
         if ($request->$key != "" && is_numeric($request->$key) &&  $request->$key != 0) {
             $machineries = $machineries->Where($key,  $request->$key);        
             
            }
        }
        $this->data['objects'] =  $machineries->get();
        $this->data['page_name'] = $this->name . "Manager";
        $this->data['page_desc'] = $this->name . "Manager";
        $this->data['btn_name'] =  $this->name . "Add";
        $this->data['btn_route'] = route($this->routeName . 'create');
        $this->data['machines'] = Machine::all();
        $this->data['brands'] =  Brand::all();
        $this->data['route_name'] =  $this->routeName;
        $this->data['search'] =  true;
        // if ($request->old('brand_id')) {
        //     $this->data['models'] =  Brand::find($request->old('brand_id'))->models;            
        // }
        $this->data['btn_search_name'] = $this->name . 'Search';
        $this->data['btn_reset'] = route($this->routeName . 'index');
        $this->data['route_name'] =  $this->routeName;
        return view($this->viewName . 'index',  $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->data['object'] =  $this->mainTable;
        $this->data['page_name'] = $this->name . "Add";
        $this->data['page_desc'] = $this->name . "Add";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] = $this->name . 'To System';
        $this->data['route'] = route($this->routeName . 'store');    
        $this->data['machines'] = Machine::all();
        $this->data['brands'] =  Brand::all();
        $this->data['update'] =  false;
        if ($request->old('brand_id')) {
            $this->data['models'] =  Brand::find($request->old('brand_id'))->models;            
        }
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMachinery $request)
    {
        $this->mainTable::create($request->all()) ;
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\Machinery  $machinery
     * @return \Illuminate\Http\Response
     */
    public function show(Machinery $machinery)
    {
        $this->data['page_name'] = $this->name . "Update";
        $this->data['page_desc'] = $this->name . "Update";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] =  $this->name . ' Update';
        $this->data['route'] = route($this->routeName . 'update', $machinery);
        $this->data['object'] =  $machinery;
        $this->data['brands'] =  Brand::all();
        $this->data['machines'] =  Brand::all();
        $this->data['models'] =  Brand::find($machinery->brand_id)->models;
        $this->data['update'] =  true;
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\Machinery  $machinery
     * @return \Illuminate\Http\Response
     */
    public function edit(Machinery $machinery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\Machinery  $machinery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Machinery $machinery)
    {
        $machinery->name = $request->name;
        $machinery->brand_id = $request->brand_id;
        $machinery->brand_model_id = $request->brand_model_id;
        $machinery->machine_id = $request->machine_id;         
        $machinery->market_rate = $request->market_rate;
        $machinery->remark = $request->remark;     
        $machinery->save();
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Updates Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\Machinery  $machinery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Machinery $machinery)
    {
        $machinery->deleted_by = Auth::id();
        $machinery->save();
        $machinery->delete();
        return redirect()->route($this->routeName . 'index')->with('status', $this->name . ' Deleted Successfully')->with('delete');
    }
}