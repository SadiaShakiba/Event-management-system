<?php

include('../middleware/userMiddleware.php');
include('includes/header.php');

// total users
$stmt = $pdo->prepare("SELECT COUNT(*) FROM users");
$stmt->execute();
$totalUsers = $stmt->fetchColumn();

// total events
$stmt = $pdo->prepare("SELECT COUNT(*) FROM events");
$stmt->execute();
$totalEvents = $stmt->fetchColumn();

// total attendees
$stmt = $pdo->prepare("SELECT COUNT(*) FROM event_attendees");
$stmt->execute();
$totalAttendees = $stmt->fetchColumn();

// Get the date and time from the GET request
$date = isset($_GET['date']) ? $_GET['date'] : '';
$time = isset($_GET['time']) ? $_GET['time'] : '';

$events = getFilteredEvents($pdo, $date, $time);



?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="container-fluid py-2">
                <div class="row">
                    <div class="col-xl-4 col-sm-4 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-2 ps-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="text-sm mb-0 text-capitalize">Total Users</p>
                                        <h4 class="mb-0"><?= htmlspecialchars($totalUsers) ?></h4>
                                    </div>
                                    <div class="icon icon-md icon-shape bg-gradient-success shadow-dark shadow text-center border-radius-lg">
                                        <i class="material-symbols-rounded opacity-10">person</i>
                                    </div>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 ps-3">
                                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+3% </span>than last month</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-4 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-2 ps-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="text-sm mb-0 text-capitalize">Total Events</p>
                                        <h4 class="mb-0"><?= htmlspecialchars($totalEvents) ?></h4>
                                    </div>
                                    <div class="icon icon-md icon-shape bg-gradient-info shadow-dark shadow text-center border-radius-lg">
                                        <i class="material-symbols-rounded opacity-10">leaderboard</i>
                                    </div>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 ps-3">
                                <p class="mb-0 text-sm"><span class="text-danger font-weight-bolder">-2% </span>than yesterday</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-sm-4 mb-xl-0 mb-4">
                        <div class="card">
                            <div class="card-header p-2 ps-3">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p class="text-sm mb-0 text-capitalize">Total Attendees</p>
                                        <h4 class="mb-0"><?= htmlspecialchars($totalAttendees) ?></h4>
                                    </div>
                                    <div class="icon icon-md icon-shape bg-gradient-warning shadow-dark shadow text-center border-radius-lg">
                                        <i class="material-symbols-rounded opacity-10">weekend</i>
                                    </div>
                                </div>
                            </div>
                            <hr class="dark horizontal my-0">
                            <div class="card-footer p-2 ps-3">
                                <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>than yesterday</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4 pt-5">
                    <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
                        <div class="card">
                            <div class="card-header pb-0">
                                <div class="row">
                                    <div class="col-lg-6 col-4">
                                        <h4>Events</h4>
                                    </div>
                                    <div class="col-lg-6 col-8">
                                        <form action="" method="GET">
                                            <div class="row">
                                                <!-- Date Filter -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="date" class="form-control" name="date" id="date" value="<?= isset($_GET['date']) ? $_GET['date'] : '' ?>">
                                                    </div>
                                                </div>

                                                <!-- Time Filter -->
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <input type="time" class="form-control" name="time" id="time" value="<?= isset($_GET['time']) ? $_GET['time'] : '' ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-success">Filter</button>
                                                        <a href="index.php" class="btn btn-info">Reset</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                            </div>
                            <div class="card-body px-4 pb-2" id="eventsTable">
                                <div class="table-responsive">
                                    <table id="myTable" class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Event Name</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Image</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Description</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Date</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Time</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Capacity</th>
                                                <th class="text-center text-uppercase text-dark text-xs font-weight-bolder">Registered</th>
                                            </tr>
                                        </thead>
                                        <tbody id="eventData">
                                            <?php
                                            if (count($events) > 0) {
                                                foreach ($events as $event) {
                                            ?>
                                                    <tr>
                                                        <td class="align-middle text-center" style='max-width: 200px; 
                                                                                overflow: hidden; 
                                                                                text-overflow: ellipsis; 
                                                                                word-wrap: break-word; 
                                                                                white-space: normal;'><?= $event['name'] ?></td>
                                                        <td class="align-middle text-center">
                                                            <img src="../uploads/events/<?= $event['image'] ?>" alt="Event Image" width="100">
                                                        </td>
                                                        <td class="align-middle text-center" style='max-width: 200px; 
                                                                                overflow: hidden; 
                                                                                text-overflow: ellipsis; 
                                                                                word-wrap: break-word; 
                                                                                white-space: normal;'>
                                                            <?= $event['description'] ?></td>
                                                        <td class="align-middle text-center"><?= $event['date'] ?></td>
                                                        <td class="align-middle text-center"><?= $event['time'] ?></td>
                                                        <td class="align-middle text-center"><?= $event['capacity'] ?></td>
                                                        <td class="align-middle text-center"><?= $event['registered'] ?></td>
                                                    </tr>
                                            <?php
                                                }
                                            } else {
                                                echo "<tr><td  class='text-center'>-</td><td  class='text-center'>-</td><td  class='text-center'>-</td><td  class='text-center'>No events found</td><td  class='text-center'>-</td><td  class='text-center'>-</td><td  class='text-center'>-</td></tr>";
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
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>