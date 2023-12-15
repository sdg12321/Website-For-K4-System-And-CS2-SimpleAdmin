function toggleMenu() {
    var navList = document.querySelector('.nav-list');
    navList.classList.toggle('show');
}

// Adaugă această funcție pentru a marca pagina activă
function setActivePage() {
    var currentLocation = window.location.pathname;
    var navItems = document.querySelectorAll('.nav-list a');

    navItems.forEach(function (item) {
        if (item.getAttribute('href') === currentLocation) {
            item.classList.add('active');
        } else {
            item.classList.remove('active');
        }
    });
}

// Apelează funcția pentru a marca pagina activă la încărcarea paginii
window.addEventListener('load', setActivePage);
