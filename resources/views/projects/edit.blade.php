@extends('layouts.app')

@section('content')
        <h1>Edit project</h1>
        <form method="POST" action="{{$project->path()}}">
            @method('PATCH')
            @include('projects.form', [
                'buttonText' => 'Edit project'
            ])
        </form>
@endsection 