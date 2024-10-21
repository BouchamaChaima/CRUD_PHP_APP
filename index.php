<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste d'utilisateurs</title>
</head>
<body>

<?php
include 'connect.php';

echo "<h1>Les utilisateurs:</h1>";
echo "</br>";
echo "<a href='add.php'>Ajouter un utisateur</a>";
echo "</br>";
echo "</br>";

$stmt = $connect->prepare("SELECT id, name, email FROM users");
$stmt->execute();

$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($users) > 0) {
    
    echo "<table border='1'>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Email</th>
              <th>Function</th>
            </tr>";
    foreach ($users as $row) {
        echo "<tr>
                <td>" . $row["id"] . "</td>
                <td>" . $row["name"] . "</td>
                <td>" . $row["email"] . "</td>
                <td>
                    <a href='modifier.php?id=" . $row["id"] . "'>Modifier</a>
                    <a href='suprimer.php?id=" . $row["id"] . "' onclick='return confirm(\"Etes-vous sûr de vouloir supprimer cet utilisateur ?\");'>Suprimer</a>
                </td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "<strong>Pas encore des utilisateurs!</strong>";
}

$connect = null;
?>
</body>
</html>