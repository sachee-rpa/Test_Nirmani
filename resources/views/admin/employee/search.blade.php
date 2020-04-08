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
                <label for="nic">Nice</label>
                <div>
                    <input type="text" class="form-control " id="nic" name="nic" placeholder="Enter Nice" 
                    value="{{ request('nic') ? request('email') : "" }}" >
                 
                </div>
            </li>

          <li class="list-group-item">
            <label for="employee_category_id">Select Employee Category</label>
            <div>
                <select id="employee_category_id" name="employee_category_id"
                    class="dynamic mb-2 form-control form-control @error('employee_category_id') is-invalid @enderror"
                    data-dependent="brand_model_id" data-route="{{ route('select') }}"
                    data-hold="Select Model" >
            <option value="0">Select Employee Category
            </option>
            @if (!empty($employee_categories))
            @foreach ($employee_categories as $employee_category)
            <option @if (request('employee_category_id')==$employee_category->id )
                     selected
                     @endif value="{{ $employee_category->id }}">
                     {{ $employee_category->name }}
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
    
     