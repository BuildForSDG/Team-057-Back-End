<?php
    $output = [];

    $input = new Validator();

    if ($input->validateNewDistress()) {

        // Distress Broadcast Creation

        $distress = new DistressBroadcast();

        $distress->location = $input->location;
        $distress->data = $input->data;
        $distress->broadcasting = $input->broadcasting;

        if ($distress->create()) {

            http_response_code(201);

            $output = [
                "status" => 201,
                "success" => true,
                "message" => "Created successfully.",
                "data" => [
                    "Distress ID" => $distress->distress_id,
                    "Location" => $distress->location,
                    "Data" => $distress->data,
                    "Broadcasting" => $distress->broadcasting,
                ],
            ];
        }
        else {

            http_response_code(424);

            $output = [
                "status" => 424,
                "success" => false,
                "message" => "Could not create, try again.",
                "data" => [
                    "Location" => $distress->location,
                    "Data" => $distress->data,
                    "Broadcasting" => $distress->broadcasting,
                ],
            ];
        }
    }
    else {

        http_response_code(400);

        $errors = $input->errors;

        $output = [
            "status" => 400,
            "title" => "Invalid parameters",
            "detail" => $errors
        ];

    }

    require 'actions/api/api.php';
    
?>