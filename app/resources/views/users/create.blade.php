@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{__('User Create')}}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('users.store') }}">
                @csrf

                @include('users.form')

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>


@endsection
