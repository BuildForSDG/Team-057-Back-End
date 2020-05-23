<?php
    function view($name) {
        return require("views/$name.php");
    }

    function action($name) {
        return require("actions/$name.php");
    }
    
    function midware($name) {
        require "actions/midware/$name.php";
    }

    function redirect($dir) {
        header("Location: $dir");
        exit;
    }

    function assets($dir) {

        $request_uri = $_SERVER['REQUEST_URI'];

        $level = substr_count($request_uri, '/');

        $path = '';

        for ($i=0; $i < $level; $i++) { 
            $path .= '../';
        }
        
        echo $path . 'assets/' . $dir;
    }

    function _($val) {
        echo $val;
    }

    function startLayout($name) {
        include 'info.php';
        return require("views/layouts/$name.start.php");
    }

    function endLayout($name) {
        return require("views/layouts/$name.end.php");
    }

    function component($name) {
        return require("views/components/$name.php");
    }

    function initModules() {
        $modules = scandir('modules/');

        foreach ($modules as $module) {
            if (substr_count($module, '.php')) {
                require "modules/$module";
            }
        }
    }

    function shuf($a, $z) {
        $array = [];

        $i = 0;

        while ($a <= $z) {
            $array[$i] = $a;
            $i++;
            $a++;
        }

        shuffle($array);

        return $array;
    }
?>