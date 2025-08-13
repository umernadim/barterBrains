<?php
include '../config.php';
session_start();

if (!isset($_SESSION['email'])) {
  header('Location:../index.php');
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Admin-panel | BarterBrains</title>
    <link
      href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
      rel="stylesheet"
    />

    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css"
      rel="stylesheet"
    />

    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <link
      href="assets/css/argon-dashboard-tailwind.css?v=1.0.1"
      rel="stylesheet"
    />
  </head>

  <body
    class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500"
  >
    <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
    <!-- sidenav  -->
  
     <?php 
     include "components/sideBar.php";
     ?>

    <!-- end sidenav -->

    <main
      class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl"
    >
      <!-- Navbar -->
     <?php 
     include "components/navBar.php";
     ?>
      <!-- end Navbar -->

      <!-- cards -->
      <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
          <!-- card1 -->
          <div
            class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/2"
          >
            <div
              class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border"
            >

            <?php
            include "../config.php";
            $sql = "SELECT COUNT(*) AS total_users FROM users";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
            }
            ?>

              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p
                        class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60"
                      >
                        Total Users
                      </p>
                      <h5 class="mb-2 font-bold dark:text-white"><?= $row["total_users"]; ?></h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div
                      class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500"
                    >
                      <i
                        class="ni leading-none ri-user-3-line text-lg relative top-3.5 text-white"
                      ></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- card2 -->

            <?php
            include "../config.php";
            $sql = "SELECT COUNT(*) AS total_reviews FROM reviews";
            $result = mysqli_query($connect, $sql);
            if (mysqli_num_rows($result) > 0) {
              $row = mysqli_fetch_assoc($result);
            }
            ?>
          <div
            class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/2"
          >
            <div
              class="relative flex flex-col min-w-0 break-words bg-white shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border"
            >
              <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                  <div class="flex-none w-2/3 max-w-full px-3">
                    <div>
                      <p
                        class="mb-0 font-sans text-sm font-semibold leading-normal uppercase dark:text-white dark:opacity-60"
                      >
                        total Feedback
                      </p>
                      <h5 class="mb-2 font-bold dark:text-white"><?= $row['total_reviews']; ?></h5>
                    </div>
                  </div>
                  <div class="px-3 text-right basis-1/3">
                    <div
                      class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600"
                    >
                      <i
                        class="ni leading-none ri-feedback-line text-lg relative top-3.5 text-white"
                      ></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- cards row 2 -->
        <div class="flex flex-wrap mt-6 -mx-3">
          <div class="w-full max-w-full px-3 mt-0 lg:flex-none">
            <div
              class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border"
            >
              <div
                class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0"
              >
                <h6 class="capitalize dark:text-white">Users Overview</h6>
                <p
                  class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60"
                >
                  <i class="fa fa-arrow-up text-emerald-500"></i>
                </p>
              </div>
              <div class="flex-auto p-4">
                <div>
                  <canvas id="usersChart" width="400" height="200"></canvas>

                </div>
              </div>
            </div>
          </div>
        </div>

        <footer class="pt-4">
          <div class="w-full px-6 mx-auto">
            <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
              <div
                class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none"
              >
                <div
                  class="text-sm leading-normal text-center text-slate-500 lg:text-left"
                >
                  © 2025 all rights reserved by BarterBrains.
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
      <!-- end cards -->
    </main>
  </body>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js" async></script>
  <script src="assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    fetch('get-users-data.php') // This will return JSON data from PHP
        .then(response => response.json())
        .then(data => {
            const ctx = document.getElementById('usersChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar', // You can change to 'line', 'pie', etc.
                data: {
                    labels: data.labels, // Months
                    datasets: [{
                        label: 'Users Registered',
                        data: data.values, // Number of users
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: 'User Registrations per Month'
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        })
        .catch(error => console.error('Error loading chart data:', error));
});
</script>
<script>
      // function to confirm logout account
    function confirmLogout(event) {
      event.preventDefault();
      const confirmed = confirm("Are you sure you want to logout your account?");
      if (confirmed) {
        window.location.href = "../logout.php";
      }
    }
</script>

</html>
