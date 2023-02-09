<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<h1>User Registeration</h1>

<form id="register_form" action="">
    <input type="text" name="name" placeholder="Enter name">
    <br><br>
    <input type="email" name="email" placeholder="Enter email">
    <br><br>
    <input type="password" name="password" placeholder="Enter password">
    <br><br>
    <input type="password" name="password_confirmation" placeholder="Enter confirm password">
    <br><br>
    <input type="submit" value="Register">
</form>

<script>
    $(document).ready(function() {

        $('#register_form').submit(function(event) {
            event.preventDefault();
        });


    });
</script>
