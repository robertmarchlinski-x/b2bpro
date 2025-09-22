import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
  const el = document.getElementById('b2bp-admin-app');
  if (el) {
    // content already printed by PHP, Alpine binds to it
  }
});
