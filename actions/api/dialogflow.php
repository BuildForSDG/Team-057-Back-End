<?php
    // Verification

    $data = json_decode(file_get_contents("php://input"));
    
    $queries = fopen("queries", "a");

    fwrite($queries, json_encode($data) . "\n" . "\n" . "\n" . "\n");

    fclose($queries);

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

    $output = [];

    $input = new Validator();

    if ($input->validateDialogflow()) {

        // User Creation

        $user = new User();

        $user->first_name = $input->first_name;
        $user->last_name = $input->last_name;
        $user->gender = $input->gender;
        $user->dob = $input->dob;
        $user->email = $input->email;
        $user->phone = $input->phone;
        $user->country = $input->country;
        $user->state = $input->state;
        $user->city = $input->city;
        $user->address = $input->address;
        $user->email_verify_otp = $input->activation_code;

        if ($user->email_verify_otp != "") {

            if ($user->verifyEmail() == "unmatched") {
                $output = [
                    "fulfillmentMessages" => [
                        [
                            "text" => [
                                "text" => [
                                    "Incorrect activation code.",
                                    // "An email has been sent to your email address " . $user->email . ". In it contains your account activation code.",
                                    // "What is the activation code please?"
                                ]
                            ]
                        ]
                    ]
                ];
            }
            elseif ($user->verifyEmail() == true) {
                $output = [
                    "fulfillmentMessages" => [
                        [
                            "text" => [
                                "text" => [
                                    "Your account has successfully been activated.",
                                    "Enjoy my sevices.",
                                    // "An email has been sent to your email address " . $user->email . ". In it contains your account activation code.",
                                    // "What is the activation code please?"
                                ]
                            ]
                        ]
                    ]
                ];
            }
            else {
                $output = [
                    "fulfillmentMessages" => [
                        [
                            "text" => [
                                "text" => [
                                    "An error occurred, please try again.",
                                    // "An email has been sent to your email address " . $user->email . ". In it contains your account activation code.",
                                    // "What is the activation code please?"
                                ]
                            ]
                        ]
                    ]
                ];
            }

        }
        elseif ($user->create()) {

            $output = [
                "fulfillmentMessages" => [
                    [
                        "text" => [
                            "text" => [
                                "Thanks for signing up " . $user->first_name . ", I am happy to have you onboard.",
                            ],
                        ],
                    ],
                    [
                        "text" => [
                            "text" => [
                                "An email has been sent to your email address '" . $user->email . "'. In it contains your account activation code.",
                            ],
                        ],
                    ],
                    [
                        "text" => [
                            "text" => [
                                "What is the activation code please?"
                            ],
                        ]
                    ]
                ]
            ];
            
        }
        else {

            $output = [
                "fulfillmentMessages" => [
                    [
                        "text" => [
                            "text" => [
                                "Account Wasn't Created Successfully."
                            ]
                        ]
                    ]
                ]
            ];
        }
    }
    else {

        // Log Errors
    
        $errors = $input->errors;

        $responseText = "";
        
        if ($errors->dob && $input->dob) {
            $responseText = $errors->dob;
        }
        elseif ($errors->email && $input->email) {
            $responseText = $errors->email;
        }
        elseif ($errors->phone && $input->phone) {
            $responseText = $errors->phone;
        }

        if ($responseText) {
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
        else {
            $output = [
                "fulfillmentMessages" => [
                    [
                        "text" => [
                            "text" => [
                                $input->responseText
                            ]
                        ]
                    ]
                ]
            ];
        }

    }

    require 'actions/api/api.php';
    
?>