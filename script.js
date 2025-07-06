// GSAP animations for landing page

function landingPgAnime() {

// Hero text animation
gsap.from('.hero h1', {
  opacity: 0,
  y: 50,
  duration: 1
});

gsap.from('.hero p', {
  opacity: 0,
  y: 30,
  delay: 0.5,
  duration: 1
});

gsap.from('.hero .cta-btn', {
  opacity: 0,
  scale: 0.8,
  delay: 1,
  duration: 0.6
});

}

landingPgAnime();


