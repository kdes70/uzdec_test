@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{__('Section Create')}}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('sections.store') }}" enctype="multipart/form-data">
                @csrf

                @include('sections.form')

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
                </div>
            </form>
        </div>
    </div>


@endsection
