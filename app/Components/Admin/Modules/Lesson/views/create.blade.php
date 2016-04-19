@extends($app_template['admin'])

@section('content')
    {!! Form::open(['name' =>'create-lesson', 'id' => 'lesson-create-form', 'url' => route('admin.lesson.create'), 'method' => 'POST']) !!}
        @include($views_path.'_form',['btTitle' => 'CREATE'])
    {!! Form::close() !!}
    @include($app_template['global_views'].'.includes.admin.media.tiny-media-form')
    {{--show file upload form--}}
    <div id="file-upload-form"></div>
    <div id="youtube-upload-form"></div>
@stop
@section('script')
    <script type="text/javascript" src="{!! asset('bower_components/socket.io-client/socket.io.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('bower_components/tinymce/tinymce.min.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('javascripts/media/file-upload.js') !!}"></script>
    <script type="text/javascript" src="{!! asset('javascripts/media/youtube-upload.js') !!}"></script>
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
                     url: baseUrl+'/api/image/upload',
                     type: "POST",
                     data: formData,
                     async: false,
                     success: function (res) {
                        win.document.getElementById(field_name).value = res['response']['url'];
                     },
                     cache: false,
                     contentType: false,
                     processData: false
                 });

                 e.preventDefault();
                 });
             }
        });

        var myAuthToken = "{{ session('user')['auth_token'] }}"; // has user id
        var   usock;
        usock = io.connect('http://localhost:3000',{
            query: "token=" + myAuthToken,
            secure: true
        });

        usock.on('message', function (data) {
            //console.log(data);
        });
    </script>
@stop