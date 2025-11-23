<?php
    session_start();
    if(isset ($_SESSION['user'])) {
    header('Location: ./CoffeeMachines-List.php');
    }
    if(isset($_POST['login']) && isset($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];
        if($login === 'admin' && $password === 'admin') {
            $_SESSION['user'] = 'admin';
            header('Location: ./CoffeeMachines-List.php');
        }
        else {
            echo "<script>alert('Invalid login or password');</script>";
        }
    }
?>

<html>
    <head>
        <title>Coffee machines management system</title>
        <meta charset="utf-8"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link href = "../assets/style.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="container">
            <h1>Content control system</h1>
            <h1>Log in form</h1>
            <div class="mt-3">
                <form method = "POST">
                    <p>
                    <input class="form-input" type="text" name = "login" placeholder="Login" required/>
                    </p>
                    <p>
                    <input class="form-input" type="password" name = "password" placeholder="Password" required/>
                    </p>
                    <p>
                    <button class="btn btn-success" type="submit">Submit</button>
                    </p>
                </form>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>