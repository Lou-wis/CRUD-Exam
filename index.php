<?php
session_start();
require('conn.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userEmail = isset($_POST['email']) ? trim($_POST['email']) : '';
    $userPassword = isset($_POST['pass']) ? trim($_POST['pass']) : '';

    if (empty($userEmail) || empty($userPassword)) {
        $_SESSION['error'] = "Please fill up all fields";
    } else { 
        $userEmail = mysqli_real_escape_string($conn, $userEmail); 

        $queryValidate = "SELECT * FROM users WHERE user_email=?";
        $stmt = mysqli_prepare($conn, $queryValidate);

        mysqli_stmt_bind_param($stmt, 's', $userEmail);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_assoc($result);

            if ($row['user_password'] == md5($userPassword)) {
                $_SESSION['status'] = 'valid';
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['useremail'] = $row['user_email'];
                $_SESSION['userpass'] = $row['user_password'];

                header("Location: ../crudexam/admin/index.php");
                exit();
            } else {
                $_SESSION['error'] = "Invalid username or password";
            }
        } else {
            $_SESSION['error'] = "Username not found";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php
include 'head.php';
?>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form" method="POST" action="">
                    <span class="login100-form-title">
                        Login
                    </span>

                    <div class="wrap-input100">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="wrap-input100">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" type="submit">
                            Login
                        </button>
                    </div>

                    <div class="text-center p-t-136">
                        <a class="txt2" href="#">
                            <!--Create your Account-->Hello, User!
                            <!--<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>-->
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/select2/select2.min.js"></script>
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <script src="js/main.js"></script>
</body>
</html>
