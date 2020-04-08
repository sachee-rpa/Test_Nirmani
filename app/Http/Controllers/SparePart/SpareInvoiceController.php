<?php

namespace App\Http\Controllers\SparePart;

use App\AdminData;
use App\Enums\SparePart\CustomerType;
use App\Enums\SparePart\InvoiceType;
use App\Http\Controllers\Controller;
use App\Http\Requests\SparePart\StoreInvoice;
use App\Model\Admin\Customer;
use App\Model\Admin\SparePart;
use App\Model\SparePart\CustomerPo;
use App\Model\SparePart\SpareGrnItem;
use App\Model\SparePart\SpareInvoice;
use App\Model\SparePart\SpareInvoiceItems;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class SpareInvoiceController extends Controller
{
    private $name = "";
    private $routeName = "";
    private $viewName = "";
    private $mainTable = "";
    private $data = [];

    public function __construct(SpareInvoice $spareInvoice)
    {

        $customerType = [];
        $invoiceType = [];
        foreach (CustomerType::toSelectArray() as $key => $value) {
            array_push( $customerType, array('id' => $key, 'name' => $value));
        }
        foreach (InvoiceType::toSelectArray() as $key => $value) {
            array_push( $invoiceType, array('id' => $key, 'name' => $value));
        }

        
        $this->name = "Spare Invoice" . " ";
        $this->routeName = "spare_invoice" . ".";
        $this->viewName = "spare.invoice" . ".";
        $this->mainTable = $spareInvoice;
        $this->data['main_icon'] = "pe-7s-car";
        $this->data['btn_icon'] = "fa-bus";
        $this->data['customers'] =  Customer::all();        
        $this->data['spareparts'] =  SparePart::all();   
        $this->data['customer_pos'] =  CustomerPo::all();       
        $this->data['nbt_percentage'] =  AdminData::getValue('nbt_percentage');
       
        $this->data['vat_percentage'] =  AdminData::getValue('vat_percentage'); 
        $this->data['customer_types'] =    json_encode($customerType); 
        $this->data['invoice_types'] =   json_encode($invoiceType);      
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

    public function print(SpareInvoice $spareInvoice){
        return view($this->viewName.'print',['spareInvoice' => $spareInvoice]);
      }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getInvoice(SpareInvoice $spareInvoice)
    {      
        $spareInvoice->items;   
        $spareInvoice->items = $spareInvoice->items->map(function ($item) {
            $item['spare_name'] = $item->spare_parts->name ;
            return $item;
        });        
         return ['success' =>   true ,'invoice' => $spareInvoice ];
    }
    
    public function create(SpareInvoice $spareInvoice)
    {
       
        $this->data['object'] =  $this->mainTable;
        $this->data['page_name'] = $this->name . "Add";
        $this->data['page_desc'] = $this->name . "Add";
        $this->data['btn_name'] = $this->name . "Manager";
        $this->data['btn_route'] = route($this->routeName . 'index');
        $this->data['submit_btn'] = $this->name . 'To System';      
        $this->data['route'] = route($this->routeName . 'store');       
        return view($this->viewName . 'form', $this->data);
    }

    public function removeInvoiceItem(SpareInvoiceItems $spareInvoiceItems)
    {
         $invoiceId = $spareInvoiceItems->spare_invoice_id;  
         $spareInvoiceItems->deleted_by = Auth::id();  
         $spareInvoiceItems->save();       
         $spareInvoiceItems->delete();         
         return ['success' => true, 'items' => SpareInvoiceItems::where('spare_grn_id', $invoiceId )->get()];
    }


    public function upsert(StoreInvoice $request)
    {
   
        $invoiceId = 0;
        $items = $request->items;
        $updateTotal = false;
        unset($request['items']);
        unset($request['invoice_type_no']);
        unset($request['customer_type_no']);
        unset($request['invoice_label']);
        
        if($request->id){
            SpareInvoice::where('id' , $request->id)->update($request->all());
            $invoiceId = $request->id;
        }else{
            $invoiceId =  $this->mainTable::create($request->all())->id;          
        }        
        foreach ($items  as $key => $item) {   
            $item['spare_invoice_id'] = $invoiceId;
            $availableStock = SpareGrnItem::find($item['spare_grn_items_id'])->available;
            if ($availableStock <  $item['quantity'] ) {
                $item['quantity'] = $availableStock;
                $item['amount'] =  $item['quantity'] *  $item['rate']  ;
                $updateTotal =true;
            }
           if(Arr::exists($item, 'id')){
                $invoiceItem  = SpareInvoiceItems::find($item['id']); 
                $invoiceItem->update($item);              
            }else{               
                $invoiceItem = SpareInvoiceItems::create($item);
            } 
           
        }
        $savedInvoice = $this->mainTable::find($invoiceId);
        $savedInvoice->items ;
        if ($updateTotal) {
            $itemsTotal =  0;   
            foreach ( $savedInvoice->items  as $key => $item) {
                $itemsTotal+= $item['amount'];
            }
            $savedInvoice->sub_total =  $itemsTotal  ; 
            $savedInvoice->after_discount = $itemsTotal - ($itemsTotal * $savedInvoice->discount_percentage ) / 100;
            $savedInvoice->discount =  $itemsTotal - $savedInvoice->after_discount ; 
            $savedInvoice->nbt =  ($savedInvoice->after_discount * $savedInvoice->nbt_percentage) / 100;
            $savedInvoice->vat =  (($savedInvoice->after_discount + $savedInvoice->nbt) *   $savedInvoice->vat_percentage) /  100 ;
            $savedInvoice->total_amount =    $savedInvoice->after_discount +   $savedInvoice->nbt  +   $savedInvoice->vat ;
            $savedInvoice->save();
        }
        return ['success' => true , 'property' => $savedInvoice ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\SparePart\SpareInvoice  $spareInvoice
     * @return \Illuminate\Http\Response
     */
    public function show(SpareInvoice $spareInvoice)
    {
        $spareInvoice->items;
      
        $this->data['invoice'] =  $spareInvoice; 
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
     * @param  \App\Model\SparePart\SpareInvoice  $spareInvoice
     * @return \Illuminate\Http\Response
     */
    public function edit(SpareInvoice $spareInvoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\SparePart\SpareInvoice  $spareInvoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SpareInvoice $spareInvoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\SparePart\SpareInvoice  $spareInvoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SpareInvoice $spareInvoice)
    {
        foreach ($spareInvoice->items as $key => $item) {
            $item->deleted_by = Auth::id();
            $item->save();
            $item->delete();
        }         
        $spareInvoice->deleted_by = Auth::id();
        $spareInvoice->save();
        $spareInvoice->delete();
        return redirect()->route($this->routeName . 'index')->with('status', $this->name . ' Deleted Successfully')->with('delete');
   
    }
}