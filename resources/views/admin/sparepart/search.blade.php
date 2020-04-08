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
                <label for="part_number">Part Number</label>
                <div>
                    <input type="text" class="form-control " id="part_number" name="part_number" placeholder="Enter Part Number" 
                    value="{{ request('part_number') ? request('part_number') : "" }}" >
                 
                </div>
            </li>

          <li class="list-group-item">
            <label for="brand_id">Search Brand/Make</label>
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

                 {{-- <li class="list-group-item">
            <label for="brand_model_id">Search Model</label>
            <div>
                <select id="brand_model_id" name="brand_model_id"
                class="multiselect-dropdown  form-control "
                >
            <option value="0">Select Model
            </option>
            @if (!empty($models))
            @foreach ($models as $model)
            <option @if (old('brand_model_id')==$model->id || $object->brand_id == $model->id)
                     selected
                     @endif value="{{ $model->id }}">
                     {{ $model->name }}
        </option>
        @endforeach
        @endif
    </select>
            </div>
        </li> --}}
        
                 <li class="list-group-item">
            <label for="machine_id">Machine Type</label>
            <div>
                <select id="machine_id" name="machine_id"
                class="multiselect-dropdown  form-control "
                >
            <option value="0">Select Machine Type
            </option>
            @if (!empty($machines))
            @foreach ($machines as $machine)
            <option @if (request('machine_id')==$machine->id )
                     selected
                     @endif value="{{ $machine->id }}">
                     {{ $machine->name }}
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
    
     