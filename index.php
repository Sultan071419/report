<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<?php
$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=safety;",$username,$password);

$removeItem = $database->prepare("DELETE FROM report WHERE id = 2");
$removeItem->execute();

$getItems = $database->prepare("SELECT * FROM report ORDER BY id DESC LIMIT 2 ");
$getItems->execute();

foreach($getItems AS $data){
  echo '<div  class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-header">observation - ' . $data['id']. '</div>
  <div class="card-body">
    <h5 class="card-title">' . $data['location'] . '</h5>
    <p class="card-text">' .$data['sub']. ' </p>
    <form method="POST"> <button class="btn btn-danger" type="submit" name="remove" value="'.$data['id'] .' ">X - delet </button></from/>
    
 
    <a href="edit.php?edit='. $data['id'].'" class="btn btn-light" type="submit" name="edit" >PDF</a> 
    <a href="REPORT2.php?" class="btn btn-light" type="submit" >report</a> 

    
  </div>
</div>';


}
?>


