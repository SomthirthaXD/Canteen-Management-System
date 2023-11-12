<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width= device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <title>Welcome to the Heritage Canteen</title>
    </head>
    <body id="otp-body" style="background-color: green;">
        <center><div id="main" style="background-color:green; color: white; font-size:xx-large; height:100%; width:100%;">Hang Tight! Your food is being prepared!</div></center>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'canteendb');
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        else {
            try {
                $stmt=$conn->prepare("select * from orders where id=? and delivered=0");
                $stmt->bind_param("i", $_SESSION['roll']);
                $stmt->execute();
                $res=$stmt->get_result();
                $stmt->close();
                $conn->close();
                if($res->num_rows==0)
                echo('<script>document.querySelector("#main").innerText="";
                swal("Way to Goooo!", "Your food is READY! Collect it at the counter by mentioning your User ID!", "success").then(function() {location.href="main.php";});
                </script>');
            }
            catch(Exception $ex) {}
        }?>
        <script type="text/javascript"> 
        setTimeout(function() {
            location.href="ready.php";
        }, 6000);
        history.forward();  
    </script>
    </body>
</html>
