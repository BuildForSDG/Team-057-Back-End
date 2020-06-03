<?php
    if (fnmatch("/view/*", $request)) {
        // action('deal');
        $db_table = str_replace('/view/', '', $request);

        header("Content-type: application/json");
        
        _(json_encode(dbSelectAll($db_table, 1)));

    }
    else {
        http_response_code(404);
        view('404');
    }
    
?>