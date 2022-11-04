<div class="container-fluid py-3 bg-light">
    <?php if (!$passwords) { ?>
        <div class="container-fluid p-2 d-flex flex-column align-items-center ">
            <h4> Uh Oh! You have no passwords stored.</h4><br>
            <a href="<?php echo base_url("dashboard/addPassword") ?>" class="btn btn-outline-primary"> <i class="fa-solid fa-plus"></i> Add Password</a>
        </div>
    <?php } else { ?>

        <div class="container-fluid d-flex justify-content-end">
            <a href="<?php echo base_url("dashboard/addPassword") ?>" class="btn btn-outline-primary"> <i class="fa-solid fa-plus"></i> Add Password</a>

        </div>
        <div class="container-fluid mt-3 d-flex  flex-wrap">
            <?php
            foreach ($passwords as $password) {
                $password['name'] = empty($password['name']) ? $password['company_name'] : $password['name'];
                $password['site'] = empty($password['site']) ? $password['company_site'] : $password['site'];
            ?>

                <a class="PasswordContainer" style="text-decoration:none;" href="<?php echo base_url('dashboard/viewPassword/'.$password['id']) ?>">
                    <div style="display:flex;justify-content:flex-start;">
                    <div class="ImageContainer">
                        <img class="PasswordImage" src="<?php echo $password['image'] ?>" class="img-fluid" alt="company logo">

                    </div>
                    <div class="SiteContainer">
                        <span class="SiteName"><?php echo $password['name'] ?></span>
                        <span class="username d-inline-block text-truncate"  style="max-width: 215px;">Username: <?php echo $password['username'] ?></span>
                        
                    </div>
                    </div>
                    <div class="IconContainer">
                    <i id="IconRight" style="margin-right:20px;color:#ccc;" class="fa-solid fa-chevron-right"></i>
                    </div>
                </a>




            <?php
            }


            ?>
        </div>
</div>
<?php } ?>
</div>