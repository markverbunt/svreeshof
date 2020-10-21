<?php
// Include config file
require_once 'account/helpers/db.php';
 
// Define variables and initialize with empty values
$username = $password = $confirm_password = $firstname = $lastname = $email = "";
$username_err = $password_err = $confirm_password_err = $firstname_err = $lastname_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($mysqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = trim($_POST["username"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Validate password
    if(empty(trim($_POST['password']))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST['password'])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST['password']);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = 'Please confirm password.';     
    } else{
        $confirm_password = trim($_POST['confirm_password']);
        if($password != $confirm_password){
            $confirm_password_err = 'Password did not match.';
        }
    }

    // Validate the rest
   if(empty(trim($_POST['firstname']))){
        $firstname_err = "Please enter a firstname.";     
    } else{
        $firstname = trim($_POST['firstname']);
    }

   if(empty(trim($_POST['lastname']))){
        $lastname_err = "Please enter a lastname.";     
    } else{
        $lastname = trim($_POST['lastname']);
    }

   if(empty(trim($_POST['email']))){
        $email_err = "Please enter a email.";     
    } else{
        $email = trim($_POST['email']);
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($firstname_err) && empty($lastname_err) && empty($email_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (username, password, firstname, lastname, email) VALUES (?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($mysqli, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_password, $param_firstname, $param_lastname, $param_email);
            
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_email = $email;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                echo "<script>window.location='/login.php'</script>";
            } else{
                echo "Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($mysqli);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sv Reeshof Bierteam - Inschrijven</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../../css/style.css" rel="stylesheet">
</head>

<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="javascript:void(0);">Aanmelden</a>
            <small>Reeshof 7</small>
        </div>
        <div class="card">
            <div class="body">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="input-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" name="username" class="form-control" placeholder="Gebruikersnaam" value="<?php echo $username; ?>" required>
                            <span class="help-block"><?php echo $username_err; ?></span>
                        </div>
                    </div>
                    <div class="input-group <?php echo (!empty($firstname_err)) ? 'has-error' : ''; ?>">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" name="firstname" class="form-control" placeholder="Voornaam" value="<?php echo $firstname; ?>" required>
                            <span class="help-block"><?php echo $firstname_err; ?></span>
                        </div>
                    </div>
                    <div class="input-group <?php echo (!empty($lastname_err)) ? 'has-error' : ''; ?>">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" name="lastname" class="form-control" placeholder="Achternaam" value="<?php echo $lastname; ?>" required>
                            <span class="help-block"><?php echo $lastname_err; ?></span>
                        </div>
                    </div>
                    <div class="input-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line">
                            <input type="email" name="email"class="form-control" placeholder="Email" value="<?php echo $email; ?>" required>
                            <span class="help-block"><?php echo $email_err; ?></span>
                        </div>
                    </div>
                    <div class="input-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" name="password" class="form-control" minlength="6" placeholder="Wachtwoord" value="<?php echo $password; ?>" required>
                            <span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                    </div>
                    <div class="input-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" name="confirm_password" class="form-control" minlength="6" placeholder="Herhaal Wachtwoord" value="<?php echo $confirm_password; ?>" required>
                            <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-block btn-lg bg-pink waves-effect" value="INLOGGEN">

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="login.php">Heb je al een account?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core Js -->
    <script src="../../plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Validation Plugin Js -->
    <script src="../../plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>
    <script src="../../js/pages/examples/sign-up.js"></script>
</body>

</html>