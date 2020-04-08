
@extends('layouts.print')

@section('content')

<style>
    .border_table  td  th {
      border: 1px solid black;
    }
    
    #table1 {
      border-collapse: separate;
    }
    
    #table2 {
      border-collapse: collapse;
    }
    </style>

    
<table style="width: 100%;" border="1"> 
    <tr>
        <td>  
            <div align=left >
                Customer Name -: {{ $spareInvoice->customer->name }}
            </div>
        {{-- <div align=left >
            Customer PO -:  {{ $spareInvoice->customer_po->name }}
        </div> --}}
        <div align=left >
            Customer Type -:  {{ $spareInvoice->customer_type_no }}
          </div>
          <div align=left >
            Invoice Type -: {{ $spareInvoice->invoice_type_no }}
          </div>
          <div align=left >
            Date -: {{ $spareInvoice->date }}
          </div>
    </td>
    
    <td>  
Company Details...
      {{-- @foreach($spareInvoice->company ?? [] as $post)
        <div align=left >
          Company Name -:  {{ $post->name }}
        </div>
        <div align=right >
          Address -: {{ $post->address }}
          </div>
          <div align=right >
            Telephone -: {{ $post->tel }}
          </div>
          <div align=right >
            FAX -: {{ $post->fax }}
          </div>
          <div align=right >
            Email -:  {{ $post->email }}
          </div>
          @endforeach --}}
    </td>

    </tr> 
</table>


<br><br><br>
                    <div class="container mt-5">
                        <div class="row" >

                        </div>
    
                          <div class="row">
                            <div class="col-md-12" >
                  
                        
                        <table style=" width: 100%; border-collapse: collapse;" cellpadding ="4" border="1">
                            <thead>
                                <tr>
                                  <th>Item Name</th>
                                  <th>Rate</th>
                                  <th>Quantity</th>
                                  <th>Amount</th>
                                 
                                </tr>
                              </thead>
                              <tbody>
                               
                                @forelse ($spareInvoice->items ?? [] as $item)
                                  <tr>
                                    <td>{{$item->spare_parts->name  ?? ''}}</td>
                                    <td>{{$item->rate  ?? ''}}</td>
                                    <td>{{$item->quantity  ?? ''}}</td>
                                    <td>{{$item->amount  ?? ''}}</td>
                               
             
                                  
                                  </tr>
                                  @empty
                                  <tr>
                                      <td colspan="5">
                                          No Data...
                                      </td>
                                  </tr>
                                  @endforelse
                                  <tr>
                                    <td colspan="3" align="right">Sub Total </td>
                                <td colspan="">{{$spareInvoice->sub_total}}</td>

                                </tr>
                                <tr>
                                    <td colspan="3" align="right">Discount</td>
                                <td colspan="">{{$spareInvoice->discount}}</td>
           
                                </tr>

                                  <tr>
                                      <td colspan="3" align="right">NBT 2.04% : </td>
                                  <td colspan="">{{$spareInvoice->nbt}}</td>
                   
                                  </tr>
                                  <tr>
                                      <td colspan="3" align="right">VAT 15% : </td>
                                      <td colspan="">{{$spareInvoice->vat}}</td>
                               
                                  </tr>
                                  <tr>
                                      <td colspan="3" align="right">Total Amount : </td>
                                      <td colspan="">{{$spareInvoice->total_amount}}</td>
                                  
                                  </tr>
                                

                              </tbody>
                        </table>
                             
                            </div>
                            </div>
<br>


<table style="width: 100%;" border="1"> 
    
    <tr>
        <td align="left"><span>Remarks</span> :- &nbsp;&nbsp; <span> {{ $spareInvoice->remarks }}</span></td>
       
    </tr>
    </table>
    <br><br>

    <table style="width: 100%;" border="0"> 
    <tr>
        <td align="center"><span>..................................................................</span></td>
        <td align="center"><span>..................................................................</span></td>
        <td align="center"><span>..................................................................</span></td>
    </tr> 
    <tr>
        <td align="center"><span>Prepared by</span></td>
        <td align="center"><span>Created By</span></td>
        <td align="center"><span>Approved By</span></td>
    </tr> 
</table>
  <br><br>
  </div>
@endsection