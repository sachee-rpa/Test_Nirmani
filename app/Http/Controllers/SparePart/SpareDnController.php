<?php

namespace App\Http\Controllers\SparePart;

use App\Http\Controllers\Controller;
use App\Http\Requests\SparePart\StoreDn;
use App\Model\SparePart\SpareDn;
use App\Model\SparePart\SpareGin;
use Illuminate\Http\Request;

class SpareDnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(SpareDn $spareDn)
    {
 
        $this->name = "Spare DN" . " ";
        $this->routeName = "spare_dn" . ".";
        $this->viewName = "spare.dn" . ".";
        $this->mainTable = $spareDn;
        $this->data['main_icon'] = "pe-7s-car";
        $this->data['btn_icon'] = "fa-bus";  
        $this->data['gins'] = SpareGin::doesnthave('spare_dns')->orderBy('id', 'DESC')->get();          
      
    }
    public function print(SpareDn $spareDn)
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
    public function create()
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
    public function upsert(StoreDn $request)
    {   
        if($request->id){
            spareDn::where('id' , $request->id)->update($request->all());
            $dnId = $request->id;
        }else{
            $dnId =  $this->mainTable::create($request->all())->id;          
        }        
        $savedInvoice = $this->mainTable::find($dnId);
        return ['success' => true , 'property' => $savedInvoice ];
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SparePart\SpareDn  $spareDn
     * @return \Illuminate\Http\Response
     */
    public function show(SpareDn $spareDn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SparePart\SpareDn  $spareDn
     * @return \Illuminate\Http\Response
     */
    public function edit(SpareDn $spareDn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SparePart\SpareDn  $spareDn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpareDn $spareDn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SparePart\SpareDn  $spareDn
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpareDn $spareDn)
    {
        //
    }
}