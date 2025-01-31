<?php

include(__DIR__ . '/../config/database.php');

function getAll($table)
{
    global $pdo;
    try {
        $query = "SELECT * FROM $table";
        $stmt = $pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function getById($table, $id)
{
    global $pdo;
    try {
        $query = "SELECT * FROM $table WHERE id = :id LIMIT 1";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}

function getFilteredEvents($pdo, $date = '', $time = '')
{
    $query = "SELECT * FROM events WHERE 1";

    if ($date != '') {
        $query .= " AND date = :date";
    }

    if ($time != '') {
        $query .= " AND time = :time";
    }

    $stmt = $pdo->prepare($query);

    if ($date != '') {
        $stmt->bindParam(':date', $date);
    }

    if ($time != '') {
        $stmt->bindParam(':time', $time);
    }

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
