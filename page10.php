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
<body><a href="page9.php">Retourner à la page d'ajout des films</a></body>
</html>
<?php
$dsn = 'mysql:dbname=cinema;localhost';
$user = 'bafode';
$password = '04082023';
$dbh = new PDO($dsn, $user, $password);
$filmName=$_GET['title'];
$id=$_GET['id'];
$sth= $dbh->prepare("INSERT INTO movie_schedule (id_movie,id_room,date_begin) VALUES('$id','5',NOW());");
$sth->execute();
$sth=$sth->fetchAll();

$sth2=$dbh->prepare("SELECT * FROM movie_schedule WHERE date_begin LIKE '2024%'");
$sth2->execute();
$result=$sth2->fetchAll();
echo "<div>Film ajouté avec succès";





?>