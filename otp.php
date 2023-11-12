<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width= device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="login.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <title>Welcome to the Heritage Canteen</title>
    </head>
    <body id="otp-body">
        <div class="container-fluid">
            <div class="row my-4">
                <div class="col-12">
                    <center id="intro" style="color:#FFFFD2; -webkit-text-stroke: 1.5px #060606;">OTP Verification</center>
                </div>
            </div>
            <div class="row" >
                <div class="mx-auto col-10 col-md-8 col-lg-6">
                    <form class="my-4 py-4 px-4" action="otp.php" method="POST" style="background-color:#C5FAD5; color:#AA96DA; border:1px solid black; border-radius: 10px;">
                        <div class="form-group">
                            <label for="otp">Enter your OTP</label>
                            <input type="tel" class="form-control" id="otp" name="otp" aria-describedby="rollHelp" style="background-color:#FFFFD2" placeholder="Enter 6 digit OTP" minlength="6" maxlength="6" required>
                            <small id="emailHelp" class="form-text text-muted">Enter the OTP sent to the email ID you provided</small>
                        </div>
                        <center><button type="submit" class="btn btn-primary" id="submit-button">Submit</button></center>
                    </form>
                </div>
            </div>
        </div>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'canteendb');
        if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
        else {
            if(isset($_POST['otp'])) {
                $otp=$_POST['otp'];
                $actualOTP=$_SESSION['otp'];
                if($otp==$actualOTP) {
                    $name=$_SESSION['name'];
                    $roll=$_SESSION['roll'];
                    $email=$_SESSION['email'];
                    $pass=$_SESSION['password'];
                    try {        
                        $stmt=$conn->prepare("insert into users(roll, name, email, password) VALUES (?, ?, ?, ?)");
                        $stmt->bind_param("isss", $roll, $name, $email, $pass);
                        $stmt->execute();
                        $stmt->close();
                        echo("<script>swal('You are registered!', 'Congratulations! Welcome to the world of GOOOOOOOD FOOD!', 'success').then(function(){
                            window.location.href = 'main.php'; 
                        });
                        </script>");
                    }
                    catch(Exception $e) {
                        echo($e->getMessage());
                    }
                }
                else {
                    echo("<script>swal('Could not register you!', 'Looks like you entered some random digits! -_-', 'error');</script>");
                }
            }
        }

        ?>
        <footer class="mt-5 text-center text-white fixed-bottom" style="background-color:#49111c; color:#FFFFD2; border: 1px solid white;">
            <div class="col-12 mt-3">
                <h5 class="text-uppercase"><a class="btn btn-outline-dark btn-floating m-1" href="https://www.heritageit.edu/" role="button" style="color:#FFFFD2; border: 1px solid #FFFFD2;">The Heritage Institute of Technology</a></h5>
                <p style="color:#FFFFD2;">
                    This is a mini project done for the Web Technology Lab of the <b>Master of Computer Application (MCA)</b> degree<br>
                    in the <b>Department of Computer Application</b>
                </p>
            </div>
            <div class="container">
                <section class="mb-2">
                  <a class="btn btn-outline-dark btn-floating" href="https://www.linkedin.com/in/somthirtha-bhowmik/" role="button" style="border: 1px solid #FFFFD2;"><img style="height: 30px; width: 30px;" src="img/git.png"></a>
                  <a class="btn btn-outline-dark btn-floating" href="https://github.com/SomthirthaXD" style="border: 1px solid #FFFFD2;" role="button"><img style="height: 30px; width:30px;" src="img/linked.png"></a>
                  <a class="btn btn-outline-dark btn-floating" href="img/My Resume.pdf" role="button" style="color:#FFFFD2; border: 1px solid #FFFFD2;">My Resume</a>
                </section>
            </div>
            <div class="text-center p-2" style="background-color: #0a0908; color:#FFFFD2; border-top: 1px solid white;">
              © 2023 Copyright: Somthirtha Bhowmik
            </div>
        </footer>
        
        <script type="text/javascript"> 
        history.forward();  
    </script>
    </body>
</html>