@extends($app_template['admin'])

@section('content')
    {!! Form::open(['name' =>'create-lesson', 'id' => 'lesson-create-form', 'url' => route('admin.lesson.create'), 'method' => 'POST']) !!}
        @include($views_path.'_form',['btTitle' => 'CREATE'])
    {!! Form::close() !!}
    @include($app_template['global_views'].'.includes.admin.media.tiny-media-form')
@stop
@section('script')
    <script type="text/javascript" src="{!! asset('bower_components/tinymce/tinymce.min.js') !!}"></script>
    <script>
        tinymce.init({
            selector: '#tinydesc',
            menubar: false,
            statusbar: false,
            height: 400,
            plugins: ["image"],
             file_browser_callback: function(field_name, url, type, win) {
                 //alert('ok');
                 if(type=='image') $('#media_form input').click();

                 $('#media_form input').on('change', function(e){
                 var formData = new FormData($('#media_form')[0]);
                 $.ajax({
                     url: baseUrl+'/admin/media/upload',
                     type: "POST",
                     data: formData,
                     async: false,
                     success: function (res) {
                        win.document.getElementById(field_name).value = res;
                     },
                     cache: false,
                     contentType: false,
                     processData: false
                 });

                 e.preventDefault();
                 });
             }
        });
    </script>
@stop