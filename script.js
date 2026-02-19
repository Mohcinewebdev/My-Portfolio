const navLinks = document.querySelector('.nav-links');
function onToggleMenu(e) {
    e.name = e.name === 'menu' ? 'close' : 'menu';
    navLinks.classList.toggle('top-[9%]')
}

const btn = document.getElementById("toggle-dark");
const body = document.body;

btn.onclick = () => {
  body.classList.toggle("dark");
  btn.textContent = body.classList.contains("dark") ? "☀️" : "🌙";
};
