<body>
    <div class="signInContainer">

        <div class="signInForm">
            <div class="signInTitle">Create an account</div>


            <?php

            echo form_open(base_url("account/register"));

            ?>

            <label for="email">Name:</label>
            <input class="signInInput" placeholder="Tony Stark" name="name" type="text" autofocus required>

            <label for="email">Email:</label>
            <input class="signInInput" placeholder="tony@starkindustries.com" name="email" type="email" required>

            <label for="password">Password:</label>
            <div class="password_container">
                <input id="password" class="signInInput" placeholder="●●●●●●●●●●" name="password" type="password" value="" required>
                <span class="showPasswordBtn" id="showPasswordBtn" onclick="show_password()"> <i class="fa-regular fa-eye"></i></span>
            </div>
            <label for="password">Confirm Password:</label>
            <div class="password_container">
                <input id="confirmpassword" class="signInInput" placeholder="●●●●●●●●●●" name="confirmPassword" type="confirmpassword" value="" required>
                <span class="showPasswordBtn" id="showPasswordBtn" onclick="show_password()"> <i class="fa-regular fa-eye"></i></span>
            </div>

            <p>By clicking Sign Up you agree to our <a target="__blank" href="<?php echo base_url("account/privacypolicy") ?>">Privacy Policy</a><br> & <a target="__blank" href="<?php echo base_url("account/termsofservice") ?>">Terms of Service</a>.</p>
            <!-- Show Password -->

            <!-- <div class="checkbox">
                <label>
                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                </label>
            </div> -->
            <div class="signInBtnContainer">
                <a href="<?php echo base_url("account/signin") ?>">Already have an account?</a>
                <!-- Change this to a button or input when using this as a form -->
                <input type="submit" onsubmit="this.form.submit();this.disabled = true;" class="signInBtn" class="btn btn-lg btn-success btn-block" value="Sign Up" />
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
            y[0].innerHTML = '<i class="fa-regular fa-eye-slash"></i>';
        } else {
            x.type = "password";
            y[0].innerHTML = "<i class='fa-regular fa-eye'></i>";
        }
    }
</script>