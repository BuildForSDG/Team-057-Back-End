<?php
    // Verification

    $input = new Validator();

    if ($input->validateLogin()) {

        // User Login

        $user = new User();

        $input->user['logtime'] = time();

        if ($user->login($input->user, $input->remember_me)) {

            $output = [
                "success" => true,
                "message" => "User logged in successfully",
                "redirectTo" => "/dashboard",
                "user" => [
                    "User ID" => $user->user_id,
                    "First Name" => $user->first_name,
                    "Last Name" => $user->last_name,
                    "Email" => $user->email,
                    "Username" => $user->username,
                    "Phone" => $user->phone,
                    "Date of Birth" => $user->dob,
                ],
                "data" => [
                    "log in" => $input->login,
                    "remember me" => $input->remember_me,
                ],
            ];
        }
        else {

            $output = [
                "success" => false,
                "message" => "Unable to log you in, please try again",
                "redirectTo" => "/sign-in",
                "data" => [
                    "log in" => $input->login,
                    "remember me" => $input->remember_me,
                ],
            ];
        }
    }
    else {

        // Log Errors
    
        $errors = $input->errors;

        $output = [
            "success" => false,
            "message" => "Error: Invalid Details",
            "errors" => $errors,
        ];
    }

    require 'actions/api/api.php';
    
?>