// code to run cards in loop of owl-carousel
function carousel() {
  const carouselCards = [
    {
      name: "Candice",
      skill: "EnglishTeacher",
      userImg:
        "assets/profile/smiling-business-woman-with-folded-hands-against-white-wall-toothy-smile-crossed-arms.jpg",
    },
    {
      name: "William",
      skill: "Guitarist",
      userImg:
        "assets/profile/handsome-asian-man-listening-music-through-headphones.jpg",
    },
    {
      name: "Taylor",
      skill: "ContentWriter",
      userImg: "assets/profile/cute-smiling-woman-outdoor-portrait.jpg",
    },
    {
      name: "Nick",
      skill: "WebDeveloper",
      userImg: "assets/profile/man-portrait.jpg",
    },
    {
      name: "Elsa",
      skill: "Blogger",
      userImg: "assets/profile/woman-posing-black-dress-medium-shot.jpg",
    },
    {
      name: "Chan",
      skill: "MathTeacher",
      userImg:
        "assets/profile/smart-attractive-asian-glasses-male-standing-smile-with-freshness-joyful-casual-blue-shirt-portrait-white-background.jpg",
    },
  ];

  let owlCarousel = document.getElementById("carousel");
  if (owlCarousel) {
    carouselCards.forEach((card) => {
      owlCarousel.innerHTML += `
  <div class="owl-carousel-info-wrap item">
                                <img src="${card.userImg}"
                                    class="owl-carousel-image img-fluid" alt="">

                                <div class="owl-carousel-info">
                                    <h4 class="mb-2">
                                        ${card.name}
                                    </h4>

                                    <span class="badge">${card.skill}</span>

                                </div>

                                <div class="social-share">
                                    <ul class="social-icon">
                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link"><i class="ri-user-3-line"></i></a>
                                        </li>

                                        <li class="social-icon-item">
                                            <a href="#" class="social-icon-link"><i class="ri-message-2-line"></i></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
  `;
    });
  }
}

carousel();

// code for testimonial section
function testimonial() {
  const slidesContainer = document.querySelector(".slides");
  const slide = document.querySelector(".slide");
  const totalSlides = document.querySelectorAll(".slide").length;

  let currentIndex = 0;

  function getSlidesToShow() {
    if (window.innerWidth <= 480) {
      return 1;
    } else if (window.innerWidth <= 768) {
      return 2;
    } else {
      return 3;
    }
  }

  function updateSlider() {
    if (!slide) return;
    const slidesToShow = getSlidesToShow();
    const slideWidth = slide.clientWidth + 20;
    slidesContainer.style.transform = `translateX(-${
      slideWidth * currentIndex
    }px)`;
  }

  function autoSlide() {
    const slidesToShow = getSlidesToShow();
    currentIndex++;
    if (currentIndex > totalSlides - slidesToShow) {
      currentIndex = 0;
    }
    updateSlider();
  }

  window.addEventListener("resize", updateSlider);
  updateSlider();
  setInterval(autoSlide, 4000);
}

document.addEventListener("DOMContentLoaded", testimonial);

// code for dashboard-sideBar
function sideBarToggle() {
  const menuBtn = document.getElementById("menuBtn");
  const dashboard = document.getElementById("dashboard");

  if (menuBtn) {
    menuBtn.addEventListener("click", (e) => {
      e.preventDefault();
      dashboard.classList.toggle("active-sideBar");
    });
  }
}

sideBarToggle();

// Mobile sidebar toggle
function mobileSideBarToggle() {
  const mobileMenuBtn = document.getElementById("mobileMenuBtn");
  const dashboard = document.getElementById("dashboard");

  if (mobileMenuBtn) {
    mobileMenuBtn.addEventListener("click", (e) => {
      e.preventDefault();
      dashboard.classList.toggle("show-mobile-sidebar");
      // 👉 CLOSE profile if sidebar opens
      dashboard.classList.remove("show-mobile-profile");
      dashboard.classList.remove("active-profile");
    });
  }
}

