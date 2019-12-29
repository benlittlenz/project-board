@extends ('layouts.app')

@section ('content')
    <h1>Create a project</h1>
    <form method="POST" action="/projects">
        @csrf
        <div>
            <label for="">Title</label>
            <div>
                <input type="text" name="title">
            </div>
        </div>

        <div>
            <label for="">Description</label>
            <div>
                <textarea type="text" name="description"> </textarea>
            </div>
        </div>

        <div>
            <div>
                <button type="submit">Submit</button>
                <a href="/projects">Cancel</a>
            </div>
        </div>
    </form>
@endsection