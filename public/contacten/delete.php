<?php

require_once '../../config/database.php';

if (!isset($_GET['id']) || !isset($_GET['bedrijf_id'])) {
    die("Geen contact-ID of bedrijf-ID opgegeven.");
}

$id = (int) $_GET['id'];
$bedrijf_id = (int) $_GET['bedrijf_id'];

if ($id <= 0 || $bedrijf_id <= 0) {
    die("Ongeldig contact-ID of bedrijf-ID.");
}

$stmt = $pdo->prepare("DELETE FROM contacten WHERE id = :id");
$stmt->execute([':id' => $id]);

header('Location: index.php?bedrijf_id=' . $bedrijf_id);
exit;  