(function() {

    document.addEventListener("DOMContentLoaded", function() {
        var elements = document.getElementsByTagName("INPUT");
        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = function(e) {
                e.target.setCustomValidity("");
                if (!e.target.validity.valid) {
                    e.target.setCustomValidity("Ovo polje je obavezno");
                }
            };
            elements[i].oninput = function(e) {
                e.target.setCustomValidity("");
            };
        }
    })

    $(document).on('keydown', 'input', () => {
        $('.errorMsg').remove();
        $('.successMsg').remove();
    });
    
    $(document).on('submit', '#regForm', (e) => {
        e.preventDefault();
        if(checkPasswords(e)) {
            registerUser(e);
        }
    });
    
    async function registerUser(e) {
        var email = $(e.target).find('input[name="email"]').val();
        var username = $(e.target).find('input[name="username"]').val();
        var newpassword = $(e.target).find('input[name="newpassword"]').val();
    
        let userExist = await isUserExist(email, username); //'username', 'email' or false
    
        if (userExist == 'email') {
            //error emai exist
            $('#regForm').prepend(
                '<p class="errorMsg">Email već registrovan</p>');
            setTimeout(() => {
                $('.errorMsg').remove();
            }, 3000);
        } else if(userExist == 'username') {
            //error username exist
            $('#regForm').prepend(
                '<p class="errorMsg">Korisničko ime već registrovano</p>');
            setTimeout(() => {
                $('.errorMsg').remove();
            }, 3000);
        } else if(userExist == 'false') {
            register({
                email: email,
                password: newpassword,
                username: username,
                captcha: grecaptcha.getResponse()
            });
        }
    }
    
    /**
     * check if username or email exist
     * return false if dont exist
     * return 'username' if username exist
     * return 'email' if email exist
     */
    function isUserExist(email, username) {
        return new Promise((resolve) => {
            $.ajax({
                method: "POST",
                url: filesPath + '/scripts/isUserExist.php',
                data: {
                    email: email,
                    username: username
                },
                success: function(data) {
                    resolve(data); //'username', 'email' or 'false'
                }
            });
        });
    }
    
    function register(dataObj) {
        $('#regForm input').attr('disabled', true);
        $.ajax({
            method: "POST",
            url: filesPath + '/scripts/register.php',
            data: dataObj,
            success: function(data) {
                $('#regForm input').attr('disabled', false);
                grecaptcha.reset(); // Reset reCaptcha
            }
        });
    }

    function checkPasswords(e) {
        const password = document.querySelector('input[name=newpassword]');
        const confirm = document.querySelector('input[name=repeatedpassword]');
        if (confirm.value !== password.value) {
            $('#regForm').prepend(
                '<p class="errorMsg">Šifre se ne poklapaju</p>');
            setTimeout(() => {
                $('.errorMsg').remove();
            }, 3000);
            return false;
        }
        else {
            return true;
        }
        
    }

})();