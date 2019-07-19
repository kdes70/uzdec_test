@extends('layouts.app')

@section('content')

    <form method="POST" action="{{ route('users.update', $user) }}">
        @csrf
        @method('PUT')

        @include('users.form')

        <div class="form-group">
            <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
        </div>
    </form>
@endsection
