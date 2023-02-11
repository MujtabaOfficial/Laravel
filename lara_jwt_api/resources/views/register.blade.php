<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<style>
    span {
        color: red;
    }
</style>

<h1>User Registeration</h1>

<form id="register_form" action="">
    <input type="text" name="name" placeholder="Enter name">
    <br>
    <span class="error name_err"></span>
    <br><br>
    <input type="email" name="email" placeholder="Enter email">
    <br>
    <span class="error email_err"></span>
    <br><br>
    <input type="password" name="password" placeholder="Enter password">
    <br>
    <span class="error password_err"></span>
    <br><br>
    <input type="password" name="password_confirmation" placeholder="Enter confirm password">
    <br>
    <span class="error password_confirmation_err"></span>
    <br><br>
    <input type="submit" value="Register">
</form>

<br>
<p class="result"></p>

<script>
    $(document).ready(function() {

        $('#register_form').submit(function(event) {
            event.preventDefault();

            //get form data from serialize method
            var formData = $(this).serialize();
            $.ajax({
                url: "http://127.0.0.1:8000/api/register",
                type: "POST",
                data: formData,
                success: function(data) {
                    if (data.msg) {
                        $('#register_form')[0].reset();
                        $(".error").text("");
                        $(".result").text(data.msg);
                    } else {
                        printErrorMsg(data);
                    }
                }
            });
        });

        function printErrorMsg(msg) {
            $(".error").text(""); //get empty all fields
            $.each(msg, function(key, value) {
                if (key == 'password') {
                    if (value.length > 1) {
                        $(".password_err").text(value[0]);
                        $(".password_confirmation_err").text(value[1]);
                    } else {
                        if (value[0].includes('password confirmation')) {
                            $(".password_confirmation_err").text(value);
                        } else {
                            $(".password_err").text(value);
                        }

                    }
                } else {
                    $("." + key + "_err").text(value);
                }

            });
        }

    });
</script>
