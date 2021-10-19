<?php

    include "database.php";

    $obj = new Database();

    # Insert Into

    // $obj->insert('students', ['name'=>'Angel Mim', 'age'=>'18', 'city'=>'Ctg']);

    // echo "Insert result is : ";
    // print_r($obj->getResult());

    # Update Data

    // $obj->update('students', ['name'=>'Shamoly Akter', 'age'=>'18', 'city'=>'Gazipur'], 'id="4"');

    // Other obj
    // $obj->update('students', ['city'=>'Goa'], 'city="Gazipur"');

    // echo "Update result is : ";
    // print_r($obj->getResult());

    # DELETE Method

    // $obj->delete('students', 'id="5"');
    // $obj->delete('students', 'age="17"');

    // echo "Delete result is : ";
    // print_r($obj->getResult());

    # select data

    // $obj->sql('SELECT * FROM students where age = "20"');

    // echo "SQL result is : ";

    // echo "<pre>";
    // print_r($obj->getResult());
    // echo "</pre>";

    #2nd rule select data

    $obj->select('students', '*', null, null, 'city', '2');

    echo "Select result is : ";

    echo "<pre>";
    print_r($obj->getResult());
    echo "</pre>";

?>