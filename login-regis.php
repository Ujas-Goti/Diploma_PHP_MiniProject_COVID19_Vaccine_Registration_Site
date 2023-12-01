<?php
session_start();
if(isset($_SESSION["lgstat"])){
    $lgstat=$_SESSION["lgstat"];
    $_SESSION["lgstat"]=0;
}
else{
    $_SESSION["lgstat"]=0;
    $lgstat=$_SESSION["lgstat"];
}

function isAadharValid($num) {
  $arrstr=str_split($num);
  $valid=0;
  if(count($arrstr)==12){
      $valid=1;
  }
  return $valid;
}
$aadharErr=$passErr = "";
$aadhar=$pass= "";
$flag=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  if (empty($_POST["aadhar"])) {
    $aadharErr = "*Field Required";
  } else {
    $valid = isAadharValid($_POST["aadhar"]);
    if ($valid == 1) {
        $aadhar = test_input($_POST["aadhar"]);
        $flag=true;
    }
    else{
        $aadharErr="*Invalid Aadhar";
    }
  }
  if (empty($_POST["password"])) {
    $passErr = "*Field Required";
  } else {
    $pass = test_input($_POST["password"]);
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
        <a class="nav-link" href="vclogin.php">Vaccinator</a>
      </li>  
    </ul>
</nav>
<?php
if($lgstat==1){
    echo' <div class="alert alert-warning alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Logged out successfully.</strong>
  </div>';
}
if(isset($_POST["Login"]))
{
    if($flag==true){
        $con=mysqli_connect('localhost','root','','project2');
        $q1="SELECT * FROM patient WHERE aadhar='$aadhar'";
        $result=mysqli_query($con,$q1);
        $rec=mysqli_num_rows($result);{
            if($rec==0){
                echo'
                <div class="alert alert-danger alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>*Aadhar not registered.</strong>
  </div>';
            }
            else{
                $row=mysqli_fetch_array($result);
                $mdpass=md5($_POST["password"]);
                if($row[5]!=$mdpass){
                    echo'
                    <div class="alert alert-danger alert-dismissible fade show">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>*Incorrect password.</strong>
      </div>';
                }
                else{
                    $_SESSION["aadhar"]=$row[2];
                    $_SESSION["lgstat"]=2;
                    header("Location:home.php");
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
       <label class="lbl" >Login</label><br><br>
       <input type="text" class="inp" placeholder="Enter Aadhar No." name="aadhar" required>
       <?php echo $aadharErr;?>
      <br><br>
       <input type="password" class="inp" placeholder="Enter Password" name="password" required>
       <?php echo $passErr;?>
      <br><br>
       <input type="Submit" name="Login" class="btn btn-primary" value="Login"><br><br>
       <a href="userregis.php">New User? Register here</a><br><br>
       <a href="PatientForgetPass.php">Forgot Password</a><br><br>
        </form>
</div>
</div>
</body>
</html>