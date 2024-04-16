<!DOCTYPE html>
<html lang="fr">

<head>
  <script src="script.js"></script>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="style.css" >
  <title>My Cinema</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
</head>
</html>
<?php
$dsn = 'mysql:dbname=cinema;localhost';
$user = 'bafode';
$password = '04082023';
$dbh = new PDO($dsn, $user, $password);
$firstname=$_GET['Firstname'];
$lastname=$_GET['Lastname'];
$id=$_GET['id'];
$Birthdate=$_GET['Birthdate'];
$Adress=$_GET['Adress'];
$Zipcode=$_GET['Zipcode'];
$City=$_GET['City'];
$Country=$_GET['Country'];

 echo
 "
<div>Firstname : $firstname</div>
<div>Lastname : $lastname</div>
<div>ID : $id</div>
<div>Birthdate : $Birthdate</div>
<div>Adress : $Adress</div>
<div>Zipcode : $Zipcode</div>
<div>Country : $Country</div>
 <input class='submit' type='submit' name='submit' value='Delete' />
 <div><a href='page2.php?users=$firstname&submit=Submit'>Cliquez pour retourner à la page de recherche </a></div>
 ";
$new_Membership=$_POST['membership'];
$membership = $dbh->prepare("SELECT * FROM membership WHERE id_user = '$id'");
$membership->execute();
$membership = $membership->fetchAll();
$membership = $membership[0];
$sth_remove1= $dbh->prepare("DELETE FROM membership_log WHERE id_membership = '$membership[id]'; DELETE FROM membership WHERE id_user = '$id'");
$sth_remove1->execute();

?>