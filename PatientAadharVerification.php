<?php
                session_start();
                      $id=$_SESSION["IDD"];
                        $con=mysqli_connect('localhost','root','','project2');
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
        <title>Blank template</title>
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
       $pass=$_POST["aadhar"];
       $pass2=$_POST["password"];
       if($pass!=$pass2){
           echo"Passwords don't match.";
       }else{
        $mdpass=md5($pass2);
        $con2=mysqli_connect('localhost','root','','project2');
        $q1="UPDATE patient SET password='$mdpass' where aadhar='$id'";
        mysqli_query($con2,$q1);
        header("Location:login-regis.php");
       }
}
?>
<br>
<div align="center">
<div class="log">
       <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
       <br>
       <label class="lbl" >ForgotPassword</label><br><br>
       <input type="password" class="inp" placeholder="Enter Password" name="aadhar" required>
      <br><br>
       <input type="password" class="inp" placeholder="Confirm Password" name="password" required>
      <br><br>
       <input type="Submit" name="Verify" class="btn btn-primary" value="Reset"><br><br>
        </form>
</div>
</div>
</body>
</html>