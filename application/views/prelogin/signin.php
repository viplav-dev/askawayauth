<body>
    <div class="signInContainer">

        <div class="signInForm">
            <div class="signInTitle">Login to account</div>
           
            <button class="oneTimeLoginBtn" onclick="window.location.href='<?php echo base_url('account/oneTimeLogin') ?>'">One Time Login via Email</button>
            <hr>

            <?php

            echo form_open(base_url("account/login"));

            ?>



            <label for="email">Email:</label>
            <input class="signInInput" placeholder="tony@starkindustries.com" name="email" type="email" autofocus required>

            <label for="password">Password:</label>
            <div class="password_container">
                <input id="password" class="signInInput" placeholder="●●●●●●●●●●" name="password" type="password" value="" required>
                <span class="showPasswordBtn" id="showPasswordBtn" onclick="show_password()"> <i class="fa-regular fa-eye"></i></span>
            </div>
            <!-- Show Password -->
            <div style="display:flex;flex-direction:row;justify-content:end">
                
                <a class="showPasswordBtn" href="<?php echo base_url("account/forgotPassword") ?>"> Forgot Password?</a>
            </div>
            <!-- <div class="checkbox">
                <label>
                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                </label>
            </div> -->
            <div class="signInBtnContainer">
                <a href="<?php echo base_url("account/signup") ?>">Don't have an account?</a>
                <!-- Change this to a button or input when using this as a form -->
                <input type="submit" onsubmit="this.form.submit();this.disabled = true;" class="signInBtn" class="btn btn-lg btn-success btn-block" value="Login" />
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