mobileSideBarToggle();

// code for user profile toggle
function userProfileToggle() {
  const profileLink = document.getElementById("show-profile");
  const dashboard = document.getElementById("dashboard");

  if (profileLink) {
    profileLink.addEventListener("click", (e) => {
      e.preventDefault();
      dashboard.classList.add("show-mobile-profile");
      dashboard.classList.remove("show-mobile-sidebar");
      dashboard.classList.add("active-profile");
    });
  }
}

userProfileToggle();

// code for closeProfileBtn
function closeProfileBtn() {
  const closeProfileBtn = document.getElementById("closeProfileBtn");
  if (closeProfileBtn) {
    closeProfileBtn.addEventListener("click", (e) => {
      e.preventDefault();
      dashboard.classList.remove("show-mobile-profile");
      dashboard.classList.remove("active-profile");
    });
  }
}
closeProfileBtn();

// update Profile images
function updateprofileImages() {
  let profileInput = document.getElementById("profileInput");
  if (profileInput) {
    profileInput.addEventListener("change", function () {
      const file = this.files[0];
      if (file) {
        document.getElementById("profile-img").src = URL.createObjectURL(file);
      }
    });

    // Cover image preview
    let coverInput = document.getElementById("coverInput");
    coverInput.addEventListener("change", function () {
      const file = this.files[0];
      if (file) {
        document.getElementById("profile-cover").src =
          URL.createObjectURL(file);
      }
    });
  }
}

updateprofileImages();


// code for Feedvack modal popup
function feedbackModal() {
  document.addEventListener("DOMContentLoaded", () => {
    const leaveFeedbackBtn = document.getElementById("leaveFeedbackBtn");
    const modal = document.getElementById("feedback-modal");
    const closeBtn = document.querySelector("#feedback-modal .close-btn");
    const feedbackForm = document.getElementById("feedback-form");

    if (leaveFeedbackBtn && modal) {
      leaveFeedbackBtn.addEventListener("click", (e) => {
        e.preventDefault();
        modal.style.display = "block";
      });
    }

    if (closeBtn && modal) {
      closeBtn.addEventListener("click", (e) => {
        e.preventDefault();
        modal.style.display = "none";
      });
    }

    window.addEventListener("click", (e) => {
      if (e.target == modal) {
        modal.style.display = "none";
      }
    });
  });
}

feedbackModal();

// function to change theme
function changeTheme() {
  const themeBtns = document.querySelectorAll(".themeBtn");
  const changeTheme = document.querySelector(".changeTheme");
  const savedTheme = localStorage.getItem("pagesTheme");

  if (!changeTheme) return; // Exit if the container is missing

  // Apply saved theme
  if (savedTheme === "dark") {
    changeTheme.classList.add("dark");
    themeBtns.forEach(btn => {
      btn.innerHTML = `<span>Light mode</span> <i class="ri-moon-clear-line"></i>`;
    });
  } else {
    changeTheme.classList.remove("dark");
    themeBtns.forEach(btn => {
      btn.innerHTML = `<span>Dark mode</span> <i class="ri-sun-line"></i>`;
    });
  }

  // Add event listeners to all buttons
  themeBtns.forEach(btn => {
    btn.addEventListener("click", () => {
      changeTheme.classList.toggle("dark");
      const isDark = changeTheme.classList.contains("dark");
      localStorage.setItem("pagesTheme", isDark ? "dark" : "light");

      themeBtns.forEach(button => {
        button.innerHTML = isDark
          ? `<span>Light mode</span> <i class="ri-moon-clear-line"></i>`
          : `<span>Dark mode</span> <i class="ri-sun-line"></i>`;
      });
    });
  });
}

changeTheme();


// code to show notification modal
function notification() {
  const bell = document.querySelector(".notification-icon");
  const panel = document.getElementById("notification-panel");

  if (bell) {
    bell.addEventListener("click", () => {
      panel.classList.toggle("show");
    });
  }
}
notification();

