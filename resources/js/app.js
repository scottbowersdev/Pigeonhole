import './bootstrap';

if (localStorage.getItem('dark-mode') === 'true' || (!('dark-mode' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    localStorage.setItem('dark-mode', true);
} else {
    localStorage.setItem('dark-mode', false);
}

function showMobileMenu() {
    var menu = document.getElementById("mobile-menu");
    if(menu.style.display === "block") {
        menu.style.display = "none";
    } else {
        menu.style.display = "block";
    }
}

const lightSwitches = document.querySelectorAll('.light-switch');
if (lightSwitches.length > 0) {
    lightSwitches.forEach((lightSwitch, i) => {
    if (localStorage.getItem('dark-mode') === 'true') {
        lightSwitch.checked = true;
    }
    lightSwitch.addEventListener('change', () => {
        alert('clicked');
        const { checked } = lightSwitch;
        lightSwitches.forEach((el, n) => {
        if (n !== i) {
            el.checked = checked;
        }
        });
        if (lightSwitch.checked) {
        document.documentElement.classList.add('dark');
        localStorage.setItem('dark-mode', true);
        } else {
        document.documentElement.classList.remove('dark');
        localStorage.setItem('dark-mode', false);
        }
    });
    });
}