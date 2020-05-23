<?php
    class Session {
        public $user;
        public $data;

        function start () {
            session_start();
        }

        function set ($name, $value) {

            $_SESSION[$name] = $value;

            if ($_SESSION[$name] == $value) {
                return true;
            }
            else {
                return false;
            }
        }

        function get ($name) {

            if (isset($_SESSION[$name])) {
                return $_SESSION[$name];
            }
            else {
                return false;
            }
        }

        function remove ($name) {
            unset($_SESSION[$name]);
            
            if (!isset($_SESSION[$name])) {
                return true;
            }
            else {
                return false;
            }
        }

        function end () {
            if (session_destroy()) {
                return true;
            }
            else {
                return false;
            }
        }
    }
?>