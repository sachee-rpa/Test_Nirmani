<?php

namespace App\Http\Controllers\SparePart;

use App\AdminData;
use App\Enums\Condition;
use App\Enums\Quality;
use App\Http\Controllers\Controller;
use App\Http\Requests\SparePart\StoreGrn;
use App\Model\Admin\Country;
use App\Model\Admin\Currency;
use App\Model\Admin\SparePart;
use App\Model\Admin\Supplier;
use App\Model\SparePart\SpareGrn;
use App\Model\Admin\Unit;
use App\Model\SparePart\SpareGrnItem;
use App\Model\SparePart\SparePo;
 
use App\SparePart\Grn\SpareGrnCredit;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class SpareGrnController extends Controller
{
     
    private $name = "";
    private $routeName = "";
    private $viewName = "";
    private $mainTable = "";
    private $data = [];

    public function __construct(SpareGrn $spareGrn)
    {

        $conditions = [];
        $qualities = [];
        foreach (Condition::toSelectArray() as $key => $value) {
            array_push( $conditions, array('id' => $key, 'name' => $value));
        }
        foreach (Quality::toSelectArray() as $key => $value) {
            array_push( $qualities, array('id' => $key, 'name' => $value));
        }

        
        $this->name = "Spare Grn" . " ";
        $this->routeName = "spare_grn" . ".";
        $this->viewName = "spare.grn" . ".";
        $this->mainTable = $spareGrn;
        $this->data['main_icon'] = "pe-7s-car";
        $this->data['btn_icon'] = "fa-bus";
        $this->data['suppliers'] =  Supplier::all();
        $this->data['countries'] =  Country::all();        
        $this->data['spareparts'] =  SparePart::all();   
        $this->data['currencies'] =  Currency::all(); 
        $this->data['spare_grns'] =  SpareGrn::all(); 
        $this->data['spare_po_search'] =  SparePo::all(); 
        //dd($this->data['spare_po_search'] );
        $this->data['spare_pos'] =  SparePo::select('id')->get(); 
        $this->data['selling_percentage'] =  AdminData::getValue('selling_percentage'); 
       
        $this->data['units'] =  Unit::all(); 
        // enum passing as json object
        $this->data['conditions'] =    json_encode($conditions); 
        $this->data['qualities'] =   json_encode($qualities);      
    }

    public function getGrnItem(SpareGrnItem $spareGrnItem)
    {      
         return ['success' =>   true ,'available' => $spareGrnItem->available ];
    }
    
    public function getGrnItems(SparePart $sparePart)
    {      
        $grn = SpareGrnItem::select(  
        'id',  
        'unit_id',
        'quantity',
        'condition',
        'quality',
        'unit_sell_price',
        'spare_parts_id'      
        )->where('spare_parts_id' , $sparePart->id)->get() ;

        $grn = $grn->filter(function ($item) {
            return $item->available > 0;
        })->values();
          return ['success' => ($grn->isEmpty())? false : true ,'grn' => $grn ];
    }

    public function index(Request $request)
    {
        $po =  $this->mainTable;

        $startDate = date('Y-m-d', strtotime($request->start_date));
        $endDate = date('Y-m-d', strtotime($request->end_date));

        if ($startDate != "" && $startDate != "1970-01-01" &&  $endDate != "" &&  $endDate != "1970-01-01" ) {
            $po = $po->whereBetween('date', [$startDate, $endDate]);
        }


        if ($request->id != "") {
            $po = $po->Where('id', "LIKE",  "%" . $request->id . "%");
        }

        if ($request->invoice_number != "") {
            $po = $po->Where('invoice_number', "LIKE",  "%" . $request->invoice_number . "%");
          //  dd($request->invoice_number );
        }

        if ($request->date_1 != "" && $request->date_2 != "") {
            //dd($request);
            $po = $po->Where('id',  $request->id);
        }
      
     

        $commonSearch  =  ['supplier_id', 'spare_po_id'];
        foreach ($commonSearch as $key) {
            if ($request->$key != "" && is_numeric($request->$key) &&  $request->$key != 0) {
                $po = $po->Where($key,  $request->$key);
            }
        }
        $this->data['objects'] =  $po->paginate(5);
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

    public function print(SpareGrn $spareGrn){
        return view($this->viewName.'print',['spareGrn' => $spareGrn]);
      }
    public function upsert(StoreGrn $request)
    {
   
        $grnId = 0;
        $items = $request->items;
       
        unset($request['items']);
   
    
        if($request->id){
            SpareGrn::where('id' , $request->id)->update($request->all());
            $grnId = $request->id;
        }else{
            $grnId =  $this->mainTable::create($request->all())->id;          
        }        
        foreach ($items  as $key => $item) {   
            $item['spare_grn_id'] = $grnId;  
            if(Arr::exists($item, 'id')){
                $grnItem  = SpareGrnItem::find($item['id']); 
                $grnItem->update($item);              
            }else{
                $grnItem = SpareGrnItem::create($item);
            } 
            SpareGrnCredit::addGrnCreditGRN($grnItem->id, $grnItem->spare_parts_id, $grnItem->quantity) ;         
                            
        }
         $savedGrn = $this->mainTable::find($grnId);
         $savedGrn->items ;
     
         return ['success' => true , 'property' => $savedGrn ];
    }

    public function removeGrnItem(SpareGrnItem $spareGrnItem)
    {
         $grnId = $spareGrnItem->spare_grn_id;  
         $spareGrnItem->deleted_by = Auth::id();  
         $spareGrnItem->save();       
         $spareGrnItem->delete();         
         return ['success' => true, 'items' => SpareGrnItem::where('spare_grn_id', $grnId )->get()];
    }
    /**
     * removeGrnItem
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SpareGrn $spareGrn)
    {
     
        $this->authorize('manage', $spareGrn);
      
        $this->data['object'] =  $this->mainTable;
        $this->data['page_name'] = $this->name . "Add";
        $this->data['page_desc'] = $this->name . "Add";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] = $this->name . 'To System';      
        $this->data['route'] = route($this->routeName . 'store');       
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SparePart\SpareGrn  $spareGrn
     * @return \Illuminate\Http\Response
     */
    public function show(SpareGrn $spareGrn)
    {
        $spareGrn = $spareGrn;
        $spareGrn->items ;
        $this->data['grn'] =  $spareGrn; 
        $this->authorize('manage', $spareGrn);
        $this->data['object'] =  $this->mainTable;
        $this->data['page_name'] = $this->name . "Add";
        $this->data['page_desc'] = $this->name . "Add";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] = $this->name . 'To System';      
        $this->data['route'] = route($this->routeName . 'store');       
        return view($this->viewName . 'form', $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\SparePart\SpareGrn  $spareGrn
     * @return \Illuminate\Http\Response
     */
    public function edit(SpareGrn $spareGrn)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SparePart\SpareGrn  $spareGrn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpareGrn $spareGrn)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SparePart\SpareGrn  $spareGrn
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpareGrn $spareGrn)
    {
      
        foreach ($spareGrn->items as $key => $item) {
            $item->deleted_by = Auth::id();
            $item->save();
            $item->delete();
        }   
         $spareGrn->deleted_by = Auth::id();
         $spareGrn->save();
         $spareGrn->delete();
        return redirect()->route($this->routeName . 'index')->with('status', $this->name . ' Deleted Successfully')->with('delete');
    }
}