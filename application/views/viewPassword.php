<?php 


$password['name'] = empty($password['name']) ? $password['company_name'] : $password['name'];
$password['site'] = empty($password['site']) ? $password['company_site'] : $password['site'];
?>
<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Do you really want to delete this password?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger"  onclick="window.location.replace('<?php echo base_url('password/delete/'.$password['id']) ?>')">Delete Password <i class="fa-solid fa-trash-can"></i></button>
        <button type="button" data-bs-dismiss="modal" class="btn btn-secondary">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid p-4 bg-light">
    <!-- back link through referrer -->
    <div id="alertBox" class="alert  "> </div>
    <a href="<?php echo base_url("dashboard") ?>" class="btn btn-outline-primary"> <i class="fa-solid fa-arrow-left"></i> Back</a>


    <br>
    <div class="container d-flex flex-column justify-content-center align-content-center" style="max-width:450px;">
        <div style="display:flex;flex-direction:row;justify-content:center;">
            <div class="pwsdImageContainer">
                <img style="height:70px;" src="<?php echo $password['image'] ?>" class="img-fluid" alt="company logo">
            </div>
        </div>

        <div class="pswdSiteDetails">
            <a class="text-primary" target="__blank" href="https://<?php echo $password['site'] ?>"><?php echo $password['name'] ?> <i class="fa-solid fa-up-right-from-square"></i> </a>


        </div>
        

        <div class="pswdUsername">
            <span class="d-inline-block text-truncate" >Username </span>
            <div class="container-fluid p-0 d-flex flex-row justify-content-start align-content-center">
                <input type="text" id="username" style="display:none;" value=" <?php echo $password['username'] ?>">
                <span class="username"><?php echo $password['username'] ?> </span><button class="copyUsername"><i class="fa-solid fa-copy"></i></button>
            </div>
        </div>
        <div class="pswdPassword ">
            <span class="d-inline-block text-truncate" >Password</span>
            <div class="container-fluid p-0 d-flex flex-row justify-content-start align-content-center">
                <input type="text" id="password" style="display:none;" value=" <?php echo $password['pswd_enc'] ?>">
                <span class="password "><?php echo $password['pswd_enc'] ?></span><button class="copyPassword"><i class="fa-solid fa-copy"></i></button>
            </div>
            <button id="showPassword" class="btn btn-outline-primary  align-self-end">Show Password</button>
        </div>
        <div >
        <?php echo !empty($password["notes"]) ? 'Notes </div><div class="align-self-center notesContainer">' . $password["notes"] : '' ?>
        </div>
        <div class="d-grid mt-5">
            <button class="btn  btn-danger"  data-bs-toggle="modal" data-bs-target="#deleteModal" >Delete Password <i class="fa-solid fa-trash-can"></i></button>
        </div>
    </div>
</div>

<script>
    const copyUsernameBtn = document.querySelector('.copyUsername');
    const copyPasswordBtn = document.querySelector('.copyPassword');
    const username = document.querySelector('#username');
    const password = document.querySelector('#password');
    const usernameContainer = document.querySelector('.pswdUsername');
    const pswdContainer = document.querySelector('.pswdPassword');
    const alertBox = document.querySelector('#alertBox');
    copyUsernameBtn.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(username.value);
                alertBox.classList.add('alert-success');
                alertBox.innerHTML = "Username copied to clipboard";
                alertBox.style.display = "block";
                setTimeout(() => {
                    alertBox.style.display = "none";
                }, 2000);
            } catch (err) {
                console.log(err);
                alertBox.classList.add('alert-danger');
                alertBox.innerHTML = "Unable to copy to clipboard";
                alertBox.style.display = "block";
                setTimeout(() => {
                    alertBox.style.display = "none";
                }, 2000);
            }
        }

    );
    copyPasswordBtn.addEventListener('click', async () => {
            try {
                await navigator.clipboard.writeText(password.value);
                alertBox.classList.add('alert-success');
                alertBox.innerHTML = "Password  copied to clipboard";
                alertBox.style.display = "block";
                setTimeout(() => {
                    alertBox.style.display = "none";
                }, 2000);

            } catch (err) {
                console.log(err);
                alertBox.classList.add('alert-danger');
                alertBox.innerHTML = "Unable to copy to clipboard";
                alertBox.style.display = "block";
                setTimeout(() => {
                    alertBox.style.display = "none";
                }, 2000);
            }
        }

    );

    const showPasswordBtn = document.querySelector('#showPassword');
    const passwordSpan = document.querySelector('.password');
    onload = () => {
        passwordSpan.textContent = "********";
        alertBox.style.display = "none";
    }
    showPasswordBtn.addEventListener('click', () => {
        if (passwordSpan.textContent == password.value) {
            passwordSpan.textContent = "********";
            showPasswordBtn.textContent = "Show Password";
        } else {
            passwordSpan.textContent = password.value;
            showPasswordBtn.textContent = "Hide Password";
        }
    });
</script>