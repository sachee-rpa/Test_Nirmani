<form id="" class="col-md-12 mx-auto search-form" method="get" action="{{ $route ?? '' }}" >
 
    <div class="p-3">
        <ul class="list-group">
         <li class="list-group-item">
                <label for="id">ID</label>
                <div>
                    <input type="text" 
                    class="form-control" id="id" name="id" 
                    placeholder="Enter REF" value="{{ request('id') ? request('id')  : '' }}" autofocus>
                   
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
     <pre></pre>
    </form>
    
     