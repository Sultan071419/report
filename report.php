
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<?php

$username = "root";
$password = "";
$database = new PDO("mysql:host=localhost; dbname=safety;",$username,$password);

$sql =$database->prepare("SELECT * FROM report "); 
$sql->execute();

foreach($sql AS $result){
  $getFile = "data:" . $result['fileType'] . ";base64,".base64_encode($result['file']);
  $getFile1 = "data:" . $result['fileType1'] . ";base64,".base64_encode($result['file1']);

  echo '<div class="container">
  <div class="row">
    <div class="col">
	<img src="http://www.olivearabia.com/wp-content/uploads/2017/10/OliveArabia.png" class="img-thumbnail rounded"high="300px" width="300px"alt="...">
    </div>
    <div class="col">
	<p align="center">Health, Safety & Environmental Division
       Observation Management system
        Operations Observation Report</p>
    </div>
    <div class="col">
	<img src="https://pbs.twimg.com/media/FEtChtAXMAIN7mo?format=jpg&name=900x900" class="img-thumbnail  rounded"high="300px" width="300px"alt="...">
    </div>
  </div>
  <div class="container">
  <table class="table table-bordered">
  <tbody>
    <tr>
      <td>Date of inspection</td>
      <td>' .$result["date"] . '</td>
	  <td>Inspected by</td>
      <td>HSE</td>
    </tr>
    <tr>
      <td>Time of inspection</td>
	  <td>' .$result["time"] . '</td>
      <td>Action by</td>
      <td>' .$result["action"] . '</td>
    </tr>
    <tr>
      <td colspan="2">Subject:' .$result["sub"] . '</td>
      <td>Location</td>
	  <td>' .$result["location"] . '</td>
      <tr>
      <td colspan="2">Photo</td>
	  <td colspan="2">Observation </td>
      
    </tr>
    
    <tr>
      <td colspan="2"><img src="' .$getFile . '" width="300px" /></td>
	  <td colspan="2">' .$result["observation"] . '</td>
      
    </tr>
    <tr>
      <td colspan="2"><img src="' .$getFile1 . '" width="300px" /></td>
	  <td colspan="2">' .$result["observation"] . '</td>
      
    </tr>
  </tbody>
</table>
</div>
';
// echo "<h1>" . $result['Title'] . "</h1>";
// echo "<p>" . $result['Text'] . "</p>";
}

  ?>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>