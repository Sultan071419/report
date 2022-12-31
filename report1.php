<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<main class="container">


<?php

require_once'db.php';



if(isset($_POST['send'])){
    $sub = $_POST['sub'];
    $action = $_POST['action'];
    $location = $_POST['location'];
    $observation = $_POST['observation'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $addData = $database->prepare("INSERT INTO report(sub,action,location,observation,date,time)
    VALUES(:sub, :location , :action, :observation, :date, :time)");

$addData->bindParam("sub",$sub);
 $addData->bindParam("action",$action);
 $addData->bindParam("location",$location);
 $addData->bindParam("observation",$observation);
 $addData->bindParam("date",$date);
 $addData->bindParam("time",$time);
 
if($addData->execute()){
  echo '<div class="alert alert-success mt-3" role="alert">
  تم إضافة بيانات بنجاح
</div>';
 
}else{
  echo '<div class="alert alert-danger" role="alert">
  فشل إضافة بيانات
</div>';
  echo '  ';
}
}
?>

<form method="POST">
subject : <input class="form-control" type="text" name="sub" required/>
<br>
action : <input class="form-control" type="text" name="action" required/>
<br>
location : <input class="form-control" type="text" name="location" required/>
<br>
observation : <input class="form-control" type="text" name="observation" required/>
<br>
Date : <input class="form-control" type="date" name="date" required/>
<br>
Time : <input class="form-control" type="time" name="time" required/>
<br>
<button class="btn btn-danger mt-3" type="submit" name="send">ارسال - Send</button>


</form>
</main>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>