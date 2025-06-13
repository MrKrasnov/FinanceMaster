document.getElementById('loginBtn').addEventListener('click', function () {
    openLoginForm()
});

document.getElementById('registerBtn').addEventListener('click', function () {
    openRegisterForm()
});

const registerForm = document.getElementById('registerForm');

registerForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(registerForm);

    for (const [name, value] of formData.entries()) {
        if(!value.trim()) {
            alert(`The field "${name}" is required and cannot be empty.`);
            return;
        }
    }

    const dataObj = Object.fromEntries(formData.entries());

   if(dataObj.password.trim() !== dataObj["repeat-password"].trim()) {
       alert("Passwords do not match. Please check and try again.");
       return;
   }

    fetch('/authentication/registration', {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json'
        }
    })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            alert("Registration successful!");
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Something went wrong during registration.");
        });
});

function openLoginForm() {
    document.getElementById('loginForm').classList.add('active');
    document.getElementById('registerForm').classList.remove('active');
    document.getElementById('loginBtn').classList.add('active');
    document.getElementById('registerBtn').classList.remove('active');
}

function openRegisterForm() {
    document.getElementById('registerForm').classList.add('active');
    document.getElementById('loginForm').classList.remove('active');
    document.getElementById('registerBtn').classList.add('active');
    document.getElementById('loginBtn').classList.remove('active');
}