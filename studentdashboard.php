<?php
include('library.php');
if(empty($_SESSION['sid']) || $_SESSION['sid']==''){
    header("Location: index.php");
    exit();   
}

if(isset($_POST['change_pass_submit']) && $_POST['change_pass_submit']!=''){
    change_password($_POST['Current_Password'],$_POST['New_Password'],$_POST['Confirm_Password']);
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile Page</title>
        <link type="text/css" rel="stylesheet" href="css/profile.css" />
        <script src="js/navbar.js" type="text/javascript"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    </head>
    <body>
        <?php
            header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
            header("Cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");   

            $user_details = get_user_details($_SESSION['sid']);
            navbar();
        ?>
        
        <div class="row">
            <div style="margin-left: 20px;">
                <div class="card" style="width: 97vw">
                    <div class="card-block">
                        <h4 class="card-title" >My Profile</h4>
                    </div>
                    <div class="panel-body">
                        <?php
                            if(isset($_REQUEST["password_change"]) && $_REQUEST["password_change"]!=''){
                                $pass_alert=$_REQUEST["password_change"];
                                if($pass_alert=="failed"){
                                    echo '<div class="alert alert-danger">Password not changed. Password did not match.</div>';
                                }else if($pass_alert=="success"){
                                    echo '<div class="alert alert-success">Password successfully changed.</div>';
                                }else if($pass_alert=="curpassincorrect"){
                                    echo '<div class="alert alert-danger">Current password incorrect. Try again.</div>';
                                }
                            }
                        ?>
                        <h5>Profile Information</h5>
                        <div class="float-right">
                            <?php
                                if($user_details['image']!=null){
                                    echo '<img class="img-rounded" src="data:image/jpeg;base64,'.base64_encode( $user_details['image'] ).'" width="150" height="150" />';
                                }else{
                                    echo '<img class="img-rounded" src="pics/avatar.png" width="150" height="150">';
                                }
                            ?>
                        </div>
                        <br>
                        <table class="col-md-6">
                        <tr class="col-md-6">
                            <td><p><b>User Name:</b></p></td>
                            <td><p><?php echo $_SESSION['sid']; ?></p></td>
                        </tr>
                        <tr class="col-md-6">
                            <td><p><b>Name:</b></p></td>
                            <td><p><?php echo $user_details['name']; ?></p></td>
                        </tr>
                        <tr class="col-md-6">
                            <td><p><b>Roll number:</b></p></td>
                            <td><p><?php echo $user_details['rno']; ?></p></td>
                        </tr>
                        </table>
                        </br>
                        </br>
                        <div class="row">
                            <h5>Change Password</h5>
                        </div>
                        <div class="row">
                            <form class="form-inline" action="" method="post">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Current_Password">Current Password:</label>
                                        <input type="password" class="form-control" id="Current_Password" name="Current_Password">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="New_Password">New Password:</label>
                                        <input type="password" class="form-control" id="New_Password" name="New_Password">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="Confirm_Password">Confirm Password:</label>
                                        <input type="password" class="form-control" id="Confirm_Password" name="Confirm_Password">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <input name="change_pass_submit" class="btn btn-primary" type="submit" value="Change Password">
                                </div>
                            </form>
                        </div>
                        <div class="row">
                                <h5>Change Profile Picture</h5>
                        </div>
                        <div class="row">
                            <form class="form-inline" action="changedp" method="post" enctype="multipart/form-data">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input class="btn" type="file" name="dp" id="dp">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit" value="Upload File">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>	
            </div>
        </div>
        <script src="js/navbar.js" type="text/javascript"></script>
        <script src="js/jquery-3.1.1.js" type="text/javascript"></script>        
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    </body>
</html>
