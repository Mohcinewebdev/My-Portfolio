<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'portfolio_contact';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection Failed : " . $e->getMessage());
}

// Requête pour récupérer tous les participants
$sql = "SELECT * FROM clients ORDER BY id DESC";
$stmt = $pdo->query($sql);
$clients = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>List of Clients</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 30px auto;
        }
        th, td {
            padding: 10px;
            border: 1px solid #666;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        h2 {
            text-align: center;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <h2>Liste of Clients</h2>

    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Message</th>
        </tr>
        <?php foreach ($clients as $client): ?>
        <tr>
            <td><?= htmlspecialchars($client['id']) ?></td>
            <td><?= htmlspecialchars($client['full_name']) ?></td>
            <td><?= htmlspecialchars($client['email']) ?></td>
            <td><?= htmlspecialchars($client['phone']) ?></td>
            <td><?= htmlspecialchars($client['message']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>