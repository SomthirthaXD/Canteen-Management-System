<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width= device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="admin.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <title>Welcome to the Heritage Canteen</title>
        <style>
            @media screen and (max-width: 700px) {
                #welcome-text {
                    font-size: 3rem;
                }
                #empty {
                    width: 350px;
                    height: 300px;
                }
            }
            </style>
    </head>
    <body>
    <?php
            $conn = mysqli_connect('localhost', 'root', '', 'canteendb');
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }
            else {
                try {
                $stmt=$conn->prepare("select * from orders where delivered=0 order by time");
                $stmt->execute();
                $res=$stmt->get_result();
                ?>
    <div class="container-fluid" id="order-manager">
            <div class="row mt-4" id="top">
                <div class="col-12">
                    <center id="welcome-text">&nbsp;&nbsp;&nbsp;Manage&nbsp;Orders<center>
                </div> 
            </div>
            <div class="row">
                <div class="mx-auto col-10 col-md-8 col-lg-6">
                    <form action='chef.php' method='post'>
                        <table class="table">
                            <thead>
                                <tr>
                                <th class="col-4 " style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;">Order Description</th>
                                <th class="col-4" style="background-color:#FFFFD2; border: 2px solid black;">Order ID</th>
                                <th class="col-4" style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;">Order Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($res->num_rows==0)
                                    echo("<center><img id='empty' src='img/empty.jpg'></center>");
                                    else {
                                        while($row=mysqli_fetch_row($res)) {
                                            echo ('<tr>
                                            <td class="col" style="background-color:#FFFFD2; border: 2px solid black;">'.$row[1].'</td>
                                            <td class="col" style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;">'.$row[0].'</td>
                                            <td class="col" style="background-color:#FFFFD2; border: 2px solid black;">'.$row[2].'</td>
                                            <td class="col" style="background-color:#AA96DA; border: 2px solid black;"><button type="submit" class="btn btn-primary" style="background-color:red; color:white" name="done" value='.$row[0].'>Call Out</button></td>
                                        </tr>');
                                        }
                                    }
                                    if(isset($_POST['done'])) {
                                        $stmt=$conn->prepare("update orders set delivered=1 where id=? and delivered=0");
                                        $stmt->bind_param('i', $_POST['done']);
                                        $stmt->execute();
                                        $stmt->close();
                                        echo("<script>location.href='chef.php';</script>");
                                    }
                                
                                $get=$conn->prepare('select email from users where roll=1111112');
                                $get->execute();
                                $ans=$get->get_result();
                                $get->close();
                                ?>
                            </tbody>   
                        </table> 
                    </form>
                </div>
            </div>
        </div><br>
        <div class="container-fluid" id="pass-manager">
            <div class="row mt-4" id="top">
                <div class="col-12">
                    <center id="welcome-text">&nbsp;&nbsp;&nbsp;Update&nbsp;Your &nbsp;Profile<center>
                </div> 
            </div>
            <div class="row">
                <div class="mx-auto col-10 col-md-8 col-lg-6">
                    <form class="my-4 py-4 px-4" action="chef.php" method="POST" style="background-color:#AA96DA; color:#FFFFD2; border:1px solid black; border-radius: 1%;">
                        <h3><div class="form-group">
                            <label>Email Address:</label>
                            <span><?php echo(mysqli_fetch_row($ans)[0]);?></span>
                          </div></h3>
                          <div class="form-group">
                          <h3><label>Change Password:</label></h3>
                            <label for="password">Type New Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password" style="background-color:#FFFFD2" minlength="8" maxlength="20" required>
                        </div>
                          <div class="form-group">
                            <label for="password">Re-Type New Password</label>
                            <input type="password" class="form-control" name="repassword" id="password" placeholder="Enter New Password" style="background-color:#FFFFD2" minlength="8" maxlength="20" required>
                        </div>
                          <center><button type="submit" class="btn btn-primary" style="background-color:#C5FAD5; color:#AA96DA">Submit</button></center>
                    </form>
                    
                </div>
            </div>
        </div><br>
        <center><form action="main.php" method="post">
                        <button type="submit" class="row btn" id="logout" style="background-color:red; color:white;" name="logout" value="1">Logout</button></form></center>
        <footer class="mt-5 text-center text-white" style="background-color:#49111c; color:#FFFFD2; border: 1px solid white;">
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
        <?php
                            
            if(isset($_POST['password']) and isset($_POST['repassword'])) {
                $pass=$_POST['password'];
                $repass=$_POST['repassword'];
                if($pass!=$repass)
                echo("<script>swal('Password Mismatch!', 'Looks like you re-typed it wrong! Try again.', 'error');</script>");
                else {
                try {        
                    $stmt=$conn->prepare("update users set password=? where roll=1111112");
                    $stmt->bind_param("s", $pass);
                    $stmt->execute();
                    echo("<script>swal('Credentials Updated!', 'A new you eh!', 'success');</script>");
                    $stmt->close();
                    $conn->close();
                }
                catch(Exception $e) {
                    echo($e->getMessage());
                }
            }
            }   
                            }
                                catch(Exception $ex)  {echo($ex);}
                            } ?>
        <script>
             document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

window.onbeforeunload = function(e) {
    localStorage.setItem('scrollpos', window.scrollY);
};
            history.forward();
            setTimeout(function() {
                location.href='chef.php';
            }, 30000);
            </script>
    </body>
</html>