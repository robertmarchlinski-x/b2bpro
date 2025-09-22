import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
  const el = document.getElementById('b2bp-admin-app');
  if (el) {
    el.innerHTML = `<div x-data="{msg: 'Witaj w B2B Pro!'}"><h2 x-text="msg"></h2></div>`;
  }
});
