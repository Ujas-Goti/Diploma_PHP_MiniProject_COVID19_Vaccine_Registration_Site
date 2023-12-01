<?php
$flag=false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $id = $_POST['id'];
  $area = $_POST['area'];
 
  if (empty($_POST["name"])) {
    $nameErr = "*Field Required";
  } else {
    $name = test_input($_POST["name"]);
    $flag=true;
  }
  
  }if (empty($_POST["email"])) {
    $emailErr = "*Field Required";
  } else {
    $email = test_input($_POST["email"]);
    $flag=true;
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
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="adminhome.php">Back</a>
      </li>  
    </ul>
</nav>
<?php
if(isset($_POST["Add"]))
{
    if($flag==true){
      $con=mysqli_connect('localhost','root','','project2');
      $q1="SELECT * FROM vaccinator WHERE ID='$id'";
      $result=mysqli_query($con,$q1);
      $rec=mysqli_num_rows($result);
          if($rec==0){
            $mdpass=md5($pass);
            $con=mysqli_connect('localhost','root','','project2');
            $q1="INSERT INTO vaccinator VALUES('$name','$id','$area','$mdpass')";
            mysqli_query($con,$q1);
            echo'<div class="alert alert-success alert-dismissible fade show">
            <strong>Added successfully.</strong>&nbsp;&nbsp;&nbsp;&nbsp;
            </div>';
          }
          else{
            echo'<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>*Vaccinator already registered.</strong>
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
       <label class="lbl" >Vaccinator Registration</label><br><br>
       <input type="text" class="inp" placeholder="Enter Name" name="name" required>
       <?php //echo $nameErr;?>
       <br><br>

       <input type="text" class="inp" placeholder="Enter ID" name="id" required>
       
       <br><br>
       
      
       <select name="area" class="inp"  id="area">
                        <option value="Default">Select Area</option>
                        <option value="Katargam">Katargam</option>
                        <option value="Adajan">Adajan</option>
                        <option value="Varacha">Varacha</option>
                        <option value="Althan">Althan</option>
                        <option value="Athwalines">Athwalines</option>
                        <option value="Vesu">Vesu</option>
                        <option value="Olpad">Olpad</option>
                    </select>
                    <br/><br>
       <input type="password" class="inp" placeholder="Enter Password" name="password" required>
       <?php $passErr;?>
       <br><br>
       <input type="password" class="inp" placeholder="Confirm Password" name="conpassword" required>
       <?php $conpassErr;?>
       <br><br>
       <input type="Submit" name="Add" class="btn btn-primary" value="Add" required><br><br>
        </form>

   </div>
</div>
</body>
</html>