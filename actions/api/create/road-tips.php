<?php
    $output = [];

    $input = new Validator();

    if ($input->validateNewRoadTip()) {

        // Road Tip Creation

        $roadTip = new RoadTip();

        $road_tip->title = $input->title;
        $road_tip->content = $input->content;
        $road_tip->illustration = $input->illustration;

        if ($road_tip->create()) {

            http_response_code(201);

            $output = [
                "status" => 201,
                "success" => true,
                "message" => "Created successfully.",
                "data" => [
                    "Road Tip ID" => $road_tip->road_tip_id,
                    "Title" => $road_tip->title,
                    "Content" => $road_tip->content,
                    "Illustration" => $road_tip->illustration,
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
                    "Title" => $road_tip->title,
                    "Content" => $road_tip->content,
                    "Illustration" => $road_tip->illustration,
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