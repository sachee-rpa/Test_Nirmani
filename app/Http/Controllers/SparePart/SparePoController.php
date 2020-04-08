<?php

namespace App\Http\Controllers\SparePart;

use App\Enums\Condition;
use App\Enums\Quality;
use App\Http\Controllers\Controller;
use App\Http\Requests\SparePart\StorePo as SparePartStorePo;
use App\Model\Admin\Country;
use App\Model\Admin\Currency;
use App\Model\Admin\SparePart;
use App\Model\Admin\Supplier;
use App\Model\SparePart\SparePo;
use App\Model\SparePart\SparePoItem;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class SparePoController extends Controller
{

    private $name = "";
    private $routeName = "";
    private $viewName = "";
    private $mainTable = "";
    private $data = [];

    public function __construct(SparePo $sparePo)
    {
        $this->name = "Spare PO" . " ";
        $this->routeName = "spare_po" . ".";
        $this->viewName = "spare.po" . ".";
        $this->mainTable = $sparePo;
        $this->data['main_icon'] = "pe-7s-car";
        $this->data['btn_icon'] = "fa-bus";
        $this->data['suppliers'] =  Supplier::all();
        $this->data['countries'] =  Country::all();        
        $this->data['spareparts'] =  SparePart::all();   
        $this->data['currencies'] =  Currency::all(); 
        $this->data['quotations'] =  SparePo::all();
        // enum passing as json object
        $this->data['conditions'] =  json_encode(Condition::toSelectArray()); 
        $this->data['qualities'] =  json_encode(Quality::toSelectArray());      
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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

        if ($request->quote_number != "") {
            $po = $po->Where('quote_number', "LIKE",  "%" . $request->quote_number . "%");
        }

        if ($request->date_1 != "" && $request->date_2 != "") {
            dd($request);
            $po = $po->Where('id',  $request->id);
        }
      
     

        $commonSearch  =  ['supplier_id', 'country_id'];
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
    public function print(SparePo $sparePo){

        echo "lksjdflkfj";
     // return view($this->viewName.'print',['sparePo' => $sparePo]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(SparePo $sparePo)
    {
        // $po = $this->mainTable::find(11);
        // $po->items ;
        // $this->data['po'] =  $po; 
        $this->authorize('manage', $sparePo);
        $this->data['object'] =  $this->mainTable;
        $this->data['page_name'] = $this->name . "Add";
        $this->data['page_desc'] = $this->name . "Add";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] = $this->name . 'To System';      
        $this->data['route'] = route($this->routeName . 'store');       
        return view($this->viewName . 'form', $this->data);
    }
 
    

    public function getPoItem(SparePo $sparePo)
    {
        $sparePo->items;        
        return ['success' => true , 'po' => $sparePo ];
    }
    public function upsert(SparePartStorePo $request)
    {
   
        $poId = 0;
        $items = $request->items;
        unset($request['items']);
        if($request->id){
            SparePo::where('id' , $request->id)->update($request->all());
            $poId = $request->id;
        }else{
            $poId =  $this->mainTable::create($request->all())->id;          
        }
        
        foreach ($items  as $key => $item) {   
            $item['spare_po_id'] = $poId;          
            if(Arr::exists($item, 'id')){
                SparePoItem::where('id' , $item['id'])->update($item); 
            }else{
                SparePoItem::create($item);
            }                     
        }

        $savedPO = $this->mainTable::find($poId);
        $savedPO->items ;
        return ['success' => true , 'po' => $savedPO ];
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SparePartStorePo $request)
    {
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SparePart\SparePo  $sparePo
     * @return \Illuminate\Http\Response
     */
    public function show(SparePo $sparePo)
    {
        $po = $sparePo;
        $po->items ;
        $this->data['po'] =  $po; 
        $this->authorize('manage', $sparePo);
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
     * @param  \App\Model\SparePart\SparePo  $sparePo
     * @return \Illuminate\Http\Response
     */
    public function removePoItem(SparePoItem $SparePoItem)
    {
         //$this->authorize('delete',$category);
         $poId = $SparePoItem->spare_po_id;  
         $SparePoItem->deleted_by = Auth::id();  
         $SparePoItem->save(); 
         $SparePoItem->delete();         
         return ['success' => true, 'items' => SparePoItem::where('spare_po_id', $poId )->get()];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SparePart\SparePo  $sparePo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SparePo $sparePo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SparePart\SparePo  $sparePo
     * @return \Illuminate\Http\Response
     */
    public function destroy(SparePo $sparePo)
    {

        foreach ($sparePo->items as $key => $item) {
            $item->deleted_by = Auth::id();
            $item->save();
            $item->delete();
        }   
        $sparePo->deleted_by = Auth::id();
        $sparePo->save();
        $sparePo->delete();
        return redirect()->route($this->routeName . 'index')->with('status', $this->name . ' Deleted Successfully')->with('delete');
    }
}