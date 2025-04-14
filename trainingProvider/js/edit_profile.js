$(document).ready(function () {

    $.validator.addMethod("emregex", function (value1, element1) {
        var regex1 = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        return regex1.test(value1);
    }, "Enter a valid email");

    $.validator.addMethod("pnregex", function (value, element) {
        var regex = /^[+\d]+$/;
        return regex.test(value);
    }, "Phone number must contain only digits");

    $.validator.addMethod("psregex", function (value2, element2) {
        var psgex1 = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
        return psgex1.test(value2);
    }, "Password must contain capital letters, small letters, numbers, and special characters.");

    $('#registrationForm').validate({
        rules: {
            fn: {
                required: true,
                minlength: 2,
                maxlength: 30,
                fnregex: true
            },
            em: {
                required: true,
                emregex: true
            },
            pn: {
                required: true,
                minlength: 10,
                maxlength: 10,
                pnregex: true
            },
        },
        messages: {
            fn: {
                required: "First Name is a required field",
                minlength: "First Name must have at least two characters",
                maxlength: "First Name can have a maximum of 30 characters",
            },
            em: {
                required: "Email is a required field",
                emregex: "Enter a valid email",
            },
            pn: {
                required: "Contact number is a required field",
                minlength: "Contact number must contain 10 digits",
                maxlength: "Do not enter more than 10 digits",
                pnregex: "Phone number must contain only digits"
            },
        },

        errorPlacement: function (error, element) {
            error.appendTo(element.closest('div').find('.error-message'));
        },
        
        highlight: function (element) {
            $(element).closest('div').addClass('has-error');
        },
        
        unhighlight: function (element) {
            $(element).closest('div').removeClass('has-error');
        }
    });

    $('#submitBtn').click(function () {
        if ($('#registrationForm').valid()) {
            alert("Form is valid!");
        } else {
            var errorMessages = [];
            $('#registrationForm .error').each(function () {
                errorMessages.push($(this).text());
            });
            alert("Errors: \n" + errorMessages.join("\n"));
        }
    });
});
