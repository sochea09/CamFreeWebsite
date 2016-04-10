<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Session;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $account;

    public function __construct()
    {
        dd(Session::get('authUser'));
        if (\Session::has('key'))
        {
            $this->account = \Session::get('key');;
        }
    }

    public function view($path)
    {
        $d_path = substr(get_class($this), 0, strrpos(get_class($this), '\\'));
        $d_path = lcfirst(str_replace("\\",".",$d_path));

        return view($d_path . '.views.'.$path)
            ->with('account', $this->account)
            ->with('views_path', $d_path . '.views.')
            ->with('app_template',$this->getAppTemplate());
    }

    public function getAppTemplate()
    {
        return array(
            'admin' => "resources.views.templates.camfree.admin",
            /*'frontend' => "resources.views.templates.camfree.frontend",
            'backend' => "resources.views.templates.camfree.backend",*/
            //Last update
            'frontend' => "resources.views.templates.camfree.frontend",
            'global_views'  => "resources.views"
        );
    }

    private $contentType = 'application/json';

    public function responseSuccess($data,$statusCode = 200,$options=null){
        $dataTmp = $data;

        try{

            if(is_object($data)) $data = json_encode((array)$data);
            elseif(is_array($data)) $data = json_encode($data);

            $dataTmp = json_decode($data,true);
            // dd($dataTmp);
        }
        catch(\Exception $e){
            dd($e->getMessage());
        }

        if($dataTmp==null) $dataTmp=$data;
        $contents = array('status' => 'success', 'response' => $dataTmp, 'options' => $options, 'code' => $statusCode);
        // dd($contents);

        return response($contents, $statusCode)
            ->header('Content-Type', $this->contentType);

        // $response = Response::make($contents, $statusCode);
        // $response->header('Content-Type', $this->contentType);

        // return $response;
    }

    public function responseError($data,$statusCode=400, $options=null){
        $dataTmp = $data;

        try{
            if(is_object($data)) $data = json_encode((array)$data);
            elseif(is_array($data)) $data = json_encode($data);

            $dataTmp = json_decode($data,true);
        }
        catch(\Exception $e){
        }

        if($dataTmp==null) $dataTmp=$data;
        $contents = array('status' => 'error', 'response' => $dataTmp, 'options' => $options, 'code' => $statusCode);

        return response($contents, $statusCode)
            ->header('Content-Type', $this->contentType);

        // $response = Response::make($contents, $statusCode);
        // $response->header('Content-Type', $this->contentType);

        // return $response;
    }

    // Curl request

    public function getServerAddress() {
        $address = Config::get('app.endpoint.scheme') . '://' . Config::get('app.endpoint.hostname'). ':'. Config::get('app.endpoint.port') . '/';
        return $address;
    }


    private function sanitizeUri($uri) {
        return str_replace('$', '/', $uri);
    }

    private function response($res, $resp) {
        $encodedResp = $resp;
        $headers = curl_getinfo($res);
        #dd($encodedResp);
        list($headers, $content) = explode("\r\n\r\n", $encodedResp , 2);

        // foreach (explode("\r\n", $headers) as $hdr)
        //     printf('<p>Header: %s</p>', $hdr);
        //echo $content;

        try {
            if(strpos($headers['content_type'], 'JSON') !== false) {
                $encodedResp = json_decode($encodedResp, true);
            } else {
                $encodedResp = $encodedResp;
            }
        }
        catch(\Exception $e) {
        }
        //Get inner string of message

        $msg = Controller::getInnerSubstring($headers, "X-MESSAGE:", "\r\n");

        $result = array('headers' => $headers,
            'responseText' => json_decode($content, true),
            'msg_status' => $msg);
        curl_close($res);
        return $result;
    }

    private function responseGet($res, $resp) {
        $encodedResp = $resp;
        $headers = curl_getinfo($res);

        #list($headers, $content) = explode("\r\n\r\n", $encodedResp , 2);
        # $d_header = explode("," , $headers);

        // for($k=0; $k<count($headers); $k++):
        //     printf('<p>Header: %s</p>', $headers[$k]);
        // endfor;

        $content = json_decode($encodedResp);
        //Get inner string of message

        curl_close($res);
        return $content;
    }

    private function responsePut($res, $resp) {
        $encodedResp = $resp;
        $headers = curl_getinfo($res);
        #dd($encodedResp);
        list($headers, $content) = explode("\r\n\r\n", $encodedResp , 2);

        // foreach (explode("\r\n", $headers) as $hdr)
        //     printf('<p>Header: %s</p>', $hdr);
        //echo $content;

        try {
            if(strpos($headers['content_type'], 'JSON') !== false) {
                $encodedResp = json_decode($encodedResp, true);
            } else {
                $encodedResp = $encodedResp;
            }
        }
        catch(\Exception $e) {
        }

        //Get inner string of message
        $msg = Controller::getInnerSubstring($headers, "X-Message:", "\r\n");

        $result = array('headers' => $headers,
            'responseText' => json_decode($content),
            'msg_status' => $msg);
        curl_close($res);
        return $result;
    }

    private function translateHeaders($header, $data = null) {
        $header['AppId'] = Config::get('webservice.application_id');

        if(!isset($header['Content-Type'])) $header['Content-Type'] = 'application/json';


        if($data){
            $header['Content-Length'] = strlen($data);
        }

        if(!isset($header['X-Forwarded-For'])) $header['X-Forwarded-For'] = filter_var( $_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
        if(!isset($header['X-Real-IP'])) $header['X-Real-IP'] = filter_var( $_SERVER['SERVER_ADDR'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
        if(!isset($header['Expect'])) $header['Expect'] = '';
        if(!isset($header['Origin'])) $header['Origin'] = 'MedVoice-Website';
        if(!isset($header['Accept-Encoding'])) $header['Accept-Encoding'] = 'gzip, deflate';
        if(!isset($header['User-Agent'])) $header['User-Agent'] = @$_SERVER['HTTP_USER_AGENT'];
        if(!isset($header['X-AUTH'])) $header['X-AUTH'] = Session::has('user') ? Session::get('user')['auth_token'] : '';

        $result = array();
        foreach ($header as $key => $value) {
            $result[] = $key . ': ' . $value;
        }

        //dd($header);

        return $result;
    }

    public function curlGet($uri, $header)
    {
        $curl = curl_init();

        $options = array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $uri,
            CURLOPT_HTTPHEADER => $this->curlHeader($header));

        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, $options);

        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        curl_close($curl);

        return $resp;
    }

    private function curlHeader($header)
    {
        $result = array();

        if(count($header)){

            foreach ($header as $key => $value) {
                $result[] = $key . ': ' . $value;
            }
        }

        return $result;
    }

    /**
     * Do Get Request to Gateway
     */
    public function get($uri, $data = array(), $headers = array()) {

        $uri        = $this->getServerAddress() . $this->sanitizeUri($uri) . http_build_query($data);
        $curl       = curl_init();

        $options    = array(CURLOPT_ENCODING => "gzip",
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $uri,
            CURLOPT_USERAGENT => 'MedVoice',
            CURLOPT_HTTPHEADER => $this->translateHeaders($headers));

        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, $options);

        // Send the request & save response to $resp
        $resp = curl_exec($curl);

        return $this->responseGet($curl, $resp);
    }

    /**
     * Do Post Request
     */
    public function post($uri, $data = array(), $headers = array()) {
        $uri = $this->getServerAddress() . $this->sanitizeUri($uri);

        if(isset($headers['Content-Type']) && ($headers['Content-Type']  == 'multipart/form-data')){
            $data   =  $data;
        }else{
            $data   =   json_encode($data);
        }

        // Get cURL resource
        $curl = curl_init();

        $options = array(CURLOPT_ENCODING => "gzip",CURLOPT_CUSTOMREQUEST => 'POST', CURLOPT_HEADER => 1,CURLOPT_HTTPPROXYTUNNEL => 1, CURLOPT_FOLLOWLOCATION=> 1, CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => $uri, CURLOPT_USERAGENT => 'CamFree', CURLOPT_POST => 1, CURLOPT_POSTFIELDS => $data, CURLOPT_HTTPHEADER => $this->translateHeaders($headers), CURLINFO_HEADER_OUT => true);

        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, $options);

        // Send the request & save response to $resp
        $resp = curl_exec($curl);

        return $this->response($curl, $resp);
    }

    /**
     * Do Put Request
     */
    public function put($uri, $data = array(), $headers = array()) {
        $uri = $this->getServerAddress() . $this->sanitizeUri($uri);

        if(isset($headers['Content-Type']) && ($headers['Content-Type']  == 'multipart/form-data')){
            $data   =  $data;

        }else{
            $data   =   json_encode($data);
        }
        // Get cURL resource
        $curl = curl_init();

        // Set some options - we are passing in a useragent too here
        #curl_setopt_array($curl, array(CURLOPT_ENCODING => "gzip",CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => $uri, CURLOPT_USERAGENT => 'MedVoice', CURLOPT_POSTFIELDS => json_encode($data), CURLOPT_HTTPHEADER => $this->translateHeaders($headers), CURLOPT_CUSTOMREQUEST => 'PUT'));
        $options = array(CURLOPT_ENCODING => "gzip",CURLOPT_CUSTOMREQUEST => 'POST', CURLOPT_HEADER => 1,CURLOPT_HTTPPROXYTUNNEL => 1, CURLOPT_FOLLOWLOCATION=> 1, CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => $uri, CURLOPT_USERAGENT => 'MedVoice', CURLOPT_POST => 1, CURLOPT_POSTFIELDS => $data, CURLOPT_HTTPHEADER => $this->translateHeaders($headers), CURLINFO_HEADER_OUT => true);

        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, $options);

        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        return $this->responsePut($curl, $resp);
    }

    /**
     * Do Delete Request
     */
    public function delete($uri, $data = array(), $headers = array()) {
        $uri = $this->getServerAddress() . $this->sanitizeUri($uri);
        $headers['X-HTTP-Method-Override'] = 'DELETE';

        // Get cURL resource
        $curl = curl_init();

        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(CURLOPT_ENCODING => "gzip",CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => $uri, CURLOPT_USERAGENT => 'MedVoice', CURLOPT_POSTFIELDS => json_encode($data), CURLOPT_HTTPHEADER => $this->translateHeaders($headers), CURLOPT_CUSTOMREQUEST => 'DELETE'));

        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        return $this->response($curl, $resp);
    }

    public function getInnerSubstring($string, $start, $end){

        $string = ' ' . $string;
        $ini = strpos($string, $start);
        if ($ini == 0) return '';
        $ini += strlen($start);
        $len = strpos($string, $end, $ini) - $ini;
        $result = trim(substr($string, $ini, $len));

        return str_replace("\r\n", "", $result);
    }

    /* ------------------------------------------------------------------------------------- */
    public function normalizeAPIData($data){
        $httpResultCode     = (isset($data['headers'])) ? substr($data['headers'], 9, 3) : 200;
        // echo "Code:<pre>";
        // print_r($httpResultCode);
        // echo "</pre>";

        if (isset($data['responseText'])) {
            $data   = $data['responseText'];
            // dd($data);
        }
        // echo "After:<pre>";
        // print_r($data);
        // echo "</pre>";

        // echo "Data JSON:<pre>";
        // print_r($data);
        // echo "</pre>";

        if ($httpResultCode >= 200 && $httpResultCode <400){
            // return "Success here...";
            return $this->responseSuccess($data, $httpResultCode);
        }
        else{
            // return "Error here...";
            return $this->responseError($data, $httpResultCode);
        }
    }
}