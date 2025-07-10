// code for user profile 
function userProfileToggle() {
  const profileLink = document.getElementById("show-profile");
  const dashboard = document.getElementById("dashboard");

  profileLink.addEventListener("click", (e) => {
    e.preventDefault();
    dashboard.classList.toggle("active-profile");
  });
}

userProfileToggle();

// code for dashboard-sideBar
  const menuBtn = document.getElementById("menuBtn");
  const dashboard = document.getElementById("dashboard");

  menuBtn.addEventListener("click", (e) => {
    e.preventDefault();
    dashboard.classList.toggle("active-sideBar");
  });
