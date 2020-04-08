<?php

namespace App\Http\Controllers\SparePart;

use App\AdminData;
use App\Enums\SparePart\CustomerType;
use App\Enums\SparePart\InvoiceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\SparePart\StoreGin;
use App\Model\Admin\Customer;
use App\Model\Admin\SparePart;
use App\Model\SparePart\CustomerPo;
use App\Model\SparePart\SpareGin;
use App\Model\SparePart\SpareInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpareGinController extends Controller
{
    private $name = "";
    private $routeName = "";
    private $viewName = "";
    private $mainTable = "";
    private $data = [];


    public function __construct(SpareGin $spareGin)
    {
 
        
        $this->name = "Spare GIN" . " ";
        $this->routeName = "spare_gin" . ".";
        $this->viewName = "spare.gin" . ".";
        $this->mainTable = $spareGin;
        $this->data['main_icon'] = "pe-7s-car";
        $this->data['btn_icon'] = "fa-bus";      
        $this->data['invoices'] = SpareInvoice::doesnthave('spare_gins')->orderBy('id', 'DESC')->get();          
       
    }

    
    public function print(SpareGin $spareGin)
    {
        //
    }
    public function index(Request $request)
    {
        $invoice =  $this->mainTable;

        $startDate = date('Y-m-d', strtotime($request->start_date));
        $endDate = date('Y-m-d', strtotime($request->end_date));

        if ($startDate != "" && $startDate != "1970-01-01" &&  $endDate != "" &&  $endDate != "1970-01-01" ) {
            $invoice = $invoice->whereBetween('date', [$startDate, $endDate]);
        }


        if ($request->id != "") {
            $invoice = $invoice->Where('id', "LIKE",  "%" . $request->id . "%");
        }

        if ($request->invoice_number != "") {
            $invoice = $invoice->Where('invoice_number', "LIKE",  "%" . $request->invoice_number . "%");
          //  dd($request->invoice_number );
        }

        if ($request->date_1 != "" && $request->date_2 != "") {
            //dd($request);
            $invoice = $invoice->Where('id',  $request->id);
        }
      
     

        $commonSearch  =  ['supplier_id', 'spare_po_id'];
        foreach ($commonSearch as $key) {
            if ($request->$key != "" && is_numeric($request->$key) &&  $request->$key != 0) {
                $invoice = $invoice->Where($key,  $request->$key);
            }
        }
        $this->data['objects'] =  $invoice->paginate(5);
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
    public function create(SpareGin $spareGin)
    {
       
        $this->data['object'] =  $this->mainTable;
        $this->data['page_name'] = $this->name . "Add";
        $this->data['page_desc'] = $this->name . "Add";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] = $this->name . 'To System';      
        $this->data['route'] = route($this->routeName . 'store');       
        $this->data['name'] = $this->name;
        return view($this->viewName . 'form', $this->data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upsert(StoreGin $request)
    {   
        if($request->id){
            SpareGin::where('id' , $request->id)->update($request->all());
            $invoiceId = $request->id;
        }else{
            $invoiceId =  $this->mainTable::create($request->all())->id;          
        }        
        $savedInvoice = $this->mainTable::find($invoiceId);
        return ['success' => true , 'property' => $savedInvoice ];
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SparePart\SpareGin  $spareGin
     * @return \Illuminate\Http\Response
     */
    public function show(SpareGin $spareGin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SparePart\SpareGin  $spareGin
     * @return \Illuminate\Http\Response
     */
    public function edit(SpareGin $spareGin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SparePart\SpareGin  $spareGin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpareGin $spareGin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SparePart\SpareGin  $spareGin
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpareGin $spareGin)
    {
        $spareGin->deleted_by = Auth::id();
        $spareGin->save();
        $spareGin->delete();
       return redirect()->route($this->routeName . 'index')->with('status', $this->name . ' Deleted Successfully')->with('delete');
    }
}