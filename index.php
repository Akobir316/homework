<?php
session_start();
require_once "interface.php";
class RunCar implements MovableInterface{
    const MAX_SPEED = 100;
    public function start()
    {
        $_SESSION['speed'] = 0;
        return "Зажигание...";
    }
    public function up()
    {
        if(!isset($_SESSION['speed'])){
            return "Сначала зажигайте автомобиль";
        }
            if($_SESSION['speed']<100){
                $_SESSION['speed'] +=10;
                return "Ускорение, ваша скорость ".$_SESSION['speed']."км/ч";
            }
            return "Мы на максимальной скорости(100км/ч)!";
    }

    public function down()
    {
        if($_SESSION['speed']>0){
        $_SESSION['speed'] -= 10;
            if($_SESSION['speed']==0){
                return "Остановка";
            }
            return "Торможение, ваша скорость ".$_SESSION['speed']."км/ч";
        }return "Мы и так не движемся";
    }
    public function stop()
    {
        unset($_SESSION['speed']);
        return "Полная остановка";
    }
}
$car = new RunCar();
if(!empty($_POST)){
    switch ($_POST["control"]){
        case "start": {
            $start = $car->start();
        }break;
        case "up": {
            $up = $car->up();
        }break;
        case "down": {
            $down = $car->down();
        }break;
        case "stop": {
            $stop = $car->stop();
        }break;
    }
}?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Car</title>

    </head>
    <body>
    <p>Ruling Car</p>
    <form action="" method="post" >
        <button name="control" value="start">Start</button>
        <button name="control" value="up">Up</button>
        <button name="control" value="down">Down</button>
        <button name="control" value="stop">Stop</button>
    </form>
    <p><?=$start?></p>
    <p><?=$stop?></p>
    <p><?=$up?></p>
    <p><?=$down?></p>
    </body>
</html>
