<?php
$servername = "localhost:8889";
$username = "root@localhost";
$password = "";
$dbname = "CubeDB";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['username']) && isset($_POST['password'])) {
  
    $username = $_POST['username'];
    $password = $_POST['password'];


    $hashedPassword = hash('sha256', $password);

    
    $stmt = $conn->prepare("INSERT INTO Utilisateur (mail, mdp) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $hashedPassword);

    if ($stmt->execute()) {
        echo "Nouvel enregistrement créé avec succès";
    } else {
        echo "Erreur: " . $stmt->error;
    }

   
    $stmt->close();
} else {
   
    echo "Erreur: Données manquantes";
}


$conn->close();

