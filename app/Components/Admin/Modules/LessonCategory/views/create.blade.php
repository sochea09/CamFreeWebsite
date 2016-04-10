@extends($app_template['admin'])

@section('content')
    {!! Form::open(['name' =>'create-lesson-category', 'id' => 'lesson-category-create-form', 'url' => route('admin.lesson.category.create'), 'method' => 'POST']) !!}
        @include($views_path.'_form',['btTitle' => 'CREATE'])
    {!! Form::close() !!}
@stop