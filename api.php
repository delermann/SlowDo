<?php
header('Content-Type: application/json');

// Configuration locale
$db_name = "slowdo_db";
$collection = "tasks";

try {
    $manager = new MongoDB\Driver\Manager("mongodb://localhost:27017");
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => 'MongoDB non lancé']);
    exit;
}

// Récupération des données JSON envoyées par le JS
$input = json_decode(file_get_contents('php://input'), true);
$action = $_GET['action'] ?? '';

// --- ACTION : AJOUTER ---
if ($action === 'add') {
    $bulk = new MongoDB\Driver\BulkWrite;
    $task = [
        '_id' => new MongoDB\BSON\ObjectId,
        'title' => $input['title'],
        'emoji' => $input['emoji'] ?? '🌿', // Valeur par défaut
        'color' => $input['color'] ?? '#10b981', // Émeraude par défaut
        'status' => 'pending',
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ];
    $bulk->insert($task);
    $manager->executeBulkWrite("$db_name.$collection", $bulk);
    
    echo json_encode(['status' => 'success', 'task' => $task]);
}

// --- ACTION : SUPPRIMER ---
if ($action === 'delete') {
    $bulk = new MongoDB\Driver\BulkWrite;
    $bulk->delete(['_id' => new MongoDB\BSON\ObjectId($input['id'])]);
    $manager->executeBulkWrite("$db_name.$collection", $bulk);
    
    echo json_encode(['status' => 'success']);
}
?>