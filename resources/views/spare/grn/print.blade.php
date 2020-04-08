
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
                Supplier Name -: {{ $spareGrn->supplier->name }}
            </div>
        <div align=left >
            PO Number -:  {{ $spareGrn->spare_po_id }}
        </div>
        <div align=left >
            Country -:  {{ $spareGrn->country->name }}
          </div>
          <div align=left >
            Invoice Number-: {{ $spareGrn->invoice_number }}
          </div>
          <div align=left >
            Date -: {{ $spareGrn->date }}
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
                                  <th>Currency</th>
                                  <th>Quantity</th>
                                  <th>Condition</th>
                                  <th>Quality</th>
                                  <th>USP</th>
                                  <th>Amount</th>
                                  <th>SP</th>
                                 
                                </tr>
                              </thead>
                              <tbody>
                               
                                @forelse ($spareGrn->items ?? [] as $item)
                                  <tr>
                                    <td>{{$item->spare_parts->name  ?? ''}}</td>
                                    <td>{{$item->currency->name  ?? ''}}</td>currency
                                    <td>{{$item->quantity  ?? ''}}</td>
                                    <td>{{$item->condition_name  ?? ''}}</td>
                                    <td>{{$item->quality_name  ?? ''}}</td>
                                    <td>{{$item->unit_sell_price  ?? ''}}</td>
                                    <td>{{$item->amount  ?? ''}}</td>
                                    <td>{{$item->sell_price  ?? ''}}</td>
                               
             
                                  
                                  </tr>
                                  @empty
                                  <tr>
                                      <td colspan="8">
                                          No Data...
                                      </td>
                                  </tr>
                                  @endforelse
                                 
                                  <tr>
                                      <td colspan="6" align="right">Total Amount : </td>
                                      <td colspan="0">{{200}}</td>
                                      <td colspan="0">{{300}}</td>
                                  
                                  </tr>
                                

                              </tbody>
                        </table>
                             
                            </div>
                            </div>
<br>


<table style="width: 100%;" border="1"> 
    
    <tr>
        <td align="left"><span>Remarks</span> :- &nbsp;&nbsp; <span> {{ $spareGrn->remarks }}</span></td>
       
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