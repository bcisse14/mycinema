<!DOCTYPE html>
<html lang="fr">

<head>
  <script src="script.js"></script>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>My Cinema</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
</head>

<body>
  <nav>
    <ul>
      <li><a href="cinema.php"> Accueil</a></li>
      <li><a href="page2.php">Recherche des utilisateurs</a></li>
      <li><a href="page3.php"> Historique des utilisateurs</a></li>
    </ul>
  </nav>
  <h1>Ajouter une séance</h1>

  <form method="post">
    <div>
      <input type="text" name="entry" class="searchBar" placeholder="Nom du film à ajouter">
      <br>
      <input class="submit" type="submit" name="submit" value="Submit">
    </div>
  </form>







</body>

</html>
<?php
$dsn = 'mysql:dbname=cinema;localhost';
$user = 'bafode';
$password = '04082023';
$dbh = new PDO($dsn, $user, $password);
$a = $_REQUEST['entry'];
if (isset($a)) {
  $sth = $dbh->prepare(
    "SELECT 
    movie.*,
    movie_schedule.id AS id_session,
    movie_schedule.id_movie,
    movie_schedule.id_room,
    movie_schedule.date_begin
    FROM movie
    INNER JOIN movie_schedule 
    ON movie.id=movie_schedule.id_movie
    WHERE movie.title LIKE '%$a%'
    "
  );
  $sth->execute();
  $result = $sth->fetchAll();
  echo "<div class=container>
  <ul>";
  foreach ($result as $filmname) {
    echo
    "
    <li>
    <div class=card> 
    <div class='movies'><div>Nom du film : $filmname[title]
    <div>Date de la seance : $filmname[date_begin]</div>
    </div>

    <a href='page10.php?title=$filmname[title]&id=$filmname[id]&date=$filmname[date_begin]'>Ajouter une séance pour ce film</a>
    </div>
    ";
    echo"</div>
    </li>";
  }
  echo "
  </ul>
  </div>";
}



?>