<?php
include('../../middleware/userMiddleware.php');
include('../../config/database.php');

$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : null;

// Set headers to force the download of a CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename=attendees_list.csv');

// Open the output stream for CSV
$output = fopen('php://output', 'w');

// Add CSV column headers
fputcsv($output, ['ID', 'Name', 'Email', 'Phone', 'Event Name']);

$sql = "SELECT event_attendees.*, events.name as event_name 
        FROM event_attendees 
        LEFT JOIN events ON event_attendees.event_id = events.id";

if ($event_id) {
    $sql .= " WHERE event_attendees.event_id = :event_id";
}

$stmt = $pdo->prepare($sql);

if ($event_id) {
    $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
}

$stmt->execute();

if ($stmt->rowCount() > 0) {
    while ($attendee = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $phone = "'" . preg_replace('/\D/', '', $attendee['phone']) . "'"; // Remove non-digits but preserve leading zero

        fputcsv($output, [
            $attendee['id'],
            $attendee['name'],
            $attendee['email'],
            $phone,
            $attendee['event_name'] ? $attendee['event_name'] : 'N/A'
        ]);
    }
} else {
    fputcsv($output, ['No attendees found']);
}


fclose($output);

exit();
