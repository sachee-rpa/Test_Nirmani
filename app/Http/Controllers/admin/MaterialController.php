<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Material\StoreMaterial;
use App\Model\Admin\Brand;
use App\Model\Admin\Material;
use App\Model\Admin\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MaterialController extends Controller
{
    private $name = "";
    private $routeName = "";
    private $viewName = "";
    private $mainTable = "";
    private $data = [];

    public function __construct(Material $material)
    {
        $this->name = "Material" . " ";
        $this->routeName = "materials" . ".";
        $this->viewName = "admin.material" . ".";
        $this->mainTable = $material;
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

        $commonSearch  =  ['brand_id','unit_id'];
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
        $this->data['units'] =  Unit::all();
        $this->data['brands'] =  Brand::all();
        $this->data['route_name'] =  $this->routeName;
        $this->data['search'] =  true;
        $this->data['btn_search_name'] = $this->name . 'Search';
        $this->data['btn_reset'] = route($this->routeName . 'index');
          //dd($this->data);
        $this->data['route_name'] =  $this->routeName;
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
        $this->data['units'] = Unit::all();
        $this->data['brands'] =  Brand::all();
        $this->data['update'] =  false;
        
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMaterial $request)
    {
        $this->mainTable::create($request->all()) ;
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function show(Material $material)
    {
        $this->data['page_name'] = $this->name . "Update";
        $this->data['page_desc'] = $this->name . "Update";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] =  $this->name . ' Update';
        $this->data['route'] = route($this->routeName . 'update', $material);
        $this->data['object'] = $material;
        $this->data['brands'] = Brand::all();
        $this->data['units'] =  Unit::all();        
        $this->data['update'] =  true;
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Material $material)
    {
       
        $material->name = $request->name;
        $material->brand_id = $request->brand_id;   
        $material->unit_id = $request->unit_id;      
        $material->market_rate = $request->market_rate;
        $material->remark = $request->remark;        
        $material->save();
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Updates Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\Material  $material
     * @return \Illuminate\Http\Response
     */
    public function destroy(Material $material)
    {
        $material->deleted_by = Auth::id();
        $material->save();
        $material->delete();
        return redirect()->route($this->routeName . 'index')->with('status', $this->name . ' Deleted Successfully')->with('delete');
    }
}