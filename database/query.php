<?php
    require 'connect.php';

    function dbQuery ($sql) {

        $conn = OpenCon();

        $sql = "";

        CloseCon($conn);
    };

    function dbSelect ($table, $parameters, $clause) {

        $conn = OpenCon();

        $data = [];

        $cols = '';
        $i = 0;

        foreach ($parameters as $param) {
            if ($i == 0) {
                $cols .= "`$param`";
            }
            else {
                $cols .= ", `$param`";
            }
            $i++;
        }

        $sql = "SELECT $cols FROM `$table` WHERE $clause";

        $result = $conn->query($sql);

        $i = 0;

        while ($row = $result->fetch_assoc()) {
            $data[$i] = $row;

            $i++;
        }

        return $data;

        CloseCon($conn);
    };

    function dbSelectAll ($table, $clause) {

        $conn = OpenCon();
        $data = [];

        $sql = "SELECT * FROM `$table` WHERE $clause";

        $result = $conn->query($sql);

        if ($result) {

            $i = 0;

            while ($row = $result->fetch_assoc()) {
                $data[$i] = $row;
    
                $i++;
            }
        
            return $data;
        }
        else {
            return false;
        }

        CloseCon($conn);
    };

    function dbInsert ($table, $parameters, $values) {

        $conn = OpenCon();

        $cols = '';
        $vals = [];
        $query = '';
        $i = 0;

        foreach ($parameters as $param) {
            if ($i == 0) {
                $cols .= "`$param`";
            }
            else {
                $cols .= ", `$param`";
            }
            $i++;
        }

        $vid = 0;

        foreach ($values as $value) {

            $i = 0;

            foreach ($value as $val) {
                if ($i == 0) {
                    if (gettype($val) == 'string') {
                        $vals[$vid] = "'$val'";
                    }
                    elseif (gettype($val) == 'array') {
                        $vals[$vid] = $val[0];
                    }
                    else {
                        $vals[$vid] = $val;
                    }
                }
                else {
                    if (gettype($val) == 'string') {
                        $vals[$vid] .= ", '$val'";
                    }
                    elseif (gettype($val) == 'array') {
                        $vals[$vid] .= ", " . $val[0];
                    }
                    else {
                        $vals[$vid] .= ", $val";
                    }
                }

                $i++;

            }

            $vid++;
        }

        $i = 0;
        foreach ($vals as $v) {
            if ($i == 0) {
                $query .= "($v)";
            }
            else {
                $query .= ", ($v)";
            }
            $i++;
        }

        $sql = "INSERT INTO `$table`($cols) VALUES $query";

        // echo $sql . '<br><br>';

        $result = $conn->query($sql);

        // echo $conn->error . '<br><br>';
    
        if ($result) {
            return true;
        }
        else {
            return false;
        }

        CloseCon($conn);
    };

    function dbUpdate ($table, $parameters, $values, $clause) {

        // $sql = "UPDATE `$table` SET $parameters `id`= $values [value-1],`email`=[value-2],`email_verified_at`=[value-3],`password`=[value-4],`remember_token`=[value-5],`created_at`=[value-6],`updated_at`=[value-7] WHERE $clause";

        
        $conn = OpenCon();

        $cols = '';
        $query = '';
        $i = 0;

        foreach ($parameters as $param) {
            if ($i == 0) {
                if (gettype($values[$i]) == 'string') {
                    $cols .= "`$param`='" . $values[$i] . "'";
                }
                elseif (gettype($values[$i]) == 'array') {
                    $cols .= "`$param`=" . $values[$i][0];
                }
                else {
                    $cols .= "`$param`=" . $values[$i];
                }
            }
            else {
                if (gettype($values[$i]) == 'string') {
                    $cols .= ", `$param`='" . $values[$i] . "'";
                }
                elseif (gettype($values[$i]) == 'array') {
                    $cols .= ", `$param`=" . $values[$i][0];
                }
                else {
                    $cols .= ", `$param`=" . $values[$i];
                }
            }
            $i++;
        }

        $sql = "UPDATE `$table` SET $cols WHERE $clause";

        // echo $sql . '<br><br>';

        $result = $conn->query($sql);

        CloseCon($conn);
    
        if ($result) {
            return true;
        }
        else {
            return false;
        }
    };

    function dbCreate($table, $values) {

        $conn = OpenCon();

        $sql = "CREATE TABLE IF NOT EXISTS `$table` ( \n";

        $queries = "";

        foreach ($values as $query) {
            $queries .= $query . " ,\n";
        }

        $sql .= $queries;

        if (strpos($sql, '`id` INT NOT NULL AUTO_INCREMENT')) {
            $sql .= "PRIMARY KEY (`id`) \n";
        }

        $sql .= ");";

        echo $sql . '<br><br>';

        $result = $conn->query($sql);
    
        if ($result) {
            echo 'Table "' . $table . '" created successfully.';
            echo '<br>';
            return true;
        }
        else {
            echo 'Error creating "' . $table . '". ERROR_MESSAGE:' . $conn -> error;
            echo '<br>';
            return false;
        }

        CloseCon($conn);
    }

    function dbTruncate($table) {

        $conn = OpenCon();

        $sql = "TRUNCATE `$table`";

        echo $sql . '<br><br>';

        $result = $conn->query($sql);
    
        if ($result) {
            echo 'Table "' . $table . '" truncated successfully.';
            echo '<br>';
            return true;
        }
        else {
            echo 'Error truncating "' . $table . '". ERROR_MESSAGE:' . $conn -> error;
            echo '<br>';
            return false;
        }

        CloseCon($conn);
    }

    function dbDropTable($table) {

        $conn = OpenCon();

        $sql = "DROP TABLE `$table`";

        echo $sql . '<br><br>';

        $result = $conn->query($sql);
    
        if ($result) {
            echo 'Table "' . $table . '" dropped successfully.';
            echo '<br>';
            return true;
        }
        else {
            echo 'Error dropping "' . $table . '". ERROR_MESSAGE:' . $conn -> error;
            echo '<br>';
            return false;
        }

        CloseCon($conn);
    }

    function name ($name) {
        return "`$name`";
    }

    function intg () {
        return " INT";
    }

    function text () {
        return " TEXT";
    }

    function json () {
        return " JSON";
    }

    function boln () {
        return " BOOLEAN";
    }

    function blob () {
        return " LONGBLOB";
    }

    function varchar ($limit) {
        if (gettype($limit) == 'string') {
            return " VARCHAR('$limit')";
        }
        elseif (gettype($limit) == 'array') {
            return " VARCHAR(" . $limit[0] . ")";
        }
        else {
            return " VARCHAR($limit)";
        }
    }

    function timestamp () {
        return " TIMESTAMP";
    }

    function null ($val) {
        if ($val) {
            return " NULL";
        }
        else {
            return " NOT NULL";
        }
    }

    function autoInc () {
        return " AUTO_INCREMENT";
    }

    function def ($val) {
        if (gettype($val) == 'string') {
            return " DEFAULT '$val'";
        }
        elseif (gettype($val) == 'array') {
            return " DEFAULT " . $val[0];
        }
        else {
            return " DEFAULT $val";
        }
    }
?>