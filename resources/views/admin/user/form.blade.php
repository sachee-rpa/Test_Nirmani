<form id="signupForm" class="col-md-10 mx-auto" method="post" action="{{ $route }}">
    @csrf
    @if ($update)
    @method('PUT')
    @endif
    <div class="position-relative form-group">
        <div>
            <div class="custom-checkbox custom-control custom-control-inline">
                <input type="checkbox" @if (old('spares')==1 || $user->spares == 1 ) checked @endif name="spares"
                id="spares"
                class="custom-control-input " value="1">
                <label class="custom-control-label" for="spares">Spare Parts</label>
            </div>
            <div class="custom-checkbox custom-control custom-control-inline">
                <input type="checkbox" @if (old('machine')==1 || $user->machine == 1) checked @endif id="machine"
                name="machine" value="1"
                class="custom-control-input"><label class="custom-control-label" for="machine">Machine - Buying and
                    selling</label>
            </div>
            <div class="custom-checkbox custom-control custom-control-inline">
                <input type="checkbox" @if (old('workshop')==1 || $user->workshop == 1) checked @endif id="workshop"
                name="workshop" value="1"
                class="custom-control-input"><label class="custom-control-label" for="workshop">Workshop</label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname">Name</label>
        <div>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                placeholder="Enter User Name" value="{{ old('name') ? old('name') : $user->name }}" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="firstname">Designation</label>
        <div>
            <input type="text" class="form-control @error('designation') is-invalid @enderror" id="designation"
                name="designation" placeholder="Enter Designation"
                value="{{ old('designation') ? old('designation') : $user->designation  }}">
            @error('designation')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    <div class="form-group">
        <label for="firstname">Email</label>
        <div>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                placeholder="Enter Email" value="{{ old('email') ?  old('email') : $user->email }}"
                autocomplete="new-password">
            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    @if (!$update)
    <div class="form-group">
        <label for="firstname">Password</label>
        <div>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                name="password" placeholder="Enter Password"
                value="{{ old('password') ?  old('password') : $user->password }}" autocomplete="new-password">
            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>
    @endif
    <div class="position-relative form-group">
        <div>
            <div class="custom-checkbox custom-control custom-control-inline">
                <input type="checkbox" @if (old('super_admin')==1 || $user->super_admin == 1) checked @endif value="1"
                name="super_admin"
                id="super_admin" class="custom-control-input">
                <label class="custom-control-label" for="super_admin">Super Admin</label>
            </div>

        </div>
    </div>

    @if ($update && !empty($all_roles))
    <div class="form-group">
        <label for="firstname">Permission</label>
        <div>
            <select multiple="multiple" name="permissions[]" class="multiselect-dropdown form-control">
                @foreach ($all_roles as $role)
                <option {{ ($user->hasRole($role->name))? 'selected' : '' }} value="{{ $role->name }}">
                    {{  ucfirst($role->name. ' Manager') }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    @endif


    <div class="form-group ">
        <button type="submit" class="btn btn-primary mt-2 btn-lg" name="signup"
            value="Sign up">{{ $submit_btn }}</button>
        @if ($update)
        @method('PUT')
        <a href="{{ URL::previous() }}" class="btn btn-warning mt-2 btn-lg">
            <i class="fa   fa-angle-double-left fa-w-20"></i> Back </a>
        @endif
    </div>
</form>