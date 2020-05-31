<?php
    class User {
        public $first_name;
        public $last_name;
        public $email;
        public $username;
        public $phone;
        public $dob;
        public $password;

        public $email_verify_token;
        public $password_reset_token;

        public $time = 1440;
        
        public $user_id;
        public $email_verified_at;
        
        public $session;
        public $cookies;

        public $user;
        public $userToken;

        public function __construct() {
            $this->session = new Session();

            $this->cookies = new Cookies();

            $this->user = $this->session->get('user');
            $this->userToken = $this->cookies->get('userToken');

            if ($this->user || $this->userToken) {
                $this->check();
            }

        }

        public function hash($password) {
            return password_hash($password, PASSWORD_DEFAULT);
        }

        public function create () {

            $this->user_id = 'USR' . time() . strtoupper(uniqid());

            $fillables = [
                'User ID',
                'First Name',
                'Last Name',
                'Gender',
                'Date of Birth',
                'Email',
                'Phone',
                'Country',
                'State',
                'City',
                'Home Address'
            ];

            $insertuser = dbInsert ('users', $fillables, [
                [
                    $this->user_id,
                    $this->first_name,
                    $this->last_name,
                    $this->gender,
                    $this->dob,
                    $this->email,
                    $this->phone,
                    $this->country,
                    $this->state,
                    $this->city,
                    $this->address,
                ]
            ]);

            $this->initEmailVerification();

            if ($insertuser) {
                return true;
            }
            else {
                return false;
            }
        }

        public function login ($user, $remember_me = FALSE) {

            if ($remember_me) {
                $this->setRememberMeToken($user["User ID"]);
            }
            
            if ($this->session->set('user', $user)) {
                return true;
            }
            else {
                return false;
            }

        }

        public function setRememberMeToken ($user_id) {

            $token = $this->tokenGen();

            $this->cookies->set('userToken', $user_id . ':' . $token, time() + (86400 * 30));

            $updateuser = dbUpdate('users', ['Remember Token'], [$this->hash($token)], "`User ID` = '" . $user_id . "'");

            if ($updateuser) {
                return true;
            }
            else {
                return false;
            }
        }

        public function tokenGen () {
            return bin2hex(random_bytes(16));
        }

        public function OTPGen () {
            return bin2hex(random_bytes(2));
        }

        public function removeToken () {
            $unsetCookie = $this->cookies->remove('userToken');
            $unsetRememberToken = dbUpdate ('users', ['Remember Token'], [''], "`User ID` = '" . $user_id . "'");

            if ($unsetCookie && $unsetRememberToken) {
                return true;
            }
            else {
                return false;
            }
        }

        public function rememberMe () {

            list ($user_id, $token) = explode(':', $this->userToken);

            $user = dbSelectAll('users', "`User ID` = '" . $user_id . "'");
        
            if ($user) {
                if (password_verify($token, $user[0]['Remember Token'])) {
                    $this->user = $user[0];

                    $this->login($this->user, TRUE);

                    $this->cookies->set('userToken', $user_id . ':' . $token, time() + (86400 * 30));

                }
            }
            else {
                $this->logout();
            }
        }

        public function logout () {
            
            if ($this->session->remove('user') && $this->removeToken()) {
                return true;
            }
            else {
                return false;
            }
            
        }

        public function authed () {

            if ($this->user) {
                return true;
            }
            else {
                return false;
            }

        }

        public function extend () {
            
            $this->user['logtime'] = time();

            $this->user_id = $this->user['User ID'];
            $this->first_name = $this->user['First Name'];
            $this->last_name = $this->user['Last Name'];
            $this->email = $this->user['Email'];
            $this->phone = $this->user['Phone'];
            
            if ($this->session->set('user', $this->user)) {
                return true;
            }
            else {
                return false;
            }
            
        }

        public function check () {
            
            if (time() - $this->user['logtime'] < $this->time) {
                $this->extend();
            }
            else {
                if ($this->userToken) {
                    $this->rememberMe();
                }
                else {
                    $this->logout();
                }
            }
            
        }

        public function changePassword ($password) {

            $updateuser = dbUpdate ('users', ['Password'], [$this->hash($password)], "`User ID` = '" . $this->user_id . "'");

            if ($updateuser) {
                return true;
            }
            else {
                return false;
            }
        }

        public function changeDetails () {

            $fillables = [
                'First Name',
                'Last Name',
                'Email',
                'Phone',
            ];

            $updateuser = dbUpdate ('users', $fillables, [
                $this->first_name,
                $this->last_name,
                $this->email,
                $this->phone,
            ], "`User ID` = '" . $this->user_id . "'");

            if ($updateuser) {
                return true;
            }
            else {
                return false;
            }
        }

        public function initEmailVerification () {
            
            $this->email_verify_otp = $this->OTPGen();

            $fillables = [
                'Email',
                'OTP'
            ];

            $insert = dbInsert ('email_verifications', $fillables, [
                [
                    $this->email,
                    $this->email_verify_otp
                ]
            ]);

            $send = $this->sendVerificationEmail();

            if ($insert && $send) {
                return true;
            }
            else {
                return false;
            }
        }

        public function sendVerificationEmail () {
            $vemail = new Vemail();

            $name = $this->first_name . ' ' . $this->last_name;

            $vemail->title = "Road Assistant App";
            $vemail->message = "<h1>Verify your email</h1><br><p>Your OTP Code is " . $this->email_verify_otp . ".</p>";
            $vemail->sender = [
                "Email" => 'no-reply@royallearn.xyz',
                "Name" => 'Road Assistant App'
            ];
            $vemail->recievers = [
                [
                    "Email" => $this->email,
                    "Name" => $name
                ]
            ];

            if ($vemail->send()) {
                return true;
            }
            else {
                return false;
            }
        }

        public function verified () {
            $verified = dbSelect ('users', ['Email Verified At'], "`Email` = '" . $this->email . "'")[0];

            if ($verified['Email Verified At']) {
                return true;
            }
            else {
                return false;
            }
        }

        public function verifyEmail () {
            $token = dbSelect ('email_verifications', ['Token'], "`Email` = '" . $this->email . "' ORDER BY `Created At` DESC")[0];

            if ($this->email_verify_token === $token['Token']) {

                $fillables = [
                    'Email Verified At'
                ];
    
                $updateuser = dbUpdate ('users', $fillables, [
                    ['CURRENT_TIMESTAMP']
                ], "`Email` = '" . $this->email . "'");
    
                if ($updateuser) {
                    return true;
                }
                else {
                    return false;
                }

            }
            else {
                return false;
            }
        }

        public function initPasswordReset () {
            
            $this->password_reset_token = $this->tokenGen();

            $fillables = [
                'Email',
                'Token'
            ];

            $insert = dbInsert ('password_resets', $fillables, [
                [
                    $this->email,
                    $this->password_reset_token
                ]
            ]);

            $send = $this->sendPasswordResetEmail();

            if ($insert && $send) {
                return true;
            }
            else {
                return false;
            }
        }

        public function sendPasswordResetEmail () {

            $vemail = new Vemail();

            $name = $this->last_name . ' ' . $this->first_name;

            $vemail->title = "Free Deals Password Reset";
            $vemail->message = "<h1>Hello,</h1><br><p>You recently took steps to reset the password for your Free Deals Account. </p><p>Click <a href=\"https://" . $_SERVER['SERVER_NAME'] . "/reset-password?token=" . $this->password_reset_token . "&email=" . $this->email . "\">here</a> to reset your password. </p>";
            $vemail->sender = [
                "Email" => 'no-reply@free-deals.herokuapp.com',
                "Name" => 'Free Deals'
            ];
            $vemail->recievers = [
                [
                    "Email" => $this->email,
                    "Name" => $name
                ]
            ];

            if ($vemail->send()) {
                return true;
            }
            else {
                return false;
            }
        }

        public function resetPassword () {
            $token = dbSelect ('password_resets', ['Token', 'Used'], "`Email` = '" . $this->email . "' ORDER BY `Created At` DESC")[0];

            if ($this->password_reset_token === $token['Token'] && !$token["Used"]) {

                $fillables = [
                    'Used'
                ];
    
                $update = dbUpdate ('password_resets', $fillables, [
                    ['TRUE']
                ], "`Token` = '" . $this->password_reset_token . "'");
    
                if ($update) {
                    return true;
                }
                else {
                    return false;
                }

            }
            else {
                return false;
            }
        }
    }
?>