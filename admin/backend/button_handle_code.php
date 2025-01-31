<?php
include('../../middleware/userMiddleware.php');
include('../../config/database.php');

if (isset($_POST['add_event_btn'])) {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $capacity = $_POST['capacity'];
    $created_by = $_SESSION['user']['id'];

    // Validate date (No past dates allowed)
    if (strtotime($date) < strtotime(date('Y-m-d'))) {
        $_SESSION['message'] = 'You cannot select a past date for the event.';
        header('Location: ../add-event.php');
        exit();
    }

    try {
        // Check if event name already exists
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM events WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $eventExists = $stmt->fetchColumn();

        if ($eventExists > 0) {
            $_SESSION['message'] = 'Event name already exists. Please choose a different name.';
            header('Location: ../add-event.php');
            exit();
        }

        // Validate Capacity (Must be a non-negative number)
        if (!is_numeric($capacity) || $capacity < 0) {
            $_SESSION['message'] = "Capacity must be a non-negative number.";
            header('Location: ../add-event.php');
            exit();
        }

        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            $imageName = time() . '_' . $_FILES['image']['name'];
            $uploadPath = '../../uploads/events/' . $imageName;

            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            if (!in_array($_FILES['image']['type'], $allowedTypes)) {
                $_SESSION['message'] = "Invalid image format. Allowed: JPG, PNG, GIF.";
                header('Location: ../add-event.php');
                exit();
            }
        } else {
            $imageName = null;
        }

        // Insert new event
        $stmt = $pdo->prepare("INSERT INTO events (name, description, date, time, capacity, created_by, image) 
                                VALUES (:name, :description, :date, :time, :capacity, :created_by, :image)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':created_by', $created_by);
        $stmt->bindParam(':image', $imageName);

        if ($stmt->execute()) {
            if ($imageName !== null) {
                move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);
            }

            $_SESSION['message'] = 'Event added successfully';
        } else {
            $_SESSION['message'] = 'Failed to add event';
        }

        header('Location: ../add-event.php');
        exit();
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else if (isset($_POST['edit_event_btn'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $capacity = $_POST['capacity'];

    // Validate date (No past dates allowed)
    if (strtotime($date) < strtotime(date('Y-m-d'))) {
        $_SESSION['message'] = 'You cannot select a past date for the event.';
        header('Location: ../edit-event.php?id=' . $id);
        exit();
    }

    // Validate Capacity (Must be a non-negative number)
    if (!is_numeric($capacity) || $capacity < 0) {
        $_SESSION['message'] = "Capacity must be a non-negative number.";
        header('Location: ../edit-event.php?id=' . $id);
        exit();
    }

    try {
        // Check if event name already exists and isn't the current event
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM events WHERE name = :name AND id != :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $eventExists = $stmt->fetchColumn();

        if ($eventExists > 0) {
            $_SESSION['message'] = 'Event name already exists. Please choose a different name.';
            header('Location: ../edit-event.php?id=' . $id);
            exit();
        }

        // Handle image upload logic
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            $imageName = time() . '_' . $_FILES['image']['name'];
            $uploadPath = '../../uploads/events/' . $imageName;
            move_uploaded_file($_FILES['image']['tmp_name'], $uploadPath);

            // Delete the old image if it exists
            $stmt = $pdo->prepare("SELECT image FROM events WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $event = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($event && !empty($event['image']) && file_exists('../../uploads/events/' . $event['image'])) {
                unlink('../../uploads/events/' . $event['image']);
            }
        } else {
            // Keep the existing image if no new image is uploaded
            $stmt = $pdo->prepare("SELECT image FROM events WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $event = $stmt->fetch(PDO::FETCH_ASSOC);
            $imageName = $event['image'];
        }

        // Update the event record
        $stmt = $pdo->prepare("UPDATE events SET name = :name, description = :description, date = :date, time = :time, capacity = :capacity, image = :image WHERE id = :id");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':capacity', $capacity);
        $stmt->bindParam(':image', $imageName);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'Event updated successfully';
            header('Location: ../edit-event.php?id=' . $id);
        } else {
            $_SESSION['message'] = 'Failed to update event';
            header('Location: ../edit-event.php?id=' . $id);
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else if (isset($_POST['delete_event_btn'])) {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("SELECT image FROM events WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        // Delete the image file if it exists
        if ($event && !empty($event['image']) && file_exists('../../uploads/events/' . $event['image'])) {
            unlink('../../uploads/events/' . $event['image']);
        }

        $stmt = $pdo->prepare("DELETE FROM events WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'Event deleted successfully';
            header('Location: ../event.php');
        } else {
            $_SESSION['message'] = 'Failed to delete event';
            header('Location: ../event.php');
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
} else if (isset($_POST['register_event_btn'])) {
    $event_id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // Validate Email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Please enter a valid email address.';
        header("Location: ../attendee-register.php?event_id=" . urlencode($event_id));
        exit();
    }

    // Validate Phone number format (BD format, 11 digits, starts with 01)
    if (!preg_match("/^01[0-9]{9}$/", $phone)) {
        $_SESSION['message'] = 'Please enter a valid phone number (BD format, 11 digits, starting with 01).';
        header("Location: ../attendee-register.php?event_id=" . urlencode($event_id));
        exit();
    }

    try {
        // Check if the email already exists for the same event
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM event_attendees WHERE event_id = :event_id AND email = :email");
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $emailExists = $stmt->fetchColumn();

        // Check if the phone number already exists for the same event
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM event_attendees WHERE event_id = :event_id AND phone = :phone");
        $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
        $stmt->bindParam(':phone', $phone);
        $stmt->execute();
        $phoneExists = $stmt->fetchColumn();

        if ($emailExists > 0) {
            $_SESSION['message'] = 'This email is already registered for this event.';
            header("Location: ../attendee-register.php?event_id=" . urlencode($event_id));
            exit();
        }

        if ($phoneExists > 0) {
            $_SESSION['message'] = 'This phone number is already registered for this event.';
            header("Location: ../attendee-register.php?event_id=" . urlencode($event_id));
            exit();
        }

        // Check event capacity
        $stmt = $pdo->prepare("SELECT name, capacity, registered FROM events WHERE id = :id");
        $stmt->bindParam(':id', $event_id, PDO::PARAM_INT);
        $stmt->execute();
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($event) {
            $event_name = $event['name'];
            $capacity = $event['capacity'];
            $registered = $event['registered'];

            if ($registered < $capacity) {
                // Register the attendee
                $stmt = $pdo->prepare("INSERT INTO event_attendees (event_id, name, email, phone) VALUES (:event_id, :name, :email, :phone)");
                $stmt->bindParam(':event_id', $event_id);
                $stmt->bindParam(':name', $name);
                $stmt->bindParam(':email', $email);
                $stmt->bindParam(':phone', $phone);

                if ($stmt->execute()) {
                    // Update registered count
                    $stmt = $pdo->prepare("UPDATE events SET registered = registered + 1 WHERE id = :id");
                    $stmt->bindParam(':id', $event_id);
                    $stmt->execute();

                    $_SESSION['message'] = 'You have successfully registered for the event.';
                    header('Location: ../event-registration.php');
                    exit();
                } else {
                    $_SESSION['message'] = 'Failed to register. Please try again later.';
                    header("Location: ../attendee-register.php?event_id=" . urlencode($event_id));
                    exit();
                }
            } else {
                $_SESSION['message'] = 'Sorry, this event is already full.';
                header('Location: ../event-registration.php');
                exit();
            }
        } else {
            $_SESSION['message'] = 'Invalid event ID.';
            header('Location: ../event-registration.php');
            exit();
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = 'An error occurred: ' . $e->getMessage();
        header('Location: ../event-registration.php');
        exit();
    }
} else if (isset($_POST['update_role_btn'])) {
    $userId = $_POST['id'];
    $roleAs = $_POST['role_as'];

    $stmt = $pdo->prepare('UPDATE users SET role_as = :role_as WHERE id = :id');
    $stmt->execute(['role_as' => $roleAs, 'id' => $userId]);

    header('Location: ../user.php');
    exit();
} else if (isset($_POST['delete_user_btn'])) {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $_SESSION['message'] = 'User deleted successfully';
            header('Location: ../user.php');
        } else {
            $_SESSION['message'] = 'Failed to delete user';
            header('Location: ../user.php');
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
