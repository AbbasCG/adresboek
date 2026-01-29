<?php 

require_once '../../config/database.php';

if (!isset($_GET['bedrijf_id'])) {
    die("geen bedrijf_id opgegeven.");
}

$bedrijf_id = (int) $_GET['bedrijf_id'];

$fout = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voornaam = trim($_POST['voornaam']);
    $tussenvoegsel = trim($_POST['tussenvoegsel']);
    $achternaam = trim($_POST['achternaam']);
    $email = trim($_POST['email']);
    $telefoon = trim($_POST['telefoon']);

    if ($voornaam && $achternaam && $email && $telefoon) {
        $stmt = $pdo->prepare("INSERT INTO contacten (bedrijf_id, voornaam, tussenvoegsel, achternaam, email, telefoon)
        VALUES (:bedrijf_id, :voornaam, :tussenvoegsel, :achternaam, :email, :telefoon)");

        $stmt->execute([
            ':bedrijf_id' => $bedrijf_id,
            ':voornaam' => $voornaam,
            ':tussenvoegsel' => $tussenvoegsel,
            ':achternaam' => $achternaam,
            ':email' => $email,
            ':telefoon' => $telefoon
        ]);

        header('Location: index.php?bedrijf_id=' . $bedrijf_id);
        exit;
    } else {
        $fout = "Voornaam, achternaam, email en telefoon zijn verplicht.";
    }
}

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacten Aanmaken</title>
</head>
<body>
    <h1>Contacten Aanmaken</h1>

    <?php if ($fout): ?>
        <p style="color: red;"><?php echo htmlspecialchars($fout); ?></p>
    <?php endif; ?>

    <form method="post">
        Voornaam: <input type="text" name="voornaam" required><br>
        Tussenvoegsel: <input type="text" name="tussenvoegsel"><br>
        Achternaam: <input type="text" name="achternaam" required><br>
        Email: <input type="email" name="email" required><br>
        Telefoon: <input type="text" name="telefoon" required><br>
        <button type="submit">Opslaan</button>
    </form>
</body>
</html>