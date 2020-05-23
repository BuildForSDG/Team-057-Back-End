<?php
    class Logs {
        public $requestStart;
        public $request;
        public $method;

        function __construct () {
            $this->requestStart = round(microtime(true) * 10000);
            $this->request = $_SERVER['REQUEST_URI'];
            $this->method = $_SERVER['REQUEST_METHOD'];
        }

        function new () {

            $newLog = $this->method . "\t" . $this->request . "\t" . http_response_code() . "\t" . str_pad((round(microtime(true) * 10000) - $this->requestStart) . "ms", 4, "0", STR_PAD_LEFT) . "\n";

            $logs = fopen("logs", "a");

            fwrite($logs, $newLog);

            fclose($logs);

        }

        function view () {
            
            header("Content-type:text/plain");

            $logs = fopen("logs", "r");

            _(fread($logs,filesize("logs")));

            fclose($logs);

        }

        function clear () {

            $newLog = "";

            $logs = fopen("logs", "w");

            fwrite($logs, $newLog);

            fclose($logs);

        }

    }
?>