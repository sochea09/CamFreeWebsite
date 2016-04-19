/**
 * Created by tsc on 4/10/16.
 */

function loadUploadYoutube(pthis){
    $('#youtube-upload-form').html('<form id="post-youtube-form" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden"><input id="youtube-upload" name="file" type="file" onchange="postUploadYoutube(this)"/> </form>');
    $('#youtube-upload').trigger('click');
    $(pthis).attr('id','current-upload-youtube');
}
function postUploadYoutube(pthis){
    var cur = $("#current-upload-youtube");
    var fd = new FormData();
    fd.append('file', pthis.files[0]);

    // You could show a loading image for example...

    $.ajax({
        url: baseUrl+'/api/youtube/upload',
        xhr: function() { // custom xhr (is the best)

            var xhr = new XMLHttpRequest();
            var total = 0;

            // Get the total size of files
            $.each(document.getElementById('youtube-upload').files, function(i, file) {
                total += file.size;
            });

            // Called when upload progress changes. xhr2
            xhr.upload.addEventListener("progress", function(evt) {
                // show progress like example
                var loaded = (evt.loaded / total).toFixed(2)*100; // percent

                $('#progress').attr('placeholder','Uploading... ' + loaded + '%' );
            }, false);

            return xhr;
        },
        type: 'post',
        processData: false,
        contentType: false,
        data: fd,
        success: function(data) {
            // do something...
            console.log(data);
            if(data['status'] == 'success'){
                cur.removeAttr('id');
            }
        }
    });
}