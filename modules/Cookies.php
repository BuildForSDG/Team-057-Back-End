<?php
    class Cookies {

        function set ($name, $value = NULL, $expire = 0, $path = "/", $domain = NULL, $secure = FALSE, $httponly = FALSE) {

            if (setcookie($name, $value, $expire, $path, $domain, $secure, $httponly)) {
                return true;
            }
            else {
                return false;
            }
        }

        function get ($name) {

            if (isset($_COOKIE[$name])) {
                return $_COOKIE[$name];
            }
            else {
                return false;
            }
        }

        function remove ($name) {
            
            if (setcookie($name, NULL, time() - 3600)) {
                return true;
            }
            else {
                return false;
            }
        }
    }
?>