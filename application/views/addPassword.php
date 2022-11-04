<div class="container my-4">
    <!-- back link through referrer -->
    <div class="row">
        <div class="col-12">
            <a href="<?php echo base_url("dashboard") ?>" class="btn btn-outline-primary"> <i class="fa-solid fa-arrow-left"></i> Back</a>
        </div>
        <br>
        <br>
        <br>
    <h3>Add Password</h3>
    <?php

echo form_open(base_url("password/add"));

?>

        <div class="form-group my-2">
            <label for="company">Site ( Select any one )</label>
            
            <!-- create horizontal stacked radio boxes with company logo and name -->
            <br>
            <?php foreach ($companies as $company) { ?>

                <div class="radio" onclick="hideOthers()">
                    <input class="form-check-input" type="radio" name="company" id="<?php echo $company['company_id'] ?>" value="<?php echo $company['company_id'] ?>" checked>
                    <label class="form-check-label" for="<?php echo $company['company_id'] ?>">
                        <img src="<?php echo $company['company_imageurl'] ?>" alt="company logo"  >
                        <?php echo $company['company_name'] ?>
                    </label>

                </div>
                <?php } ?>
                <div class="radio" onclick="showOthers()">
                    <input class="form-check-input" type="radio" name="company" id="0" value="0" required>
                    <label class="form-check-label" for="0">
                        <img src="https://cdn-icons-png.flaticon.com/512/152/152529.png" alt="company logo">
                        Others
                    </label>

                </div>
        </div>
        <!-- Site name, url as input -->
        <div class="form-group my-2" id="siteName" style="display:none;">
            <label for="name">Site Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Site Name" >
        </div>
        <div class="form-group my-2" id="siteUrl" style="display:none;">
            <label for="url">Site URL</label>
            <input type="text" class="form-control" id="url" name="url" placeholder="Enter Site URL">
        </div>

        <div class="form-group my-2 ">
            <label for="username">Username / Email / Mobile No.</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter Username / Email / Mobile No." required>
        </div>
        <div class="form-group my-2">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" required>
        </div>
         <!-- Show Password -->
         <span id="passwordToggle" class="link-primary" onclick="show_password()" style="user-select: none; cursor:pointer; "> Show Password</span>
        <div class="form-group my-2">
            <label for="notes">Notes</label>
            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
        </div>
        <div class="d-grid">
        <button type="submit" onclick="this.form.submit();this.disabled = true;" class="btn btn-primary">Submit</button>
        </div>
    </div>


</div>

<script>
    function showOthers(){
        document.getElementById("siteName").style.display = "block";
        document.getElementById("siteUrl").style.display = "block";

    }
    function hideOthers(){
        document.getElementById("siteName").style.display = "none";
        document.getElementById("siteUrl").style.display = "none";
    }
    function show_password() {
        var x = document.getElementById("password");
        var y = document.getElementById("passwordToggle");
        if (x.type === "password") {
            x.type = "text";
            y.innerHTML = "Hide Password";
        } else {
            x.type = "password";
            y.innerHTML = "Show Password";
        }
    }
</script>