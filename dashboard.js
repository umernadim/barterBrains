// Animate match cards when Dashboard loads
  
gsap.from('.match-card', {
  opacity: 0,
  y: 30,
  stagger: 0.2,
  duration: 0.8
});

// Animate sidebar skills badges
gsap.from('.sidebar .skill-badge', {
  opacity: 0,
  x: -20,
  stagger: 0.2,
  duration: 0.5
});

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
