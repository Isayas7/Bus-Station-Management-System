 <!-- Navbar -->
 <nav class="navbar navbar-expand-lg nav-col fixed-top py-4">
     <div class="container">
         <!-- offcanvas tigger -->
         <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
             <span class="navbar-toggler-icon"></span>
         </button>
         <!-- offcanvas tigger -->
         <a class="navbar-brand me-auto fs-4 py-2 title-of" href="#"><span class="material-icons-outlined align-middle me-2  fw-bold main-menu">
                 menu
             </span>
             <span class="align-middle fw-bold" id="station_city" style="font-weight: 600"><?php echo $station_city ?></span>
         </a>
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon" data-bs-target="#navbarSupportedContent"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarSupportedContent">
             <!-- search button -->
             <form class="d-flex ms-auto" role="search">
                 <div class="input-group my-3 my-lg-0">
                     <input type="text" id="search" class="form-control" placeholder="Search" aria-label="Recipient's username" aria-describedby="button-addon2" />
                     <button class="btn btn-search" type="button" id="button-addon2">
                         <i class="bi bi-search text-light"></i>
                     </button>
                 </div>
             </form>
             <!-- search btn end -->
             <ul class="navbar-nav mb-2 mb-lg-0">

                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                         <i class="bi bi-person-fill text-dark"></i>
                     </a>
                     <ul class="dropdown-menu dropdown-menu-end">
                         <li>
                             <a class="dropdown-item" href="../../model/logout.php" id="logout_button">Logout</a>
                         </li>

                     </ul>
                 </li>
             </ul>
         </div>
     </div>
 </nav>
 <!-- Navbar End -->

 <!-- Offcanvas -->
 <div class="offcanvas offcanvas-start text-light sidebar-nav" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
     <div class="offcanvas-body text-light p-0">
         <nav class="navbar-light">
             <ul class="navbar-nav lists">
                 <li>
                     <a class="navbar-brand fs-4" href="#">
                         <span> <img src="../../assets/bus.ico" alt="" /> </span>
                         <span class="of-txt align-middle" style="font-weight: 900">Ethio Travel</span>
                     </a>
                 </li>
                 <li>
                     <div class="small fw-bold text-uppercase px-3">CORE</div>
                 </li>
                 <li>

                     <a href="../station-admin/station-admin-dashboard.php?station_city=<?php echo $station['station_city'] ?>">
                         <button class="nav-link-button dashboard">
                             <div class="text-in-button">
                                 <span class="material-icons-outlined me-2"> dashboard </span>
                                 <span class="of-txt1 align-top">Dashboard</span>
                             </div>
                         </button>
                     </a>
                 </li>
                 <li class="my-1">
                     <hr />
                 </li>
                 <li>
                     <div class="small fw-bold text-uppercase px-3">Operations</div>
                 </li>
                 <li>
                     <?php
                        $count = 0;
                        $pending_s = 'Pending';
                        $sql = "SELECT * FROM schedule WHERE schedule_status='$pending_s'";
                        $query_run_tou = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($query_run_tou) > 0) {
                            foreach ($query_run_tou as $stationtou) {
                                $count++;
                            }
                        }
                        ?>
                     <a href="../station-admin/schedule-management.php?station_city=<?php echo $station['station_city'] ?>">
                         <button class="nav-link-button vehicles">
                             <div class="text-in-button">
                                 <span class="material-icons-outlined">
                                     schedule
                                 </span>
                                 <span class="of-txt7 align-top">Schedule</span><span class="ms-5 ps-2 pe-2 bg-danger text-light align-top"><?php echo $count ?></span>
                             </div>
                         </button>
                     </a>
                 </li>
                 <li>
                     <a href="../station-admin/seat-management.php?station_city=<?php echo $station['station_city'] ?>">
                         <button class="nav-link-button traffic">
                             <div class="text-in-button">
                                 <span class="material-icons-outlined">
                                     airline_seat_recline_normal
                                 </span>
                                 <span class="of-txt3 align-top">Seats</span>
                             </div>
                         </button>
                     </a>
                 </li>
                 <li>
                     <a href="../station-admin/passenger-management.php?station_city=<?php echo $station['station_city'] ?>">
                         <button class="nav-link-button passengers">
                             <div class="text-in-button">
                                 <span class="material-icons-outlined me-2"> hail </span>
                                 <span class="of-txt4 align-top">Passenger</span>
                             </div>
                         </button>
                     </a>
                 </li>
                 <li class="my-1">
                     <hr />
                 </li>
             </ul>
         </nav>
     </div>
 </div>
 <!--==================================== Offcanvas End ===================================-->