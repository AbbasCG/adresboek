<?php 

require_once '../../config/database.php';

if (!isset($_GET['id'])) {
    die("Geen bedrijf-ID opgegeven.");
}

$id = (int) $_GET['id'];

if ($id <= 0) {
    die("Ongeldig bedrijf-ID.");
}

$stmt = $pdo->prepare("DELETE FROM bedrijven WHERE id = :id");
$stmt->execute([':id' => $id]);

header('Location: index.php');
exit;