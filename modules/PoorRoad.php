<?php
    class PoorRoad {
        public $report_id;

        public $location;
        public $damage_ratio;
        public $pictures;
        public $data;

        public function create () {

            $this->report_id = 'RPR' . time() . strtoupper(uniqid());

            if (!$this->damage_ratio) {
                $this->damage_ratio = "";
            }

            if (!$this->pictures) {
                $this->pictures = json_encode([]);
            }

            if (!$this->data) {
                $this->data = json_encode([]);
            }

            $fillables = [
                'Report ID',
                'Location',
                'Damage Ratio',
                'Pictures',
                'Data',
            ];

            $insert = dbInsert ('poor_road_reports', $fillables, [
                [
                    $this->report_id,
                    $this->location,
                    $this->damage_ratio,
                    $this->pictures,
                    $this->data,
                ]
            ]);

            if ($insert) {
                return true;
            }
            else {
                return false;
            }
        }

        public function getReports () {
            return dbSelectAll('poor_road_reports', 1);
        }
    }
?>