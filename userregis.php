<?php
function isAadharValid($num) {
  $arrstr=str_split($num);
  $valid=0;
  if(count($arrstr)==12){
      $valid=1;
  }
  return $valid;
}

$nameErr=$ageErr = $lnameErr=$emailErr=$aadharErr=$noErr=$passErr=$conpassErr = "";
$name=$age = $lname=$aadhar=$email=$no=$pass=$conpass = "";
$flag=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  if (empty($_POST["name"])) {
    $nameErr = "*Field Required";
  } else {
    $name = test_input($_POST["name"]);
    $flag=true;
  }
  if (empty($_POST["age"])) {
    $ageErr = "*Field Required";
  } else {
    $age = test_input($_POST["age"]);
    $flag=true;
  }
  if (empty($_POST["lname"])) {
    $lnameErr = "*Field Required";
  } else {
    $lname = test_input($_POST["lname"]);
    $flag=true;
  }
  if (empty($_POST["no"])) {
    $noErr = "*Field Required";
  } else {
    $no = test_input($_POST["no"]);
    $flag=true;
  }if (empty($_POST["email"])) {
    $emailErr = "*Field Required";
  } else {
    $email = test_input($_POST["email"]);
    $flag=true;
  }
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
  if (empty($_POST["conpassword"])) {
    $conpassErr = "*Field Required";
  } else {
      if($pass==$_POST["conpassword"]){
        $conpass = test_input($_POST["conpassword"]);
        $flag=true;
      }
      else{
          $conpassErr="*Passwords don't match.";
      }
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
     .lbl{
        font-size:30px;
        font-weight:bold;
    }
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
    .alertmsg{
      color:black;
      text-decoration:underline;
    }
</style>
    </head>
<body class="body">

<nav class="navbar navbar-expand-md bg-light navbar-light">
    <a class="nav-br" href="index.php"><img src="images/logo.png" class="logo" alt="logo"></a>
</nav>
<?php
if(isset($_POST["Register"]))
{
    if($flag==true){
      $con=mysqli_connect('localhost','root','','project2');
      $q1="SELECT * FROM patient WHERE aadhar='$aadhar'";
      $result=mysqli_query($con,$q1);
      $rec=mysqli_num_rows($result);
          if($rec==0){
            $mdpass=md5($conpass);
            $con=mysqli_connect('localhost','root','','project2');
            $q1="INSERT INTO patient VALUES('$name','$lname','$aadhar','$no','$email','$mdpass','Unvaccinated','$age','2')";
            mysqli_query($con,$q1);
            echo'<div class="alert alert-success alert-dismissible fade show">
            <strong>Registered successfully.</strong>&nbsp;&nbsp;&nbsp;&nbsp;<a href="login-regis.php" class="alertmsg">Back to Login page</a>
            </div>';
          }
          else{
            echo'<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>*Aadhar already registered.</strong>
            </div>';
          }
          mysqli_close($con);
    }
}
?>
<br>
<div align="center">
<div class="log">
   <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
   <br>
       <label class="lbl" >Register</label><br><br>
       <input type="text" class="inp" placeholder="Enter First Name" name="name" required>
       <?php echo $nameErr;?>
       <br><br>
       <input type="text" class="inp" placeholder="Enter Last Name" name="lname" required>
       <?php echo $lnameErr;?>
       <br><br>
       <input type="text" class="inp" placeholder="Enter Aadhar No." name="aadhar" required>
       <?php echo $aadharErr;?>
       <br><br>
       <input type="number" class="inp" placeholder="Enter Age" name="age" required>
       <?php echo $ageErr;?>
       <br><br>
       <input type="text" class="inp" placeholder="Enter Phone No." name="no" required>
       <?php echo $noErr;?>
       <br><br>
       <input type="text" class="inp" placeholder="Enter Email" name="email" required>
       <?php echo $emailErr;?>
       <br><br>
       <input type="password" class="inp" placeholder="Enter Password" name="password" required>
       <?php echo $passErr;?>
       <br><br>
       <input type="password" class="inp" placeholder="Confirm Password" name="conpassword" required>
       <?php echo $conpassErr;?>
       <br><br>
       <input type="Submit" name="Register" class="btn btn-primary" value="Register" required><br><br>
        </form>

   </div>
</div>
</body>
</html>