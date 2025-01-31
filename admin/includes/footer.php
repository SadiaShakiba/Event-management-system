 <footer class="footer py-4  ">
     <div class="container-fluid">
         <div class="row align-items-center justify-content-lg-between">
             <div class="col-lg-7">
                 <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                     <li class="nav-item">
                         <a href="#" class="nav-link text-muted" target="_blank">Services</a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link text-muted" target="_blank">About Us</a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link text-muted" target="_blank">Contact</a>
                     </li>
                     <li class="nav-item">
                         <a href="#" class="nav-link pe-0 text-muted" target="_blank">License</a>
                     </li>
                 </ul>
             </div>
         </div>
     </div>
 </footer>
 </main>
 <div class="fixed-plugin">
     <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
         <i class="material-symbols-rounded py-2">settings</i>
     </a>
     <div class="card shadow-lg">
         <div class="card-header pb-0 pt-3">
             <div class="float-start">
                 <h5 class="mt-3 mb-0">Material UI Configurator</h5>
                 <p>See dashboard options</p>
             </div>
             <div class="float-end mt-4">
                 <button
                     class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                     <i class="material-symbols-rounded">clear</i>
                 </button>
             </div>
             <!-- End Toggle Button -->
         </div>
         <hr class="horizontal dark my-1" />
         <div class="card-body pt-sm-3 pt-0">
             <!-- Sidebar Backgrounds -->
             <div>
                 <h6 class="mb-0">Sidebar Colors</h6>
             </div>
             <a href="javascript:void(0)" class="switch-trigger background-color">
                 <div class="badge-colors my-2 text-start">
                     <span
                         class="badge filter bg-gradient-primary"
                         data-color="primary"
                         onclick="sidebarColor(this)"></span>
                     <span
                         class="badge filter bg-gradient-dark active"
                         data-color="dark"
                         onclick="sidebarColor(this)"></span>
                     <span
                         class="badge filter bg-gradient-info"
                         data-color="info"
                         onclick="sidebarColor(this)"></span>
                     <span
                         class="badge filter bg-gradient-success"
                         data-color="success"
                         onclick="sidebarColor(this)"></span>
                     <span
                         class="badge filter bg-gradient-warning"
                         data-color="warning"
                         onclick="sidebarColor(this)"></span>
                     <span
                         class="badge filter bg-gradient-danger"
                         data-color="danger"
                         onclick="sidebarColor(this)"></span>
                 </div>
             </a>
             <!-- Navbar Fixed -->
             <div class="mt-3 d-flex">
                 <h6 class="mb-0">Navbar Fixed</h6>
                 <div class="form-check form-switch ps-0 ms-auto my-auto">
                     <input
                         class="form-check-input mt-1 ms-auto"
                         type="checkbox"
                         id="navbarFixed"
                         onclick="navbarFixed(this)" />
                 </div>
             </div>
             <hr class="horizontal dark my-3" />
         </div>
     </div>
 </div>
 <!--   Core JS Files   -->
 <script src="./assets/js/core/popper.min.js"></script>
 <script src="./assets/js/core/bootstrap.min.js"></script>
 <script src="./assets/js/plugins/perfect-scrollbar.min.js"></script>
 <script src="./assets/js/plugins/smooth-scrollbar.min.js"></script>
 <script src="./assets/js/plugins/chartjs.min.js"></script>
 <script src="./assets/js/custom.js"></script>
 <script>
     var win = navigator.platform.indexOf('Win') > -1;
     if (win && document.querySelector('#sidenav-scrollbar')) {
         var options = {
             damping: '0.5'
         }
         Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
     }
 </script>

 <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
 <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>


 <script>
     $(document).ready(function() {
         $('#myTable').DataTable();
     });
 </script>


 <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
 <script src="./assets/js/material-dashboard.min.js?v=3.2.0"></script>
 <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.14.0/build/alertify.min.js"></script>

 <script>
     <?php if (isset($_SESSION['message'])) {
        ?>
         alertify.set('notifier', 'position', 'top-right');
         alertify.success('<?php echo $_SESSION['message']; ?>');
     <?php unset($_SESSION['message']);
        } ?>
 </script>

 <script>
     $(document).ready(function() {
         // Function to fetch and display attendees
         function fetchAttendees(event_id = '') {
             $.ajax({
                 url: './backend/fetch-attendees.php',
                 method: 'GET',
                 data: {
                     event_id: event_id
                 },
                 success: function(data) {
                     $('#attendeesTable tbody').html(data);
                 }
             });
         }
         fetchAttendees();
         // Event listener for event filter dropdown
         $('#eventFilter').change(function() {
             var event_id = $(this).val();
             fetchAttendees(event_id);
         });
     });
 </script>
 <script>
     $(document).ready(function() {
         function fetchEvents() {
             $.ajax({
                 url: './backend/fetch-events.php',
                 method: 'GET',
                 success: function(data) {
                     $('#eventTableBody tbody').html(data);
                 }
             });
         }

         fetchEvents();
     });
     document.getElementById('eventSearch').addEventListener('input', function() {
         var searchQuery = this.value.toLowerCase();
         var rows = document.querySelectorAll('#eventTableBody tbody tr');

         rows.forEach(function(row) {
             var nameCell = row.querySelector('td:nth-child(2)');
             if (nameCell) {
                 var name = nameCell.textContent.toLowerCase();
                 row.style.display = name.includes(searchQuery) ? '' : 'none';
             }
         });
     });
 </script>
 </body>

 </html>