<?php

    include 'database.php';
    $obj = new Database();

    $join = "departments ON students.department = departments.did";

    $colName = "students.id, students.name, students.age, students.city, departments.dname";

    $limit = '2';

    $order = "students.id ASC";

    $obj->select('students', '*', $join, null, $order, $limit);

    $result = $obj->getResult();

    echo "Select result is : ";

    echo "<pre>";
    print_r($result);
    echo "</pre>";

    echo "<table cellpadding='5px' cellspacing='0' border='1px'>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Age</th>
            <th>City</th>
            <th>Department</th>
        </tr>
    ";

    foreach ($result as list("id"=>$id, "name"=>$name, "age"=>$age, "city"=>$city, "dname"=>$dname)) {
        // echo "$id - $name - $age - $city - $dname <br>";
        echo "
            <tr>
                <td>$id</td>
                <td>$name</td>
                <td>$age</td>
                <td>$city</td>
                <td>$dname</td>
            </tr>
        ";
    }
    echo "</table>";

    $obj->pagination('students', $join, null, $limit);

?>