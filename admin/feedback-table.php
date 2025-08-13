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
  <title>Feedback-Table | BarterBrains</title>
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700"
    rel="stylesheet" />
  <script
    src="https://kit.fontawesome.com/42d5adcbca.js"
    crossorigin="anonymous"></script>
  <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
  <link
    href="https://cdn.jsdelivr.net/npm/remixicon/fonts/remixicon.css"
    rel="stylesheet" />

  <script src="https://unpkg.com/@popperjs/core@2"></script>
  <link
    href="assets/css/argon-dashboard-tailwind.css?v=1.0.1"
    rel="stylesheet" />
</head>

<body
  class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500">
  <div class="absolute w-full bg-blue-500 dark:hidden min-h-75"></div>
  <!-- sidenav  -->

  <?php
  include "components/sideBar.php";
  ?>

  <!-- end sidenav -->

  <main
    class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">
    <!-- Navbar -->
    <?php
    include "components/navBar.php";
    ?>
    <!-- end Navbar -->

    <div class="w-full px-6 py-6 mx-auto">
      <!--Users table-->

      <div class="flex flex-wrap -mx-3">
        <div class="flex-none w-full max-w-full px-3">
          <div
            class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl dark:bg-slate-850 dark:shadow-dark-xl rounded-2xl bg-clip-border">
            <div
              class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
              <h6 class="dark:text-white">Feedback table</h6>
            </div>
            <div class="flex-auto px-0 pt-0 pb-2">

              <div class="p-0 overflow-x-auto">
                <?php
                include "../config.php";
                $sql = "SELECT u.id, u.first_name, u.last_name, u.email, u.profile_photo, r.comment, r.user_id, r.id ,r.created_at
                        FROM users AS u
                        INNER JOIN reviews AS r
                        ON u.id = r.user_id
                        ORDER BY r.created_at DESC";
                $result = mysqli_query($connect, $sql);
                if (mysqli_num_rows($result) > 0) {
                ?>
                  <table
                    class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                    <thead class="align-bottom">
                      <tr>
                        <th
                          class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400">
                          Users
                        </th>
                        <th
                          class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400">
                          Feedback
                        </th>
                        <th
                          class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400">
                          Action
                        </th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      while ($row = mysqli_fetch_assoc($result)) {
                      ?>
                        <tr>
                          <td
                            class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                            <div class="flex px-2 py-1">
                              <div>
                                <img
                                  src="<?= !empty($row['profile_photo']) ? '../uploads/' . $row['profile_photo'] : '../assets/profile-img.jpg' ?>"
                                  class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-9 w-9 rounded-xl"
                                  alt="user3" />
                              </div>
                              <div class="flex flex-col justify-center">
                                <h6
                                  class="mb-0 text-sm leading-normal dark:text-white">
                                  <?= $row['first_name'] . ' ' . $row['last_name']; ?>
                                </h6>
                                <p
                                  class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">
                                  <?= $row['email']; ?>
                                </p>
                              </div>
                            </div>
                          </td>

                          <td
                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                            <p
                              class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400"><?= $row['comment']; ?></p>
                          </td>
                          <td
                            class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                            <a
                              href="delete-feedback.php?id=<?= urlencode($row['id']); ?>"
                              onclick="return confirm('Are you sure you want to delete this feedback?');"
                              class="text-xs font-semibold leading-tight dark:text-white dark:opacity-80 text-slate-400">
                              Delete
                            </a>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                <?php } ?>
              </div>


            </div>
          </div>
        </div>
      </div>

      <footer class="pt-4">
        <div class="w-full px-6 mx-auto">
          <div class="flex flex-wrap items-center -mx-3 lg:justify-between">
            <div
              class="w-full max-w-full px-3 mt-0 mb-6 shrink-0 lg:mb-0 lg:w-1/2 lg:flex-none">
              <div
                class="text-sm leading-normal text-center text-slate-500 lg:text-left">
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
<!-- plugin for charts  -->
<script src="assets/js/plugins/chartjs.min.js" async></script>
<!-- plugin for scrollbar  -->
<script src="assets/js/plugins/perfect-scrollbar.min.js" async></script>
<!-- main script file  -->
<script src="assets/js/argon-dashboard-tailwind.js?v=1.0.1" async></script>

</html>