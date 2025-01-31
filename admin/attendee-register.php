<?php

include('../middleware/userMiddleware.php');
include('includes/header.php');

$event_id = $_GET['id'] ?? $_SESSION['event_id'] ?? null;

if ($event_id) {
    $_SESSION['event_id'] = $event_id;

    $stmt = $pdo->prepare("SELECT name FROM events WHERE id = :id");
    $stmt->bindParam(':id', $event_id, PDO::PARAM_INT);
    $stmt->execute();
    $event = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($event) {
        $event_name = $event['name'];
    } else {
        $_SESSION['message'] = "Event not found";
    }
} else {
    $_SESSION['message'] = "Invalid Event ID";
}

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header events-header">
                    <h4>Register for <?= htmlspecialchars($event_name) ?></h4>
                    <div>
                        <div class="button-container">
                            <a href="event-registration.php">
                                <button class="btn btn-success">All Events</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="backend/button_handle_code.php" method="POST">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($event_id) ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                            </div>
                            <div class="col-md-4">
                                <label for="email">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
                            </div>
                            <div class="col-md-4">
                                <label for="phone">Phone</label>
                                <input type="tel" name="phone" class="form-control" placeholder="Enter your phone number" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary" name="register_event_btn">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>