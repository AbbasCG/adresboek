<?php 

require_once '../../config/database.php';

$id = (int)$_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM contacten WHERE id = :id");
$stmt->execute([':id' => $id]);
$contact = $stmt->fetch();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $voornaam = trim($_POST['voornaam']);
    $tussenvoegsel = trim($_POST['tussenvoegsel']);
    $achternaam = trim($_POST['achternaam']);
    $email = trim($_POST['email']);
    $telefoon = trim($_POST['telefoon']);

    if ($voornaam && $achternaam && $email && $telefoon) {
        $update = $pdo->prepare("UPDATE contacten SET voornaam = :voornaam, tussenvoegsel = :tussenvoegsel, achternaam = :achternaam, email = :email, telefoon = :telefoon WHERE id = :id");
        $update->execute([
            ':voornaam' => $voornaam,
            ':tussenvoegsel' => $tussenvoegsel,
            ':achternaam' => $achternaam,
            ':email' => $email,
            ':telefoon' => $telefoon,
            ':id' => $id
        ]);

        header('Location: index.php?bedrijf_id=' . $contact['bedrijf_id']);
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
    <title>Contact bewerken</title>
</head>
<body>
    <form action="" method="post">
        Voornaam: <input type="text" name="voornaam" value="<?php echo htmlspecialchars($contact['voornaam']); ?>" required><br>
        Tussenvoegsel: <input type="text" name="tussenvoegsel" value="<?php echo htmlspecialchars($contact['tussenvoegsel']); ?>"><br>
        Achternaam: <input type="text" name="achternaam" value="<?php echo htmlspecialchars($contact['achternaam']); ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo htmlspecialchars($contact['email']); ?>" required><br>
        Telefoon: <input type="text" name="telefoon" value="<?php echo htmlspecialchars($contact['telefoon']); ?>" required><br>
        <button type="submit">Opslaan</button>
    </form>
</body>
</html>