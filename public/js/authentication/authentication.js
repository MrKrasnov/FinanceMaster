document.getElementById('loginBtn').addEventListener('click', function () {
    openLoginForm()
});

document.getElementById('registerBtn').addEventListener('click', function () {
    openRegisterForm()
});

const registerForm = document.getElementById('registerForm');
const loginForm = document.getElementById('loginForm');

loginForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const formData = new FormData(loginForm);

    for (const [name, value] of formData.entries()) {
        if (!value.trim()) {
            alert(`The field "${name}" is required and cannot be empty.`);
            return;
        }
    }

    fetch('/authentication/authentication', {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json'
        }
    })
        .then(async response => {
            const text = await response.text();
            let data;
            try {
                data = JSON.parse(text);
            } catch (e) {
                throw new Error("Invalid JSON from server");
            }

            if (!response.ok) {
                throw new Error(data.error || 'Unknown server error');
            }

            window.location.href = '/';
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || "Something went wrong during login.");
        });
});

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

    //TODO: set limit length for email and login

    fetch('/authentication/registration', {
        method: 'POST',
        body: formData,
        headers: {
            'Accept': 'application/json'
        }
    })
        .then(async response => {
            const text = await response.text();
            let data;

            try {
                data = JSON.parse(text);
            } catch (e) {
                // console.error("Server did not return valid JSON:", text); //for debug!
                throw new Error("Invalid JSON from server");
            }

            if (!response.ok) {
                throw new Error(data.error || 'Unknown server error');
            }

            openLoginForm()
            let id = data.data.id ?? null
            if (id) {
                console.log('created user: ' + id)
            }
            alert("Registration successful!");
        })
        .catch(error => {
            console.error('Error:', error);
            if (error.code === 409) {
                alert(error);
            } else {
                alert("Something went wrong during registration.");
            }
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