document.addEventListener('DOMContentLoaded', () => {
    const sections = document.querySelectorAll('.section');
    const navLinks = document.querySelectorAll('nav ul li a');

    navLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            sections.forEach(section => section.classList.remove('active'));
            navLinks.forEach(nav => nav.classList.remove('active'));

            const targetId = link.getAttribute('href').substring(1);
            document.getElementById(targetId).classList.add('active');
            link.classList.add('active');
        });
    });
});
