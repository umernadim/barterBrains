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

let owlCarousel = document.getElementById('carousel');
carouselCards.forEach((card) => {
  owlCarousel.innerHTML  += `
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
