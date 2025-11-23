<?php
session_start();
if(!isset ($_SESSION['user'])) {
    header('Location: ./login.php');
}
require_once '../app/Power_typesList.php';
$ptl = new Power_typesList();
$ptl -> readFromFile();
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    $ptl->delete($_GET['id']);
    $ptl->saveToFile();
    header('Location: ./PowerTypes-List.php');
}
?>

<hmtl>
    <head>
        <title>Coffee machines management system</title>
        <meta charset="utf-8"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link href = "../assets/style.css" rel="stylesheet"/>
    </head>
    <body>
        <div class="container">
            <h1>Content control system</h1>
            <h1>Power types list</h1>
            <nav class = "navbar-nav flex-row">
                <li><a class ="btn btn-secondary" id = "secbtn" href="CoffeeMachines-List.php">Coffee machines list</a></li>
                <li><a class ="btn btn-secondary" id = "secbtn" href="AddCoffeeMachine.php">Add coffee machine</a></li>
                <li><a class ="btn btn-secondary" id = "secbtn" href="Producers-List.php">Producers list</a></li>
                <li><a class ="btn btn-secondary" id = "secbtn" href="AddProducer.php">Add producer</a></li>
                <li><a class ="btn btn-secondary" id = "secbtn" href="Types-List.php">Types list</a></li>
                <li><a class ="btn btn-secondary" id = "secbtn" href="AddType.php">Add type</a></li>
                <li><a class ="btn btn-secondary" id = "secbtn" href="CoffeeTypes-List.php">Coffee type list</a></li>
                <li><a class ="btn btn-secondary" id = "secbtn" href="AddCoffeeType.php">Add coffee type</a></li>
                <li><a class ="btn btn-secondary" id = "secbtn" href="PowerTypes-List.php">Power type list</a></li>
                <li><a class ="btn btn-secondary" id = "secbtn" href="AddPowerType.php">Add power type</a></li>
                <li><a class ="btn btn-danger" id = "secbtn" href="logout.php">Log out</a></li>
            </nav>
            <a class="btn btn-primary" href="AddPowerType.php">Add power type</a>
            <div>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Power type</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody> <?php echo $ptl->exportAsTableData();?> </tbody>
                </table>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>