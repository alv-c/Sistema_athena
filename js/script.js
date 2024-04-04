$(document).ready(function () {
    var navbar = document.getElementById('navbar');
    document.addEventListener("scroll", function() {
        var posicaoy = window.pageYOffset;
        navbar.style.padding = posicaoy == 0 ? '1.6rem 1rem' : '1.2rem 1rem';
        navbar.style.background = posicaoy == 0 ? 'rgba(192, 192, 192, .7)' : 'rgba(192, 192, 192, .9)';
    });
})