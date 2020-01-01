@extends ('layouts.app')

@section ('content')

    <h1>Create a project</h1>
    <form method="POST" action="/projects">
        @include('projects.form', [
            'project' => new App\Project, 
            'buttonText' => 'Create project'
        ])
    </form>
@endsection

\\