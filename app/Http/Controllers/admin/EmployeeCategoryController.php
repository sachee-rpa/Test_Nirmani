<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Admin\EmployeeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeCategoryController extends Controller
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

    public function __construct(EmployeeCategory $employeeCategory)
    {
        $this->name = "Employee Category" . " ";
        $this->routeName = "employee_categories" . ".";
        $this->viewName = "admin.employee_category" . ".";
        $this->mainTable = $employeeCategory;
        $this->data['main_icon'] = "pe-7s-car";
        $this->data['btn_icon'] = "fa-bus";
    }

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
        // dd($request);
        $request->validate(['name' => 'required|unique:employee_categories']);
        $user  = $this->mainTable::create($request->all());

        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\EmployeeCategory  $employeeCategory
     * @return \Illuminate\Http\Response
     */
    public function show(EmployeeCategory $employeeCategory)
    {

        $this->data['page_name'] = $this->name . "Update";
        $this->data['page_desc'] = $this->name . "Update";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] =  $this->name . ' Update';
        $this->data['route'] = route($this->routeName . 'update', $employeeCategory);
        $this->data['object'] =  $employeeCategory;
        $this->data['update'] =  true;

        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\EmployeeCategory  $employeeCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(EmployeeCategory $employeeCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\EmployeeCategory  $employeeCategory
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EmployeeCategory $employeeCategory)
    {


        $request->validate([
            'name' => 'required|unique:users,name,' . $employeeCategory->id,

        ]);

        $employeeCategory->name = $request->name;
        $employeeCategory->save();
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Updates Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\EmployeeCategory  $employeeCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(EmployeeCategory $employeeCategory)
    {
        $employeeCategory->deleted_by = Auth::id();
        $employeeCategory->save();
        $employeeCategory->delete();
        return redirect()->route($this->routeName . 'index')->with('status', $this->name . ' Deleted Successfully')->with('delete');
    }
}
