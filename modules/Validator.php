<?php
    class Validator {
        public $user;
        public $admin;
        public $errors;

        public $intent;
        public $responseText;
        
        public $first_name;
        public $last_name;
        public $email;
        public $username;
        public $phone;
        public $dob;
        public $password;
        public $password_confirmation;

        function __construct () {
            $this->errors = new Errors();
        }

        function validateDialogflow () {

            $data = json_decode(file_get_contents("php://input"));

            $intent = $data->queryResult->intent->displayName;
            $inputs = $data->queryResult->parameters;
            $queryString = $data->queryResult->queryText;
            
            $this->responseText = $data->queryResult->fulfillmentText;

            switch ($intent) {
                case 'onboarding':
                    $this->first_name = $inputs->{'given-name'};
                    $this->last_name = $inputs->{'last-name'};
                    $this->gender = $inputs->{'gender'};
                    $this->dob = $inputs->{'date'};
                    $this->email = $inputs->{'email'};
                    $this->phone = $inputs->{'phone-number'};
                    $this->country = $inputs->{'geo-country'};
                    $this->state = $inputs->{'geo-state'};
                    $this->city = $inputs->{'geo-city'};
                    $this->address = $inputs->{'address'};

                    $emailExists = intval(!dbSelectAll('users', "`Email` = '" . $this->email . "'"));
                    $phoneExists = intval(!dbSelectAll('users', "`Phone` = '" . $this->phone . "'"));
                    $dobInvalid = intval(!time() <= strtotime($this->dob));

                    
                    if ($this->dob != "" && $dobInvalid) {
                        $this->errors->dob = 'I need a valid date of birth please.';
                    }
                    elseif ($this->email != "" && $emailExists) {
                        $this->errors->email = 'This email address has already been used. Already have an account?';
                    }
                    elseif ($this->phone != "" && $phoneExists) {
                        $this->errors->phone = 'This phone number is linked to an account already.';
                    }

                    
            
                    // Validate Sign Up Data

                    // if (!$this->first_name) {
                    //     $this->errors->first_name = 'Your first name?';
                    // }

                    // if (!$this->last_name) {
                    //     $this->errors->last_name = 'Your last name?';
                    // }

                    // if (!$this->gender) {
                    //     $this->errors->last_name = 'Your gender?';
                    // }

                    // if (!$this->dob) {
                    //     $this->errors->dob = 'Your date of birth?';
                    // }

                    // $user = dbSelectAll('users', "`Email` = '" . $this->email . "'");

                    // if (!$this->email) {
                    //     $this->errors->email = 'Your email address?';
                    // }
                    // elseif ($user) {
                    //     $this->errors->email = 'This email address has already been used. Already have an account?';
                    // }

                    // $user = dbSelectAll('users', "`Phone` = '" . $this->phone . "'");

                    // if (!$this->phone) {
                    //     $this->errors->phone = 'Please input your phone number';
                    // }
                    // elseif ($user) {
                    //     $this->errors->phone = 'This phone number is linked to an account already. Already have an account?';
                    // }

                    // if (!$this->country) {
                    //     $this->errors->country = 'Your country?';
                    // }

                    // if (!$this->state) {
                    //     $this->errors->state = 'Your state?';
                    // }

                    // if (!$this->city) {
                    //     $this->errors->city = 'Your city?';
                    // }

                    // if (!$this->address) {
                    //     $this->errors->address = 'Your home address?';
                    // }


                    break;
                
                default:
                    # code...
                    break;
            }

            if ($this->errors->isvalid()) {
                return true;
            }
            else {
                return false;
            }

        }

        function validateSignup () {

            $data = json_decode(file_get_contents("php://input"));

            $this->first_name = $data->{'first name'};
            $this->last_name = $data->{'last name'};
            $this->email = $data->{'email address'};
            $this->username = $data->{'username'};
            $this->phone = $data->{'phone number'};
            $this->dob = $data->{'date of birth'};
            $this->password = $data->{'password'};
            $this->password_confirmation = $data->{'password confirmation'};
            
            // Validate Sign Up Data

            if (!$this->first_name) {
                $this->errors->first_name = 'Please input your first name';
            }

            if (!$this->last_name) {
                $this->errors->last_name = 'Please input your last name';
            }

            $user = dbSelectAll('users', "`Email` = '" . $this->email . "'");

            if (!$this->email) {
                $this->errors->email = 'Please input your email address';
            }
            elseif ($user) {
                $this->errors->email = 'Email already exists';
            }

            $user = dbSelectAll('users', "`Username` = '" . $this->username . "'");

            if (!$this->username) {
                $this->errors->username = 'Please input your username';
            }
            elseif ($user) {
                $this->errors->username = 'Username already exists';
            }

            $user = dbSelectAll('users', "`Phone` = '" . $this->phone . "'");

            if (!$this->phone) {
                $this->errors->phone = 'Please input your phone number';
            }
            elseif ($user) {
                $this->errors->phone = 'Phone number already exists';
            }

            if (!$this->dob) {
                $this->errors->dob = 'Please input your phone number';
            }
            elseif (time() <= strtotime($this->dob)) {
                $this->errors->dob = 'Please input a valid date of birth';
            }
            elseif (strtotime($this->dob) > strtotime('-10 years', time())) {
                $this->errors->dob = 'Sorry, this service is available only to students from 10 years and above.';
            }
            
            if (!$this->password) {
                $this->errors->password = 'Please input your email address';
            }
            elseif (strlen($this->password) < 6) {
                $this->errors->password = 'Password length should be more than 6';
            }
            elseif ($this->password != $this->password_confirmation) {
                $this->errors->password = 'Passwords don\'t match';
            }

            if ($this->errors->isvalid()) {
                return true;
            }
            else {
                return false;
            }
    
        }

        function checkEmail() {

            $data = json_decode(file_get_contents("php://input"));

            $this->email = $data->email;

            $user = dbSelectAll('users', "`Email` = '" . $this->email . "'");

            if ($user) {
                return true;
            }
            else {
                return false;
            }

        }

        function checkPhone() {

            $data = json_decode(file_get_contents("php://input"));

            $this->phone = $data->phone;

            $user = dbSelectAll('users', "`Phone` = '" . $this->phone . "'");

            if ($user) {
                return true;
            }
            else {
                return false;
            }

        }

        function checkUsername() {

            $data = json_decode(file_get_contents("php://input"));

            $this->username = $data->username;

            $user = dbSelectAll('users', "`Username` = '" . $this->username . "'");

            if ($user) {
                return true;
            }
            else {
                return false;
            }

        }


        

        function validateAdminLogin () {

            $data = json_decode(file_get_contents("php://input"));

            $this->login = $data->{'log in'};
            $this->password = $data->{'password'};
            $this->remember_me = $data->{'remember me'};

            // Validate Log In Data

            $admin = dbSelectAll('admins', "`Email` = '" . $this->login . "'");
        
            if ($admin) {
                if (password_verify($this->password, $admin[0]['Password'])) {
                    $this->admin =  $admin[0];
                    return true;
                }
                else {
                    $this->errors->password = 'Incorrect password';
                    return false;
                }
            }
            else {
                $this->errors->login = 'Email does not exist';
                return false;
            }

        }

        function validateAdminSignup () {

            $data = json_decode(file_get_contents("php://input"));

            $this->first_name = $data->{'first name'};
            $this->last_name = $data->{'last name'};
            $this->email = $data->{'email address'};
            $this->username = $data->{'username'};
            $this->phone = $data->{'phone number'};
            $this->dob = $data->{'date of birth'};
            $this->password = $data->{'password'};
            $this->password_confirmation = $data->{'password confirmation'};
            
            // Validate Sign Up Data

            if (!$this->first_name) {
                $this->errors->first_name = 'Please input your first name';
            }

            if (!$this->last_name) {
                $this->errors->last_name = 'Please input your last name';
            }

            $user = dbSelectAll('users', "`Email` = '" . $this->email . "'");

            if (!$this->email) {
                $this->errors->email = 'Please input your email address';
            }
            elseif ($user) {
                $this->errors->email = 'Email already exists';
            }

            $user = dbSelectAll('users', "`Username` = '" . $this->username . "'");

            if (!$this->username) {
                $this->errors->username = 'Please input your username';
            }
            elseif ($user) {
                $this->errors->username = 'Username already exists';
            }

            $user = dbSelectAll('users', "`Phone` = '" . $this->phone . "'");

            if (!$this->phone) {
                $this->errors->phone = 'Please input your phone number';
            }
            elseif ($user) {
                $this->errors->phone = 'Phone number already exists';
            }

            if (!$this->dob) {
                $this->errors->dob = 'Please input your phone number';
            }
            elseif (time() <= strtotime($this->dob)) {
                $this->errors->dob = 'Please input a valid date of birth';
            }
            elseif (strtotime($this->dob) > strtotime('-10 years', time())) {
                $this->errors->dob = 'Sorry, this service is available only to students from 10 years and above.';
            }
            
            if (!$this->password) {
                $this->errors->password = 'Please input your email address';
            }
            elseif (strlen($this->password) < 6) {
                $this->errors->password = 'Password length should be more than 6';
            }
            elseif ($this->password != $this->password_confirmation) {
                $this->errors->password = 'Passwords don\'t match';
            }

            if ($this->errors->isvalid()) {
                return true;
            }
            else {
                return false;
            }
    
        }

        function checkAdminEmail() {

            $data = json_decode(file_get_contents("php://input"));

            $this->email = $data->email;

            $user = dbSelectAll('users', "`Email` = '" . $this->email . "'");

            if ($user) {
                return true;
            }
            else {
                return false;
            }

        }

        function checkAdminPhone() {

            $data = json_decode(file_get_contents("php://input"));

            $this->phone = $data->phone;

            $user = dbSelectAll('users', "`Phone` = '" . $this->phone . "'");

            if ($user) {
                return true;
            }
            else {
                return false;
            }

        }

        function checkAdminUsername() {

            $data = json_decode(file_get_contents("php://input"));

            $this->username = $data->username;

            $user = dbSelectAll('users', "`Username` = '" . $this->username . "'");

            if ($user) {
                return true;
            }
            else {
                return false;
            }

        }
    }
?>