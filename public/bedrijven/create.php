<?php

require_once '../../config/database.php';

$fout = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $naam = trim($_POST['naam']);
    $adres = trim($_POST['adres']);
    $woonplaats = trim($_POST['woonplaats']);

    if ($naam && $adres && $woonplaats) {
        $stmt = $pdo->prepare("INSERT INTO bedrijven (naam, adres, woonplaats) VALUES (:naam, :adres, :woonplaats)");
        $stmt->execute([
            ':naam' => $naam,
            ':adres' => $adres,
            ':woonplaats' => $woonplaats
        ]);

        header('Location: index.php');
        exit;
    } else {
        $fout = "Alle velden zijn verplicht.";
    }
}

?>

<!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Nieuw bedrijf</h1>
    <?php if ($fout): ?>
        <p style="color: red;"><?php echo htmlspecialchars($fout); ?></p>
    <?php endif; ?>

    <form method="post">
        Naam: <input type="text" name="naam" required><br>
        Adres: <input type="text" name="adres" required><br>
        Woonplaats: <input type="text" name="woonplaats" required><br>
        <button type="submit">Opslaan</button>
    </form>
</body>

</html>