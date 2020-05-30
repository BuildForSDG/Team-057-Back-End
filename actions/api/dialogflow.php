<?php
    // Verification

    // $data = json_decode(file_get_contents("php://input"));
    
    // $queries = fopen("queries", "a");

    // fwrite($queries, json_encode($data) . "\n" . "\n" . "\n" . "\n");

    // fclose($queries);

    // $output = [
    //     "fulfillmentMessages" => [
    //         [
    //             "text" => [
    //                 "text" => [
    //                     "Text response from webhook"
    //                 ]
    //             ]
    //         ]
    //     ]
    // ];

    // require 'actions/api/api.php';



    $input = new Validator();

    if ($input->validateDialogflow()) {

        $output = [
            "fulfillmentMessages" => [
                [
                    "text" => [
                        "text" => [
                            "Account Created Successfully."
                        ]
                    ]
                ]
            ]
        ];

        // User Creation

        // $user = new User();

        // $user->first_name = $input->first_name;
        // $user->last_name = $input->last_name;
        // $user->email = $input->email;
        // $user->username = $input->username;
        // $user->phone = $input->phone;
        // $user->dob = $input->dob;
        // $user->password = $input->password;

        // if ($user->create()) {

        //     $output = [
        //         "success" => true,
        //         "message" => "User account created successfully",
        //         "redirectTo" => "/sign-in",
        //         "data" => [
        //             "User ID" => $user->user_id,
        //             "First Name" => $user->first_name,
        //             "Last Name" => $user->last_name,
        //             "Email" => $user->email,
        //             "Username" => $user->username,
        //             "Phone" => $user->phone,
        //             "Date of Birth" => $user->dob,
        //         ],
        //     ];
        // }
        // else {

        //     $output = [
        //         "success" => false,
        //         "message" => "User account could not be created, please try again.",
        //         "redirectTo" => "/create-account",
        //         "data" => [
        //             "First Name" => $user->first_name,
        //             "Last Name" => $user->last_name,
        //             "Email" => $user->email,
        //             "Username" => $user->username,
        //             "Phone" => $user->phone,
        //             "Date of Birth" => $user->dob,
        //         ],
        //     ];
        // }
    }
    else {

        // Log Errors
    
        $errors = $input->errors;
        
        if ($errors->first_name) {
            $responseText = $errors->first_name;
        }
        elseif ($errors->last_name) {
            $responseText = $errors->last_name;
        }
        elseif ($errors->gender) {
            $responseText = $errors->last_name;
        }
        elseif ($errors->dob) {
            $responseText = $errors->dob;
        }
        elseif ($errors->email) {
            $responseText = $errors->email;
        }
        elseif ($errors->phone) {
            $responseText = $errors->phone;
        }
        elseif ($errors->country) {
            $responseText = $errors->country;
        }
        elseif ($errors->state) {
            $responseText = $errors->state;
        }
        elseif ($errors->city) {
            $responseText = $errors->city;
        }
        elseif ($errors->address) {
            $responseText = $errors->address;
        }

        $output = [
            "fulfillmentMessages" => [
                [
                    "text" => [
                        "text" => [
                            $responseText
                        ]
                    ]
                ]
            ]
        ];
    }

    require 'actions/api/api.php';
    
?>