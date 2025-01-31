<?php

include('../middleware/userMiddleware.php');
include('includes/header.php');

?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header events-header">
                    <h4>Events</h4>
                    <div class="d-flex justify-content-between">
                        <div class="button-container">
                            <input type="text" id="eventSearch" class="form-control custom-button-height" placeholder="Search event by name">
                        </div>
                        <div class="button-container ml-2">
                            <a href="add-event.php">
                                <button>+ Add events</button>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="eventTableBody" class=" table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Image</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Capacity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>