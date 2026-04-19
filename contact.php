<?php
// Connexion à la base de données (à adapter selon ton environnement)
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

// 1. Récupérer les données du formulaire
$full_name = $_POST['full_name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$message = $_POST['message'] ?? '';

// 2. Valider les champs obligatoires
if (empty($full_name) || empty($email) || empty($phone) || empty($message)) {
    die("⚠️ You have to fill all the fields.");
}

// 3. Valider l’email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("⚠️ Email Address invalid.");
}

// 4. Valider le numéro de téléphone
if (!preg_match('/^\+213[0-9]{9}$/', $phone)) {
    die("⚠️ Phone Number invalid. Format attendu : +213XXXXXXXXX");
}

// 5. Vérifier l’unicité de l’email
$verif = $pdo->prepare("SELECT id FROM clients WHERE email = ?");
$verif->execute([$email]);
if ($verif->fetch()) {
    die("⚠️ Cet email est déjà inscrit !");
}

// 6. Insérer les données avec une requête préparée (sécurité anti injection SQL)
$insert = $pdo->prepare("INSERT INTO clients (full_name, email, phone, message) VALUES (?, ?, ?, ?)");
try {
    $insert->execute([$full_name, $email, $phone, $message]);
    echo "✅ Message sent successfully. Thank you $full_name !";
} catch (PDOException $e) {
    die("❌ Error : " . $e->getMessage());
}
?>

