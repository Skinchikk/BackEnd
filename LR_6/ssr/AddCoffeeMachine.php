<?php
session_start();
if(!isset ($_SESSION['user'])) {
    header('Location: ./login.php');
}
require_once '../app/Coffee_machinesList.php';
require_once '../app/ProducersList.php';
require_once '../app/TypesList.php';
require_once '../app/Coffee_typesList.php';
require_once '../app/Power_typesList.php';
require_once '../app/dbconnect.php';

$pl = new ProducersList();
$pl -> getAllFromDB($conn);
$tl = new TypesList();
$tl -> getAllFromDB($conn);
$ctl = new Coffee_typesList();
$ctl -> getAllFromDB($conn);
$ptl = new Power_typesList();
$ptl -> getAllFromDB($conn);
$cml = new Coffee_machinesList();
$cml -> getAllFromDB($conn);
$modelC = '';
$producerC = '';
$typeC = '';
$coffee_typeC = '';
$power_typeC = '';
$IdC = '';
if(isset($_GET['id'])) {
    $data = $cml->getItemById($_GET['id']);
    $IdC = $data['id'];
    $modelC = $data['model'];
    $producerC = $data['producer_id'];
    $typeC = $data['type_id'];
    $coffee_typeC = $data['coffee_type_id'];
    $power_typeC = $data['power_type_id'];
}
if(isset($_POST['model'])) {
    if($_POST['id']=='') {
        $cml->addToDB($conn, array('model'=>$_POST['model'], 'producer_id'=>$_POST['producer_id'], 'type_id'=>$_POST['type_id'], 'coffee_type_id'=>$_POST['coffee_type_id'], 'power_type_id'=>$_POST['power_type_id']));
    }
    else {
        $cml->updateDB($conn, array('id'=>$_POST['id'], 'model'=>$_POST['model'], 'producer_id'=>$_POST['producer_id'], 'type_id'=>$_POST['type_id'], 'coffee_type_id'=>$_POST['coffee_type_id'], 'power_type_id'=>$_POST['power_type_id']));
    }
    header('Location: ./CoffeeMachines-List.php');
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
            <h1>Add coffee machines form</h1>
            <nav class = "navbar-nav flex-row" id = "navbardiv">
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
            <div class="mt-3">
                <form method = "POST">
                    <p>
                    <input class="form-input" type="text" value="<?php echo $modelC; ?>" name = "model" placeholder="Model name" required/>
                    </p>
                    <p>
                    Choose producer <select name = "producer_id" required> <?php echo $pl->exportAsDDItems(); ?> </select>
                    </p>
                    <p>
                    Choose type <select name = "type_id" required> <?php echo $tl->exportAsDDItems(); ?> </select>
                    </p>
                    <p>
                    Choose coffee type <select name = "coffee_type_id" required> <?php echo $ctl->exportAsDDItems(); ?> </select>
                    </p>
                    <p>
                    Choose power type <select name = "power_type_id" required> <?php echo $ptl->exportAsDDItems(); ?> </select>
                    </p>
                    <input type="hidden" name="id" value="<?php echo $IdC; ?>"/>
                    <p>
                    <button class="btn btn-success" type="submit">Submit</button>
                    </p>
                </form>
            </div>
        </div>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</html>