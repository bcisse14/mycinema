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
<body>

</html>
<?php
$dsn = 'mysql:dbname=cinema;localhost';
$user = 'bafode';
$password = '04082023';
$dbh = new PDO($dsn, $user, $password);
$filmName=$_GET['title'];
$id_member=$_GET['id_membership'];
$date=$_GET['date'];
$id_session=$_GET['id_session'];
$sth=$dbh->prepare("INSERT INTO membership_log (id_membership,id_session) VALUES ($id_member,$id_session)");
$sth->execute();
echo "<div><a href='page3.php'>Seance ajoutée avec succès, cliquez pour retourner à la page de recherche d'historique</a></div>";
?>

</body>

