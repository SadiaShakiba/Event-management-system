<?php

include('../middleware/userMiddleware.php');
include('includes/header.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header events-header">
                    <h4>Event Registration</h4>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Capacity</th>
                                    <th>Registered</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $events = getAll('events');

                                if (count($events) > 0) {
                                    foreach ($events as $event) {
                                ?>
                                        <tr>
                                            <td> <?= $event['id'] ?></td>
                                            <td style='max-width: 200px; 
                                                        overflow: hidden; 
                                                        text-overflow: ellipsis; 
                                                        word-wrap: break-word; 
                                                        white-space: normal;'> <?= $event['name'] ?></td>
                                            <td> <img src="../uploads/events/<?= $event['image'] ?>" alt="Event Image" width="100"></td>
                                            <td style='max-width: 200px; 
                                                        overflow: hidden; 
                                                        text-overflow: ellipsis; 
                                                        word-wrap: break-word; 
                                                        white-space: normal;'> <?= $event['description'] ?></td>
                                            <td> <?= $event['date'] ?></td>
                                            <td> <?= $event['time'] ?></td>
                                            <td> <?= $event['capacity'] ?></td>
                                            <td> <?= $event['registered'] ?></td>
                                            <td>
                                                <a href="attendee-register.php?id=<?= $event['id'] ?>" class="btn btn-success btn-sm">Register</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>No events found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>