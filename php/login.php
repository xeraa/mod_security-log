<?php

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = $password = "";
$name_err = $password_err = "";

// Processing form data when form is submitted with a user
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } else{
        $name = $input_name;
    }

    // Validate password
    $input_password = trim($_POST["password"]);
    if(empty($input_password)){
        $password_err = "Please enter a password.";
    } else{
        $password = $input_password;
    }

    // Check input errors before inserting in database
    if(empty($name_err) && empty($password_err)){
        // Prepare a user check; masking the password in the log is intentionally missing
        $sql = "SELECT * FROM `employees` WHERE name='$name' AND password=SHA1('$password')";
        error_log("SQL query [login.php]: " . $sql . "\n", 3, "/var/log/app.log");

        $result = mysqli_query($link, $sql);

        if(mysqli_num_rows($result) !== 0){

            // Logged in. Set the cookie and forward to the create form
            // This cookie is not secure and could be created or extended client-side
            setcookie("authenticated", sha1("ok"), time() + 3600);
            header("location: create.php");
            exit();
        }
    }

    // Wrong credentials
    $name_err = $password_err = "The combination of name and password are incorrect.";

    // Close connection
    mysqli_close($link);

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Login</h2>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>" required>
                            <span class="help-block"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" value="<?php echo $password; ?>" required>
                            <span class="help-block"><?php echo $password_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
