<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur</title>
    <style>
        .error {color: #f00;}
    </style>
</head>
<body>
    <p><span class="error">* champ obligatoire</span></p>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    Name: <input type="text" name="name" id="name" /><span class="error">*</span>    
    <br><br>

    Email: <input type="email" name="email" id="email" /><span class="error">*</span>
    <br><br>

    <input type="submit" value="Ajouter">

    </form>
    <br><br>

    <?php

        include "connect.php";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (!empty($_POST["name"]) && !empty($_POST["email"])) {
                $name = $_POST["name"];
                $email = $_POST["email"];

                $stmt = $connect->prepare("INSERT INTO users (name, email) VALUES (:name, :email)");

                $stmt->bindParam(":name", $name);
                $stmt->bindParam(":email", $email);

                if ($stmt->execute()) {
                    header("Location: index.php");
                } else {
                    echo "Erreur lors de l'ajout d'un utilisateur.";
                }
            } else {
                echo "<span class='error'>Name and email sont des champs obligatoires.</span>";
            }
        }
        
        $connect = null;
    ?>
</body>
</html>