<?php
session_start();
include(__DIR__ . '/db_config.php');
?>

<?php  
    $nameErr = $emailErr = $mobilenoErr = "";  
    $name = $email = $mobile =$address= $password  = "";  

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $address = $_POST["address"];
    $mobile = $_POST["mobile"];
  
    if (empty($name) || empty($email) || empty($password) || empty($address) || empty($mobile)) {
        $error_message = "All fields are required. Please fill in all the fields."; 
        }
    else if (!preg_match("/^[a-zA-Z ]*$/",$name)) {  
                    $nameErr = "Only alphabets and white space are allowed";  
                }     
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {  
                    $emailErr = "Invalid email format";  
                }    
    else if (!preg_match ("/^[0-9]*$/", $mobile) ) {  
                $mobilenoErr = "Only numeric value is allowed.";  
                }   
    else  if (strlen ($mobile) != 10) {  
                $mobilenoErr = "Mobile no must contain 10 digits.";  
                }  
    else {
                    $name = mysqli_real_escape_string($conn, $name);
                    $email = mysqli_real_escape_string($conn, $email);
                    $address = mysqli_real_escape_string($conn, $address);
            
                    $stmt = $conn->prepare("INSERT INTO register (name, email, password, address, mobile) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("sssss", $name, $email, $password, $address, $mobile);
            
                    if ($stmt->execute()) {
                        $_SESSION['registration_success'] = true;
                        header("Location: index.php");
                        exit();
                    } else {
                        $error_message = "Error occurred while processing your request. Please try again later.";
                        header("Location: index.php?error_message=" . urlencode($error_message));
                        exit();
                    }
                    $stmt->close();
                    $conn->close();
                }
            }
             
    
    function input_data($data) {  
      $data = trim($data);  
      $data = stripslashes($data);  
      $data = htmlspecialchars($data);  
      return $data;  
    }  
?>  

<?php
    if (isset($_SESSION['registration_success']) && $_SESSION['registration_success'] === true) {
        echo '<div class="alert alert-success" role="alert">
                Successfully registered! You can now <a href="login.php">login</a>.
            </div>';
        unset($_SESSION['registration_success']);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="index.css" rel="stylesheet">
    <title>Register</title>
    

  
</head>

<body>

<div class="" style="text-align:center;display:block">
    <h2>Registration Form</h2>  
    <span class = "error">* required field </span>  
</div>

<div class="container"  >
<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >    
    
    <div class="row g-3">
    <label class="col-sm-2 col-form-label" for="autoSizingInput">Name:</label>  
    <div class="col-sm-7"> 
        <input class="form-control" type="text" name="name">  
        <span class="error">* <?php echo $nameErr; ?> </span>  
    </div>
    </div>

    <div class="row g-3">
    <label class="col-sm-2 col-form-label" for="autoSizingInput"> E-mail:</label>
    <div class="col-sm-7">  
     <input  class="form-control" type="text" name="email">  
        <span class="error">* <?php echo $emailErr; ?> </span>  
    </div>
    </div> 

    <div class="row g-3">
    <label for="password" class="col-sm-2 col-form-label" for="autoSizingInput"> Password: </label>  
    <div class="col-sm-7">
        <input class="form-control" type="password" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
        <span class="error">*</span>  
    </div>  
    </div>

    <div class="row g-3">
    <label for="address" class="col-sm-2 col-form-label" for="autoSizingInput"> Address:  </label>  
    <div class="col-sm-7">
        <textarea  class="form-control"name="address" id="address" rows="5" required></textarea>
        <span class="error">*</span>  
        </div>
    </div>

    <div class="row g-3">
    <label for="mobile" class="col-sm-2 col-form-label" for="autoSizingInput">  Phone No:     </label>  
    <div class="col-sm-7">
        <input class="form-control" type="text" name="mobile">  
        <span class="error">* <?php echo $mobilenoErr; ?> </span>  
    </div>
    </div>
        
    <div class="row">
    <div class="col-sm-2" ></div>
    <div class="col-sm-2" >                 
        <input type="submit" name="submit" value="Submit" class="btn btn-primary">   
    </div>  

    <div class="row">
    <div class="col-sm-2" ></div>
    <span class="col-sm-7">
         Already have an account?
        <a href="Login.php">Login</a>
    </span>
    </div>
                 
</form> 
</div> 

<div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>

      <!-- Option 1: Bootstrap Bundle with Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
      <script src="index.js"></script>
</body>
</html>