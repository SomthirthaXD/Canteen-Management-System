<?php
session_start();
require "mailer.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width= device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="main.css">
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <title>Welcome to the Heritage Canteen</title>
    </head>
    <body id="body">
        <?php
            //error_reporting(E_ERROR | E_PARSE);
            $conn = mysqli_connect('localhost', 'root', '', 'canteendb');
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }
            else {
                $check=$conn->prepare('select * from users where roll=?');
              try {
                $check->bind_param("s", $_SESSION['roll']);
                $check->execute();
                $res=$check->get_result();
                $check->close();
                $check=$conn->prepare('select * from menu');
                $check->execute();
        ?>
        <div class="container-fluid py-3" id="top-container">
            <div class="row" id="top">
                <div class="col-12">
                    <center><img src="img/canteenlogoblacktransparent.png" class="img-fluid" id="logo"></center>
                </div>
                <div class="col-12">
                    <center id="intro">THE HERITAGE CANTEEN</center>
                </div>
            </div>
            <div class="row" id="top">
                <div class="col-12">
                    <center id="welcome-text">Welcome <?php
                    $userrow=(mysqli_fetch_row($res));
                    echo($userrow[1]);
                    $userid=$userrow[0];
                    $_POST['feedbackuser']=$userrow[1];
                    $_POST['feedbackid']=$userid;
                    $_POST['feedbackmail']=$userrow[2];
                    ?><center>
                </div>  
            </div>
        </div>
        <div class="container-fluid row py-1 ml-0 sticky-top" id="nav-bar">
            <a class="col-2 btn" id="logo-short" href="#top-container"><img src="img/canteenlogowhitetransparent.png" class="img-fluid" style="height:50px; width:100px;"></a>
            <a class="col-2 pt-3 btn" href="#snacks">Snacks</a>
            <a class="col-2 pt-3 btn" href="#main-course">Main Course</a>
            <a class="col-2 pt-3 btn" href="#d-n-b">Drinks & Beverages</a>
            <a class="col-2 pt-3 btn" href="#ice-cream">Ice Cream</a>
            <button class="col-2 btn fa fa-bars" style="font-size: 25px;" id="menu-maker" data-toggle="modal" data-target="#small-menu" id="nav-menu"></button>
        </div>
        <div class="modal fade" id="small-menu" tabindex="-1" role="dialog" style="color:#AA96DA">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: black; color:white">
                      <h4 class="modal-title py-2" style="color:#FFFFD2; text-shadow: 5px 2px #060606;"><h1>&nbsp;&nbsp;Menu</h1></h4>
                      <button type="button" class="close" aria-label="close" data-dismiss="modal" style="color:white">&times;</button>
                    </div>
                    <div class="modal-body" style="background-color: white;" id="menu-form">
                        <button class="row btn fa fa-search" data-toggle="modal" data-dismiss="modal" data-target="#live-search">&nbsp;&nbsp;Search Items</button><br>
                        <button class="row btn fa fa-shopping-cart" name="cart" value="1" id="cart-maker" data-toggle="modal" data-dismiss="modal" data-target="#cart">&nbsp;&nbsp;Cart</button><br>
                        <button class="row btn fa fa-user" data-toggle="modal" data-dismiss="modal" data-target="#profile">&nbsp;&nbsp;Profile</button>
                        <button class="row btn fa fa-info" data-toggle="modal" data-dismiss="modal" data-target="#about">&nbsp;&nbsp;About Us</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="about" tabindex="-1" role="dialog" style="color:#AA96DA">
                <div class="modal-dialog modal-dialog-centered" id="modal-dialog-about">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: black; color:white">
                      <h4 class="modal-title py-2"><h1>&nbsp;&nbsp;About Us</h1></h4>
                      <button type="button" class="close" aria-label="close" data-dismiss="modal" style="color:white">&times;</button>
                    </div>
                    <div class="modal-body" style="background-color: white; color: black;" id="about-form">
                <center><img src="img/MyPic.jpg" style=" border:2px solid black; padding: 2px; height: 200px; width: 150px;"></center>
                    <h5 style="text-align: justify;">Hello foodie!<br>We are currently an impression of how the actual website for The Heritage Canteen should be designed as,
                created by the guy in the picture.<br>His name is <b>Somthirtha Bhowmik</b> and he is currently pursuing MCA at The Heritage Institute of Technology<br><br>
            If you liked his work, have some other implementation ideas or have noticed some issues in his work, kindly write that down in the feedback form below:<br>
        <b style="color: red;">[Though we cannot promise he will reach back out to everyone, but he sure will try his best]</b></h5>
                    <form action="main.php" method="post">
                            <input type="text" name="feedback" style="width: 100%; background-color:#FFFFD2; padding: 5px;" placeholder="Enter your valued feedback" required><br><br>
                            <center><button class="row btn fa fa-comments" name="feeder" value="1" id="feed-button">&nbsp;&nbsp;Submit Feedback</button></center>
                    </form>
                </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="live-search" tabindex="-1" role="dialog" style="color:#AA96DA">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: black; color:white">
                      <h4 class="modal-title py-2"><h1>&nbsp;&nbsp;Search For An Item</h1></h4>
                      <button type="button" class="close" aria-label="close" data-dismiss="modal" style="color:white">&times;</button>
                    </div>
                    <div class="modal-body" style="background-color: white; color: black;" id="search-form">
                    <form>
                        <label for="text" class="fa fa-search" style="font-size: x-large;">&nbsp;&nbsp;Search</label><br>
                        <input type="text" style="width:100%;" onkeyup="showResult(this.value)">
                        <div id="livesearch"></div>
                    </form>
                </div>
                  </div>
                </div>
              </div>
        <div class="modal fade" id="profile" tabindex="-1" role="dialog" style="color:#AA96DA">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: black; color:white">
                      <h4 class="modal-title py-2"><h1>&nbsp;&nbsp;My Profile</h1></h4>
                      <button type="button" class="close" aria-label="close" data-dismiss="modal" style="color:white">&times;</button>
                    </div>
                    <div class="modal-body" style="background-color: white; color: black;" id="profile-form">
                        <span>College Roll:&nbsp;<?php echo($userrow[0]);?></span><br><br>
                        <span>Name:&nbsp;<?php echo($userrow[1]);?></span>
                        <button class="btn" id="logout" style="background-color:green; color:white;" data-toggle="modal" data-dismiss="modal" data-target="#update">&nbsp;&nbsp;Change Username</button>
                        <br><br>
                        <span>College Email ID:&nbsp;<?php echo($userrow[2]);?></span><br><br>
                        <button class="row btn fa fa-key" data-toggle="modal" data-dismiss="modal" data-target="#passchange">&nbsp;&nbsp;Change Password</button>
                        <form action="main.php" method="post">
                        <button type="submit" class="row btn fa fa-sign-out" id="logout" style="background-color:red; color:white;" name="logout" value="1">&nbsp;&nbsp;Logout</button></form>
                        <button type="submit" class="row btn fa fa-close" id="logout" style="background-color:red; color:white;" data-toggle="modal" data-dismiss="modal" data-target="#delacc">&nbsp;Delete Account</button></form>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="update" tabindex="-1" role="dialog" style="color:#AA96DA">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: black; color:white">
                      <h4 class="modal-title py-2"><h1>&nbsp;&nbsp;Update Username</h1></h4>
                      <button type="button" class="close" aria-label="close" data-dismiss="modal" style="color:white">&times;</button>
                    </div>
                    <div class="modal-body" style="background-color: white; color: black;" id="profile-form">
                        <form action='main.php' method='post'>
                            <h3><label for="text">Enter New Username</label></h3>
                            <input type="text" name="newname" placeholder="Enter Username Here" style="width:100%; background-color:#FFFFD2" pattern="^[A-Za-z\s]+$" required>
                            <center><button type="submit" class="btn fa fa-submit" id="logout" style="background-color:green; color:white;">&nbsp;&nbsp;Submit</button></center></form>
                        </form>
                </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="delacc" tabindex="-1" role="dialog" style="color:#AA96DA">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: black; color:white">
                      <h4 class="modal-title py-2"><h1>&nbsp;&nbsp;Delete Account?</h1></h4>
                      <button type="button" class="close" aria-label="close" data-dismiss="modal" style="color:white">&times;</button>
                    </div>
                    <div class="modal-body" style="background-color: white; color: black;" id="profile-form">
                        <form action='main.php' method='post'>
                            <label>Are you sure you want to "DELETE" this account?</label>
                            <div class="row"><button type="submit" class="col-3 mx-1 btn fa fa-close" id="logout" style="background-color:red; color:white;" name="delacc" value="1">&nbsp;&nbsp;Yes</button>
                            <button type="submit" class="col-3 mx-1 btn fa fa-sign-out" id="logout" style="background-color:green; color:white;" name="logout" value="1">&nbsp;&nbsp;No</button></form></form></div>
                        </form>
                </div>
                  </div>
                </div>
              </div>
              <div class="modal fade" id="passchange" tabindex="-1" role="dialog" style="color:black;">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: black; color:white">
                      <h4 class="modal-title py-2" style="color:#FFFFD2; text-shadow: 5px 2px #060606;"><h1>&nbsp;&nbsp;Change Password</h1></h4>
                      <button type="button" class="close" aria-label="close" data-dismiss="modal" style="color:white;">&times;</button>
                    </div>
                    <div class="modal-body" style="background-color: white;" id="pass-form">
                    <form action="main.php" method="post">
                              <div class="form-group">
                                <label for="old">Old Password</label>
                                <input type="password" name="oldpassword" class="form-control" id="password" placeholder="Enter Old Password" minlength="8" style="background-color:#FFFFD2" maxlength="20" required>
                              </div>
                            <div class="form-group">
                              <label for="password">New Password</label>
                              <input type="password" name="newpassword" class="form-control" id="password" placeholder="Enter New Password" minlength="8" style="background-color:#FFFFD2" maxlength="20" required>
                            </div>
                            <div class="form-group">
                              <label for="password">Re-Type New Password</label>
                              <input type="password" name="renewpassword" class="form-control" id="password" placeholder="Re-Enter New Password" minlength="8" style="background-color:#FFFFD2;;" maxlength="20" required>
                            </div>
                            <center><button type="submit" class="btn" style="bakcground-color:black;" id="submit-button">Submit</button></center>
                          </form>
                    </div>
                  </div>
                </div>
              </div>
        <div class="container-fluid" id="snacks">
            <span>Snacks</span>
            <div style="background-color: black; height:2px;">&nbsp;</div><br>
            <?php
                    $resmenu=$check->get_result();
                if($resmenu->num_rows==0)
                echo("<img class='ml-5 pl-5' src='img/empty.jpg'>");
                else {
                    $count=0;
                    while($row=mysqli_fetch_row($resmenu)) {
                        if($row[3]!="Snacks")
                        continue;
                        if($count==0)
                        echo('<div class="row pl-lg-5 pl-sm-1 ml-sm-1 ml-lg-5">');
                        $veg=True;
                        if($row[5]=='Non-Veg')
                        $veg=False;
                        echo ('<div class="m-lg-5 m-3 pt-4 px-4 col-lg-3" id="snack-tabs">');
                        if($veg)
                        echo('<h2 id="'.$row[0].'">
                        '.$row[0].'</h2><i class="fa fa-circle mb-2" style="font-size:20px; color:green"></i><br>');
                        else
                        echo('<h2 id="'.$row[0].'">
                        '.$row[0].'</h2><i class="fa fa-circle mb-2" style="font-size:20px; color:red"></i><br>');
                            echo('<img class="mb-3 mt-2" src="'.$row[1].'"><br>'.$row[2].'<br>
                            <h5 class="my-3">Price: Rs. <span style="color: red; font-size: larger;">'.$row[4].'</span></h5>');
                            if($row[6]==1)
                            echo('<form action="main.php" method="post"><button class="mt-2 btn" style="background-color:orange; color:white" name="cartitem" value="'.$row[0].'">Add to Cart</button></form></div>');
                            else
                            echo('<button class="mt-2 btn" style="background-color:grey; color:white" disabled>Unavailable</button></div>');
                        $count+=1;
                        if($count==3) {
                            echo('</div>');
                            $count=0;
                        }
                    }
                }
            ?>
        </div>
        <div class="container-fluid" id="main-course">
        <span>Main Course</span>
            <div style="background-color: black; height:2px;">&nbsp;</div><br>
            <?php
                $check->execute();
                    $resmenu=$check->get_result();
                if($resmenu->num_rows==0)
                echo("<img class='ml-5 pl-5' src='img/empty.jpg'>");
                else {
                    $count=0;
                    while($row=mysqli_fetch_row($resmenu)) {
                        if($row[3]!="Main Course")
                        continue;
                        if($count==0)
                        echo('<div class="row pl-lg-5 pl-sm-1 ml-sm-1 ml-lg-5">');
                        $veg=True;
                        if($row[5]=='Non-Veg')
                        $veg=False;
                        echo ('<div class="m-lg-5 m-3 pt-4 px-4 col-lg-3" id="mc-tabs">');
                        if($veg)
                        echo('<h2 id="'.$row[0].'">
                        '.$row[0].'</h2><i class="fa fa-circle mb-2" style="font-size:20px; color:green"></i><br>');
                        else
                        echo('<h2 id="'.$row[0].'">
                        '.$row[0].'</h2><i class="fa fa-circle mb-2" style="font-size:20px; color:red"></i><br>');
                        echo('<img class="mb-3 mt-2" src="'.$row[1].'"><br>'.$row[2].'<br>
                        <h5 class="my-3">Price: Rs. <span style="color: red; font-size: larger;">'.$row[4].'</span></h5>');
                            if($row[6]==1)
                            echo('<form action="main.php" method="post"><button class="mt-2 btn" style="background-color:orange; color:white" name="cartitem" value="'.$row[0].'">Add to Cart</button></form></div>');
                            else
                            echo('<button class="mt-2 btn" style="background-color:grey; color:white" disabled>Unavailable</button></div>');
                        $count+=1;
                        if($count==3) {
                            echo('</div>');
                            $count=0;
                        }
                    }
                }
            ?>
        </div>
        <div class="container-fluid" id="d-n-b">
        <span>Drinks and Beverages</span>
            <div style="background-color: black; height:2px;">&nbsp;</div><br>
            <?php
                $check->execute();
                    $resmenu=$check->get_result();
                if($resmenu->num_rows==0)
                echo("<img class='ml-5 pl-5' src='img/empty.jpg'>");
                else {
                    $count=0;
                    while($row=mysqli_fetch_row($resmenu)) {
                        if($row[3]!="Drinks and Beverages")
                        continue;
                        if($count==0)
                        echo('<div class="row pl-lg-5 pl-sm-1 ml-sm-1 ml-lg-5">');
                        $veg=True;
                        if($row[5]=='Non-Veg')
                        $veg=False;
                        echo ('<div class="m-lg-5 m-3 pt-4 px-4 col-lg-3" id="dnb-tabs">');
                        if($veg)
                        echo('<h2 id="'.$row[0].'">
                        '.$row[0].'</h2><i class="fa fa-circle mb-2" style="font-size:20px; color:green"></i><br>');
                        else
                        echo('<h2 id="'.$row[0].'">
                        '.$row[0].'</h2><i class="fa fa-circle mb-2" style="font-size:20px; color:red"></i><br>');
                        echo('<img class="mb-3 mt-2" src="'.$row[1].'"><br>'.$row[2].'<br>
                        <h5 class="my-3">Price: Rs. <span style="color: red; font-size: larger;">'.$row[4].'</span></h5>');
                            if($row[6]==1)
                            echo('<form action="main.php" method="post"><button class="mt-2 btn" style="background-color:orange; color:white" name="cartitem" value="'.$row[0].'">Add to Cart</button></form></div>');
                            else
                            echo('<button class="mt-2 btn" style="background-color:grey; color:white" disabled>Unavailable</button></div>');
                        $count+=1;
                        if($count==3) {
                            echo('</div>');
                            $count=0;
                        }
                    }
                }
            ?>
        </div>
        <div class="container-fluid" id="ice-cream">
        <span>Ice Cream</span>
            <div style="background-color: black; height:2px;">&nbsp;</div><br>
            <?php
                $check->execute();
                    $resmenu=$check->get_result();
                if($resmenu->num_rows==0)
                echo("<img class='ml-5 pl-5' src='img/empty.jpg'>");
                else {
                    $count=0;
                    while($row=mysqli_fetch_row($resmenu)) {
                        if($row[3]!="Ice Cream")
                        continue;
                        if($count==0)
                        echo('<div class="row pl-lg-5 pl-sm-1 ml-sm-1 ml-lg-5">');
                        $veg=True;
                        if($row[5]=='Non-Veg')
                        $veg=False;
                        echo ('<div class="m-lg-5 m-3 pt-4 px-4 col-lg-3" id="ic-tabs">');
                        if($veg)
                        echo('<h2 id="'.$row[0].'">
                        '.$row[0].'</h2><i class="fa fa-circle mb-2" style="font-size:20px; color:green"></i><br>');
                        else
                        echo('<h2 id="'.$row[0].'">
                        '.$row[0].'</h2><i class="fa fa-circle mb-2" style="font-size:20px; color:red"></i><br>');
                        echo('<img class="mb-3 mt-2" src="'.$row[1].'"><br>'.$row[2].'<br>
                        <h5 class="my-3">Price: Rs. <span style="color: red; font-size: larger;">'.$row[4].'</span></h5>');
                            if($row[6]==1)
                            echo('<form action="main.php" method="post"><button class="mt-2 btn" style="background-color:orange; color:white" name="cartitem" value="'.$row[0].'">Add to Cart</button></form></div>');
                            else
                            echo('<button class="mt-2 btn" style="background-color:grey; color:white" disabled>Unavailable</button></div>');
                        $count+=1;
                        if($count==3) {
                            echo('</div>');
                            $count=0;
                        }
                    }
                }
                $check->close();
            }
            catch(Exception $ex) {} }
            ?>
        </div>

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
        if (isset($_POST['oldpassword']) and isset($_POST['newpassword']) and isset($_POST['renewpassword'])) {
        if($_POST['oldpassword']!=$userrow[3])
        echo("<script>swal('Wrong Password!', 'Looks like you typed it wrong! Try again.', 'error');</script>");
        else if($_POST['newpassword']!=$_POST['renewpassword'])
        echo("<script>swal('Password Mismatch!', 'Looks like you re-typed it wrong! Try again.', 'error');</script>");
    else {
            try {
            $stmt=$conn->prepare("update users set password=? where roll=?");
            $stmt->bind_param("si", $_POST['renewpassword'], $userrow[0]);
            $stmt->execute();
            echo("<script>swal('Password Changed!', 'But please do not forget it.', 'success');
            </script>");
            $stmt->close();
        }
        catch(Exception $e) {}
    }
        }
        if(isset($_POST['logout'])) {
            session_unset();
            session_destroy();
            unset($_POST['logout']);
            echo("<script>
            localStorage.removeItem('scrollpos');
            setTimeout(function(){
                window.location.href = 'index.php'; 
            },0000);// for 3 second redirection
            </script>");
            exit;

        }

        //Cart starts here.
        if(isset($_POST['cartitem'])) {
            try {
                $check=$conn->prepare('select * from cart where user=? and item=?');
                $check->bind_param('is', $userid, $_POST['cartitem']);
                $check->execute();
                $res=$check->get_result();
                $check->close();
                if($res->num_rows==0) {
                    $stmt=$conn->prepare('select price from menu where name=?');
                    $stmt->bind_param('s', $_POST['cartitem']);
                    $stmt->execute();
                    $res=$stmt->get_result();
                    $price=mysqli_fetch_row($res)[0];
                    $stmt->close();
                    $stmt=$conn->prepare('insert into cart(user, item, quantity, price) values (?,?,1,?)');
                    $stmt->bind_param("isi", $userid, $_POST['cartitem'], $price);
                    $stmt->execute();
                    $stmt->close();
                }
                echo("<script>swal('Item Added!', 'You have chosen the best! Confirm it at the cart.', 'success');
                </script>");
                unset($_POST['cartitem']);
            }
            catch(Exception $ex) {echo($ex);}
        }
        try {
            $fetch=$conn->prepare('select * from cart where user=?');
            $fetch->bind_param('i', $userid);
            $fetch->execute();
            $fetched=$fetch->get_result();
            $fetch->close();
        }
        catch(Exception $ex) {}
        ?>
        <div class="modal fade" id="cart" tabindex="-1" role="dialog" style="color:#AA96DA">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header" style="background-color: black; color:white">
                      <h4 class="modal-title py-2"><h1>&nbsp;&nbsp;My Cart</h1></h4>
                      <button type="button" id="cart-close" class="close" aria-label="close" data-dismiss="modal" style="color:white">&times;</button>
                    </div>
                    <div class="modal-body" style="background-color: white; color: black;" id="cart-form">
                        <?php
                        if($fetched->num_rows==0)
                        echo("<img src='img/empty.jpg'>");
                    else {?>
                    <div class="row"><div class="col-4 pl-5" style="background-color:black; color:white; border:2px solid:white">Quantity</div><div class="col-6 pl-5" style="background-color:black; color:white; border:2px solid:white">Item Name</div><div class="col-2 pr-5 pl-0" style="background-color:black; color:white; border:2px solid:white">Price</div></div>
                    <?php
                        $total=0;
                        while($row=mysqli_fetch_row($fetched)) {
                            echo("<div class='row m-2' style='font-size:large'>");
                            echo("<div class='col-4'><form action='main.php' method='post'><button class='btn' name='sub' value='".$row[1]."'>-- </button>&nbsp;&nbsp;&nbsp;".$row[2]."&nbsp;&nbsp;&nbsp;<button class='btn' name='add' value='".$row[1]."'> + </button></form></div>");
                            echo("<div class='col-6 mt-1'>".$row[1]."</div>");
                            echo("<div class='col-2 mt-1'>Rs.&nbsp;<b style='color:red;'>".(intval($row[2])*intval($row[3]))."</b></div>");
                            $total+=intval($row[2])*intval($row[3]);
                            echo("</div>");
                        }
                        echo("<br><center>Total Amount: Rs.&nbsp;<b style='color:red;'>".$total."</b></center>");
                        echo('<br><center><form method="post" action="main.php"><button class="btn" id="pay" style="background-color: green; color: white; font-size: large; border: 1px solid black; border-radius: 2%;" name="payed" value="1" onclick="payed()">Make Payment</button></form></center>');
                    }
                    if(isset($_POST['payed'])) {
                        try {
                            $stmt=$conn->prepare('select * from cart where user=?');
                            $stmt->bind_param('i', $userid);
                            $stmt->execute();
                            $res=$stmt->get_result();
                            $order="";
                            while($row=mysqli_fetch_row($res)) 
                                $order=$order."<span>".$row[1]."&nbsp;&nbsp;X&nbsp;&nbsp;".$row[2]."</span><br>";
                            $stmt->close();
                            $stmt=$conn->prepare('delete from cart where user=?');
                            $stmt->bind_param('i', $userid);
                            $stmt->execute();
                            $stmt->close();
                            $stmt=$conn->prepare("insert into orders(id, content, time, delivered) values(?, ?, now(), 0)");
                            $stmt->bind_param('is', $userid, $order);
                            $stmt->execute();
                            $stmt->close();
                            unset($_POST['payed']);
                            echo('<script>location.href="ready.php"</script>');
                        }
                        catch(Exception $ex) {echo($ex);}
                    }
                    if(isset($_SESSION['open'])) {
                        echo("<script>document.querySelector('#cart-close').click();
                        document.querySelector('#cart-maker').click();</script>");
                        unset($_SESSION['open']);
                    }
                    if(isset($_POST['sub'])) {
                        try {
                            $stmt=$conn->prepare('select quantity from cart where user=? and item=?');
                            $stmt->bind_param('is', $userid, $_POST['sub']);
                            $stmt->execute();
                            $res=$stmt->get_result();
                            $stmt->close();
                        $qty=intval(mysqli_fetch_row($res)[0])-1;
                        if($qty==0) {
                            $stmt=$conn->prepare('delete from cart where user=? and item=?');
                            $stmt->bind_param('is', $userid, $_POST['sub']);
                            $stmt->execute();
                            $stmt->close();
                        }
                        else {
                            $stmt=$conn->prepare('update cart set quantity=? where user=? and item=?');
                            $stmt->bind_param('iis', $qty, $userid, $_POST['sub']);
                            $stmt->execute();
                            $stmt->close();
                        }
                     }
                     catch(Exception $ex) {}
                     $_SESSION['open']=1;
                     echo('<script>location.href="main.php";</script>');
                    }
                    if(isset($_POST['add'])) {
                        try {
                            $stmt=$conn->prepare('select quantity from cart where user=? and item=?');
                            $stmt->bind_param('is', $userid, $_POST['add']);
                            $stmt->execute();
                            $res=$stmt->get_result();
                            $stmt->close();
                        $qty=intval(mysqli_fetch_row($res)[0])+1;
                        if($qty<=50) {
                            $stmt=$conn->prepare('update cart set quantity=? where user=? and item=?');
                            $stmt->bind_param('iis', $qty, $userid, $_POST['add']);
                            $stmt->execute();
                            $stmt->close();
                        }
                     }
                     catch(Exception $ex) {}
                     $_SESSION['open']=1;
                     echo('<script>location.href="main.php";</script>');
                    }
                    if(isset($_POST['delacc'])) {
                        try {
                            $stmt=$conn->prepare('delete from users where roll=?');
                            $stmt->bind_param('i', $userid);
                            $stmt->execute();
                            $stmt->close();
                            echo('<script>location.href="index.php";</script>');
                        }
                        catch(Exception $ex) {}
                    }
                    if(isset($_POST['newname'])) {
                        if(htmlspecialchars($_POST['newname']))
                        try {
                            $stmt=$conn->prepare('update users set name=? where roll=?');
                            $stmt->bind_param('si', htmlspecialchars($_POST['newname']), $userid);
                            $stmt->execute();
                            $stmt->close();
                            echo('<script>swal("Username Updated!", "Ah! I will have to memorize a new name now!", "success").then(function() {location.href="main.php";});</script>');
                        }
                        catch(Exception $ex) {}
                    }
                     $conn->close();
                        ?>
                    </div>
                  </div>
                </div>
              </div>
              <?php
              if(isset($_POST['feeder'])) {
                $mail->AddAddress('somthirtha.bhowmik.mca24@heritageit.edu.in');
                $mail->Subject="Feedback from The Heritage Canteen user";
                $mail->Body="Here is what ".$_POST['feedbackuser']." (".$_POST['feedbackid'].") with registered email ID: ".$_POST['feedbackmail']." wrote: ".$_POST['feedback'];
                if($mail->send())
                echo("<script>swal('Feedback Mailed!', 'We promise it is valuable for us! Thank You!', 'success');</script>");
                else
                echo("<script>swal('Could not send the mail!', 'We promise it is us, not you! Please try again!', 'error');
                        </script>");
              }
              ?>
        <script type="text/javascript">
             document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

        window.onbeforeunload = function(e) {
            localStorage.setItem('scrollpos', window.scrollY);
        };
        function showResult(str) {
            if (str.length==0) {
                document.getElementById("livesearch").innerHTML="";
                document.getElementById("livesearch").style.border="0px";
                return;
            }
            var xmlhttp=new XMLHttpRequest();
            xmlhttp.onreadystatechange=function() {
                if (this.readyState==4 && this.status==200) {
                document.getElementById("livesearch").innerHTML=this.responseText;
                document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                }
            }
            
            xmlhttp.open("GET","livesearch.php?q="+str,true);
            xmlhttp.send();
            } 

        history.forward();  
    </script>
    </body>
</html>