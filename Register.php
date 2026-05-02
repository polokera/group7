<!DOCTYPE html>
<html>
    <head>
    <title> register </title>
    </head>

    <body>
        <div class="container">
            <?php
                if(isset($_POST["submit"])) {
                    $fullname = $_POST["fullname"];
                    $email = $_POST["email"];
                    $password_hash = password_hash($password, PASSWORD_DEFAULT);

                    $sqlcheckuser = "SELECT * FROM users email = '$email'";
                    $errors = array();

                    $result = mysqli_query($conn, $sqlcheckuser);
                    $rowCount = mysqli_num_rows($result);

                    if(count($errors) > 0) {
                        echo $errors;
                    }

                    if($rowCount > 0) {
                        array_push($errors, "Email already exists");
                    }else {
                        $sql = "INSERT INTO users(fullname, email, password) VALUES (?,?,?)";
                        $stmt = mysqli_stmt_init($conn);
                        $preparestmt = mysqli_stmt_prepare($stmt, $sql);

                        if($preparestmt) {
                            myqli_stmt_bind_param($stmt, "sss", $fullname, $email, $password_hash);
                            mysqli_stmt_execute($stmt);

                            echo "<div class='alert alert-success'> You are registered successfully.</div>";
                        }
                        else{
                            die("Something went wrong");
                        }
                    }
                }