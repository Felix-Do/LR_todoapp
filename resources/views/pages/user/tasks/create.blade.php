@extends('layouts.user.application', [
    'bodyClasses' => ''
])

@section('metadata')
@stop

@section('styles')
    @parent
@stop

@section('title')
    Top
@stop

@section('scripts')
    @parent
@stop

@section('content')
    <section>
        <div class="container">
            <br>
            {{--  @include("layouts.user.messages")  --}}
            <br>
            <a href="{{ action('User\TaskController@index') }}" class="btn btn-default">< Go Back</a>
            <br><br>
            Create a new task:
            <br><br>
            <form action="{!! action('User\TaskController@store') !!}" method="post">
                {!! csrf_field() !!}
                Name:
                <input type="text" name="name" placeholder="enter a name" id="input_name" autofocus value="{{$data['task']->name}}">
                @if(empty($data['task']->name))
                    <div class="alert alert-danger">Please Enter a Name</div>
                @endif
                Description:
                <input type="text" name="description" placeholder="description goes here" value="{{$data['task']->description}}">
                Due Date:
                <input type="date" name="duedate" value="{{$data['task']->duedate}}">
                @if(empty($data['task']->duedate))
                    <div class="alert alert-danger">Please Enter a Due Date</div>
                @endif
                Status: 
                <input type="radio" name="status" value=0 
                    @if($data['task']->status < 1 || $data['task']->status > 2)
                        checked
                    @endif
                > Not Started
                <input type="radio" name="status" value=1 
                    @if($data['task']->status==1)
                        checked
                    @endif
                > In Progress
                <input type="radio" name="status" value=2 
                    @if($data['task']->status==2)
                        checked
                    @endif
                > Finished
                <br><br>
                Label: 
                <input type="radio" name="label" value=0 
                    @if($data['task']->label < 1 || $data['task']->label > 5)
                        checked
                    @endif
                > No Label
                <input type="radio" name="label" value=1 
                    @if($data['task']->label==1)
                        checked
                    @endif
                > Label 1
                <input type="radio" name="label" value=2 
                    @if($data['task']->label==2)
                        checked
                    @endif
                > Label 2
                <input type="radio" name="label" value=3 
                    @if($data['task']->label==3)
                        checked
                    @endif
                > Label 3
                <input type="radio" name="label" value=4 
                    @if($data['task']->label==4)
                        checked
                    @endif
                > Label 4
                <input type="radio" name="label" value=5 
                    @if($data['task']->label==5)
                        checked
                    @endif
                > Label 5
                <br><br>
                <button type="submit" class="btn btn-default">Create New Task</button>
            </form>
        </div>
    </section>
    <script>
        // auto select the input text name field
        document.getElementById('input_name').select();
    </script>
@stop
