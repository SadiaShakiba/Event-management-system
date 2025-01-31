<?php

include('../middleware/userMiddleware.php');
include('includes/header.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header events-header">
                    <h4>Add Event</h4>
                    <div>
                        <div class="button-container">
                            <a href="event.php">
                                <button>All Events</button>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="backend/button_handle_code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Enter event name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="image">Upload Image</label>
                                <input type="file" name="image" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label for="description">Description</label>
                                <textarea rows="3" name="description" placeholder="Enter event description" class="form-control" required></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="date">Date</label>
                                <input type="date" name="date" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="time">Time</label>
                                <input type="time" name="time" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label for="capacity">Capacity</label>
                                <input type="number" name="capacity" class="form-control" placeholder="Enter event capacity" required>
                            </div>
                            <div class="col-md-12 mt-3">
                                <button type="submit" class="btn btn-primary" name="add_event_btn">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>