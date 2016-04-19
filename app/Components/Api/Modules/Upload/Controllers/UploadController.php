<?php

namespace App\Components\Api\Modules\Upload\Controllers;

use App\Components\Site\Modules\Frontend\Model\general_mod as General;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;
use Session;
use Validator;
use CURLFile;

class UploadController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    // Upload file to temporary storage
    public function store()
    {
        if(Input::hasFile('file')) {
            $file                   = Input::file('file');
            $destinationUploadPath  = storage_path() . '/uploads/';
            $filename               =  date('Y_m_d_His') . '.' . $file->getClientOriginalExtension();

            if (!file_exists($destinationUploadPath)){
                mkdir($destinationUploadPath,0777,true);
            }

            $uploadSuccess          = $file->move($destinationUploadPath, $filename);
            return $this->responseSuccess(array(
                "filename" => $filename
            ));

        } else {
            return $this->responseError("File did not get uploaded successfully!");
        }
    }

    // Read file to view
    public function show($filename){

        $path = storage_path() . '/uploads/' . $filename;
        if (file_exists($path)) {
            return \Response::inline($path);
        }
        return \Response::error(404);

    }

    // Upload file by Call to service
    public function storeFile()
    {
        if(Input::hasFile('file')) {
            $file                   = Input::file('file');
            $uploadResult           = $this->post('media/uploadfile', array('media' => new CURLFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName())), array('Content-Type' => 'multipart/form-data'));
            $result                 = $this->normalizeAPIData($uploadResult);
            return $result;

        } else {
            return $this->responseError("File did not get uploaded successfully!");
        }
    }

    public function storeYoutube(){
        if(Input::hasFile('file')) {
            $file                   = Input::file('file');
            $uploadResult           = $this->post('youtube-upload', array('media' => new CURLFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName())), array('Content-Type' => 'multipart/form-data'));
            $result                 = $this->normalizeAPIData($uploadResult);
            return $result;

        } else {
            return $this->responseError("File did not get uploaded successfully!");
        }
    }

    public function storeImage(){
        if(Input::hasFile('media')) {
            $file                   = Input::file('media');
            $uploadResult           = $this->post('media/uploadimage', array('media' => new CURLFile($file->getRealPath(), $file->getMimeType(), $file->getClientOriginalName())), array('Content-Type' => 'multipart/form-data'));
            $result                 = $this->normalizeAPIData($uploadResult);
            return $result;

        } else {
            return $this->responseError("File did not get uploaded successfully!");
        }
    }

}
