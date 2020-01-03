@extends ('layouts.app')

@section ('content')
    <header class="flex items-center mb-3 py-4">
        <div class="flex justify-between items-end w-full">
            <p class="text-gray-500 text-sm font-normal">
               <a href="/projects" class="text-gray-500 text-sm font-normal no-underline">My Projects / {{$project->title}}</a> 
            </p>

            <a href="{{$project->path()."/edit"}}" class="button">Edit Project</a>
        </div>
    </header>

    <main>
        <div class="flex">
            <div class="w-3/4 px-3 mb-8">
                <div class="mb-6">
                    <h2 class="text-lg text-gray-500 font-normal mb-3">Tasks</h2>
                    @foreach ($project->tasks as $task)
                        <div class="card mb-3">
                            <form method="POST" action="{{$task->path()}}">
                                @method('PATCH')
                                @csrf
                                <div class="flex">
                                    <input 
                                        name="body" 
                                        value="{{$task->body}}"
                                        class="w-full {{$task->completed ? 'text-gray-500' : ''}}"
                                        
                                        >
                                    <input 
                                        name="completed" 
                                        type="checkbox"
                                        onChange="this.form.submit()"
                                        {{$task->completed ? 'checked' : ''}}
                                        >
                                </div>
                                
                            </form>
                            
                        </div>
                        
                    @endforeach

                    <div class="card mb-3">
                        <form action={{$project->path() . "/tasks"}} method="POST">
                            @csrf
                            <input placeholder="Begin adding tasks" 
                                class="w-full"
                                name="body"
                                >
                        </form>
                    </div>
                </div>
 
                
                <div>
                    <h2 class="text-lg text-gray-500 font-normal mb-3">Notes</h2>
                    <form method="POST" action="{{$project->path()}}">
                        @csrf
                        @method("PATCH")
                        <textarea name="notes" class="card w-full mb-4" style="min-height: 200px">{{$project->notes}}</textarea>
                        <button type="button" class="button">Submit</button>
                    </form>
                    
                </div>

            </div>
            <div class="w-1/4 px-3 py-8">
                @include('projects.card')
                
                <div class="card mt-3">
                    <ul>
                        @foreach ($project->activity as $activity)
                            <li>{{$activity->description}}</li>
                        @endforeach 
                    </ul>
         
                </div>
            </div>
        </div>
    </main>


@endsection