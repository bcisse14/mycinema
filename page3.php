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
            <li><a href="page9.php">Ajouter une séance</a></li>
        </ul>
    </nav>
    <h1>Historique des utilisateurs</h1>

    <form method="post">
        <div>
            <input type="text" name="hist" class="searchBar" placeholder="Nom ou prénom de l'utilisateur">
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
$hist = $_POST['hist'];
if (isset($hist)) {
    $sth6 = $dbh->prepare("SELECT title, movie_schedule.*, membership.id_user, user.firstname, user.lastname, membership_log.id_membership FROM movie_schedule INNER JOIN movie ON movie_schedule.id_movie=movie.id INNER JOIN membership_log ON movie_schedule.id=membership_log.id_session INNER JOIN membership ON membership_log.id_membership=membership.id INNER JOIN user ON user.id=membership.id_user WHERE firstname LIKE '%$hist%' OR lastname LIKE '%$hist%';
        ");
    $sth6->execute();
    $result6 = $sth6->fetchAll();
    echo "<div class=container>
        <ul>";
    foreach ($result6 as $historique) {
        echo
        "
            <li>
            <div class=card> 
            <div class='hist'>
            <div> Firstname : $historique[firstname]</div>
            <div> Lastname : $historique[lastname]</div>
            <div> Movie seen : $historique[title]</div>
            <div> Seen on : $historique[date_begin]</div>
            <div> ID : $historique[id_user]</div>

            <form method='post'>
            <div class='buttons'>
            <a href='page4.php?Firstname=$historique[firstname]&Lastname=$historique[lastname]&id_user=$historique[id_user]&id_membership=$historique[id_membership]'>Ajouter une nouvelle entrée</a>
            </div>
            </form>
            </div>";
        echo "</div>
            </li>";
    }
    echo "
        </ul>
        </div>";
}
?>