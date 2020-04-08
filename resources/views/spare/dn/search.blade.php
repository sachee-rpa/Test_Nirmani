<form id="" class="col-md-12 mx-auto search-form" method="get" action="{{ $route ?? '' }}" >
 
    <div class="p-3">
        <ul class="list-group">
            
            <li class="list-group-item">
                <label for="date_1">Cheque Date Range </label>
                <div class="row">
                    <input type="text" 
                    class="form-control col-md-6" id="start_date" name="start_date"  data-toggle="datepicker"
                    placeholder="Start Date" value="{{ request('start_date') ? request('start_date')  : '' }}" autocomplete="off" >
                   
                    <input type="text" 
                class="form-control col-md-6" id="end_date" name="end_date"  data-toggle="datepicker"
                placeholder="End Date" value="{{ request('end_date') ? request('end_date')  : '' }}" autocomplete="off" >
                </div>
            </li>

            
            <li class="list-group-item">
                <label for="id">Search GRN</label>
                <div>
                    <input type="text" 
                    class="form-control" id="id" name="id" 
                    placeholder="Enter  GRN" value="{{ request('id') ? request('id')  : '' }}" >
                   
                </div>
            </li>
            <li class="list-group-item">
                <label for="invoice_number">Search Invoice</label>
                <div>
                    <input type="text" 
                    class="form-control" id="invoice_number" name="invoice_number" 
                    placeholder="Enter Invoice" value="{{ request('invoice_number') ? request('invoice_number')  : '' }}" autofocus>
                   
                </div>
            </li>
            <li class="list-group-item">
                <label for="supplier_id">Search Supplier</label>
                <div>
                    <select id="supplier_id" name="supplier_id"
                    class="multiselect-dropdown mb-2 form-control "
                    autofocus>
                <option value="0">Select Supplier
                </option>
                @if (!empty($suppliers))
                @foreach ($suppliers as $supplier)
                <option @if (request('supplier_id')==$supplier->id )
                         selected
                         @endif value="{{ $supplier->id }}">
                         {{ $supplier->name }}
            </option>
            @endforeach
            @endif
        </select>
                </div>
            </li>

            <li class="list-group-item">
                <label for="spare_po_id">Search PO</label>
                <div>
                    <select id="spare_po_id" name="spare_po_id"
                    class="multiselect-dropdown mb-2 form-control "
                    autofocus>
                <option value="0">Select Search PO
                </option>
                @if (!empty($spare_po_search))
                @foreach ($spare_po_search as $spare_po)
               
                <option @if (request('spare_po_id')==$spare_po->id )
                         selected
                         @endif value="{{ $spare_po->id }}">
                         {{ $spare_po->id }}
            </option>
            @endforeach
            @endif
        </select>
                </div>
            </li>

           
           
             
         
             
        </ul>
    </div>
    <button type="submit"
     data-clipboard-target="#clipboard-source"
      class="clipboard-trigger btn-shadow btn-pill btn-wide btn btn-primary"
      >{{ $btn_search_name ?? '' }}</button>
      <a type="submit" href="{{ $btn_reset ?? '#' }}" style="color: aliceblue"
    data-clipboard-target="#clipboard-source"
     class="clipboard-trigger btn-shadow btn-pill btn-wide btn btn-danger"
     >Reset {{ $btn_search_name ?? '' }}</a>
    </form>
    
     