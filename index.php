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
            case '/dialogflow' : action('api/dialogflow'); break;
            case '/queries' : action('api/queries'); break;
            
            case '/api/user/profile/create' : action('api/create/profile'); break;
            case '/api/distresses/create' : action('api/create/distress'); break;
            case '/api/reports/rouge-drivers/create' : action('api/create/rouge-driver'); break;
            case '/api/reports/poor-roads/create' : action('api/create/poor-roads'); break;
            case '/api/road-tips/create' : action('api/create/road-tips'); break;

            case '/api/user/profile/update' : action('api/update/profile'); break;
            case '/api/distresses/update' : action('api/update/distress'); break;
            case '/api/reports/rouge-drivers/update' : action('api/update/report/rouge-driver'); break;
            case '/api/reports/poor-roads/update' : action('api/update/report/rouge-driver'); break;
            case '/api/road-tips/update' : action('api/update/road-tips'); break;

            default: require 'app/routes.php'; break;
        }
    }
    else {
        switch ($request) {
            case '' : _(getenv('APP_NAME')); break;
            case '/' : _(getenv('APP_NAME')); break;

            case '/test' : _(rand(10000,99999)); break;

            case '/test' : _(rand(10000,99999)); break;
            
            case '/api/user/profile' : action('api/read/profile'); break;
            
            case '/api/distresses' : action('api/read/distress'); break;
            
            case '/api/reports/rouge-drivers' : action('api/read/report/rouge-driver'); break;
            
            case '/api/reports/poor-roads' : action('api/read/report/rouge-driver'); break;

            case '/api/road-tips' : action('api/read/road-tips'); break;

            case '/queries' : header("Content-type:text/plain"); $logs = fopen("logs", "r"); _(fread($logs,filesize("logs"))); fclose($logs); break;

            // case '/truncate/users' 

            case '/setup' : require 'database/migrations/setup.php'; break;
            
            default: require 'app/routes.php'; break;
        }
    }

    $logs->new();
?>