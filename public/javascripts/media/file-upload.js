/**
 * Created by tsc on 4/10/16.
 */

function loadUploadFile(pthis){
    $('#file-upload-form').html('<form id="post-file-form" target="form_target" method="post" enctype="multipart/form-data" style="width:0px;height:0;overflow:hidden"><input id="file-upload" name="file" type="file" onchange="postUploadFile(this)"/> </form>');
    $('#file-upload').trigger('click');
    $(pthis).attr('id','current-upload-file');
}
function postUploadFile(pthis){
    var cur = $("#current-upload-file");
    var fd = new FormData();
    fd.append('file', pthis.files[0]);

    // You could show a loading image for example...

    $.ajax({
        url: baseUrl+'/api/files/upload',
        xhr: function() { // custom xhr (is the best)

            var xhr = new XMLHttpRequest();
            var total = 0;

            // Get the total size of files
            $.each(document.getElementById('file-upload').files, function(i, file) {
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
                cur.parents('.upload-main').find('#upload-file').val(data['response']['name']);
                cur.removeAttr('id');
            }
        }
    });
}