<?php
    class Vemail {
        public $title;
        public $message;
        public $sender;
        public $recievers;

        public function __construct() {
            $this->cURL = new CURL();
        }
        
        public function send() {

            $sender = $this->sender['Email'] . ":" . $this->sender['Name'];
            $recievers = '';

            foreach ($this->recievers as $reciever) {
                if ($recievers) {
                    $recievers .= "," . $reciever['Email'] . ":" . $reciever['Name'];
                }
                else {
                    $recievers = $reciever['Email'] . ":" . $reciever['Name'];
                }
            }

            $title = urlencode($this->title);
            $message = urlencode($this->message);
            $sender = urlencode($sender);
            $recievers = urlencode($recievers);
            
            $this->cURL->url = "http://vemail.herokuapp.com/";
            $this->cURL->url .= "?senders=" . $sender;
            $this->cURL->url .= "&recievers=" . $recievers;
            $this->cURL->url .= "&title=" . $title;
            $this->cURL->url .= "&message=" . $message;

            $response = $this->cURL->get();

            if ($response) {
                return true;
            }
            else {
                return false;
            }

        }
    }
?>