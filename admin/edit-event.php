<?php

include('../middleware/userMiddleware.php');
include('includes/header.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $event = getById('events', $id);

                if ($event) {

                    $data = $event;

            ?>
                    <div class="card">
                        <div class="card-header events-header">
                            <h4>Edit Event</h4>
                            <div>
                                <div class="button-container">
                                    <a href="event.php">
                                        <button>Back</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="backend/button_handle_code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value="<?= $data['id'] ?>">

                                        <label for="name">Name</label>
                                        <input type="text" value="<?= htmlspecialchars($data['name']) ?>" name="name" class="form-control" placeholder="Enter event name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="image">Upload New Image</label>
                                        <input type="file" name="image" class="form-control">
                                        <label>Current Image:</label><br>
                                        <?php if (!empty($event['image'])): ?>
                                            <img src="../uploads/events/<?= $event['image'] ?>" alt="Event Image" width="50" height="50">
                                        <?php else: ?>
                                            <p>No image available</p>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="description">Description</label>
                                        <textarea rows="3" name="description" placeholder="Enter event description" class="form-control" required><?= htmlspecialchars($data['description']) ?></textarea>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="date">Date</label>
                                        <input type="date" value="<?= htmlspecialchars($data['date']) ?>" name="date" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="time">Time</label>
                                        <input type="time" value="<?= htmlspecialchars($data['time']) ?>" name="time" class="form-control" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="capacity">Capacity</label>
                                        <input type="number" name="capacity" value="<?= htmlspecialchars($data['capacity']) ?>" class="form-control" placeholder="Enter event capacity" required>
                                    </div>
                                    <div class="col-md-12 mt-3">
                                        <button type="submit" class="btn btn-primary" name="edit_event_btn">Update</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

            <?php
                } else {
                    echo "<h4>Event not found</h4>";
                }
            } else {
                echo "<h4>Id missing from url</h4>";
            }
            ?>

        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>