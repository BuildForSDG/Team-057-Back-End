<?php
    class CURL {
        public $url;
        public $data;
        public $http_status;
        public $header;
        public $user;
        public $password;
        public $ch;
        public $timeout = 50000;

        public function __construct() {
            # code...
        }

        public function post() {

            $this->ch = curl_init();

            // user credentials
            curl_setopt($this->ch, CURLOPT_USERPWD, $this->user . ":" . $this->password);
            curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->ch, CURLOPT_URL, $this->url);
        
            // data
            curl_setopt($this->ch, CURLOPT_POST, true);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->data);
        
            if (!is_null($this->header)) {
                curl_setopt($this->ch, CURLOPT_HEADER, true);
            }
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Accept: application/json', 'Content-Type: application/json'));
        
            curl_setopt($this->ch, CURLOPT_VERBOSE, true);
            
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        
            $response = curl_exec($this->ch);
            // Log::debug('Curl exec=' . $this->url);
              
            // $body = null;
            // // error
            // if (!$response) {
            //     $body = curl_error($this->ch);
            //     // HostNotFound, No route to Host, etc  Network related error
            //     $http_status = -1;
            //     Log::error("CURL Error: = " . $body);
            // } else {
            //    //parsing http status code
            //     $http_status = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);
        
            //     if (!is_null($this->header)) {
            //         $header_size = curl_getinfo($this->ch, CURLINFO_HEADER_SIZE);
        
            //         $header = substr($response, 0, $header_size);
            //         $body = substr($response, $header_size);
            //     } else {
            //         $body = $response;
            //     }
            // }
        
            curl_close($this->ch);
        
            // return $body;
        
            return $response;
        }

        public function get() {

            $this->ch = curl_init();

            curl_setopt($this->ch, CURLOPT_URL, $this->url);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, $this->timeout);

            // Get URL content
            $response = curl_exec($this->ch);

            // close handle to release resources
            curl_close($this->ch);

            //output, you can also save it locally on the server
            return $response;
        }
    }

?>