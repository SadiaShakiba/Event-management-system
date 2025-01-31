<?php
include('../../config/database.php');

header('Content-Type: application/json');

$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;

if ($event_id) {
    try {
        $stmt = $pdo->prepare("SELECT id, name, image, description, date, time, capacity, registered FROM events WHERE id = :event_id");
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->execute();

        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($event) {
            echo json_encode([
                'status' => 'success',
                'data' => $event
            ]);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Event not found'
            ]);
        }
    } catch (PDOException $e) {
        echo json_encode([
            'status' => 'error',
            'message' => 'Database error: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Event ID is required'
    ]);
}
