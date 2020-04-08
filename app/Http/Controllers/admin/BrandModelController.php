<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\Brand;
use App\Model\Admin\BrandModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandModelController extends Controller
{

    private $name = "";
    private $routeName = "";
    private $viewName = "";
    private $mainTable = "";
    private $data = [];
   
    public function __construct(BrandModel $brandModel)
    {
        $this->name = "Model" . " ";
        $this->routeName = "brand_models" . ".";
        $this->viewName = "admin.brand_model" . ".";
        $this->mainTable = $brandModel;
        $this->data['main_icon'] = "pe-7s-car";
        $this->data['btn_icon'] = "fa-bus";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['page_name'] = $this->name . "Manager";
        $this->data['page_desc'] = $this->name . "Manager";
        $this->data['btn_name'] =  $this->name . "Add";
        $this->data['btn_route'] = route($this->routeName . 'create');
        $this->data['objects'] =  $this->mainTable::all();
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
        $this->data['update'] =  false;
        $this->data['brands'] =  Brand::all();
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
    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required',
            'name' => 'required|unique:brand_models'            
            ]);
        $this->mainTable::create($request->all());
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\BrandModel  $brandModel
     * @return \Illuminate\Http\Response
     */
    public function show(BrandModel $brandModel)
    {
        $this->data['page_name'] = $this->name . "Update";
        $this->data['page_desc'] = $this->name . "Update";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] =  $this->name . ' Update';
        $this->data['route'] = route($this->routeName . 'update', $brandModel);
        $this->data['object'] =  $brandModel;
        $this->data['brands'] =  Brand::all();
        $this->data['update'] =  true;
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\BrandModel  $brandModel
     * @return \Illuminate\Http\Response
     */
    public function edit(BrandModel $brandModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\BrandModel  $brandModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BrandModel $brandModel)
    {
        $request->validate([
            'brand_id' => 'required',
            'name' => 'required|unique:users,name,' . $brandModel->id,

        ]);
        $brandModel->name = $request->name;
        $brandModel->brand_id = $request->brand_id;
        $brandModel->save();
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Updates Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\BrandModel  $brandModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(BrandModel $brandModel)
    {
        $brandModel->deleted_by = Auth::id();
        $brandModel->save();
        $brandModel->delete();
        return redirect()->route($this->routeName . 'index')->with('status', $this->name . ' Deleted Successfully')->with('delete');
    }
}
