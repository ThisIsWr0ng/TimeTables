<?php
    session_start();

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        if ($_SESSION["lvl"] <=1){
            header("location: admin_portal.php");
            exit;
        }
        else {
            header("location: personal_timetable.php");
            exit;
        }
    }

    require_once "php/conn.php";

    $username = $password = "";
    $username_err = $password_err = $login_err = "";

    if($_SERVER["REQUEST_METHOD"] == "POST") {

        if(empty(trim($_POST["username"]))){
            $username_err = "Please enter username.";
        } 
        else {
            $username = trim($_POST["username"]);
        }

        if(empty(trim($_POST["password"]))){
            $password_err = "Please enter your password.";
        }
        else {
            $password = trim($_POST["password"]);
        }

        if(empty($username_err) && empty($password_err)){
            $sql = "SELECT Id, Username, Password FROM logins WHERE Username = ?";

            if($stmt = mysqli_prepare($conn, $sql)){
                mysqli_stmt_bind_param($stmt, "s", $param_username);

                $param_username = $username;

                if(mysqli_stmt_execute($stmt)){

                    mysqli_stmt_store_result($stmt);

                    if(mysqli_stmt_num_rows($stmt) == 1){
                        mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                        if(mysqli_stmt_fetch($stmt)){
        
                            if($password == $hashed_password) {
                                
                                $accesslvlsql = "SELECT `roles`.`Access_Level`
                                FROM `users`
                                LEFT JOIN `role_assignment` ON `role_assignment`.`User` = `users`.`Id`
                                LEFT JOIN `roles` ON `role_assignment`.`Role` = `roles`.`Id`
                                WHERE `users`.`Id` = '$username';";

                                (int)$accesslvlresult = $conn->query($accesslvlsql);
                                echo $accesslvlresult;
                                session_start();

                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["username"] = $username;
                                $_SESSION["lvl"] = $accesslvlresult;
/*
                                if($_SESSION["lvl"] >2)
                                {
                                    header("location: personal_timetable.php");
                                }
                                else{
                                    header("location: admin_portal.php");
                                    
                                }
                                */
                            }
                            else {
                                $login_err = "Invalid Username or Password.";
                            }
                        }
                    } else {
                        $login_err = "Invalid Username or Password.";
                    }

                } else{
                    echo "Oops! Something went wrong. Please try again later.";
                }

                mysqli_stmt_close($stmt);
            }
        }

        mysqli_close($conn);

    }
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
<link href="sheet.css" rel="stylesheet" type="text/css">
<title>University Timetable</title>

</head>
<body>
<div class="center">

<div id="panel">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">User Name:</label>
        <input type="text" id="username" name="username" <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" tabindex="1">
        <span class="invalid-feedback"><?php echo $username_err;?></span>

        <label for="password">Password:</label>
        <input type="password" id="username" name="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" tabindex="2">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
        <div id="lower">
            <input type="checkbox"><label class="check" for="checkbox">Remember me!</label>
            <input type="submit" value="Login" tabindex="3">
        </div>
    </form>
</div>

</div>
</body>
</html>