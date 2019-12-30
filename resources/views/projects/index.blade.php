@extends ('layouts.app')

@section ('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify between items-center w-full">
            <h1 class="mr-auto">My Projects</h1>
            <a href="/projects/create" class="button">New Project</a>
        </div>
    </header>
    
    <main class="flex flex-wrap -mx-3">
        @forelse ($projects as $project)
        <div class="w-1/3 px-3 pb-6">
            <div class="bg-white p-5 rounded shadow" style="height: 200px">
                <h3 class="font-normal text-xl py-4">{{$project->title}}</h3>
                <div class="text-grey">
                    {{Str::limit($project->description, 300)}}
                </div>
            </div>
        </div>
        
        @empty
            <div>No projects yet.</div>
        @endforelse
    </main>

@endsection