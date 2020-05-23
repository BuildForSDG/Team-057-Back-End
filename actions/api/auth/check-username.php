<?php
    $input = new Validator();

    if ($input->checkUsername()) {
        $output = [
            "exists" => true,
            "message" => "Username already exists",
            "data" => [
                "Username" => $input->email,
            ],
        ];
    }
    else {
        $output = [
            "exists" => false,
            "message" => "Username not found",
            "data" => [
                "Username" => $input->email,
            ],
        ];
    }

    require 'actions/api/api.php';

?>