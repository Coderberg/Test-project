'use strict';

$(document).ready(function () {

    function isValidFormData(name, email, text, token) {

        let pattern = /^[a-z0-9_-]+@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;

        if (name.length < 1) {

            $('#name').addClass('error').focus();

            return false;

        } else if (email.length < 1) {

            $('#email').addClass('error').focus();

            return false;

        } else if(email.search(pattern) !== 0){

            $('#email').addClass('error').focus();

            return false;

        } else if (text.length < 1) {

            $('#text').addClass('error').focus();

            return false;

        } else if (token.length < 1) {

            alert('Invalid csrf token');

            return false;

        } else {

            return true;
        }
    }

    function clearFields() {

        $('#name').val('');
        $('#email').val('');
        $('#text').val('');
    }

    function sendFeedback(name, email, text, token) {

        $.ajax({
            type: "POST",
            url: "/",
            data: {
                name: name,
                email: email,
                text: text,
                _csrf_token: token
            },
            success: function () {
                $("#alert").html('<div class="alert alert-success">Feedback was successfully added. Thank you!</div>');

                clearFields();
            }
        });
    }

    $('#submit').click(function () {

        let name = $('#name').val();
        let email = $('#email').val();
        let text = $('#text').val();
        let token = $('#_csrf_token').val();

        $(".error").removeClass('error');

        if (isValidFormData(name, email, text, token)) {

            sendFeedback(name, email, text, token);
        }

        return false;
    });
});
