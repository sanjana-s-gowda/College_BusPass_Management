<?php session_start(); ?>
<html>

<head>
    <title>Online Quiz Portal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=""> 
</head>
<?php
    if (isset($_POST['login'])) {
        if (isset($_POST['usertype']) && isset($_POST['username']) && isset($_POST['pass'])) {
            require_once 'sql.php';
            $conn = mysqli_connect($host, $user, $ps, $project);
            if (!$conn) {
                echo "<script>alert('Database error retry after some time!')</script>";
            }
            $type = mysqli_real_escape_string($conn, $_POST['usertype']);
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $password = mysqli_real_escape_string($conn, $_POST['pass']);
            $password = crypt($password, 'rakeshmariyaplarrakesh');
            $sql = "select * from " . $type . " where mail='{$username}'";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                global $dbmail, $dbpw;
                while ($row = mysqli_fetch_array($res)) {
                    $dbpw = $row['pw'];
                    $dbmail = $row['mail'];
                    $_SESSION["name"] = $row['name'];
                    $_SESSION["type"] = $type;
                    $_SESSION["username"] = $dbmail;
                }
                if ($dbpw === $password) {
                    if ($type === 'student') {
                        header("location:homestud.php");
                    } elseif ($type === 'staff') {
                        header("Location: homestaff.php");
                    }
                } elseif ($dbpw !== $password && $dbmail === $username) {
                    echo "<script>alert('Password is wrong');</script>";
                } elseif ($dbpw !== $password && $dbmail !== $username) {
                    echo "<script>alert('Username not found. Sign up');</script>";
                }
            }
        }
    }
?>
<style>
    body {
        margin: 0;
        font-family: 'Courier New', Courier, monospace;
        color: #042A38;
        
        background-size: cover;
        height: 100%;
        opacity: 0.9;
        background-color: #e0f7fa; /* Light cyan background color */
    }

    h1 {
        background: #fff;
        padding: 1vw;
        color: #042A38;
        text-transform: uppercase;
    }

    .login-container {
        max-width: 40vw;
        margin: 10vh auto;
        background-color: #ffffffab;
        padding: 2vw;
        border: 2px solid black;
        border-radius: 10px;
    }

    .inp, .sub {
        width: 100%;
        padding: 1vw;
        margin: 0.5vw 0;
        border-radius: 10px;
        border: 2px solid black;
        box-sizing: border-box;
    }

    .inp:focus, .sub:focus {
        outline: none;
    }

    .sub {
        background-color: lightblue;
        cursor: pointer;
    }

    a {
        color: #042A38;
    }

    .seluser {
        display: flex;
        justify-content: space-around;
    }
</style>

<body>
    <center>
        <h1>ONLINE Quiz Portal</h1>
        <div class="login-container w3-card">
            <form method="POST">
                <div class="seluser">
                    <label>
                        <input type="radio" name="usertype" value="student" required> STUDENT
                    </label>
                    <label>
                        <input type="radio" name="usertype" value="staff" required> STAFF
                    </label>
                </div><br>
                <label for="username">Username</label><br>
                <input type="email" name="username" placeholder="Email" class="inp" required><br>
                <label for="password">Password</label><br>
                <input type="password" name="pass" placeholder="******" class="inp" required><br>
                <input name="login" class="sub" type="submit" value="Login"><br>
            </form><br>
            <a href="reset.php">Forgot password?</a> &nbsp; New user! <a href="signup.php">SIGN UP</a>
        </div>
    </center>
</body>

</html>
