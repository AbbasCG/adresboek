<?php 

require_once '../../config/database.php';

$bedrijf_id = (int) $_GET['bedrijf_id'];

$stmt = $pdo->prepare("SELECT * FROM contacten WHERE bedrijf_id = :bedrijf_id");
$stmt->execute([':bedrijf_id' => $bedrijf_id]);
$contacten = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacten</title>
</head>
<body>
    <h1>Contacten</h1>
    <a href="create.php?bedrijf_id=<?php echo htmlspecialchars($bedrijf_id); ?>">Nieuw Contact Toevoegen</a>

    <table border="1">
        <tr>
            <th>Voornaam</th>
            <th>Tussenvoegsel</th>
            <th>Achternaam</th>
            <th>Email</th>
            <th>Telefoon</th>
            <th>Acties</th>
        </tr>
        <?php foreach ($contacten as $contact): ?>
            <tr>
                <td><?php echo htmlspecialchars($contact['voornaam']); ?></td>
                <td><?php echo htmlspecialchars($contact['tussenvoegsel']); ?></td>
                <td><?php echo htmlspecialchars($contact['achternaam']); ?></td>
                <td><?php echo htmlspecialchars($contact['email']); ?></td>
                <td><?php echo htmlspecialchars($contact['telefoon']); ?></td>
                <td>
                    <a href="../contacten/edit.php?id=<?= $contact['id'] ?>">Bewerken</a>
                    <a href="../contacten/delete.php?id=<?= $contact['id'] ?>" onclick="return confirm('Weet je zeker dat je dit contact wilt verwijderen?')">Verwijderen</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <a href="../bedrijven/index.php">Terug naar Bedrijven</a>
</body>
</html>