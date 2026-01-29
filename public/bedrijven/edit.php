<?php 

require_once '../../config/database.php';

$id = (int) $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM bedrijven WHERE id = :id");
$stmt->execute([':id' => $id]);
$bedrijf = $stmt->fetch();

if (!$bedrijf)  {
    die("Bedrijf niet gevonden.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = trim($_POST['naam']);
    $adres = trim($_POST['adres']);
    $woonplaats = trim($_POST['woonplaats']);

    if ($naam && $adres && $woonplaats) {
        $update = $pdo->prepare("UPDATE bedrijven SET naam = :naam, adres = :adres, woonplaats = :woonplaats WHERE id = :id");
        $update->execute([
            ':naam' => $naam,
            ':adres' => $adres,
            ':woonplaats' => $woonplaats,
            ':id' => $id
        ]);

        header('Location: index.php');
        exit;
    } else {
        $fout = "Alle velden zijn verplicht.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Berwerken</title>
</head>
<body>
    <h1>Bedrijf Bewerken</h1>

    <?php if ($fout): ?>
        <p style="color: red;"><?php echo htmlspecialchars($fout); ?></p>
    <?php endif; ?>

    <form method="post">
        Naam: <input type="text" name="naam" value="<?php echo htmlspecialchars($bedrijf['naam']); ?>" required><br>
        Adres: <input type="text" name="adres" value="<?php echo htmlspecialchars($bedrijf['adres']); ?>" required><br>
        Woonplaats: <input type="text" name="woonplaats" value="<?php echo htmlspecialchars($bedrijf['woonplaats']); ?>" required><br>
        <button type="submit">Opslaan</button>

</body>
</html>