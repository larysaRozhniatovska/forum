<form action="<?= \app\core\Route::url('user','loginUser')?>" method="post"
      class="w3-panel w3-card-4 w3-content w3-center" name="formSignIn" style="max-width:400px">
    <div >
        <h1 class="w3-border-left w3-text-red w3-xlarge">LOGIN</h1>
        <div class="w3-margin-bottom">
            <label for="id-login">Login</label>
            <input class="w3-input" type="text" name="login" id="id-login" placeholder="Enter login">
        </div>
        <div class="w3-margin-bottom">
            <label for="id-pass">Password</label>
            <i class="w3-right fa fa-eye-slash" id="eye"></i>
            <input class="w3-input" type="password" name="pass" id="id-pass" placeholder="Enter password">
        </div>
        <div class="w3-container w3-center w3-margin-bottom w3-margin-top">
            <button class="w3-btn w3-teal" style="min-width:50%">Sign In</button>
        </div>
        <div class="w3-container w3-margin-bottom">
            <button id="id-register" type="button" class="w3-left w3-btn w3-light-blue"
                    onclick="document.getElementById('formModal').style.display='block'">Register</button>
        </div>

    </div>
</form>
<?php if (!empty($messageNoUser)): ?>
    <div class="w3-panel w3-card-4 w3-display-middle w3-red" id="messageNoUser">
        <p><?= htmlspecialchars($messageNoUser); ?></p>
    </div>
<?php endif; ?>
<?php if (!empty($errorsLogin)): ?>
    <ul class="w3-red w3-left w3-left-align" id="errorsLogin" >
        <?php foreach ($errorsLogin as $key => $error):?>
            <li > <?= $error; ?> </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>


<form action="<?= \app\core\Route::url('index','addUser')?>" method="post" name="formSignOut" id="formModal"
      class="w3-panel  w3-center w3-modal"  >
    <div class="w3-modal-content ">
        <header class="w3-container w3-teal">
            <h1 class="w3-border-left w3-text-red w3-xlarge ">REGISTER</h1>
            <span onclick="document.getElementById('formModal').style.display='none'"
                  class="w3-button w3-display-topright">&times;
            </span>

        </header>
        <div class="w3-margin">
            <label for="id-reglogin">Login</label>
            <input class="w3-input" type="text" name="reglogin" id="id-reglogin" placeholder="Enter login">
        </div>
        <div class="w3-margin ">
            <label for="id-regpass">Password</label>
            <i class="w3-right fa fa-eye-slash" id="eye-regpass"></i>
            <input class="w3-input" type="password" name="regpass" id="id-regpass" placeholder="Enter password">
        </div>
        <div class="w3-margin">
            <label for="id-reregpass">Repeat Password</label>
            <i class="w3-right fa fa-eye-slash" id="eye-reregpass"></i>
            <input class="w3-input" type="password" name="reregpass" id="id-reregpass" placeholder="Enter password">
        </div>
        <div class="w3-container w3-center w3-margin-bottom w3-margin-top ">
            <button class="w3-btn w3-teal w3-margin-bottom" style="min-width:50%">Add</button>
        </div>

        <?php if (!empty($errorsAdd)): ?>
            <ul class="w3-red w3-left w3-left-align" id="errorsAdd">
                <?php foreach ($errorsAdd as $key => $error):?>
                    <li> <?= $error; ?> </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
</form>
<?php if (!empty($errorsAdd)): ?>
<script>
    let form = document.forms.formSignOut;
    console.log(form);
    form.style.display='block';
</script>
<?php endif; ?>