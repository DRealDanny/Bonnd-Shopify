document.addEventListener('DOMContentLoaded', () => {
  'use strict';
  
  // Sticky Nav Logic
  const nav = document.getElementById('navbar');
  if (nav) {
    window.addEventListener('scroll', () => {
      nav.classList.toggle('scrolled', window.scrollY > 8);
    }, { passive: true });
  }
  
  // Sidebar Toggle Logic
  const hbg = document.getElementById('hamburger'),
        sb = document.getElementById('sidebar'),
        ov = document.getElementById('sbOverlay'),
        sbc = document.getElementById('sbClose');
        
  function openSB() {
    if(!sb) return;
    sb.classList.add('open');
    ov.classList.add('open');
    hbg.setAttribute('aria-expanded', 'true');
    document.body.style.overflow = 'hidden';
  }
  
  function closeSB() {
    if(!sb) return;
    sb.classList.remove('open');
    ov.classList.remove('open');
    if(hbg) hbg.setAttribute('aria-expanded', 'false');
    document.body.style.overflow = '';
  }
  
  if (hbg) hbg.addEventListener('click', openSB);
  if (sbc) sbc.addEventListener('click', closeSB);
  if (ov) ov.addEventListener('click', closeSB);
  document.addEventListener('keydown', e => {
    if (e.key === 'Escape') closeSB();
  });
});