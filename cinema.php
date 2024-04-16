<!DOCTYPE html>
<html lang="fr">

<head>
  <script src="script.js"></script>
  <meta charset="utf-8">
  <link rel="stylesheet" type="text/css" href="style.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
  <title>My Cinema</title>
</head>

<body>
  <header>

    <h1>My Cinema</h1>
  </header>
  <h2>Accueil</h2>
  <nav>
    <ul>
      <li><a href="page2.php">Recherche des utilisateurs</a></li>
      <li><a href="page3.php"> Historique des utilisateurs</a></li>
      <li><a href="page9.php">Ajouter une séance</a></li>
    </ul>
  </nav>
  <form>
    <div>
      <input type="text" name="movie" class="searchBar" placeholder="Nom du film ou du distributeur">
      <br>
      <input class="submit" type="submit" name="submit" value="Submit">
    </div>
  </form>
  <form>
    <div>
      <label>Date du film:</label>
      <input type="date" id="start" name="date" value="2018-07-22" min="2017-01-01" max="2024-12-31">
      <br>
      <input class="submit" type="submit" name="submit" value="Submit">
    </div>
  </form>
  <form class="line">
    <div>
      <input type="radio" name="type" value="Thriller">
      <label>Thriller</label>
    </div>

    <div>
      <input type="radio" name="type" value="Action">
      <label>Action</label>
    </div>

    <div>
      <input type="radio" name="type" value="Adventure">
      <label>Adventure</label>
    </div>
    <div>
      <input type="radio" name="type" value="Animation">
      <label>Animation</label>
    </div>

    <div>
      <input type="radio" name="type" value="Biography">
      <label>Biography</label>
    </div>

    <div>
      <input type="radio" name="type" value="Comedy">
      <label>Comedy</label>
    </div>
    <div>
      <input type="radio" name="type" value="Crime">
      <label>Crime</label>
    </div>

    <div>
      <input type="radio" name="type" value="Drama">
      <label>Drama</label>
    </div>

    <div>
      <input type="radio" name="type" value="Family">
      <label>Family</label>
    </div>
    <div>
      <input type="radio" name="type" value="Fantasy">
      <label>Fantasy</label>
    </div>

    <div>
      <input type="radio" name="type" value="Horror">
      <label>Horror</label>
    </div>

    <div>
      <input type="radio" name="type" value="Mystery">
      <label>Mystery</label>
    </div>
    <div>
      <input type="radio" name="type" value="Romance">
      <label>Romance</label>
    </div>
    <div>
      <input type="radio" name="type" value="Sci-Fi">
      <label>Sci-Fi</label>
    </div>
    <div>
      <input id=submitSelect type="submit" name="submit" value="Submit">
    </div>
  </form>

  <footer>

  </footer>
</body>

</html>
<?php
$c = [];
$e = [];
$f = [];
$dsn = 'mysql:dbname=cinema;localhost';
$user = 'bafode';
$password = '04082023';
$dbh = new PDO($dsn, $user, $password);
$a = $_REQUEST['movie'];
if (isset($a)) {
  $sth = $dbh->prepare(
    "SELECT 
    movie.id,
    movie.id_distributor,
    movie.title,
    movie.director,
    movie.duration,
    movie.release_date, movie.rating,
    movie_genre.id_genre, genre.name AS genre_name,
    distributor.name as distributor_name
    FROM movie 
    INNER JOIN movie_genre ON movie.id = movie_genre.id_movie 
    INNER JOIN genre ON id_genre = genre.id 
    INNER JOIN distributor ON movie.id_distributor = distributor.id 
    WHERE title LIKE '%$a%' 
    OR distributor.name LIKE '%$a%'"
  );
  $sth->execute();
  $result = $sth->fetchAll();
  echo "<div class=container>
  <ul>";
  foreach ($result as $filmname) {
    echo "
    <li>
    <div class=card> 
    <div class='movies'><div>Nom du film : $filmname[title]</div><div>Directeur : $filmname[director]</div><div> Durée : $filmname[duration] min</div><div>Date de création : $filmname[release_date]</div></div>" . PHP_EOL;
    echo "</div>
    </li>";
  }
  echo "
  </ul>
  </div>";
}
$b = $_REQUEST['date'];
if (isset($b)) {
  $sth2 = $dbh->prepare("SELECT * FROM movie_schedule WHERE date_begin LIKE '%$b%'");
  $sth2->execute();
  $result2 = $sth2->fetchAll();
  foreach ($result2 as $dates) {
    array_push($c, $dates['id']);
  }
  echo "<div class=container>
  <ul>";
  foreach ($c as $name) {
    $sth3 = $dbh->prepare("SELECT * FROM movie WHERE id=$name");
    $sth3->execute();
    $result3 = $sth3->fetchAll();
    foreach ($result3 as $names) {
      echo "
      <li>
      <div class=card> 
      <div class='movies'><div>$names[title]</div><div class = 'director'>Directeur : $names[director]</div><div class='duration'>$names[duration] min</div><div>Date de création : $names[release_date]</div></div>";
      echo "</div>
      </li>";
    }
  }
  echo "
  </ul>
  </div>";
}
$d = $_REQUEST['type'];
if (isset($d)) {
  $sth4 = $dbh->prepare("SELECT movie.id, movie.id_distributor, movie.title, movie.director, movie.duration, movie.release_date, movie.rating, movie_genre.id_genre, genre.name AS genre_name, distributor.name as distributor_name FROM movie INNER JOIN movie_genre ON movie.id = movie_genre.id_movie INNER JOIN genre ON id_genre = genre.id INNER JOIN distributor ON movie.id_distributor = distributor.id WHERE genre.name='$d'");
  $sth4->execute();
  $result4 = $sth4->fetchAll();
  echo "<div class=container>
  <ul>";
  foreach ($result4 as $filmdisplay) {
    echo "
    <li>
    <div class=card> 
    <div class='movies'><div>$filmdisplay[title]</div><div class = 'director'>Directeur : $filmdisplay[director]</div><div class='duration'>$filmdisplay[duration] min</div><div>Date de création : $filmdisplay[release_date]</div></div>";
    echo "</div>
    </li>";
  }
  echo "
  </ul>
  </div>";
}

?>