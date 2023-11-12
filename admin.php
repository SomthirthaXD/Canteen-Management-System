<?php
session_start();
?>
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
    </head>
    <body id="body" style="background-color:#C5FAD5;">
    <div id="small-screen" class="p-5 m-5"><h5>Sorry! This page is visible on larger screens only!</h5></div>
        <div id="my-body">
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'canteendb');
            if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }
            else {
              $check=$conn->prepare('select * from users where roll<>1111111');
              try {
                $check->execute();
                $res=$check->get_result();
                $get=$conn->prepare('select email from users where roll=1111111');
                $get->execute();
                $ans=$get->get_result();
        ?>
        <div class="container-fluid py-3" id="top-container">
            <div class="row" id="top">
                <div class="col-12">
                    <center><img src="img/hitlogo.png" class="img-fluid" id="logo"></center>
                </div>
                <div class="col-12">
                    <center id="intro">THE HERITAGE CANTEEN</center>
                </div>
            </div>
            <div class="row" id="top">
                <div class="col-12">
                    <center id="welcome-text">Welcome Canteen Manager<center>
                </div>  
            </div>
        </div>
        <div class="container-fluid row py-1 ml-0" id="nav-bar">
            <button class="col-4 btn" onclick="userToggle()">Manage Users</button>
            <button class="col-4 btn" onclick="menuToggle()" autofocus>Manage Menu</button>
            <button class="col-4 btn" onclick="profileToggle()">Update Profile</button>
        </div>
        <div class="container-fluid" id="profile-manager">
            <div class="row mt-4" id="top">
                <div class="col-12">
                    <center id="welcome-text">&nbsp;&nbsp;&nbsp;Update&nbsp;Your &nbsp;Profile<center>
                </div> 
            </div>
            <div class="row">
                <div class="mx-auto col-10 col-md-8 col-lg-6">
                    <form class="my-4 py-4 px-4" action="admin.php" method="POST" style="background-color:#AA96DA; color:#FFFFD2; border:1px solid black; border-radius: 1%;">
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
                    <center><form action="main.php" method="post">
                        <button type="submit" class="row btn" id="logout" style="background-color:red; color:white;" name="logout" value="1">Logout</button></form></center>
                    
                </div>
            </div>
        </div>
        <div class="container-fluid" id="user-manager">
            <div class="row mt-4" id="top">
                <div class="col-12">
                    <center id="welcome-text">&nbsp;&nbsp;&nbsp;Manage&nbsp;Users<center>
                </div> 
            </div>
            <div class="row">
                <div class="mx-auto col-10 col-md-8 col-lg-6">
                    <form action='admin.php' method='post'>
                        <table class="table">
                            <thead>
                                <tr>
                                <th class="col-4 " style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;">Full Name</th>
                                <th class="col-4" style="background-color:#FFFFD2; border: 2px solid black;">User ID</th>
                                <th class="col-4" style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;">Email ID</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($res->num_rows==0)
                                    echo("<img class='ml-5 pl-5' src='img/empty.jpg'>");
                                    else {
                                        while($row=mysqli_fetch_row($res)) {
                                            echo ('<tr>
                                            <td class="col" style="background-color:#FFFFD2; border: 2px solid black;">'.$row[1].'</td>
                                            <td class="col" style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;">'.$row[0].'</td>
                                            <td class="col" style="background-color:#FFFFD2; border: 2px solid black;">'.$row[2].'</td>
                                            <td class="col" style="background-color:#AA96DA; border: 2px solid black;"><button type="submit" class="btn btn-primary" style="background-color:red; color:white" name="delete" value='.$row[0].'>Delete</button></td>
                                        </tr>');
                                        }
                                    }
                                    $check->close();
                                }
                                catch(Exception $ex)  {}
                                $check=$conn->prepare('select * from menu order by category');
                                try {
                                    $check->execute();
                                    $res=$check->get_result();
                                ?>
                            </tbody>   
                        </table> 
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid" id="menu-manager">
            <div class="row mt-4" id="top">
                <div class="col-12">
                    <center id="welcome-text">&nbsp;&nbsp;&nbsp;Manage&nbsp;Menu<center>
                </div> 
            </div>
            <div class="row">
                <div class="mx-auto col-10 col-md-8 col-lg-6">
                    <form action='admin.php' method='post'>
                        <table class="table">
                            <thead>
                                <tr>
                                <th class="col " style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;">Item Description</th>
                                <th class="col" style="background-color:#FFFFD2; border: 2px solid black;">Image</th>
                                <th class="col" style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;">Item Name</th>
                                <th class="col" style="background-color:#FFFFD2; border: 2px solid black;">Category</th>
                                <th class="col" style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;">Price</th>
                                <th class="col" style="background-color:#FFFFD2; border: 2px solid black;">Veg/Non-Veg</th>
                                <th class="col" style="background-color:#FFFFD2; border: 2px solid black;">Availability</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if($res->num_rows==0)
                                    echo("<img class='ml-5 pl-5' src='img/empty.jpg'>");
                                    else {
                                        while($row=mysqli_fetch_row($res)) {
                                            echo ('<form action="admin.php" method="post"><tr>
                                            <td class="col" style="background-color:#FFFFD2; border: 2px solid black;"><input type="text" name="updateDesc" value="'.$row[2].'" placeholder="Enter Updated Value"></td>
                                            <td class="col" style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;"><input type="text" name="updateImg" value="'.$row[1].'" placeholder="Enter Updated Value"><br><center><img src="'.$row[1].'" style="height: 90px; width:90px;"></center></td>
                                            <td class="col" style="background-color:#FFFFD2; border: 2px solid black;">'.$row[0].'</td>
                                            <td class="col" style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;">'.$row[3].'</td>
                                            <td class="col" style="background-color:#FFFFD2; border: 2px solid black;"><input type="text" name="updatePrice" value="'.$row[4].'" placeholder="Enter Updated Value" pattern="^[0-9]{1, 5}$"></td>
                                            <td class="col" style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;">'.$row[5].'</td>');
                                            if($row[6]==1)
                                            echo('<td class="col" style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;"><button type="submit" class="btn btn-primary" style="background-color:green; color:white" name="avail" value="'.$row[0].'">Available</button></td>');
                                            else
                                            echo('<td class="col" style="background-color:#AA96DA; color:#FFFFD2; border: 2px solid black;"><button type="submit" class="btn btn-primary" style="background-color:red; color:white" name="unavail" value="'.$row[0].'">Unavailable</button></td>');
                                            echo('<td class="col" style="background-color:#AA96DA; border: 2px solid black;"><button type="submit" class="btn btn-primary" style="background-color:red; color:white" name="deleteMenu" value="'.$row[0].'">Delete</button></td>');
                                            echo('<td class="col" style="background-color:#AA96DA; border: 2px solid black;"><button type="submit" class="btn btn-primary" style="background-color:green; color:white" name="updateMenu" value="'.$row[0].'">Update</button></td>
                                            </tr></form>');
                                        }
                                    }
                                    $check->close();
                                }
                                catch(Exception $ex)  {}
                                ?>
                                <tr>
                                    <td class="col" colspan=6 style="background-color:#AA96DA; border: 2px solid black;"><center><button type="button"  data-toggle="modal" data-target="#insert" class="btn btn-primary" style="background-color:black; color:white">+</button></center></td>
                                </tr>
                            </tbody>   
                        </table> 
                    </form>
                </div>
            </div>
            <div class="modal fade" id="insert" tabindex="-1" role="dialog" style="color:#AA96DA">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header" style="background: url(img/food2.jpg) center center; color:white">
                      <h4 class="modal-title py-2"><center style="color:#FFFFD2; text-shadow: 5px 2px #060606;"><h1>&nbsp;&nbsp;Add New Menu Item</h1></center></h4>
                      <button type="button" class="close" aria-label="close" data-dismiss="modal" style="color:white">&times;</button>
                    </div>
                    <div class="modal-body" id="new-item">
                      <p>
                        <form action="admin.php" method="post">
                              <div class="form-group">
                                <label>Item Name</label>
                                <input type="text" class="form-control" name="itemname" style="background-color:#FFFFD2" placeholder="Enter Item Name" required>
                              </div>
                            <div class="form-group">
                              <label>Item Image</label>
                              <input type="text" name="itemimage" class="form-control" placeholder="Enter image url" style="background-color:#FFFFD2" value="img/" required>
                            </div>
                            <div class="form-group">
                              <label>Item Description</label>
                              <input type="text" name="itemdesc" class="form-control" placeholder="Describe the item briefly" style="background-color:#FFFFD2" required>
                            </div>
                            <div class="form-group">
                              <label>Item Category</label><br>
                              <select class="form-select" name="cat" style="background-color:#FFFFD2;">
                                <option selected value="Snacks">Snacks</option>
                                <option value="Main Course">Main Course</option>
                                <option value="Drinks and Beverages">Drinks and Beverages</option>
                                <option value="Ice Cream">Ice Cream</option>
                            </select>
                            </div>
                            <div class="form-group">
                              <label>Item Price</label>
                              <input type="tel" name="itemprice" class="form-control" placeholder="Enter item price" style="background-color:#FFFFD2" maxlength="5" required>
                            </div>
                            <div class="form-group">
                              <label>Veg</label>
                              <input type="radio" name="itemveg" class="form-control" value="Veg" style="background-color:#FFFFD2;" checked>
                              <label>Non-Veg</label>
                              <input type="radio" name="itemveg" class="form-control" value="Non-Veg" style="background-color:#FFFFD2">
                            </div>
                            <center><button type="submit" class="btn btn-primary" style="background-color:#AA96DA">Submit</button></center>
                          </form>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        <script>
            function profileToggle() {
                document.getElementById("profile-manager").style.display="block";
                document.getElementById("menu-manager").style.display="none";
                document.getElementById("user-manager").style.display="none";
            }
            function menuToggle() {
                document.getElementById("profile-manager").style.display="none";
                document.getElementById("menu-manager").style.display="block";
                document.getElementById("user-manager").style.display="none";
            }
            function userToggle() {
                document.getElementById("profile-manager").style.display="none";
                document.getElementById("menu-manager").style.display="none";
                document.getElementById("user-manager").style.display="block";
            }
        </script>
        <?php
            if(isset($_POST['password']) and isset($_POST['repassword'])) {
                $pass=$_POST['password'];
                $repass=$_POST['repassword'];
                if($pass!=$repass)
                echo("<script>swal('Password Mismatch!', 'Looks like you re-typed it wrong! Try again.', 'error');</script>");
                else {
                try {        
                    $stmt=$conn->prepare("update users set password=? where roll=1111111");
                    $stmt->bind_param("s", $pass);
                    $stmt->execute();
                    echo("<script>swal('Credentials Updated!!', 'A new you eh!.', 'success');</script>");
                    $stmt->close();
                    $conn->close();
                }
                catch(Exception $e) {
                    echo($e->getMessage());
                }
            }
            }
            else if(isset($_POST['updateMenu'])) {
                try {
                    $i=htmlspecialchars($_POST['updateImg']);
                    $d=htmlspecialchars($_POST['updateDesc']);
                    $p=htmlspecialchars($_POST['updatePrice']);
                    $stmt=$conn->prepare("update menu set about=?, image=?, price=? where name=?");
                    $stmt->bind_param("ssis", $d, $i, $p, $_POST['updateMenu']);
                    $stmt->execute();
                    unset($_POST['updateMenu']);
                    echo("<script>swal('Menu Updated!', 'I hate making changes! Please be careful.', 'success').then(function(){
                        window.location.href = 'admin.php'; 
                    });
                    </script>");
                    $stmt->close();
                    $conn->close();
                }
                catch(Exception $e) {
                    echo($e->getMessage());
                }
                unset($_POST['updateMenu']);
            }
            else if(isset($_POST['delete'])) {
                try {
                    $stmt=$conn->prepare("delete from users where roll=?");
                    $stmt->bind_param("i", $_POST['delete']);
                    $stmt->execute();echo("<script>swal('User Removed!', 'Hmmmm! I wonder why they had to leave.', 'success').then(function(){
                        window.location.href = 'admin.php'; 
                    });
                    </script>");
                    $stmt->close();
                    $conn->close();
                }
                catch(Exception $e) {
                    echo($e->getMessage());
                }
            }
            else if(isset($_POST['deleteMenu'])) {
                try {
                    $stmt=$conn->prepare("delete from menu where name=?");
                    $stmt->bind_param("s", $_POST['deleteMenu']);
                    $stmt->execute();
                    unset($_POST['deleteMenu']);
                    echo("<script>swal('Item Removed!', 'Oooops! Looks like something was not tasty!', 'success').then(function(){
                        window.location.href = 'admin.php'; 
                    });
                    </script>");
                    $stmt->close();
                    $conn->close();
                }
                catch(Exception $e) {
                    echo($e->getMessage());
                }
            }
            else if(isset($_POST['avail'])) {
                echo($_POST['avail']);
                try {
                    $stmt=$conn->prepare("update menu set available=False where name=?");
                    $stmt->bind_param("s", $_POST['avail']);
                    $stmt->execute();echo("<script>swal('Item Held Back!', 'Oooops! Looks like the star of the show is sold out!', 'success').then(function(){
                        window.location.href = 'admin.php'; 
                    });
                    </script>");
                    $stmt->close();
                    $conn->close();
                }
                catch(Exception $e) {
                    echo($e->getMessage());
                }
            }
            else if(isset($_POST['unavail'])) {
                try {
                    $stmt=$conn->prepare("update menu set available=True where name=?");
                    $stmt->bind_param("s", $_POST['unavail']);
                    $stmt->execute();echo("<script>swal('Item Added Back!', 'Yayy! The menu got its star back', 'success').then(function(){
                        window.location.href = 'admin.php'; 
                    });
                    </script>");
                    $stmt->close();
                    $conn->close();
                }
                catch(Exception $e) {
                    echo($e->getMessage());
                }
            }
            else if(isset($_POST['itemname'])) {
                try {
                    $stmt=$conn->prepare("INSERT INTO `menu` (`name`, `image`, `about`, `category`, `price`, `veg`) VALUES (?,?,?,?,?,?)");
                    $stmt->bind_param("ssssis", htmlspecialchars($_POST['itemname']), htmlspecialchars($_POST['itemimage']), htmlspecialchars($_POST['itemdesc']), $_POST['cat'], htmlspecialchars($_POST['itemprice']), $_POST['itemveg']);
                    $stmt->execute();echo("<script>swal('Item Added!', 'Lucky them! Another great item up!', 'success').then(function(){
                        window.location.href = 'admin.php'; 
                    });
                    </script>");
                    $stmt->close();
                    $conn->close();
                }
                catch(Exception $e) {
                    echo($e->getMessage());
                }
            }
        }
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
        
        <script type="text/javascript"> 
             document.addEventListener("DOMContentLoaded", function(event) { 
            var scrollpos = localStorage.getItem('scrollpos');
            if (scrollpos) window.scrollTo(0, scrollpos);
        });

window.onbeforeunload = function(e) {
    localStorage.setItem('scrollpos', window.scrollY);
};
        history.forward();  
    </script>
    </div>
    </body>
</html>