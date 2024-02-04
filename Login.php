<?php
session_start();
include(__DIR__ . '/db_config.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];
    
        $query = "SELECT * FROM register WHERE email=? LIMIT 1";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
    
        if ($result && $row = mysqli_fetch_assoc($result)) {
          if ($password == $row['password']) { 
                $_SESSION['email'] = $email;
                header("Location: Home.php");
                exit();
            } else {
                $error = "Invalid email or password. Please try again.";
            }
        } else {
            $error = "Invalid email or password. Please try again.";
        }
    
}
?>


<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="index.css" rel="stylesheet">
</head>
<body>


<div class="" style="text-align:center;display:block">
    <h2>Login Form:</h2>
    <?php
    if (isset($error)) {
        echo '<p style="color: red;">' . $error . '</p>';
    }
    ?>
    </div>

    <div class="container">
    <form method="post">

    <div class="row">
    <label class="col-sm-2 col-form-label" for="email">Email:</label>  
    <div class="col-sm-7"> 
        <input class="form-control" type="text" name="email"required>   
    </div>
    </div>

    <div class="row">
    <label class="col-sm-2 col-form-label" for="password">Password:</label>  
    <div class="col-sm-7"> 
        <input class="form-control" type="text" name="password" required>   
    </div>
    </div>
    <div class="row">
    <div class="col-sm-2" ></div>
    <div class="col-sm-2" >
        <input type="submit" name="submit" value="Login" class="btn btn-primary" onclick="check()">
        <label id="status" style="text-align:center; display:block;"></label>
    </div>
</div>
<div class="row">
<div class="col-sm-2" ></div>
    <span class="col-sm-7">
        Don't you have an account?
        <a href="index.php">Register</a>
    </span>
</div>
    </form>
</div>
</body>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="index.js"></script>
</html>
