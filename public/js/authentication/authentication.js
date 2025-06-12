document.getElementById('loginBtn').addEventListener('click', function () {
    document.getElementById('loginForm').classList.add('active');
    document.getElementById('registerForm').classList.remove('active');
    this.classList.add('active');
    document.getElementById('registerBtn').classList.remove('active');
});

document.getElementById('registerBtn').addEventListener('click', function () {
    document.getElementById('registerForm').classList.add('active');
    document.getElementById('loginForm').classList.remove('active');
    this.classList.add('active');
    document.getElementById('loginBtn').classList.remove('active');
});