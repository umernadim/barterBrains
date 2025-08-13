   <aside
      class="fixed inset-y-0 flex-wrap items-center justify-between block w-full p-0 my-4 overflow-y-auto antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-850 max-w-64 ease-nav-brand z-990 xl:ml-6 rounded-2xl xl:left-0 xl:translate-x-0"
      aria-expanded="false"
    >
      <div class="h-17">
        <i
          class="absolute top-3 right-0 p-4 cursor-pointer ri-close-large-line dark:text-white text-slate-400 xl:hidden"
          sidenav-close
        ></i>
 
         <a class="block px-6 py-6 m-0 pb-0 text-sm whitespace-nowrap dark:text-white text-slate-700" href="../dashboard.php">
          <h4 class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">BarterBrains</h4>
        </a>
      </div>

      <hr
        class="h-px mt-0 bg-transparent bg-gradient-to-r from-transparent via-black/40 to-transparent dark:bg-gradient-to-r dark:from-transparent dark:via-white dark:to-transparent"
      />

      <div
        class="items-center block w-auto max-h-screen h-sidenav grow basis-full"
      >
        <ul class="flex flex-col pl-0 mb-0">
          <!-- Dashboard -->
          <li class="mt-0.5 w-full">
            <a
              class="py-2.7 bg-blue-500/13 dark:text-white dark:opacity-80 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap rounded-lg px-4 font-semibold text-slate-700 transition-colors"
              href="./admin-panel.php"
            >
              <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg xl:p-2.5"
              >
                <i class="ri-dashboard-line text-blue-500 text-lg"></i>
              </div>
              <span
                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                >Dashboard</span
              >
            </a>
          </li>

          <!-- Users -->
          <li class="mt-0.5 w-full">
            <a
              class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
              href="./users-table.php"
            >
              <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg xl:p-2.5"
              >
                <i class="ri-user-3-line text-orange-500 text-lg"></i>
              </div>
              <span
                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                >Users</span
              >
            </a>
          </li>

          <!-- Feedback -->
          <li class="mt-0.5 w-full">
            <a
              class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
              href="./feedback-table.php"
            >
              <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg xl:p-2.5"
              >
                <i class="ri-feedback-line text-emerald-500 text-lg"></i>
              </div>
              <span
                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                >Feedback</span
              >
            </a>
          </li>

          <!-- Logout -->
          <li class="mt-0.5 w-full">
            <a
              class="dark:text-white dark:opacity-80 py-2.7 text-sm ease-nav-brand my-0 mx-2 flex items-center whitespace-nowrap px-4 transition-colors"
              href="../../logout.php"
              onclick="confirmLogout(event)"
            >
              <div
                class="mr-2 flex h-8 w-8 items-center justify-center rounded-lg xl:p-2.5"
              >
                <i class="ri-logout-circle-r-line text-cyan-500 text-lg"></i>
              </div>
              <span
                class="ml-1 duration-300 opacity-100 pointer-events-none ease"
                >Logout</span
              >
            </a>
          </li>
        </ul>
      </div>
    </aside>