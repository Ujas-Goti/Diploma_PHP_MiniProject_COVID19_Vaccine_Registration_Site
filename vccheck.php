<?php
session_start();
$user=$_SESSION["userdet"];
$con=mysqli_connect('localhost','root','','project2');
$q1="SELECT * FROM appointments WHERE aadhar='$user' and status='Due'";
$result=mysqli_query($con,$q1);
$rows=mysqli_fetch_array($result);
list($name,,$date,$dose,,$ar,$vcc,)=$rows;
$q2="SELECT * FROM patient WHERE aadhar='$user'";
$result3=mysqli_query($con,$q2);
$rows3=mysqli_fetch_array($result3);
$d=$rows3[8]-1;
$vcname=$_SESSION["vcnme"];
if(isset($_POST["yes"])){
    if($dose==1){
        $con=mysqli_connect('localhost','root','','project2');
        $query="UPDATE appointments SET status='Done',vaccinator='$vcname' WHERE name='$name'";
        $qa="UPDATE appointments SET status='Done',vaccinator=$vcname WHERE name='$name'";
        $qb="UPDATE patient SET status='Partially Vaccinated',doses=$d WHERE aadhar='$user'";
        mysqli_query($con,$query);
      mysqli_query($con,$qb);
        header("Location:vchome.php");
    }
    else if($dose==2){
        $con=mysqli_connect('localhost','root','','project2');
        $query="UPDATE appointments SET status='Done',vaccinator='$vcname' WHERE name='$name'";
        $qa="UPDATE appointments SET status='Done',vaccinator=$vcname WHERE name='$name'";
        $qb="UPDATE patient SET status='Fully Vaccinated',doses=$d WHERE aadhar='$user'";
        mysqli_query($con,$query);
      mysqli_query($con,$qb);
        header("Location:vchome.php");
    }
}
if(isset($_POST["no"])){
    header("Location:vchome.php");
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    .card{
        margin : auto;
        width:90%;
        border-radius:10px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
    tr{
        align:center
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
      <li class="nav-item">
        <a class="nav-link" href="vchome.php">Back</a>
      </li>  
</ul>
  </div>  
</nav>
<br>
<div align="center">
    <div class="card">
        <br>
        <table cellpadding="10px" width="70%" align="center" border="1">
            <tr>
                <h3 colspan="2" align="center">
                    Appointment Details
                    <br><br>
                </h3>
            </tr>
            <tr align="center">
                <th>
                   Name
                </th>
                <td>
                <?php 
                echo $name;?>
                </td>
            </tr>
            <tr align="center">
                <th>
                   Date
                </th>
                <td>
                <?php echo $date;?>
                </td>
            </tr>
            <tr align="center">
                <th>
                   Dose
                </th>
                <td>
                <?php echo $dose;?>
                </td>
            </tr>
            <tr align="center">
                <th>
                   Vaccine
                </th>
                <td>
                <?php echo $vcc;?>
                </td>
            </tr>
            <tr align="center">
                <th>
                   Area
                </th>
                <td>
                <?php echo $ar;?>
                </td>
            </tr>
            <tr align="center">
                <th>
                   Vaccinated
                </th>
                <td>
                <input type="Submit" name="yes" class="btn btn-outline-success" value="Yes">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="Submit" class="btn btn-outline-danger" name="no" value="No">
                </td>
            </tr>
        </table>
        <br><br>
    </div>
</div>
</form>
</body>
</html>