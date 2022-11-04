<body>
    <div class="signInContainer">

        <div class="signInForm">
            <div class="signInTitle">Reset Password</div>
            <?php

            echo form_open(base_url("account/changePassword"));

            ?>




            <label for="password">New Password:</label>
            <input id="password" class="signInInput" placeholder="●●●●●●●●●●" name="password" type="password" onkeyup="checkPassword()" required>

            <!-- Show Password -->
            <div style="display:flex;flex-direction:row;justify-content:end">
                <span class="showPasswordBtn" id="showPasswordBtn" onclick="show_password()"> Show Password</span>

            </div>
            <label for="password">Confirm Password:</label>
            <input id="confirmPassword" class="signInInput" placeholder="●●●●●●●●●●" name="confirmPassword" type="password" onkeyup="checkPassword()" required>

            <!-- Show Password -->
            <div style="display:flex;flex-direction:row;justify-content:end">
                <span class="showPasswordBtn" id="showConfirmPasswordBtn" onclick="show_Confirmpassword()"> Show Password</span>

            </div>
            <!-- <div class="checkbox">
                <label>
                    <input name="remember" type="checkbox" value="Remember Me">Remember Me
                </label>
            </div> -->
            <div class="signInBtnContainer">
                <div id="passwordCheck"></div>
                <input type="hidden" name="token" value="<?php echo $this->input->get('token'); ?>">
                <input type="hidden" name="email" value="<?php echo $this->input->get('email'); ?>">
                <input type="submit" style="width: fit-content;" class="signInBtn" id="resetPasswordBtn" class="btn btn-lg btn-success btn-block" onclick="this.form.submit();this.disabled = true;" value="Reset Password" disabled />
            </div>
            </form>
        </div>

    </div>
</body>
<script>
    function checkPassword() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('confirmPassword').value;
        var resetPasswordBtn = document.getElementById('resetPasswordBtn');
        if (password != confirmPassword || password == "" || confirmPassword == "") {
            document.getElementById('passwordCheck').innerHTML = "<i class=\"fa-solid fa-xmark\"></i> Password doesn't match";
            document.getElementById('passwordCheck').style.color = "red";
            resetPasswordBtn.disabled = true;
        } else {
            document.getElementById('passwordCheck').innerHTML = "<i class=\"fa-solid fa-check\"></i> Password matched";
            document.getElementById('passwordCheck').style.color = "green";
            resetPasswordBtn.disabled = false;
        }
    }

    function show_password() {
        var x = document.getElementById("password");
        var y = document.getElementById("showPasswordBtn");
        if (x.type === "password") {
            x.type = "text";
            y[0].innerHTML = "Hide Password";
        } else {
            x.type = "password";
            y[0].innerHTML = "Show Password";
        }
    }

    function show_Confirmpassword() {
        var x = document.getElementById("confirmPassword");
        var y = document.getElementById("showConfirmPasswordBtn");
        if (x.type === "password") {
            x.type = "text";
            y[0].innerHTML = "Hide Password";
        } else {
            x.type = "password";
            y[0].innerHTML = "Show Password";
        }
    }
</script>