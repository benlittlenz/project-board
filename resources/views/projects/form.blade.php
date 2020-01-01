

@csrf

<div>
    <label for="">Title</label>
    <div>
        <input 
            class="input bg-transparent" 
            type="text" 
            name="title" 
            value={{$project->title}}>
    </div>
</div>

<div>
    <label for="">Description</label>
    <div>
        <textarea type="text" name="description">{{$project->description}}</textarea>
    </div>
</div>

<div>
    <div>
        <button class="button is-button" type="submit">{{$buttonText}}</button>
        <a href="{{$project->path()}}">Cancel</a>
    </div>
</div>
