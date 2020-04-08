<?php

namespace App\Http\Controllers\Overhead;

use App\Http\Controllers\Controller;
use App\Http\Requests\overHead\SubAccount as SubReq;
use App\Model\Overhead\SubAccount;
use App\Model\Overhead\Account;
use Illuminate\Http\Request;

class SubAccountController extends Controller
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

    public function __construct(SubAccount $subAccount)
    {
        $this->name = "Sub Account" . " ";
        $this->routeName = "sub_accounts" . ".";
        $this->viewName = "services_and_overhead.sub_account" . ".";
        $this->mainTable = $subAccount;
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
        $this->data['accounts'] =  Account::all();
        // dd($this->data['accounts']);
        $this->data['selected_brand'] =  0;

        // dd($this->data);
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubReq $request)
    {
        $this->mainTable::create($request->all());
        return redirect()->route($this->routeName . 'index')->with('status',   $this->name . ' Added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Overhead\SubAccount  $subAccount
     * @return \Illuminate\Http\Response
     */
    public function show(SubAccount $subAccount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Overhead\SubAccount  $subAccount
     * @return \Illuminate\Http\Response
     */
    public function edit(SubAccount $subAccount)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Overhead\SubAccount  $subAccount
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubAccount $subAccount)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Overhead\SubAccount  $subAccount
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubAccount $subAccount)
    {
        //
    }
}