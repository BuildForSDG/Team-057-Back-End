<?php
    $output = [];

    $input = new Validator();

    if ($input->validateNewProfile()) {

        // Road Tip Creation

        $profile = new Profile();

        $profile->user_id = $input->user_id;
        $profile->profile_data = $input->profile_data;

        if ($profile->create()) {

            http_response_code(201);

            $output = [
                "status" => 201,
                "success" => true,
                "message" => "Created successfully.",
                "data" => [
                    "User ID" => $profile->user_id,
                    "Profile Data" => $profile->profile_data,
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
                    "User ID" => $profile->user_id,
                    "Profile Data" => $profile->profile_data,
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