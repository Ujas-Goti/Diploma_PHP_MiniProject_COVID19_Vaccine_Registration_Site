<?php
session_start();

$ID=$_SESSION["vcID"];
$con=mysqli_connect('localhost','root','','project2');
$q1="SELECT * FROM vaccinator WHERE ID='$ID'";
$result=mysqli_query($con,$q1);
$rows=mysqli_fetch_array($result);
list($name,,$area,)=$rows;

if(isset($_POST["Logout"])){
    unset($_SESSION["vcID"]);
    header("Location:vclogin.php");
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="icon" href="images/logo2.png" type="image/icon">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <title>Home</title> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    .inp{
        border: 1px solid black;
        border-radius:5px;
        height:35px;
        width:300px;
    
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
        <?php echo $name;?>
      </a>
      <div class="dropdown-menu">
      <button type="Submit" name="Logout" class="btn btn-light btn-block ">Logout</button>
      </div>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="vchome.php">Home</a>
      </li>  
      <li class="nav-item">
          <?php echo"<a class=\"nav-link\" href=\"vchistory.php?id=$name\">History</a>";?>
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
                <td colspan="2" align="center">
                  <h3>Vaccinator Details</h3>
                </td>
            </tr>
            <tr align="center">
                <td>
                Name
                </td>
                <td>
                <?php echo $name;?>
                </td>
            </tr>
            <tr align="center">
                <td>
                Area
                </td>
                <td>
                <?php echo $area;?>
                </td>
            </tr>
        </table>
        <br>
    </div>
    <br>
    <div class="card">
    <br>
        <table cellpadding="10px" width="50%" align="center" >
            <tr>
                <th>
                   Enter Aadhar
                </th>
                <td>
                <input type="text" class="inp" name="aadhar">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                <input type="Submit" name="Verify" class="btn btn-primary" value="Verify"><br><br>
                <?php
                    if(isset($_POST['Verify'])){
                        $ad=$_POST['aadhar'];
                        $con=mysqli_connect('localhost','root','','project2');
                        $q1="SELECT * FROM appointments WHERE aadhar='$ad' and area='$area' and status='Due'";
                        $result=mysqli_query($con,$q1);
                        if(mysqli_num_rows($result)==0){
                            echo"No appointments of this user.";
                        }
                        else{
                            $_SESSION["userdet"]=$ad;
                            $_SESSION["vcnme"]=$name;
                            header("Location:vccheck.php");
                        }
                    }
                ?>
                </td>
            </tr>
            </table>
            <br>
            <br>
            <table cellpadding="10px" width="80%" align="center" border="1" >
            <tr>
                <td colspan="5" align="center">
                <br>
                    <h2>
                   Appointments Today
                </h2> 
                <br>
                </td>
            </tr>
            <tr>
                <th>
                    Name
                </th>
                <th>
                    Date
                </th>
                <th>
                    Dose
                </th>
                <th>
                    Area
                </th>
                <th>
                    Vaccine
                </th>
            </tr>
            <?php
                    $con=mysqli_connect('localhost','root','','project2');
                    $dt=date("Y-m-d");
                    $q1="SELECT name,date,dose,area,vaccine FROM appointments WHERE area='$area' and date='$dt' and status='Due'";
                    $result=mysqli_query($con,$q1);
                    while($row=mysqli_fetch_array($result)){
                        echo"<tr>";
                        for($i=0;$i<5;$i++){
                            echo"<td>".$row[$i]."</td>";
                        }
                        echo"</tr>";
                    }
            ?>
            
        </table>
        <br>
    </div>
</div>
</form>
</body>
</html>
