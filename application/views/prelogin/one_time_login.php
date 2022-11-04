<body>
    <div class="signInContainer">

        <div class="signInForm">
            <a href="<?php echo base_url('account/signin'); ?>"><i class="fa-solid fa-arrow-left"></i> Return to Login</a>
            <br><br>
            <div class="signInTitle">One Time Login Via Email</div>
            <p style="max-width:325px;">Please enter your registered email address to receive a one time login link to bypass password authentication.</p>
            <?php

            echo form_open(base_url("account/sendOneTimeLoginLink"));

            ?>



            <label for="email">Email:</label>
            <input class="signInInput" placeholder="tony@starkindustries.com" name="email" type="email" autofocus required>


            <div class="signInBtnContainer" style="justify-content:end!important;">

                <input type="submit" id="signInBtn" style="width:fit-content!important ;" onclick="this.form.submit();this.disabled = true;" class="signInBtn" class="btn btn-lg btn-success btn-block" value="Send Link" />
            </div>
            </form>
        </div>

    </div>
</body>
<script>
   
    function show_password() {
        var x = document.getElementById("password");
        var y = document.getElementsByClassName("showPasswordBtn");
        if (x.type === "password") {
            x.type = "text";
            y[0].innerHTML = "Hide Password";
        } else {
            x.type = "password";
            y[0].innerHTML = "Show Password";
        }
    }
</script>