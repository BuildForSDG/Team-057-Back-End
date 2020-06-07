<?php
    $output = [];

    $input = new Validator();

    if ($input->validateNewPoorRoadReport()) {

        // Road Tip Creation

        $poor_road = new PoorRoad();

        $poor_road->location = $input->location;
        $poor_road->damage_ratio = $input->damage_ratio;
        $poor_road->pictures = $input->pictures;
        $poor_road->data = $input->data;

        if ($poor_road->create()) {

            http_response_code(201);

            $output = [
                "status" => 201,
                "success" => true,
                "message" => "Created successfully.",
                "data" => [
                    "Road Tip ID" => $poor_road->poor_road_id,
                    "Location" => $poor_road->location,
                    "Damage Ratio" => $poor_road->damage_ratio,
                    "Pictures" => $poor_road->pictures,
                    "Data" => $poor_road->data,
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
                    "Location" => $poor_road->location,
                    "Damage Ratio" => $poor_road->damage_ratio,
                    "Pictures" => $poor_road->pictures,
                    "Data" => $poor_road->data,
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