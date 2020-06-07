<?php
    class Report {
        public $report_id;

        public $location;
        public $pictures;
        public $medias;
        public $data;

        public function create () {

            $this->road_tip_id = 'RPD' . time() . strtoupper(uniqid());

            if (!$this->pictures) {
                $this->pictures = json_encode([]);
            }

            if (!$this->medias) {
                $this->medias = json_encode([]);
            }

            if (!$this->data) {
                $this->data = json_encode([]);
            }

            $fillables = [
                'Report ID',
                'Location',
                'Pictures',
                'Medias',
                'Data',
            ];

            $insert = dbInsert ('rogue_driver_reports', $fillables, [
                [
                    $this->report_id,
                    $this->location,
                    $this->pictures,
                    $this->medias,
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
            return dbSelectAll('rogue_driver_reports', 1);
        }
    }
?>