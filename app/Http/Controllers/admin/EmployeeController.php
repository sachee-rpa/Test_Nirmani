<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\Employee\StoreEmployee;
use App\Model\Admin\Employee;
use App\Model\Admin\EmployeeCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
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


    public function __construct(Employee $employee)
    {
        $this->name = "Employee" . " ";
        $this->routeName = "employees" . ".";
        $this->viewName = "admin.employee" . ".";
        $this->mainTable = $employee;
        $this->data['main_icon'] = "pe-7s-car";
        $this->data['btn_icon'] = "fa-bus";
    }
    public function index(Request $request)
    {

        $employees =  $this->mainTable;

        if ($request->id != "") {
         $employees = $employees->Where('id',  $request->id);
        }
        if ($request->name != "") {
            $employees = $employees->Where('name',  $request->name);
           }
        if ($request->nic != "") {
         $employees =  $employees->Where('nic',  $request->nic);       
        }
        $commonSearch  =  ['employee_category_id'];
        foreach($commonSearch as $key) {
           
         if ($request->$key != "" && is_numeric($request->$key) &&  $request->$key != 0) {
             $employees = $employees->Where($key,  $request->$key);        
             
            }
        }
        $this->data['objects'] =  $employees->get();
        $this->data['page_name'] = $this->name . "Manager";
        $this->data['page_desc'] = $this->name . "Manager";
        $this->data['btn_name'] =  $this->name . "Add";
        $this->data['btn_route'] = route($this->routeName . 'create');
        $this->data['employee_categories'] =  EmployeeCategory::all();
        $this->data['route_name'] =  $this->routeName;
        $this->data['search'] =  true;
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
        $this->data['categories'] =  EmployeeCategory::all();

        // dd($this->data['categories']);
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEmployee $request)
    {
       $employee = $this->mainTable::create($request->all());
        if ($request->hasFile('upload')) {
            $file = $request->upload;          
            $upload = 'emp_documents/' . time() .'_'. $file->getClientOriginalName();
             if (Storage::disk('s3')->put($upload, file_get_contents($file))) {                
                $employee->file = $upload;
                $employee->save();                       
             };
        }
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Admin\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {

        $this->data['page_name'] = $this->name . "Update";
        $this->data['page_desc'] = $this->name . "Update";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] =  $this->name . ' Update';
        $this->data['route'] = route($this->routeName . 'update', $employee);
        $this->data['object'] =  $employee;
        $this->data['categories'] =  EmployeeCategory::all();
        $this->data['update'] =  true;
        //  dd($this->data['categories']);
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Admin\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Admin\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {

        $employee->name = $request->name;
        $employee->initial = $request->initial;
        $employee->nic_number = $request->nic_number;
        $employee->employee_category_id = $request->employee_category_id;
        $employee->designation = $request->designation;
        $employee->join_date = $request->join_date;
        $employee->day_rate = $request->day_rate;
        $employee->ot_rate = $request->ot_rate;
        $employee->remark = $request->remark;
        $employee->save();
        if ($request->hasFile('upload')) {
            $file = $request->upload;          
            $upload = 'emp_documents/' . time() .'_'. $file->getClientOriginalName();
             if (Storage::disk('s3')->put($upload, file_get_contents($file))) {    
                Storage::disk('s3')->delete($employee->file);            
                $employee->file = $upload;
                $employee->save();                       
             };
        }

        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Updates Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Admin\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Storage::disk('s3')->delete($employee->file);     
        $employee->deleted_by = Auth::id();        
        $employee->save();
        $employee->delete();
        return redirect()->route($this->routeName . 'index')->with('status', $this->name . ' Deleted Successfully')->with('delete');
    }
}