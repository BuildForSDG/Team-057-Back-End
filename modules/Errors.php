<?php
    class Errors {
        // public $logs;

        // Authentication

        // public $first_name;
        // public $last_name;
        // public $email;
        // public $username;
        // public $phone;
        // public $dob;
        // public $password;

        function has ($name) {
            if (isset($this->errors[$name])) {
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
            elseif ($this->email) {
                return false;
            }
            elseif ($this->username) {
                return false;
            }
            elseif ($this->phone) {
                return false;
            }
            elseif ($this->dob) {
                return false;
            }
            elseif ($this->password) {
                return false;
            }
            else {
                return true;
            }
        }
    }
?>