<?php
    namespace App\Helpers;
    
    use GuzzleHttp\Client;
    use Illuminate\Support\Facades\Session;
    use Request;

    class Curl {

        public static function endpoint()
        {
            $str = config('app.api');
            return $str;
        }  
        
        public static function getClientIps()
        {
            return Request::ip(); 

            foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
                if (array_key_exists($key, $_SERVER) === true){
                    foreach (explode(',', $_SERVER[$key]) as $ip){
                        $ip = trim($ip); // just to be safe
                        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                            return $ip;
                        }
                    }
                }
            }

            return request()->ip(); 
        } 

        public static function storagePath() {
            $path = Curl::frontUrl() ."storage/assets/uploads";
            return $path;
        }

        public static function postRequest($url, $param)
        {
            $client = new Client();
            $res = $client->request('POST', $url, [
                'headers' => [
                    'Content-Type'  => 'application/x-www-form-urlencoded',
                    'Authorization' => 'Bearer '. Session::get('access')
                ],
                'form_params'     => $param,
                'connect_timeout' => 10
            ]);
            
            //if($res->getStatusCode() == 200) {
                return json_decode($res->getBody());
            //}
            //else {
            //    return json_decode('{"status": false, "message": "Kesalahan koneksi internal", "data": "[]"}');
            //}
        }

        public static function requestPost($url, $param)
        {
            $client = new Client();
            $res = $client->request('POST', $url, [
                'json'     => $param,
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer '. Session::get('access')
                ],
                'connect_timeout' => 10
            ]);
            
            //if($res->getStatusCode() == 200) {
                return json_decode($res->getBody());
            //}
            //else {
            //    return json_decode('{"status": false, "message": "Kesalahan koneksi internal", "data": "[]"}');
            //}
        }

        public static function requestGet($url)
        {
            $client = new Client();
            $res = $client->request('GET', $url, [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer '. Session::get('access')
                ],
                'connect_timeout' => 10
            ]);
            //$res = $client->request('GET', $url);
            
            //if($res->getStatusCode() == 200) {
                return json_decode($res->getBody());
            //}
            //else {
            //    return json_decode('{"status": false, "message": "Kesalahan koneksi internal", "data": "[]"}');
            //}
        }

        public static function requestPut($url, $param)
        {
            $client = new Client();
            $res = $client->request('PUT', $url, [
                'json'     => $param,
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer '. Session::get('access')
                ],
                'connect_timeout' => 10
            ]);
            //Curl::json($res);
            //if($res->getStatusCode() == 200) {
                return json_decode($res->getBody());
            //}
            //else {
            //    return json_decode('{"status": false, "message": "Kesalahan koneksi internal", "data": "[]"}');
            //}
        }

        public static function requestDelete($url)
        {
            $client = new Client();
            $res = $client->request('DELETE', $url, [
                'headers' => [
                    'Content-Type'  => 'application/json',
                    'Authorization' => 'Bearer '. Session::get('access')
                ],
                'connect_timeout' => 10
            ]);
            //$res = $client->request('GET', $url);
            
            //if($res->getStatusCode() == 200) {
                return json_decode($res->getBody());
            //}
            //else {
            //    return json_decode('{"status": false, "message": "Kesalahan koneksi internal", "data": "[]"}');
            //}
        }

        public static function json($str)
        {
            echo json_encode($str); die();
        }
    }
