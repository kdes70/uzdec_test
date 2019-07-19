<div class="form-group">
    <label for="name" class="col-form-label">{{__('Name')}}<span class="text-danger">*</span></label>
    <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
           value="{{ old('name', isset($user) ? $user->name : '') }}" required>
    @if ($errors->has('name'))
        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
    @endif
</div>

<div class="form-group">
    <label for="email" class="col-form-label">{{__('E-Mail Address')}}<span class="text-danger">*</span></label>
    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
           name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
    @if ($errors->has('email'))
        <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
    @endif
</div>

<div class="form-group">
    <label for="password" class="col-form-label">{{__('Password')}}<span
            class="text-danger">*</span></label>
    <input id="password" type="password"
           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
           name="password" value="{{ old('password') }}" required>
    @if ($errors->has('password'))
        <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
    @endif
</div>


<div class="form-group">
    <label for="role" class="control-label">
        {{__('Role')}}<span class="text-danger">*</span>
    </label>
    <select name="role" id="role" class="form-control">
        @foreach($roles as $key => $name)
            <option value="{{$key}}" {{ $key == old('role', isset($user) ? $user->role : '') ? ' selected' : '' }}>{{$name}}</option>
        @endforeach
    </select>
    @if ($errors->has('role'))
        <span class="invalid-feedback"><strong>{{ $errors->first('role') }}</strong></span>
    @endif
</div>

<div class="form-group">
    <label for="state" class="control-label">
        {{__('State')}}<span class="text-danger">*</span>
    </label>
    <select name="state" id="state" class="form-control">
        @foreach($statuses as $key => $name)
            <option value="{{$key}}" {{ $key == old('state', isset($user) ? $user->state : '') ? ' selected' : '' }}>{{$name}}</option>
        @endforeach
    </select>
    @if ($errors->has('state'))
        <span class="invalid-feedback"><strong>{{ $errors->first('state') }}</strong></span>
    @endif
</div>
