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
            <li><a href="page3.php"> Historique des utilisateurs</a></li>
            <li><a href="page9.php">Ajouter une séance</a></li>
        </ul>
    </nav>
    <h1>Recherche des utilisateurs</h1>
    <form>
        <div>
            <input type="text" name="users" class="searchBar" placeholder="Nom ou prénom de l'utilisateur">
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
$user = $_REQUEST['users'];
if (isset($user)) {
    $sth5 = $dbh->prepare("SELECT user.*, 
    membership.date_begin, 
    subscription.name 
    FROM user 
    LEFT OUTER JOIN membership ON membership.id_user = user.id 
    LEFT OUTER JOIN subscription ON membership.id_subscription = subscription.id 
    WHERE user.firstname LIKE '%$user%' 
    OR user.lastname LIKE '%$user%'
    ");
    $sth5->execute();
    $result5 = $sth5->fetchAll();
    echo "<div class=container>
    <ul>";
    foreach ($result5 as $users) {
        echo
        "
        <li>
        <div class=card> 
            <div>Mail : $users[email]</div>
            <div>Firstname : $users[firstname]</div>
            <div>Lastname : $users[lastname]</div>
            <div>Birthdate : $users[birthdate]</div>
            <div>Adress : $users[address]</div>
            <div>Zipcode : $users[zipcode]</div>
            <div>City : $users[city]</div>
            <div>Country : $users[country]</div>
            <div>Membership : $users[name]</div>


            <div class='buttons'>
                <a href='page5.php?id=$users[id]&mail=$users[email]&Firstname=$users[firstname]&Lastname=$users[lastname]&Birthdate=$users[birthdate]&Adress=$users[address]&Zipcode=$users[zipcode]&City=$users[city]&Country=$users[country]&Membership=$add'>Add</a>
                <a href='page6.php?id=$users[id]&mail=$users[email]&Firstname=$users[firstname]&Lastname=$users[lastname]&Birthdate=$users[birthdate]&Adress=$users[address]&Zipcode=$users[zipcode]&City=$users[city]&Country=$users[country]&Membership=$delete'>Delete</a>
                <a href='page7.php?id=$users[id]&mail=$users[email]&Firstname=$users[firstname]&Lastname=$users[lastname]&Birthdate=$users[birthdate]&Adress=$users[address]&Zipcode=$users[zipcode]&City=$users[city]&Country=$users[country]&Membership=$update'>Update</a>
            </div>";
        echo "
            </form>
        </div>
        </li>
        ";
    }
    echo "
    </ul>
    </div>";
}
?>




