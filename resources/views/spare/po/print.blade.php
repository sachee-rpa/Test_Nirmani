
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

    
<table style="width: 100%;" border="0"> 
    <tr>
        <td>  
            <div align=left >
                Company Address
        </div>
    </td>
    <td>  
        <div align=right >
            {{-- <a>&nbsp;&nbsp;
                <img style="width: 100px; height: 100px;" src="{{ $invoice->company->logo_url  }}" />
            </a> 
           <br> --}}
         Company Logo
           
        </div>
    </td>

    </tr> 
</table>
<br><br><br>
<table style="width: 100%;" border="0">
    <tr>
        <td>
            <div>
                Supplier : {{ $sparePo->supplier->name }}
            </div>
        </td>
        <td>
            <div>
                Quotation No : {{ $sparePo->quote_number }}
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div>
                Date : {{ $sparePo->required_date }}
            </div>
        </td>
        <td>
            <div>
               Country : {{ $sparePo->country->name }}
            </div>
        </td>
    </tr>
    <tr>
        <td>
            <div>
                Required Date : {{ $sparePo->required_date }}
            </div>
        </td>
       
    </tr>

</table>
<br><br><br>
                    <div class="container mt-5">
                        <div class="row" >

                        </div>
    
                          <div class="row">
                            <div class="col-md-12" >
                        
                        
                        <table style=" width: 100%; border-collapse: collapse;" cellpadding ="6" border="1">
                            <thead>
                                <tr>
                                 
                                  <th>Item Name</th>
                                  <th>Currency</th>
                                  <th>Rate</th>
                                  <th>Quantity</th>
                                  <th>Condition</th>
                                  <th>Quality</th>
                                  <th>Amount</th> 
                                </tr>
                              </thead>
                              <tbody>
                               
                                @forelse ($sparePo->items ?? [] as $item)
                                  <tr>
                                   
                                     <td>{{$item->spare_parts->name ?? ''}}</td>
                                     <td>{{$item->currency->name ?? ''}}</td>
                                     <td>{{$item->rate ?? ''}}</td>
                                     <td>{{$item->quantity ?? ''}}</td>
                                     <td>{{$item->condition_name ?? ''}}</td>
                                     <td>{{$item->quality_name ?? ''}}</td>
                                     <td>{{$item->amount ?? ''}}</td>
                                  
                                  </tr>
                                  @empty
                                  <tr>
                                      <td colspan="9">
                                          No Data...
                                      </td>
                                  </tr>
                                  @endforelse
                                  <tr>
                                      <td colspan="6" align="right">NBT 2.04% : </td>
                                  <td colspan=""></td>
                                  </tr>
                                  <tr>
                                      <td colspan="6" align="right">VAT 15% : </td>
                                      <td colspan=""></td>
                                  </tr>
                                  <tr>
                                      <td colspan="6" align="right">Total Amount : </td>
                                      <td colspan="">{{$sparePo->total_amount}}</td>
                                  </tr>
                                

                              </tbody>
                        </table>
                             
                            </div>
                            </div>
<br>


<table style="width: 100%;" border="0"> 
    
    <tr>
        <td align="left"><span>Remarks</span> :- &nbsp;&nbsp; <span> {{ $sparePo->remarks }}</span></td>
       
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
        <td align="center"><span>Issued By</span></td>
        <td align="center"><span>Checked By</span></td>
        <td align="center"><span>Approved By</span></td>
    </tr> 
</table>
  <br><br>
  </div>
@endsection