<?php
    $output = [];

    $input = new Validator();

    if ($input->validateNewRogueDriverReport()) {

        // Road Tip Creation

        $rogue_driver = new RogueDriver();

        $rogue_driver->location = $input->location;
        $rogue_driver->pictures = $input->pictures;
        $rogue_driver->medias = $input->medias;
        $rogue_driver->data = $input->data;

        if ($rogue_driver->create()) {

            http_response_code(201);

            $output = [
                "status" => 201,
                "success" => true,
                "message" => "Created successfully.",
                "data" => [
                    "Report ID" => $rogue_driver->rogue_driver_id,
                    "Location" => $rogue_driver->location,
                    "Pictures" => $rogue_driver->pictures,
                    "Medias" => $rogue_driver->medias,
                    "Data" => $rogue_driver->data,
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
                    "Location" => $rogue_driver->location,
                    "Pictures" => $rogue_driver->pictures,
                    "Medias" => $rogue_driver->medias,
                    "Data" => $rogue_driver->data,
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