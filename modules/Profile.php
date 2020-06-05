<?php
    class Profile {
        public $user_id;

        public $profile_data;

        public function create () {

            // $this->user_id = 'DSB' . time() . strtoupper(uniqid());

            if (!$this->profile_data) {
                $this->profile_data = json_encode([]);
            }

            $fillables = [
                'User ID',
                'Profile Data',
            ];

            $insert = dbInsert ('user_profiles', $fillables, [
                [
                    $this->user_id,
                    $this->profile_data,
                ]
            ]);

            if ($insert) {
                return true;
            }
            else {
                return false;
            }
        }

        public function getProfile ($user_id) {
            return dbSelectAll('user_profiles', "`User ID` = '" . $user_id . "'");
        }
    }
?>