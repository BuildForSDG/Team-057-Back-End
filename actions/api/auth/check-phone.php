<?php
    $input = new Validator();

    if ($input->checkPhone()) {
        $output = [
            "exists" => true,
            "message" => "Phone number already exists",
            "data" => [
                "Phone" => $input->email,
            ],
        ];
    }
    else {
        $output = [
            "exists" => false,
            "message" => "Phone number not found",
            "data" => [
                "Phone" => $input->email,
            ],
        ];
    }

    require 'actions/api/api.php';

?>