<form id="" class="col-md-12 mx-auto search-form" method="get" action="{{ $route ?? '' }}" >
 
    <div class="p-3">
        <ul class="list-group">
            <li class="list-group-item">
                <label for="id">ID</label>
                <div>
                    <input type="text" 
                    class="form-control" id="id" name="id" 
                    placeholder="Enter ID" value="{{ request('id') ? request('id')  : '' }}" autofocus>
                   
                </div>
            </li>
                 <li class="list-group-item">
                <label for="name"> Name</label>
                <div>
                    <input type="text" class="form-control " id="name" name="name" placeholder="Enter name" 
                    value="{{ request('name') ? request('name') : "" }}" >
                 
                </div>
            </li>
  
          <li class="list-group-item">
            <label for="unit_id">Select Unit</label>
            <div>
                <select id="unit_id" name="unit_id"
                    class="dynamic mb-2 form-control form-control @error('unit_id') is-invalid @enderror"
                    data-dependent="brand_model_id" data-route="{{ route('select') }}"
                    data-hold="Select Model" >
            <option value="0">Select Unit
            </option>
            @if (!empty($units))
            @foreach ($units as $unit)
            <option @if (request('unit_id')==$unit->id )
                     selected
                     @endif value="{{ $unit->id }}">
                     {{ $unit->name }}
        </option>
        @endforeach
        @endif
    </select>
            </div>
        </li>

              <li class="list-group-item">
            <label for="brand_id">Select Brand</label>
            <div>
                <select id="brand_id" name="brand_id"
                    class="dynamic mb-2 form-control form-control @error('brand_id') is-invalid @enderror"
                    data-dependent="brand_model_id" data-route="{{ route('select') }}"
                    data-hold="Select Model" >
            <option value="0">Select Brand
            </option>
            @if (!empty($brands))
            @foreach ($brands as $brand)
            <option @if (request('brand_id')==$brand->id )
                     selected
                     @endif value="{{ $brand->id }}">
                     {{ $brand->name }}
        </option>
        @endforeach
        @endif
    </select>
            </div>
        </li>
    
        </ul>
    <pre></pre>
    <button type="submit"
     data-clipboard-target="#clipboard-source"
      class="clipboard-trigger btn-shadow btn-pill btn-wide btn btn-primary"
      >{{ $btn_search_name ?? '' }}</button>
      <a type="submit" href="{{ $btn_reset ?? '#' }}" style="color: aliceblue"
    data-clipboard-target="#clipboard-source"
     class="clipboard-trigger btn-shadow btn-pill btn-wide btn btn-danger"
     >Reset {{ $btn_search_name ?? '' }}</a>
     </div>
     </form>
    
     