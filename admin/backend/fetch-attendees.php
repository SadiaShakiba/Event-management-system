<?php

include('../../middleware/userMiddleware.php');
include('../../config/database.php');


$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : '';

if ($event_id) {
    $query = "SELECT ea.*, e.name AS event_name 
              FROM event_attendees ea 
              JOIN events e ON ea.event_id = e.id 
              WHERE ea.event_id = :event_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['event_id' => $event_id]);
} else {
    $query = "SELECT ea.*, e.name AS event_name 
              FROM event_attendees ea 
              JOIN events e ON ea.event_id = e.id";
    $stmt = $pdo->query($query);
}

$attendees = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($attendees) > 0) {
    foreach ($attendees as $attendee) {
        echo "<tr>";
        echo "<td>{$attendee['id']}</td>";
        echo "<td>{$attendee['event_name']}</td>";
        echo "<td>{$attendee['name']}</td>";
        echo "<td>{$attendee['email']}</td>";
        echo "<td>{$attendee['phone']}</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4' class='text-center'>No attendees found</td></tr>";
}
