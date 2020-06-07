<?php
    header("Content-type:text/plain");

    $queries = fopen("queries", "r");

    _(fread($queries,filesize("queries")));

    fclose($queries);
?>