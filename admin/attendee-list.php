<?php

include('../middleware/userMiddleware.php');
include('includes/header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header events-header">
                    <h4>Attendees</h4>
                    <div class="d-flex justify-content-between">
                        <div class="button-container">
                            <input type="text" id="attendeeSearch" class="form-control custom-button-height" placeholder="Search attendee by name">
                        </div>
                        <div class="button-container">
                            <select id="eventFilter" class="form-control bg-success text-white custom-button-height ml-2">
                                <option value="">Select Event</option>
                                <?php
                                $events = getAll('events');
                                foreach ($events as $event): ?>
                                    <option value="<?= $event['id']; ?>"><?= $event['name']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="button-container">
                            <a href="./backend/download_attendees_csv.php" id="downloadCsv" class="btn btn-info custom-button-height ml-2">Download CSV</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="attendeesTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Event</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
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

<script>
    document.getElementById('eventFilter').addEventListener('change', function() {
        var selectedEventId = this.value;
        var downloadLink = document.getElementById('downloadCsv');

        downloadLink.href = "./backend/download_attendees_csv.php?event_id=" + selectedEventId;
    });
    document.getElementById('attendeeSearch').addEventListener('input', function() {
        var searchQuery = this.value.toLowerCase();
        var rows = document.querySelectorAll('#attendeesTable tbody tr');

        rows.forEach(function(row) {
            var nameCell = row.querySelector('td:nth-child(3)');
            if (nameCell) {
                var name = nameCell.textContent.toLowerCase();
                row.style.display = name.includes(searchQuery) ? '' : 'none';
            }
        });
    });
</script>


<?php include('includes/footer.php'); ?>