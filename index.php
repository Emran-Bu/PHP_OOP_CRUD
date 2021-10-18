<?php

    include "database.php";

    $obj = new database();

    $obj->insert('students', ['name'=>'Angel Mim', 'age'=>'18', 'city'=>'Ctg']);

?>