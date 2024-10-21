<?php
    include "connect.php";

    if (isset($_GET["id"])) {
        $id = $_GET["id"];

        $stmt = $connect->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(":id", $id);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit;
        }
        else {
            echo "Erreur lors de la suppression de l'utilisateur.";
        }
    }
    else {
        echo "Aucun ID d'utilisateur fourni!";
        exit;
    }

    $connect = null;
?>