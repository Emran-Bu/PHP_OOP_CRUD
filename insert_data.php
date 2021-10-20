<?php

    include "database.php";

    $obj = new Database();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>insert data</title>
</head>
<body>
    <form action="save-data.php" method="post">
        <label for="">Name</label><br><br>
        <input type="text" name="sname" id=""><br><br>
        <label for="">Age</label><br><br>
        <input type="text" name="sage" id=""><br><br>
        <label for="">City</label><br><br>
        <input type="text" name="scity" id=""><br><br>
        <label for="">Department</label><br><br>
        <select name="department" id="">
            <?php
                $obj->select('departments');
                $result = $obj->getResult();

                foreach ($result as list("did"=>$did, "dname"=>$dname)) {
                    echo "<option value='$did'>$dname</option>";
                }
            ?>
            
        </select><br><br>
        <input type="submit" value="Save">
    </form>
</body>
</html>