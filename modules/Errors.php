<?php
    class Errors {
        // public $logs;

        // Authentication

        public $first_name;
        public $last_name;
        public $gender;
        public $dob;
        public $email;
        public $phone;
        public $country;
        public $state;
        public $city;
        public $address;

        // Road Tips
        
        public $title;
        public $content;
        public $illustration;

        function has ($name) {
            if (isset($this->errors->{$name})) {
                return true;
            }
            else {
                return false;
            }
        }

        function logs () {
            return [
                "first_name" => $this->first_name,
                "last_name" => $this->last_name,
                "email" => $this->email,
                "username" => $this->username,
                "phone" => $this->phone,
                "dob" => $this->dob,
                "password" => $this->password,
            ];
        }

        function isvalid () {
            if ($this->first_name) {
                return false;
            }
            elseif ($this->last_name) {
                return false;
            }
            elseif ($this->gender) {
                return false;
            }
            elseif ($this->dob) {
                return false;
            }
            elseif ($this->email) {
                return false;
            }
            elseif ($this->phone) {
                return false;
            }
            elseif ($this->country) {
                return false;
            }
            elseif ($this->state) {
                return false;
            }
            elseif ($this->city) {
                return false;
            }
            elseif ($this->address) {
                return false;
            }
            elseif ($this->title) {
                return false;
            }
            elseif ($this->content) {
                return false;
            }
            elseif ($this->illustration) {
                return false;
            }
            else {
                return true;
            }
        }
    }
?>