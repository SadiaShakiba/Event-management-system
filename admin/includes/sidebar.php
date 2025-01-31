  <?php
    $page =  substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
    ?>

  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main">
      <div class="sidenav-header">
          <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
          <a class="navbar-brand px-4 py-3 m-0" href="index.php">
              <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
              <span class="ms-1 text-sm text-dark">Event Management</span>
          </a>
      </div>
      <hr class="horizontal dark mt-0 mb-2">
      <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
          <ul class="navbar-nav">
              <li class="nav-item">
                  <a class="nav-link text-dark <?= $page == "index.php" ? 'text-white active bg-gradient-success' : ''; ?>" href="index.php">
                      <i class="material-symbols-rounded opacity-5">dashboard</i>
                      <span class="nav-link-text ms-1">Dashboard</span>
                  </a>
              </li>
              <?php if (isset($_SESSION['user']) && $_SESSION['user']['role_as'] == 1): ?>
                  <li class="nav-item">
                      <a class="nav-link text-dark <?= $page == "user.php" ? 'text-white active bg-gradient-success' : ''; ?>" href="user.php">
                          <i class="material-symbols-rounded opacity-5">group</i>
                          <span class="nav-link-text ms-1">Users</span>
                      </a>
                  </li>
              <?php endif; ?>
              <li class="nav-item">
                  <a class="nav-link text-dark <?= $page == "event.php" ? 'text-white active bg-gradient-success' : ''; ?>" href="event.php">
                      <i class="material-symbols-rounded opacity-5">assignment</i>
                      <span class="nav-link-text ms-1">Events</span>
                  </a>
              </li>
              <li class="nav-item">
                  <a class="nav-link text-dark <?= $page == "event-registration.php" ? 'text-white active bg-gradient-success' : ''; ?>" href="event-registration.php">
                      <i class="material-symbols-rounded opacity-5">article_person</i>
                      <span class="nav-link-text ms-1">Event Registration</span>
                  </a>
              </li>
              <?php if (isset($_SESSION['user']) && $_SESSION['user']['role_as'] == 1): ?>
                  <li class="nav-item">
                      <a class="nav-link text-dark <?= $page == "attendee-list.php" ? 'text-white active bg-gradient-success' : ''; ?>" href="attendee-list.php">
                          <i class="material-symbols-rounded opacity-5">groups</i>
                          <span class="nav-link-text ms-1">Attendee List</span>
                      </a>
                  </li>
              <?php endif; ?>
          </ul>
      </div>
      <div class="sidenav-footer position-absolute w-100 bottom-0 ">
          <div class="mx-3">
              <a class="btn bg-gradient-success w-100" href="../logout.php" type="button">Log out</a>
          </div>
      </div>
  </aside>