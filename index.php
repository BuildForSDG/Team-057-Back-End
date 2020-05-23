<?php
    include 'app/info.php';
    include 'app/functions.php';

    require 'database/query.php';

    initModules();

    $logs = new Logs();

    $request = $_SERVER['REQUEST_URI'];
    $method = $_SERVER['REQUEST_METHOD'];
    
    if ($method === 'POST') {
        switch ($request) {
            // case '/api/v1/on-covid-19' : action('api/estimate-json'); break;
            
            default: require 'app/routes.php'; break;
        }
    }
    else {
        switch ($request) {
            case '' : _(getenv('APP_NAME')); break;
            case '/' : _(getenv('APP_NAME')); break;

            case '/api/v1/on-covid-19/logs' : $logs->view(); break;
            case '/api/v1/on-covid-19/logs/clear' : $logs->clear(); break;
            
            default: require 'app/routes.php'; break;
        }
    }

    $logs->new();
?>