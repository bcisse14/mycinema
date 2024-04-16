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

 <form method='post'>
 <select name='membership'>
 <option value=''></option>
 <option value='1'>VIP</option>
 <option value='2'>GOLD</option>
 <option value='3'>Classic</option>
 <option value='4'>Pass Day</option>
 </select>
 <input class='submit' type='submit' name='submit' value='Submit' />
 <div><a href='page2.php?users=$firstname&submit=Submit'>Cliquez pour retourner à la page de recherche </a></div>
 ";
 $update = $_POST["membership"];
$sth_update = $dbh->prepare(
 "UPDATE membership
 SET id_subscription = $update
 WHERE id_user= $id;");
$sth_update->execute();
     echo "
      </form>
      </div>";

?>