<?php session_start();?>
<?php include'includes/db.php';?>
<?php

$firstName = $_POST['firstname'];
// $secondName = $_POST['lastname'];
$secondName = 'Amos';

$insert = "INSERT INTO account
      (firstname, lastname)
      VALUES(?, ?)";
$stmt = $pdo->prepare($insert);
if ($stmt->execute([$firstName, $secondName])) {

  // $_SESSION['firstname'] = $firstName;
  echo "<span>$firstName was saved.... Still under progress.</span>";
  

}else{
  echo "<div class='alert alert-danger'>Unable to insert Data</div>";
}


?>