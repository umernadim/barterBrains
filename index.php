<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BarterBrains</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />

    <link rel="stylesheet" href="css/owl.carousel.min.css" />

    <link rel="stylesheet" href="css/owl.theme.default.min.css" />

    <link href="css/templatemo-pod-talk.css" rel="stylesheet" />
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>
    <main>
      <!-- code for navBar  -->
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <h5 style="color: #fff">BarterBrains</h5>

          <div class="ms-4">
            <a
              href="signup.php"
              class="btn custom-btn custom-border-btn smoothscroll"
              >Create Profile</a
            >
          </div>
        </div>
      </nav>

      <!-- code for her-section  -->
      <section class="hero-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-12 col-12">
              <div class="text-center mb-5 pb-2">
                <h1 class="text-white">Skill Up Without Paying Up.</h1>

                <p class="text-white">
                  Share What You Know. Learn What You Love.
                </p>

                <a href="login.php" class="btn custom-btn smoothscroll mt-3"
                  >Get Started</a
                >
              </div>
              <!-- == CAROUSEL ==-->
              <div id="carousel" class="owl-carousel owl-theme">
                <!-- cards code is in javascript  -->
              </div>
            </div>
          </div>
        </div>
      </section>
 

    <!-- HOW IT WORKS -->
    <section class="how-it-works">
      <h2>How It Works</h2>
      <div class="steps">
        <div class="step">
          <h3>1. Create Profile</h3>
          <p>Add what you can teach and what you want to learn.</p>
        </div>
        <div class="step">
          <h3>2. Get Matches</h3>
          <p>We find people who want to swap skills with you.</p>
        </div>
        <div class="step">
          <h3>3. Request Live Call</h3>
          <p>Chat live, learn together, grow together.</p>
        </div>
      </div>
    </section>

    <!-- FEATURED USERS / TESTIMONIALS -->
    <section class="featured-users">
      <h2>What Our Users Say</h2>
      <div class="slider">
        <div class="slides">
          <div class="slide">
            <img src="assets/profile-img.avif" alt="User" />
            <h3>M.Umer</h3>
            <p class="skills">Teaches: Guitar | Learns: English</p>
            <p class="testimonial">
              “BarterBrains helped me find amazing people to learn English while
              teaching guitar. Perfect match!”
            </p>
          </div>
          <div class="slide">
            <img src="assets/profile-img.avif" alt="User" />
            <h3>Sarah A.</h3>
            <p class="skills">Teaches: Yoga | Learns: Photography</p>
            <p class="testimonial">
              “I exchanged my yoga lessons for photography tips. Loved how easy
              it is!”
            </p>
          </div>
          <div class="slide">
            <img src="assets/profile-img.avif" alt="User" />
            <h3>David K.</h3>
            <p class="skills">Teaches: Coding | Learns: Cooking</p>
            <p class="testimonial">
              “Sharing skills without money — best thing ever. Highly
              recommended!”
            </p>
          </div>
          <div class="slide">
            <img src="assets/profile-img.avif" alt="User" />
            <h3>Emma L.</h3>
            <p class="skills">Teaches: French | Learns: Web Design</p>
            <p class="testimonial">
              “A perfect way to swap skills and meet inspiring people.”
            </p>
          </div>
        </div>
      </div>
    </section>

    <!---- code for footer-section ---->
   <?php
   include "components/footer.php";
   ?>
   </main>
    <!-- JAVASCRIPT FILES -->
    <script src="script.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>
