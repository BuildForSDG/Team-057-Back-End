<?php
        
    $distress_id = str_replace('/api/', '', $request);
    $distress_id = str_replace('/stop', '', $distress_id);

    $output = [];

    $distress = new DistressBroadcast();

    if ($distress->stop($distress_id)) {

        http_response_code(201);

        $output = [
            "status" => 201,
            "success" => true,
            "message" => "Updated successfully.",
            "data" => [
                "Distress ID" => $distress->distress_id,
                "Broadcasting" => false,
            ],
        ];
    }
    else {

        http_response_code(424);

        $output = [
            "status" => 424,
            "success" => false,
            "message" => "Could not update, try again.",
            "data" => [
                "Distress ID" => $distress->distress_id,
                "Broadcasting" => true
            ],
        ];
    }

    require 'actions/api/api.php';
    
?>