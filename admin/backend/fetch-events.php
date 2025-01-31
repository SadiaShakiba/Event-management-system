<?php

include('../../middleware/userMiddleware.php');
include('../../config/database.php');

$query = "SELECT * FROM events";
$stmt = $pdo->query($query);
$events = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($events) > 0) {
    foreach ($events as $event) {
        echo "<tr>";
        echo "<td>{$event['id']}</td>";
        echo "<td style='max-width: 100px; 
                         overflow: hidden; 
                         text-overflow: ellipsis; 
                         word-wrap: break-word; 
                         white-space: normal;'>{$event['name']}</td>";
        echo "<td><img src='../uploads/events/{$event['image']}' alt='Event Image' width='100'></td>";
        echo "<td style='max-width: 200px; 
                         overflow: hidden; 
                         text-overflow: ellipsis; 
                         word-wrap: break-word; 
                         white-space: normal;'>{$event['description']}</td>";
        echo "<td>{$event['date']}</td>";
        echo "<td>{$event['time']}</td>";
        echo "<td>{$event['capacity']}</td>";
        echo "<td>
                <a href='./edit-event.php?id={$event['id']}' class='btn btn-warning btn-sm'>Edit</a>
                <form action='backend/button_handle_code.php' method='POST' onsubmit='return confirm(\"Are you sure you want to delete this event?\");' style='display:inline-block;'>
                    <input type='hidden' name='id' value='{$event['id']}'>
                    <button type='submit' class='btn btn-danger btn-sm ml-2' name='delete_event_btn'>Delete</button>
                </form>
              </td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='7' class='text-center'>No events found</td></tr>";
}
