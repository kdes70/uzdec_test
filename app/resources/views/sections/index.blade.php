@extends('layouts.app')

@section('content')



    <p><a href="{{ route('sections.create') }}" class="btn btn-success">Add User</a></p>

    <div class="card mb-3">
        <div class="card-header">Filter</div>
        <div class="card-body">
            <form action="?" method="GET">
                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <label for="id" class="col-form-label">ID</label>
                            <input id="id" class="form-control" name="id" value="{{ request('id') }}">
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group">
                            <label for="username" class="col-form-label">Name</label>
                            <input id="username" class="form-control" name="username" value="{{ request('name') }}">
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="col-form-label">&nbsp;</label><br/>
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Logo</th>
            <th>Name</th>
            <th>Users</th>
            <th></th>
        </tr>
        </thead>
        <tbody>

        @foreach ($sections as $section)
            <tr>
                <td>{{ $section->id }}</td>
                <td><img src="{{$section->logo_url}}" alt="{{$section->name}}" class="img-thumbnail" width="80"></td>
                <td>{{ $section->name}}</td>
                <td>
                    @if ($section->users->isNotEmpty())
                        <ul>
                            @foreach($section->users as $user)
                                <li>{{$user->name}}</li>
                            @endforeach
                        </ul>
                    @endif
                </td>
                <td>
                    <a href="{{route('sections.edit', $section)}}" class="btn btn-info btn-xs">{{__("Edit")}}</a>

                    <a href="{{route('sections.destroy', $section)}}"
                       onclick="event.preventDefault(); if(confirm('Удалить отдел: {{$section->name}}?')){
                           document.getElementById('delete-form-{{$section->id}}').submit();} "
                       class="btn btn-danger btn-xs">{{__('Delete')}}
                    </a>

                    <form id="delete-form-{{$section->id}}" action="{{route('sections.destroy', $section)}}"
                          method="POST"
                          style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $sections->links() }}
@endsection
