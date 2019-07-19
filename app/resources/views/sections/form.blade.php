<div class="form-group">
    <label for="name" class="col-form-label">{{__('Name')}}<span class="text-danger">*</span></label>
    <input id="name" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name"
           value="{{ old('name', isset($section) ? $section->name : '') }}" required>
    @if ($errors->has('name'))
        <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
    @endif
</div>

<div class="form-group">
    <label for="description" class="col-form-label">{{__('Description')}}<span class="text-danger">*</span></label>
    <textarea id="description" class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"
              name="description">{{ old('description', isset($section) ? $section->description : '') }}</textarea>

    @if ($errors->has('description'))
        <span class="invalid-feedback"><strong>{{ $errors->first('description') }}</strong></span>
    @endif
</div>

<div class="form-group">
    <div class="custom-file">
        <input type="file" class="custom-file-input {{ $errors->has('logo') ? ' is-invalid' : '' }}" id="logo"
               name="logo">
        <label class="custom-file-label" for="logo">Choose file</label>
    </div>
    {{--    <label for="logo" class="col-form-label">{{__('Logo')}}<span class="text-danger">*</span></label>--}}
    {{--    <input id="logo" type="file" name="logo" required>--}}

    @if ($errors->has('logo'))
        <span class="invalid-feedback"><strong>{{ $errors->first('logo') }}</strong></span>
    @endif
</div>

@isset($users)

    @foreach($users as $user)
        <div class="form-check">
            <input class="form-check-input" name="users[]" type="checkbox"
                   @if(in_array(old('users', $user->id), $selected_user))
                   checked
                   @endif
                   value="{{$user->id}}"
                   id="user-{{$user->id}}">
            <label class="form-check-label" for="user-{{$user->id}}">
                {{$user->name}} (<a href="{{route('users.show', $user)}}">{{$user->email}}</a>)
            </label>
        </div>
        @if ($errors->has('users'))
            <span class="invalid-feedback"><strong>{{ $errors->first('users') }}</strong></span>
        @endif
    @endforeach

@endisset


