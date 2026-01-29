<?php

require_once '../../config/database.php';

$stmt = $pdo->query("SELECT * FROM bedrijven");
$bedrijven = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bedrijven</title>
</head>
<body>

    <h1>Bedrijven</h1>

    <a href="create.php">Nieuw Bedrijf Toevoegen</a>

    <table border="1">
        <tr>
            <th>Naam</th>
            <th>Adres</th>
            <th>Woonplaats</th>
            <th>Acties</th>
        </tr>

        <?php foreach ($bedrijven as $bedrijf): ?>
            <tr>
                <td><?php echo htmlspecialchars($bedrijf['naam']); ?></td>
                <td><?php echo htmlspecialchars($bedrijf['adres']); ?></td>
                <td><?php echo htmlspecialchars($bedrijf['woonplaats']); ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $bedrijf['id']; ?>">Bewerken</a>
                    |
                    <a href="delete.php?id=<?php echo $bedrijf['id']; ?>"
                       onclick="return confirm('Weet je zeker dat je dit bedrijf wilt verwijderen?')">
                        Verwijderen
                    </a>
                    |
                    <a href="../contacten/index.php?bedrijf_id=<?php echo $bedrijf['id']; ?>">
                        Contacten
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

</body>
</html>
