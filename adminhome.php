<?php
session_start();
$ID=$_SESSION["adminID"];
$con=mysqli_connect('localhost','root','','project2');
$q1="SELECT * FROM admin WHERE ID='$ID'";
$result=mysqli_query($con,$q1);
$rows=mysqli_fetch_array($result);
list($id)=$rows;

if(isset($_POST["Logout"])){
    unset($_SESSION["adminID"]);
    header("Location:adminlogin.php");
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
    .add{
        margin-left: 400px;
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
        <?php echo $id;?>
      </a>
      <div class="dropdown-menu">
      <button type="Submit" name="Logout" class="btn btn-light btn-block ">Logout</button>
      </div>
    </li>
      <li class="nav-item">
        <a class="nav-link" href="addvcc.php">Add Vaccinator</a>
      </li> 
      <li class="nav-item">
          <?php echo"<a class=\"nav-link\" href=\"Adminhistory.php\">History</a>";?>
      </li>  
    </ul>
  </div>  
</nav>
<br>
<div align="center">
    <div class="card">
        <br>
        <table cellpadding="10px"  width="70%" align="center" border="1">
            <tr>
                <td colspan="2" align="center">
                  <h3>Admin Details</h3>
                </td>
            </tr>
            <tr align="center">
                <td>
                ID
                </td>
                <td>
                <?php echo $ID;?>
                </td>
            </tr>
            
        </table>
        <br>
    </div>
    <br>
    <div class="card">
    <br>
    <form method="POST">
        <table cellpadding="10px"  width="50%" align="center" >
            <tr>
                <td align="center" >
                  <h3> Add Slot</h3>
                </td>
            </tr>
            
        </table>
        <table  cellpadding="10px" class="add "width="50%" align="center">
            <tr>
                <td>Select Vaccine Name
              </td>

 <td>
    <select id="Name" name="Name">
    <option value="Select">Select</option>
    <option value="Sputnik">Sputnik</option>
    <option value="Covishield">Covishield</option>
    <option value="Covaxin">Covaxin</option>
 </td>

            </tr>
            <tr>
                <td>
                    Area
                </td>
            <td>
            <select name="Area" id="Area">
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
            <tr>
                <td>
                    Date
                </td>
                <td>
                    <input type="Date" id="Date" name="Date" required>
                </td>
            </tr>
            <tr>
                <td>
                    Slot
                </td>
                <td>
                    <input type="text" id="Slot" name="Slot" required>
                </td>
            </tr> </table>

           <table cellpadding="10px"  width="50%" align="center" >
            <tr>
                <td colspan="1" align="center"><input type="Submit" name="Add" class="btn btn-primary" value="Add"></td>
            </tr>
            
        </table>
        </form>
<?php
  $con=mysqli_connect('localhost','root','','project2');
  if(isset($_POST['Add'])){
        $name = $_POST['Name'];
        $area = $_POST['Area'];
        $date = $_POST['Date'];
        $slot = $_POST['Slot'];

         $q = "INSERT INTO slot2 (avail,booked,dt,area,vaccine)VALUES('$slot','','$date','$area','$name')" ;
        mysqli_query($con,$q);
        }
        ?>

            <br>
            <br>
            
        <br>
    </div>
</div>
</form>
</body>
</html>