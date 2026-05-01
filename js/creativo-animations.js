// Safety: If GSAP fails, make everything visible after 3 seconds
setTimeout(() => {
  gsap.to(".reveal, .stagger-list li", { opacity: 1, duration: 0.5 });
}, 3000);

document.addEventListener("DOMContentLoaded", (event) => {
  gsap.registerPlugin(ScrollTrigger);

  // 1. Hero Reveal (Immediate load)
  gsap.from(".hero h1, .hero .sub, .hero .cta-block", {
    duration: 1.2,
    y: 30,
    opacity: 0,
    stagger: 0.2,
    ease: "power3.out"
  });

  // 2. Section Reveal (Fades in as you scroll)
  // Use the class 'reveal' on any element you want to fade up
  const revealElements = gsap.utils.toArray('.reveal');
  revealElements.forEach(el => {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: "top 85%", // Starts when the top of the element hits 85% of the viewport
        toggleActions: "play none none none"
      },
      duration: 1,
      y: 40,
      opacity: 0,
      ease: "power2.out"
    });
  });

  // 3. Staggered Lists (For your benefit lists and signal lists)
  // Use the class 'stagger-list' on the <ul> and it will animate the <li>s
  const staggerLists = gsap.utils.toArray('.stagger-list');
  staggerLists.forEach(list => {
    gsap.from(list.querySelectorAll('li'), {
      scrollTrigger: {
        trigger: list,
        start: "top 80%"
      },
      duration: 0.8,
      x: -20,
      opacity: 0,
      stagger: 0.15,
      ease: "power2.out"
    });
  });
});