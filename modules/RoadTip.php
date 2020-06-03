<?php
    class RoadTip {
        public $road_tip_id;

        public $title;
        public $content;
        public $illustration;

        public function create () {

            $this->road_tip_id = 'RST' . time() . strtoupper(uniqid());

            $fillables = [
                'Road Tip ID',
                'Title',
                'Content',
                'Illustration',
            ];

            $insert = dbInsert ('road_tips', $fillables, [
                [
                    $this->road_tip_id,
                    $this->title,
                    $this->content,
                    $this->illustration,
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
            return dbSelectAll('road_tips', 1);
        }
    }
?>