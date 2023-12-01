<?php
session_start();
if(!isset($_SESSION["aadhar"])){
    header("Location:session.php");
}
$aadhar=$_SESSION["aadhar"];
$con=mysqli_connect('localhost','root','','project2');
$q1="SELECT * FROM patient WHERE aadhar='$aadhar'";
$result=mysqli_query($con,$q1);
$rows=mysqli_fetch_array($result);
list($fname,$lname,,$no,$email,,$status,$age,$doses)=$rows;
$name=$fname." ".$lname;
$dose=$_SESSION["dose"];
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
        <table cellpadding="10px" width="70%" align="center" border="1">
            <tr>
                <h3 colspan="2" align="center">
                    Book your appointment 
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
                   Aadhar
                </th>
                <td>
                <?php echo $aadhar;?>
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
                    <select name="vcc">
                        <option value="Default">Select</option>
                        <option value="Covaxin">Covaxin</option>
                        <option value="Covishield">Covishield</option>
                        <option value="Sputnik">Sputnik</option>
                    </select>
                </td>
            </tr>
            <tr align="center">
                <th>
                   Area
                </th>
                <td>
                    <select name="area">
                        <option value="Default">Select</option>
                        <option value="Katargam">Katargam</option>
                        <option value="Adajan">Adajan</option>
                        <option value="Varacha">Varacha</option>
                        <option value="Althan">Althan</option>
                        <option value="Athwalines">Athwalines</option>
                        <option value="Vesu">Vesu</option>
                        <option value="Olpad">Olpad</option>
                    </select>
                </td>
            </tr>
            <tr align="center">
                <th>
                   Date
                </th>
                <td>
                <input type="date" name="date" value="Select Date">
                &nbsp;&nbsp;&nbsp;&nbsp; <input type="Submit" class="btn btn-outline-primary" name="verify" value="Book">
                <?php
                 if(isset($_POST["verify"])){
                     $ar=$_POST["area"];
                     $vc=$_POST["vcc"];
                    $date=strval($_POST["date"]);
                    $con2=mysqli_connect('localhost','root','','project2');
                    $query="SELECT * FROM slot2 WHERE dt='$date' and area='$ar'";
                    $res=mysqli_query($con2,$query);
                    $recs=mysqli_num_rows($res);
                        if($recs==0){
                            echo'<br><br><strong>Slot : </strong>Not available';
                        }
                        else{
                            $rows=mysqli_fetch_array($res);
                            list($a,$b,,$ar)=$rows;
                            if($a>0){
                                $b=$b+1;
                                $a=$a-1;
                                $con3=mysqli_connect('localhost','root','','project2');
                                $query5="INSERT INTO appointments VALUES('$name','$aadhar','$date','$dose','Due','$ar','$vc','')";
                                $query6="UPDATE slot2 SET avail=$a,booked=$b WHERE dt='$date'";
                                mysqli_query($con3,$query5);
                                mysqli_query($con3,$query6);
                                $_SESSION["bslt"]=1;
                                $URL="home.php";
                                echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
                                echo '<META HTTP-EQUIV="refresh" content="0;URL=' . $URL . '">';
                            }
                            else{
                                echo'<br><br><strong>Slot : </strong>Full';
                            }
                        }
                        mysqli_close($con2);
                 }
                ?>
                </td>
            </tr>
        </table>
        <br><br>
    </div>
</div>
</form>
</body>
</html>