<?php
    $input = new Validator();

    if ($input->checkEmail()) {
        $output = [
            "exists" => true,
            "message" => "Email already exists",
            "data" => [
                "Email" => $input->email,
            ],
        ];
    }
    else {
        $output = [
            "exists" => false,
            "message" => "Email not found",
            "data" => [
                "Email" => $input->email,
            ],
        ];
    }

    require 'actions/api/api.php';

?>