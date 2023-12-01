<?php
session_start();
if(!isset($_SESSION["aadhar"])){
    header("Location:session.php");
}

if(isset($_SESSION["bslt"])){
    $bslt=$_SESSION["bslt"];
    $_SESSION["bslt"]=0;
}
else{
    $_SESSION["bslt"]=0;
    $bslt=$_SESSION["bslt"];
}
$aadhar=$_SESSION["aadhar"];
$con=mysqli_connect('localhost','root','','project2');
$q1="SELECT * FROM patient WHERE aadhar='$aadhar'";
$result=mysqli_query($con,$q1);
$rows=mysqli_fetch_array($result);
list($fname,$lname,,$no,$email,,$status,$age,$doses)=$rows;
$dose=$doses;
$dose+=2;
$dose-=4;
$dose=abs($dose);
if(isset($_POST["Logout"])){
    unset($_SESSION["aadhar"]);
    $_SESSION["lgstat"]=1;
    header("Location:login-regis.php");
}
if(isset($_POST["Dose1"])){
    $_SESSION["dose"]=1;
    header("Location:regis.php");
}
if(isset($_POST["Dose2"])){
    $_SESSION["dose"]=2;
    header("Location:regis.php");
}
?>

<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="images/logo2.png" type="image/icon">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <title>Home</title>
 <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
  
  <link rel="stylesheet" href="styles.css">
<style>
    .body{
        
        background-color:#c3cdfa;

     }
    .logo{
            height:50px;
            width:140px;
        
        }
    .slider{
        margin:auto;
        height:600px;
        width:1000px;
        border-radius:7px;
    }
    .LAY1{
        margin-bottom:30px;
        
    }
    .card{
        margin : auto;
        width:90%;
        border-radius:10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

</style>
    </head>
<body class="body">
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
<nav class="navbar navbar-expand-md bg-light navbar-light">
  <a class="navbar-brand" href="index.php"><img src="images/logo.png" class="logo" alt="logo"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        <?php echo $fname." ".$lname;?>
      </a>
      <div class="dropdown-menu">
      <button type="Submit" name="Logout" class="btn btn-light btn-block ">Logout</button>
      </div>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="home.php">Home</a>
      </li>  
    </ul>
  </div>  
</nav>
<?php
if($bslt==1){
    echo' <div class="alert alert-success alert-dismissible fade show">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <strong>Slot booked succcessfully.</strong>
  </div>';
}
?>
<br>
<div align="center">
    <div class="card">
        <br>
        <table cellpadding="10px" width="70%" align="center" border="1">
            <tr>
                <th>
                   Status
                </th>
                <th>
                    Doses taken
                </th>
            </tr>
            <tr>
                <td>
                <?php echo $status;?>
                </td>
                <td>
                <?php echo $dose;?>
                </td>
            </tr>
        </table>
        <br>
    </div>
    <br>
    <div class="card">
    <br>
        <table cellpadding="10px" width="70%" align="center" >
            <tr>
                <th>
                   Name
                </th>
                <td>
                <?php echo $fname." ".$lname;?>
                </td>
            </tr>
            <tr>
                <th>
                   Age
                </th>
                <td>
                <?php echo $age;?>
                </td>
            </tr>
            <tr>
                <th>
                   Mobile Number
                </th>
                <td>
                <?php echo "+91 ".$no;?>
                </td>
            </tr>
            <tr>
                <th>
                   Email
                </th>
                <td>
                <?php echo $email;?>
                </td>
            </tr>
            <tr>
                <th>
                   Dose 1
                </th>
                <td>
                <?php
                    if($dose==0){ 
                        $cons=mysqli_connect('localhost','root','','project2');
                        $q4="SELECT * FROM appointments WHERE aadhar='$aadhar' and dose='1'";
                        $result=mysqli_query($cons,$q4);
                        $record=mysqli_num_rows($result);
                        if($record==0){
                            echo'<input type="Submit" name="Dose1" value="Book" class="btn btn-outline-info">';
                        }
                        else{
                            $rows=mysqli_fetch_array($result);
                            if($rows[4]=="Due"){
                                echo"Due on $rows[2]";
                            }
                        }
                    }
                    else{
                        $con=mysqli_connect('localhost','root','','project2');
                        $q1="SELECT * FROM appointments WHERE aadhar='$aadhar' and dose='1'";
                        $result=mysqli_query($con,$q1);
                        $rows=mysqli_fetch_array($result);
                        if($rows[4]=="Due"){
                            echo"Due on $rows[2]";
                        }
                        else{
                            echo"Vaccinated on $rows[2]  <a href=\"details.php?aad=$aadhar&dose=1\">Details</a>";
                        }
                    }
                ?>
                </td>
            </tr>
            <tr>
                <th>
                   Dose 2
                </th>
                <td>
                <?php
                if($dose==0){
                        echo'<input type="Submit" name="Dose2" value="Book" class="btn btn-outline-secondary" disabled>';
                }
                    else if($dose==1){
                        $cons=mysqli_connect('localhost','root','','project2');
                        $q4="SELECT * FROM appointments WHERE aadhar='$aadhar' and dose='2'";
                        $result=mysqli_query($cons,$q4);
                        $record=mysqli_num_rows($result);
                        if($record==0){
                            echo'<input type="Submit" name="Dose2" value="Book" class="btn btn-outline-info">';
                        }
                        else{
                            $rows=mysqli_fetch_array($result);
                            if($rows[4]=="Due"){
                                echo"Due on $rows[2]";
                            }
                        }
                    }
                    else if($dose==2){
                        $con=mysqli_connect('localhost','root','','project2');
                        $q1="SELECT * FROM appointments WHERE aadhar='$aadhar' and dose='2'";
                        $result=mysqli_query($con,$q1);
                        $rows=mysqli_fetch_array($result);
                        if($rows[4]=="Due"){
                            echo"Due on $rows[2]";
                        }
                        else{
                            echo"Vaccinated on $rows[2] <a href=\"details.php?aad=$aadhar&dose=2\">Details</a>";
                        }
                    }
                ?>
                </td>
            </tr>
        </table>
        <br>
    </div>
</div>
</form>
</body>
</html>
