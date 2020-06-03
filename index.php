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
            
            default: require 'app/routes.php'; break;
        }
    }
    else {
        switch ($request) {
            case '' : _(getenv('APP_NAME')); break;
            case '/' : _(getenv('APP_NAME')); break;

            case '/dropUser' : dbDropTable('user');


            // case '/view/users' : header("Content-type: application/json"); _(json_encode(dbSelectAll('users', 1))); break;

            case '/setup' : require 'database/migrations/setup.php'; break;
            
            default: require 'app/routes.php'; break;
        }
    }

    $logs->new();
?>