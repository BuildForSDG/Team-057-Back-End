<?php
    if (fnmatch("/db/view/*", $request)) {
        
        $db_table = str_replace('/db/view/', '', $request);

        header("Content-type: application/json");
        
        _(json_encode(dbSelectAll($db_table, 1)));

    }
    elseif (fnmatch("/db/drop/*", $request)) {
        
        $db_table = str_replace('/db/drop/', '', $request);

        header("Content-type: application/json");

        _((dbDropTable($db_table)) ? 'Done...' : 'Not Done...');

    }
    elseif (fnmatch("/db/truncate/*", $request)) {
        
        $db_table = str_replace('/db/truncate/', '', $request);

        header("Content-type: application/json");

        _((dbTruncate($db_table)) ? 'Done...' : 'Not Done...');

    }
    elseif (fnmatch("/api/DSB*/stop", $request)) {
        
        $distress_id = str_replace('/api/', '', $request);
        $distress_id = str_replace('/stop', '', $distress_id);

        require 'actions/api/update/stop-distress.php';

    }
    else {
        http_response_code(404);
        view('404');
    }
    
?>