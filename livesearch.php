<?php
    $conn = mysqli_connect('localhost', 'root', '', 'canteendb');
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
    }
    else {
        $check=$conn->prepare('select name from menu');
        try {
        $check->execute();
        $res=$check->get_result();
        $check->close();
        $conn->close();
        $q=$_GET["q"];

        if (strlen($q)>0) {
        $hint="";
            while($row=mysqli_fetch_row($res)) {
                if(stristr($row[0], $q)) {
                    if($hint=="")
                    $hint="<span style='font-size:larger; color:red;'>(Click on an item to navigate to it)</span><br><a href='#".$row[0]."' style='text-decoration:none; font-size:larger; color:black;'>".$row[0]."</a>";
                    else
                    $hint=$hint."<br><a href='#".$row[0]."' style='text-decoration:none; font-size:larger; color:black;'>".$row[0]."</a>";
                }
            }
        }
        if ($hint=="") {
        $response="Oops! No such items available.";
        } else {
        $response=$hint;
        }
        echo $response;
        }
        catch(Exception $ex) {}

}
?>