// code for admin navBar toggle
function adminNavBarToggle() {
  const menuBtn = document.querySelector("#menu i");
  const sidebar = document.querySelector("#sidebar");

  menuBtn.addEventListener("click", () => {
    sidebar.classList.toggle("active");
  });

}

// adminNavBarToggle();


const panel = document.getElementById("notification-panel");

// Load notifications on page load
document.addEventListener("DOMContentLoaded", () => {
    fetchNotifications();
});

// Fetch notifications from backend
function fetchNotifications() {
    fetch("get_notifications.php")
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                console.error("Error loading notifications:", data.error);
                return;
            }

            panel.innerHTML = "<h4>Notifications</h4>"; // Reset with header

            // Pending requests
            if (Array.isArray(data.pending)) {
                data.pending.forEach(n => {
                    showNotification(n.name, n.time, n.profile_photo, n.id, n.sender_id, "pending");
                });
            }

            // Accepted connections
            if (Array.isArray(data.accepted)) {
                data.accepted.forEach(n => {
                    showNotification(n.name, n.time, n.profile_photo, n.id, n.sender_id, "accepted");
                });
            }
        });
}

// Create notification item
function showNotification(userName, timeAgo = "Just now", profilePhoto = "assets/profile-img.jpg", requestId, senderId, status = "pending") {
    const notificationItem = document.createElement("div");
    notificationItem.className = "notification-item";

    let actionsHTML = "";
    if (status === "pending") {
        actionsHTML = `
            <button class="accept-btn" data-request-id="${requestId}" data-sender-id="${senderId}">Accept</button>
            <button class="reject-btn" data-request-id="${requestId}">Reject</button>
        `;
    } else if (status === "accepted") {
        actionsHTML = `<span class="accepted-label">✅ Connected</span>`;
    }

    notificationItem.innerHTML = `
        <img src="${profilePhoto}" alt="${userName}">
        <div class="notification-text">
            <strong>${userName}</strong> wants to connect with you.
            <div class="notification-actions">${actionsHTML}</div>
            <small>${timeAgo}</small>
        </div>
    `;

    panel.appendChild(notificationItem);
}

// Handle click events
document.addEventListener("click", function (e) {
    if (e.target.classList.contains("accept-btn") || e.target.classList.contains("reject-btn")) {
        const requestId = e.target.getAttribute("data-request-id");
        const senderId = e.target.getAttribute("data-sender-id") || null;
        const action = e.target.classList.contains("accept-btn") ? "accept" : "reject";
        const notificationItem = e.target.closest(".notification-item");

        fetch("handle_connection_action.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `request_id=${requestId}&action=${action}`,
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (action === "accept") {
                        // Change notification to connected
                        const actionsDiv = notificationItem.querySelector(".notification-actions");
                        if (actionsDiv) actionsDiv.innerHTML = `<span class="accepted-label">✅ Connected</span>`;

                        if (senderId) {
                            const connectBtn = document.querySelector(`.connect-btn[data-receiver-id="${senderId}"]`);
                            if (connectBtn) {
                                connectBtn.outerHTML = '<button class="request-btn connected-btn" disabled>Connected</button>';
                            }
                        }
                    } else {
                        notificationItem.remove();
                    }
                } else {
                    alert(data.error || "Something went wrong");
                }
            });
    }

    // Send a new connection request
    if (e.target.classList.contains("connect-btn") && !e.target.disabled) {
        const button = e.target;
        const receiverId = button.dataset.receiverId;

        fetch("send_request.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" },
            body: `receiver_id=${receiverId}`,
        })
            .then(res => res.json())
            .then(data => {
                if (data.message) {
                    button.innerText = "Requested";
                    button.disabled = true;
                } else {
                    alert(data.error || "Something went wrong");
                }
            });
    }
});
