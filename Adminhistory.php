<?php

$con=mysqli_connect('localhost','root','','project2');
$qur="SELECT * from appointments"; 
    $record_set = mysqli_query($con,$qur);
    if(mysqli_error($con)) {
    $var = mysqli_error($con); 
     echo $var; 

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
    
    <li class="nav-item">
        <a class="nav-link" href="adminhome.php">Back</a>
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
                <td colspan="8" align="center">
                  <h3>History</h3>
                </td></tr>
                 <th>Name</th>
                <th>Aadhar No.</th>
                <th>Date</th>
                <th>Dose</th>
                <th>Status</th>
                <th>Area</th>
                <th>Vaccine</th>
                <th>Vaccinator</th>
                <?php
                while($record = mysqli_fetch_row($record_set)){ ?>
             <tr>
                <td> <?php echo $record[0] ?> </td>
                <td> <?php echo $record[1] ?> </td>
                <td> <?php echo $record[2] ?> </td>
                <td> <?php echo $record[3] ?> </td>
                <td> <?php echo $record[4] ?> </td>
                <td> <?php echo $record[5] ?> </td>
                <td> <?php echo $record[6] ?> </td>
                <td> <?php echo $record[7] ?> </td>
    </tr>   
<?php
}?>
            
        </table>
        <br>
    </div>
</div>
</form>
</body>
</html>
