// code for user profile
function userProfileToggle() {
  const profileLink = document.getElementById("show-profile");
  const dashboard = document.getElementById("dashboard");

  if (profileLink) {
    profileLink.addEventListener("click", (e) => {
      e.preventDefault();
      dashboard.classList.toggle("active-profile");
    });
  }
}

userProfileToggle();

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

  // update Profile images
function updateprofileImages() {
  let profileInput = document.getElementById('profileInput')
  if (profileInput) {
    profileInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
      document.getElementById('profile-img').src = URL.createObjectURL(file);
    }
  });

  // Cover image preview
  let coverInput = document.getElementById('coverInput')
  coverInput.addEventListener('change', function() {
    const file = this.files[0];
    if (file) {
      document.getElementById('profile-cover').src = URL.createObjectURL(file);
    }
  });
}
}


updateprofileImages();





function requestCallBtn() {
  
// Hover effect for request buttons
document.querySelectorAll('.request-btn').forEach(btn => {
  btn.addEventListener('mouseenter', () => {
    gsap.to(btn, { scale: 1.05, duration: 0.2 });
  });
  btn.addEventListener('mouseleave', () => {
    gsap.to(btn, { scale: 1, duration: 0.2 });
  });
});


// Get modal elements
const callModal = document.getElementById('callModal');
const modalStatus = document.getElementById('modal-status');
const joinCallBtn = document.getElementById('joinCallBtn');

// Attach click event to each Request button
document.querySelectorAll('.request-btn').forEach(btn => {
  btn.addEventListener('click', () => {
    // Show modal
    callModal.style.display = 'flex';

    // Animate in modal
    gsap.from('.modal', {
      scale: 0.8,
      opacity: 0,
      duration: 0.3
    });

    // Reset text and button
    modalStatus.textContent = 'Sending request...';
    joinCallBtn.style.display = 'none';

    // Simulate waiting → accepted
    setTimeout(() => {
      modalStatus.textContent = 'Request accepted! 🎉';
      joinCallBtn.style.display = 'inline-block';
    }, 2000); // 2 seconds fake wait
  });
});

// Join Call button
joinCallBtn.addEventListener('click', () => {
  // Open Jitsi in new tab (for now)
  window.open('https://meet.jit.si/SkillExchangeRoom123', '_blank');
});

// Close modal when clicking outside modal
callModal.addEventListener('click', (e) => {
  if (e.target === callModal) {
    callModal.style.display = 'none';
  }
});

}
requestCallBtn();