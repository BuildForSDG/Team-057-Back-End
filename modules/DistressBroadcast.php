<?php
    class DistressBroadcast {
        public $distress_id;

        public $location;
        public $data;
        public $broadcasting;

        public function create () {

            $this->distress_id = 'DSB' . time() . strtoupper(uniqid());

            if (!$this->data) {
                $this->data = json_encode([]);
            }

            $fillables = [
                'Distress ID',
                'Location',
                'Data',
                'Broadcasting',
            ];

            $insert = dbInsert ('distress_broadcasts', $fillables, [
                [
                    $this->distress_id,
                    json_encode($this->location),
                    json_encode($this->data),
                    true,
                ]
            ]);

            if ($insert) {
                return true;
            }
            else {
                return false;
            }
        }

        public function getTips () {
            return dbSelectAll('distress_broadcasts', 1);
        }
    }
?>