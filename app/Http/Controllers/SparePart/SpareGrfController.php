<?php

namespace App\Http\Controllers\SparePart;

use App\Http\Controllers\Controller;
use App\Http\Requests\SparePart\StoreGrf;
use App\Model\SparePart\SpareGin;
use App\Model\SparePart\SpareGrf;
use App\Model\SparePart\SpareGrfItems;
use App\Model\SparePart\SpareInvoice;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SpareGrfController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(SpareGrf $spareGrf)
    {
 
        $this->name = "Spare GRF" . " ";
        $this->routeName = "spare_grf" . ".";
        $this->viewName = "spare.grf" . ".";
        $this->mainTable = $spareGrf;
        $this->data['main_icon'] = "pe-7s-car";
        $this->data['btn_icon'] = "fa-bus";  
        $this->data['gins'] = SpareGin::doesnthave('spare_grfs')->orderBy('id', 'DESC')->get();          
      
    }
    public function index()
    {
        //
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
    public function upsert(StoreGrf $request)
    {
        $invoiceId = 0;
        $returnItems = [];
        $items = $request->invoice['items'];
        $updateTotal = false;
       
      
        if($request->id){
            StoreGrf::where('id' , $request->id)->update($request->all());
            $grfId = $request->id;
        }else{
            $grfId =  $this->mainTable::create($request->all())->id;          
        }        
        if ($grfId) {
            StoreGrf::find( $grfId )->spare_gin;
        }
        dd($grfId );
        foreach ($items  as $key => $item) {   
                  
        }
        $savedGrf = $this->mainTable::find($grfId);
        dd($savedGrf);
        return ['success' => true , 'property' => $savedGrf ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SparePart\SpareGrf  $spareGrf
     * @return \Illuminate\Http\Response
     */
    public function show(SpareGrf $spareGrf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SparePart\SpareGrf  $spareGrf
     * @return \Illuminate\Http\Response
     */
    public function edit(SpareGrf $spareGrf)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SparePart\SpareGrf  $spareGrf
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpareGrf $spareGrf)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SparePart\SpareGrf  $spareGrf
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpareGrf $spareGrf)
    {
        //
    }
}