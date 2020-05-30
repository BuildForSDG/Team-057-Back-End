<?php
    // Verification
    
    $data = json_decode(file_get_contents("php://input"));
    
    $queries = fopen("queries", "a");

    fwrite($queries, json_encode($data) . "\n" . "\n" . "\n" . "\n");

    fclose($queries);

    // $input = new Validator();

    // if ($input->validateDialogflow()) {

    //     // User Creation

    //     $user = new User();

    //     $user->first_name = $input->first_name;
    //     $user->last_name = $input->last_name;
    //     $user->email = $input->email;
    //     $user->username = $input->username;
    //     $user->phone = $input->phone;
    //     $user->dob = $input->dob;
    //     $user->password = $input->password;

    //     if ($user->create()) {

    //         $output = [
    //             "success" => true,
    //             "message" => "User account created successfully",
    //             "redirectTo" => "/sign-in",
    //             "data" => [
    //                 "User ID" => $user->user_id,
    //                 "First Name" => $user->first_name,
    //                 "Last Name" => $user->last_name,
    //                 "Email" => $user->email,
    //                 "Username" => $user->username,
    //                 "Phone" => $user->phone,
    //                 "Date of Birth" => $user->dob,
    //             ],
    //         ];
    //     }
    //     else {

    //         $output = [
    //             "success" => false,
    //             "message" => "User account could not be created, please try again.",
    //             "redirectTo" => "/create-account",
    //             "data" => [
    //                 "First Name" => $user->first_name,
    //                 "Last Name" => $user->last_name,
    //                 "Email" => $user->email,
    //                 "Username" => $user->username,
    //                 "Phone" => $user->phone,
    //                 "Date of Birth" => $user->dob,
    //             ],
    //         ];
    //     }
    // }
    // else {

    //     // Log Errors
    
    //     $errors = $input->errors;

    //     $output = [
    //         "success" => false,
    //         "message" => "Error: Invalid Details",
    //         "errors" => $errors,
    //     ];
    // }

    // require 'actions/api/api.php';
    
?>