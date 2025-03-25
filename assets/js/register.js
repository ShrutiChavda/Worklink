$(document).ready(function () {
    $.validator.addMethod("nameRegex", function (value, element) {
        return /^[a-zA-Z ]+$/.test(value);
    }, "Full Name must contain only letters and spaces");

    $.validator.addMethod("emailRegex", function (value, element) {
        return /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(value);
    }, "Enter a valid email");

    $.validator.addMethod("phoneRegex", function (value, element) {
        return /^\d{10}$/.test(value);
    }, "Phone number must be exactly 10 digits");

    $.validator.addMethod("passwordMatch", function (value, element) {
        return value === $("#password").val();
    }, "Passwords do not match");

    $.validator.addMethod("fileSize", function (value, element) {
        if (element.files.length === 0) {
            return false;
        }
        return element.files[0].size <= 2 * 1024 * 1024;
    }, "File must be less than 2MB");

    $.validator.addMethod("fileType", function (value, element) {
        if (element.files.length === 0) {
            return false;
        }
        return element.files[0].type === "application/pdf";
    }, "Only PDF files are allowed");

    $('#registrationForm').validate({
        rules: {
            fullName: {
                required: true,
                nameRegex: true,
                minlength: 2,
                maxlength: 50
            },
            email: {
                required: true,
                emailRegex: true
            },
            phone: {
                required: true,
                phoneRegex: true
            },
            password: {
                required: true,
                minlength: 5,
                maxlength: 10
            },
            confirmPassword: {
                required: true,
                passwordMatch: true
            },
            fileUpload: {
                required: true,
                fileSize: true,
                fileType: true
            }
        },
        messages: {
            fullName: {
                required: "Full Name is required",
                minlength: "Full Name must have at least two characters",
                maxlength: "Full Name can have a maximum of 50 characters"
            },
            email: {
                required: "Email is required",
            },
            phone: {
                required: "Phone number is required",
            },
            password: {
                required: "Password is required",
                minlength: "Password must have at least five characters",
                maxlength: "Password can have a maximum of ten characters"
            },
            confirmPassword: {
                required: "Confirm Password is required",
                equalTo: "Passwords must match"
            },
            fileUpload: {
                required: "File upload is required",
            }
        },
        errorPlacement: function (error, element) {
            $("#" + element.attr("name") + "_err").html(error);
        }
    });
});
