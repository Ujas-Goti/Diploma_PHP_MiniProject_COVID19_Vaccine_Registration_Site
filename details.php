<?php
    $aadhar = $_GET['aad'];
    $dose=$_GET['dose'];
    $con=mysqli_connect('localhost','root','','project2');
    $q1="SELECT * FROM appointments WHERE aadhar='$aadhar' and dose='$dose' and status='Done'";
    $result=mysqli_query($con,$q1);
    $rows=mysqli_fetch_array($result);
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
        <a class="nav-link" href="home.php">Back</a>
      </li>  
</ul>
  </div>  
</nav>
<br>
<div align="center">
    <div class="card">
        <br>
        <table cellpadding="10px" id="tb1" width="70%" align="center" border="1">
            <tr>
                <h3 colspan="2" align="center">
                    Vaccination Details
                    <br><br>
                </h3>
            </tr>
            <tr align="center">
                <th>
                   Name
                </th>
                <td>
                <?php 
                echo $rows[0];?>
                </td>
            </tr>
            <tr align="center">
                <th>
                   Vaccine
                </th>
                <td>
                <?php 
                echo $rows[6];?>
                </td>
            </tr>
            <tr align="center">
                <th>
                   Dose
                </th>
                <td>
                <?php 
                echo $rows[3];?>
                </td>
            </tr>
            <tr align="center">
                <th>
                  Vaccinator
                </th>
                <td>
                <?php 
                echo $rows[7];?>
                </td>
            </tr>
            <tr align="center">
                <th>
                   Area
                </th>
                <td>
                <?php 
                echo $rows[5];?>
                </td>
            </tr>
            <tr align="center">
                <th>
                   Vaccination Date
                </th>
                <td>
                <?php 
                echo $rows[2];?>
                </td>
            </tr>
        </table>
        <br><br>

    </div>
</div>
</form>
</body>
</html>