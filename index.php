<?php
session_start();
require "mailer.php";
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
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <title>Welcome to the Heritage Canteen</title>
    </head>
    <body id="body">
        <div class="container-fluid" id="main-container">
            <div class="row" id="top">
                <div class="col-12">
                    <center><img src="img/canteenlogo.png" class="img-fluid mt-2" style="height:220px; width:400px;" id="logo"></center>
                </div>
                <div class="col-12 mt-3">
                    <center style="font-family: Ranchers, cursive;">Welcome to</center>
                </div>
                <div class="col-12">
                    <center id="intro">THE HERITAGE CANTEEN</center>
                </div>
            </div>
            <div class="my-2 row" id="img-row">
                <div class="py-3 col-md-3"><img src="img/canteen1.jpg" class="img-fluid"></div>
                <div class="py-3 col-md-3"><img src="img/canteen2.jpg" class="img-fluid"></div>
                <div class="py-3 col-md-3"><img src="img/canteen3.jpg" class="img-fluid"></div>
                <div class="py-3 col-md-3"><img src="img/canteen4.jpg" class="img-fluid"></div>
            </div>
            <div class="row py-4" id="button-row">
              <div class="col-6">
                <button type="button" class="btn btn-lg float-right" id="sign-up" data-toggle="modal" data-target="#register">Sign Up</button>
              </div>
              <div class="col-6">
                <button type="button" class="btn btn-lg" id="sign-in" data-toggle="modal" data-target="#login">Sign In</button>
              </div>
            </div>
            <div class="modal fade" id="login" tabindex="-1" role="dialog" style="color:#AA96DA">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header" style="background: url(img/foodpic1.jpg) center center fixed; color:white">
                      <h4 class="modal-title py-2"><center style="color:#FFFFD2; text-shadow: 5px 2px #060606;"><h1>&nbsp;&nbsp;User Login</h1></center></h4>
                      <button type="button" class="close" aria-label="close" data-dismiss="modal" style="color:white">&times;</button>
                    </div>
                    <div class="modal-body" style="background-color: #C5FAD5;" id="login-form">
                      <p>
                        <span type="button" class="float-right mt-0" style="color: blue;" data-toggle="modal" data-dismiss="modal" data-target="#forgot">Forgot Password?</span>
                        <form action="index.php" method="post">
                              <div class="form-group">
                                <label for="roll">User ID</label>
                                <input type="tel" class="form-control" name="logname" id="roll" aria-describedby="rollHelp" style="background-color:#FFFFD2" placeholder="Enter User ID" minlength="7" maxlength="7" required>
                                <small id="rollHelp" class="form-text text-muted">Enter your registered User ID. E.g. 2282003</small>
                              </div>
                            <div class="form-group">
                              <label for="password">Password</label>
                              <input type="password" name="logpassword" class="form-control" id="password" placeholder="Password" minlength="8" style="background-color:#FFFFD2" maxlength="20" required>
                            </div>
                            <center><button type="submit" class="btn btn-primary" id="submit-button">Submit</button></center>
                          </form>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            
              <div class="modal fade" id="forgot" tabindex="-1" role="dialog" style="color:#AA96DA">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header" style="background: url(img/foodpic1.jpg); color:white">
                      <h4 class="modal-title py-2"><center style="color:#FFFFD2; text-shadow: 5px 2px #060606;"><h1>&nbsp;&nbsp;Forgot Password</h1></center></h4>
                      <button type="button" class="close" aria-label="close" data-dismiss="modal" style="color:white">&times;</button>
                    </div>
                    <div class="modal-body" style="background-color: #C5FAD5;" id="login-form">
                      <p>
                        <form action="index.php" method="post">
                              <div class="form-group">
                                <label for="roll">User ID</label>
                                <input type="tel" class="form-control" name="resetname" id="roll" aria-describedby="rollHelp" style="background-color:#FFFFD2" placeholder="Enter User ID" minlength="7" maxlength="7" required>
                                <small id="rollHelp" class="form-text text-muted">Enter your registered User ID. E.g. 2282003</small>
                              </div>
                              <div class="g-recaptcha mb-4"
                              data-sitekey="Public Site Key Here"
                              data-callback="onRecaptchaSuccess"
                              data-expired-callback="onRecaptchaResponseExpiry"
                              data-error-callback="onRecaptchaError"></div>
                            <center><button type="submit" class="btn btn-primary" id="submit-button">Submit</button></center>
                          </form>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              
            <div class="modal fade" id="register" tabindex="-1" role="dialog" style="color:#AA96DA;">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header" style="background: url(img/food2.jpg) center fixed;">
                    <h4 class="modal-title py-2"><center style="color:#FFFFD2; text-shadow: 5px 2px #060606;"><h1>&nbsp;&nbsp;New User Registration</h1></center></h4>
                    <button type="button" class="close" aria-label="close" data-dismiss="modal" style="color:white">&times;</button>
                  </div>
                  <div class="modal-body" style="background-color: #C5FAD5;" id="register-form">
                    <p>
                      <form action="index.php" method="POST">
                          <div class="form-group">
                              <label for="name">Full Name</label>
                              <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name" style="background-color:#FFFFD2" pattern="^[A-Za-z\s]+$" required>
                            </div>
                            <div class="form-group">
                              <label for="roll">College Roll Number</label>
                              <input type="tel" class="form-control" id="roll" name="roll" aria-describedby="rollHelp" style="background-color:#FFFFD2" placeholder="Enter College Roll Number" min="2000000" minlength="7" maxlength="7" pattern="^[0-9]{7}$" required>
                              <small id="emailHelp" class="form-text text-muted">Enter your college provided roll number. E.g. 2282003</small>
                            </div>
                          <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email" style="background-color:#FFFFD2" pattern="[a-z0-9._%+\-]+@heritageit.edu(.in)?$" required>
                            <small id="emailHelp" class="form-text text-muted">Enter your college provided mail ID only.</small>
                          </div>
                          <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" style="background-color:#FFFFD2" minlength="8" maxlength="20" required>
                          </div>
                          <div class="g-recaptcha mb-4"
                            data-sitekey="Public Site Key Here"
                            data-callback="onRecaptchaSuccess"
                            data-expired-callback="onRecaptchaResponseExpiry"
                            data-error-callback="onRecaptchaError"></div>
                          <center><button type="submit" class="btn btn-primary" id="submit-button">Submit</button></center>
                        </form>
                    </p>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'canteendb');
        if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
        }
        else {
          if(isset($_POST['name']) and isset($_POST['roll']) and isset($_POST['email']) and isset($_POST['password'])) {
            $name=$_POST['name'];
            $roll=$_POST['roll'];
            $email=$_POST['email'];
            $pass=$_POST['password'];
            $check=$conn->prepare('select * from users where roll=? or email=?');
            $check->bind_param("is", $roll, $email);
            try {
              $check->execute();
              $res=$check->get_result();
              $check->close();
              $recaptcha = $_POST['g-recaptcha-response'];
              $secret_key='Secret Site Key Here';
              $url='https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$recaptcha;
              $response=file_get_contents($url);
              $response=json_decode($response);
              if($res->num_rows==0 and $response->success==true) {
                $_SESSION['name']=htmlspecialchars($name);
                $_SESSION['email']=htmlspecialchars($email);
                $_SESSION['roll']=$roll;
                $_SESSION['password']=$pass;
                $_SESSION['otp']=rand(100000,999999);
                $mail->AddAddress($_SESSION['email']);
                $mail->Subject="OTP for The Heritage Canteen verification";
                $mail->Body="Here is your One Time Pass (OTP) for registraion to THE HERITAGE CANTEEN: ".$_SESSION['otp'];
                if($mail->send())
                echo("<script>location.href=('otp.php');</script>");
                else
                echo("<script>swal('Could not register you!', 'Hey Elon Musk! Looks like your email ID is not from this planet!', 'error');
                        </script>"); 
              }
              else if($response->success==false)
                echo("<script>swal('Could not register you!', 'Are you a robot? You failed the test!', 'error');</script>");
              else {
                echo("<script>swal('Could not register you!', 'Looks like you forgot that we know you!', 'error');</script>");
              }
            }
            catch(Exception $e) {}
          }
          else {
            if(isset($_POST['logname']) and isset($_POST['logpassword'])) {
              $roll=$_POST['logname'];
              $pass=$_POST['logpassword'];
              $check=$conn->prepare('select * from users where roll=? and password=?');
              $check->bind_param("is", $roll, $pass);
              try {
                $check->execute();
                $res=$check->get_result();
                $check->close();
                if($res->num_rows>0) {
                  $_SESSION['roll']=$roll;
                  if($roll==1111111)
                  echo("<script>window.location.replace('admin.php');</script>");
                  else if($roll==1111112)
                  echo("<script>window.location.replace('chef.php');</script>");
                  else
                  echo("<script>window.location.replace('main.php');</script>");
                }
                else {
                  echo("<script>swal('Oops! Invalid User!', 'Looks like you forgot yourself!', 'error');</script>");
                }
              }
              catch(Exception $e) {}
            }
            else if(isset($_POST['resetname'])) {
              $roll=$_POST['resetname'];
              $check=$conn->prepare('select * from users where roll=?');
              $check->bind_param("i", $roll);
              $recaptcha = $_POST['g-recaptcha-response'];
              $secret_key='Secret Site Key Here';
              $url='https://www.google.com/recaptcha/api/siteverify?secret='.$secret_key.'&response='.$recaptcha;
              $response=file_get_contents($url);
              $response=json_decode($response);
              try {
                $check->execute();
                $res=$check->get_result();
                $check->close();
                if($res->num_rows==1 and $response->success==true) {
                  $row=mysqli_fetch_row($res);
                  $mail->AddAddress($row[2]);
                  $mail->Subject="Your credentials for The Heritage Canteen";
                  $mail->Body="Here are your credentials of registraion: User ID: ".$row[0]." and Password: ".$row[3];
                  if($mail->send())
                  echo("<script>swal('Hmm! We remember you!', 'Credentials mailed to your registered email ID!', 'success');</script>");
                  else
                  echo("<script>swal('Oooops! Something went wrong!', 'We promise it is us and not you! Try again please.', 'error');</script>");
                }
                else if($response->success==false)
                  echo("<script>swal('ROBOT!!!!!', 'Are you a robot? You failed the test!', 'error');</script>");
                else {
                  echo("<script>swal('Oops! New User?', 'Register yourself!', 'error');</script>");
                }
              }
              catch(Exception $e) {}
            }
          }
        }
        $conn->close();
        ?>
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

  </body>
</html>