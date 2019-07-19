@extends('layouts.app')

@section('content')

    <div class="card">
        <div class="card-header">{{__('Section Update')}}</div>

        <div class="card-body">
            <form method="POST" action="{{ route('sections.update', $section) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                @include('sections.form')

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{__('Update')}}</button>
                </div>
            </form>
        </div>
    </div>

@endsection
