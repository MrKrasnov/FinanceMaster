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

   //TODO: send post request
});
