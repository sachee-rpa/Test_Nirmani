<form id="" class="col-md-12 mx-auto search-form" method="get" action="{{ $route ?? '' }}" >
 
    <div class="p-3">
        <ul class="list-group">
            <li class="list-group-item">
                <label for="date_1">Date Range </label>
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
                <label for="id">Spare Po ID</label>
                <div>
                    <input type="text" 
                    class="form-control" id="id" name="id" 
                    placeholder="Enter Spare Po ID" value="{{ request('id') ? request('id')  : '' }}" >
                   
                </div>
            </li>

            <li class="list-group-item">
                <label for="quote_number">Quotation Number</label>
                <div>
                    <input type="text" 
                    class="form-control" id="quote_number" name="quote_number" 
                    placeholder="Enter Quotation Number" value="{{ request('quote_number') ? request('quote_number')  : '' }}" >
                   
                </div>
            </li>
     

                   <li class="list-group-item">
                <label for="supplier_id">Supplier</label>
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
                <label for="country_id">Country</label>
                <div>
                    <select id="country_id" name="country_id"
                    class="multiselect-dropdown mb-2 form-control "
                    autofocus>
                <option value="0">Select Country
                </option>
                @if (!empty($countries))
                @foreach ($countries as $country)
                <option @if (request('country_id')==$country->id )
                         selected
                         @endif value="{{ $country->id }}">
                         {{ $country->name }}
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
    
     