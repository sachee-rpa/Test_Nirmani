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
                <label for="email">Email</label>
                <div>
                    <input type="text" class="form-control " id="email" name="email" placeholder="Enter Email" 
                    value="{{ request('email') ? request('email') : "" }}" >
                 
                </div>
            </li>

          <li class="list-group-item">
            <label for="country_id">Select Country</label>
            <div>
                <select id="country_id" name="country_id"
                    class="dynamic mb-2 form-control form-control @error('country_id') is-invalid @enderror"
                    data-dependent="brand_model_id" data-route="{{ route('select') }}"
                    data-hold="Select Model" >
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
    
     