<!DOCTYPE html>
<html>
    <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Log-in</title>
            <link rel="stylesheet" href="main.css">
    </head>
    <body>
        
        <?php
            if(isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];

                require_once "connect.php";

                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

                if($user) {
                    if  (password_verify($password, $user["password"] ))
                        {
                            header("Location : Reports.php");
                        }
                }else {
                    echo "<div> email does not exist </div>";
                }

                }
            ?>
        <header class="navbar">
            <div class="logo"><img src="https://www.must.ac.mw/imgs/logo/must%20log%20black.png"
                 width="100"></div>
            <h1 class="app-name">MUST Travel Safe</h1>
            <div class="spacer"></div>
        </header>
        <main class="Login-container">
            <div class="login-card">
                <h2>Log to begin booking</h2>
        <form id="loginform">
            <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" placeholder="id@must.ac.mw" required><br><br>
            <div>
             <label for="password">Password</label>
             <input type="password" id="password" placeholder="******" required><br><br>
            </div>
            <button type="submit" class="login-btn">sign in</button><br><br>
        </form>
        <a href="#">forgot password?</a>
        <span>Don't have an account<a href="#">Sign up</a></span></div>
        </main>
        <script src="login.js"></script>
    </body>
</html>