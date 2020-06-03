<?php
    $output = [];

    $road_tips = new RoadTip();

    $tips = $road_tips->getTips();

    if ($tips) {

        http_response_code(200);

        $output = [
            "status" => 200,
            "success" => true,
            "message" => "Successful.",
            "tips" => $tips,
        ];
    }
    else {

        http_response_code(204);

        $output = [
            "status" => 204,
            "success" => false,
            "message" => "No Content.",
        ];
    }

    require 'actions/api/api.php';

?>