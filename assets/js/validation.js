document.getElementById('registrationForm').addEventListener('submit', function (e) {
    e.preventDefault();
    let errors = false;

    let fullName = document.getElementById('fullName').value;
    let email = document.getElementById('email').value;
    let phone = document.getElementById('phone').value;
    let password = document.getElementById('password').value;
    let confirmPassword = document.getElementById('confirmPassword').value;

    if (fullName.trim() === '') {
        document.getElementById('fullNameError').innerText = "Full Name is required";
        errors = true;
    } else {
        document.getElementById('fullNameError').innerText = "";
    }

    if (!email.match(/^\S+@\S+\.\S+$/)) {
        document.getElementById('emailError').innerText = "Invalid email format";
        errors = true;
    } else {
        document.getElementById('emailError').innerText = "";
    }

    if (!phone.match(/^\d{10}$/)) {
        document.getElementById('phoneError').innerText = "Invalid phone number";
        errors = true;
    } else {
        document.getElementById('phoneError').innerText = "";
    }

    if (password.length < 6) {
        document.getElementById('passwordError').innerText = "Password must be at least 6 characters";
        errors = true;
    } else {
        document.getElementById('passwordError').innerText = "";
    }

    if (password !== confirmPassword) {
        document.getElementById('confirmPasswordError').innerText = "Passwords do not match";
        errors = true;
    } else {
        document.getElementById('confirmPasswordError').innerText = "";
    }

    if (!errors) {
        this.submit();
    }
});
