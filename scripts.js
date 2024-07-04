// scripts.js
document.addEventListener('DOMContentLoaded', () => {
    const homeLink = document.getElementById('home-link');
    const loginLink = document.getElementById('login-link');
    const signupLink = document.getElementById('signup-link');
    const profileLink = document.getElementById('profile-link');

    const homeSection = document.getElementById('home');
    const loginSection = document.getElementById('login');
    const signupSection = document.getElementById('signup');
    const profileSection = document.getElementById('profile');

    homeLink.addEventListener('click', () => {
        showSection(homeSection);
    });

    loginLink.addEventListener('click', () => {
        showSection(loginSection);
    });

    signupLink.addEventListener('click', () => {
        showSection(signupSection);
    });

    profileLink.addEventListener('click', () => {
        showSection(profileSection);
    });

    function showSection(section) {
        const sections = document.querySelectorAll('.section');
        sections.forEach(sec => sec.classList.remove('active'));
        section.classList.add('active');
    }

    // Initially show the home section
    showSection(homeSection);
});
