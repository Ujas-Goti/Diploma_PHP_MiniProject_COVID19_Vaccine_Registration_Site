<?php
session_start();
$aadharErr="";
$aadhar= "";
$flag=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  if (empty($_POST["aadhar"])) {
    $aadharErr = "*Field Required";
  } else {
        $aadhar = test_input($_POST["aadhar"]);
  }
  if (empty($_POST["password"])) {
    $passErr = "*Field Required";
  } else {
    $email = test_input($_POST["password"]);
    $flag=true;
  }
}
function test_input($data) {
    $data = trim($data);
    return $data;
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="images/logo2.png" type="image/icon">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <title>Cowin-Lite</title>
  <link rel="stylesheet" href="styles.css">
<style>
    .body{
        
        background-color:#c3cdfa;

     }
    .logo{
            height:50px;
            width:140px;
        
        }
    .nav-br{
margin-top:0px;
    }
    .log{
        background-color:white;
        width:500px;
        height:fit-content;
        border-radius:10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    .inp{
        border: 1px solid black;
        border-radius:5px;
        height:35px;
        width:300px;
    
    }
    .inp:focus{
        border: 1px solid black;

    }
    .lbl{
        font-size:30px;
        font-weight:bold;
    }
</style>
    </head>
<body class="body">

<nav class="navbar navbar-expand-md bg-light navbar-light">
    <a class="nav-br" href="index.php"><img src="images/logo.png" class="logo" alt="logo"></a>
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="adminlogin.php">Admin</a>
      </li>  
      <li class="nav-item">
        <a class="nav-link" href="login-regis.php">User Login</a>
      </li>  
    </ul>
</nav>
<?php
if(isset($_POST["Verify"]))
{
    if($flag==true){
        $con=mysqli_connect('localhost','root','','project2');
        $q1="SELECT * FROM patient WHERE aadhar='$aadhar' and email='$email'";
        $result=mysqli_query($con,$q1);
        $rec=mysqli_num_rows($result);{
            if($rec==0){
                echo'
                <div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>*User not registered.</strong>
  </div>';
            }
            else{
                $row=mysqli_fetch_array($result);
                if($row[4]!=$_POST["password"]){
                    echo'
                    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>*Incorrect Credentials.</strong>
      </div>';
                }
                else{
                    $_SESSION["IDD"]=$row[2];
                    header("Location:PatientAadharVerification.php");
                }
            }
        }
    }
}
?>
<br>
<div align="center">
<div class="log">
       <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       <br>
       <label class="lbl" >ForgotPassword</label><br><br>
       <input type="text" class="inp" placeholder="Enter ID" name="aadhar" required>
      <br><br>
       <input type="text" class="inp" placeholder="Enter Email" name="password" required>
      <br><br>
       <input type="Submit" name="Verify" class="btn btn-primary" value="Verify"><br><br>
        </form>
</div>
</div>
</body>
</html>