<?php

    include "database.php";

    $obj = new Database();

    // print_r($_POST);
    $sname = $_POST['sname'];
    $sage = $_POST['sage'];
    $scity = $_POST['scity'];
    $sdepartment = $_POST['sdepartment'];

    $value = ["name"=>$sname, "age"=>$sage, "city"=>$scity, "department"=>$sdepartment];

    if ($obj->insert("students", $value)) {
        echo "<h2>Data inserted successfully.</h2>";
    } else {
        echo "<h2>Data inserted Unsuccessfully.</h2>";
    }

?>