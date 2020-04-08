<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SparePart\StoreSparePart;
use App\Http\Requests\Admin\SparePart\UpdateSparePart;
use App\Model\Admin\Brand;
use App\Model\Admin\Machine;
use App\Model\Admin\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SparePartController extends Controller
{

    private $name = "";
    private $routeName = "";
    private $viewName = "";
    private $mainTable = "";
    private $data = [];

    public function __construct(SparePart $sparePart)
    {
        $this->name = "Spare Parts" . " ";
        $this->routeName = "spare_parts" . ".";
        $this->viewName = "admin.sparepart" . ".";
        $this->mainTable = $sparePart;
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


    
              
        $spare_parts =  $this->mainTable;

        if ($request->id != "") {
         $spare_parts = $spare_parts->Where('id',  $request->id);
        }
        if ($request->name != "") {
            $spare_parts = $spare_parts->Where('name',  $request->name);
           }
        if ($request->part_number != "") {
         $spare_parts =  $spare_parts->Where('part_number',  $request->part_number);       
        }
        $commonSearch  =  ['brand_id','machine_id'];
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
        $this->data['machines'] = Machine::all();
        $this->data['brands'] =  Brand::all();
        $this->data['route_name'] =  $this->routeName;
        $this->data['search'] =  true;
        // if ($request->old('brand_id')) {
        //     $this->data['models'] =  Brand::find($request->old('brand_id'))->models;            
        // }
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
       
        //dd($this->data);
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSparePart $request)
    {
        $this->mainTable::create($request->all()) ;
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */
    public function show(SparePart $sparePart)
    {
        $this->data['page_name'] = $this->name . "Update";
        $this->data['page_desc'] = $this->name . "Update";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] =  $this->name . ' Update';
        $this->data['route'] = route($this->routeName . 'update', $sparePart);
        $this->data['object'] =  $sparePart;
        $this->data['brands'] =  Brand::all();
        $this->data['machines'] =  Brand::all();
        $this->data['models'] =  Brand::find($sparePart->brand_id)->models;
        $this->data['update'] =  true;
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */

 
    public function edit(SparePart $sparePart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */
    public function update(StoreSparePart $request, SparePart $sparePart)
    {
         
        $sparePart->name = $request->name;
        $sparePart->brand_id = $request->brand_id;
        $sparePart->brand_model_id = $request->brand_model_id;
        $sparePart->machine_id = $request->machine_id;
        $sparePart->part_number = $request->part_number;
        $sparePart->market_rate = $request->market_rate;
        $sparePart->remark = $request->remark;     
        $sparePart->save();
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Updates Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\SparePart  $sparePart
     * @return \Illuminate\Http\Response
     */
    public function destroy(SparePart $sparePart)
    {
        $sparePart->deleted_by = Auth::id();
        $sparePart->save();
        $sparePart->delete();
        return redirect()->route($this->routeName . 'index')->with('status', $this->name . ' Deleted Successfully')->with('delete');
    }
}