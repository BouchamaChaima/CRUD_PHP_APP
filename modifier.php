<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier</title>
    <style>
        .error {color: #f00;}
    </style>
</head>
<body>
    
    <?php
        include "connect.php";

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $stmt = $connect->prepare("SELECT * FROM users WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                echo "Utilisateur non trouvé!";
                exit;
            }
        } else {
            echo "Aucun ID d'utilisateur fourni!";
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            $name = $_POST["name"];
            $email = $_POST["email"];

            $stmt = $connect->prepare("UPDATE users SET name = :name, email = :email WHERE id = :id");

            $stmt->bindParam(":name", $name);
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                echo "Mise à jour de l'utilisateur réussie!";
                header("Location: index.php");
            } else {
                echo "Erreur lors de la mise à jour de l'utilisateur.";
            }
        } else {
            echo "<span class='error'>Name and email sont des champs obligatoires.</span>";
        }
        
        $connect = null;
    ?>
    <p><span class="error">* champ obligatoire</span></p>
    <form action="modifier.php?id=<?php echo $id; ?>" method="post">

        Name: <input type="text" name="name" id="name" value="<?php echo htmlspecialchars($user['name']); ?>" /><span class="error">*</span>    
        <br><br>

        Email: <input type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" /><span class="error">*</span>
        <br><br>

        <input type="submit" value="Modifier">
    </form>
    <br><br>

</body>
</html>