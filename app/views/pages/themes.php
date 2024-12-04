<div class="div-admin">
    <div>
        <div class="w3-container w3-padding w3-teal">
            <button class="w3-right " type="button" >
                <a href="<?= \app\core\Route::url('user','signOutUser')?>"> <i class="fa fa-sign-out" aria-hidden="true"></i></a></button>
            <div class="w3-right w3-margin-right "><i class="fa fa-user-o" aria-hidden="true"></i><?= $login ?></div>
        </div>

    </div>
    <div>
        <div class="w3-container w3-margin-bottom">
            <button id="id-add" type="button" class="w3-left w3-btn w3-light-blue"
                    onclick="document.getElementById('formModal').style.display='block'">Add Theme</button>
        </div>
    </div>
    <div>
        <?php if(!empty($themes)) : ?>
        <?php foreach($themes as $theme) : ?>
           <div class="div-row">
               <form action="<?= \app\core\Route::url('theme','viewTheme')?>" method="post">
                   <input type="hidden" name="idTheme" value="<?=$theme['id']?>">
                   <button class="title"><?=$theme['title']?></button>
               </form>
               <div class="div-description"> <?=$theme['description']?></div>
               <div class="div-colum">
                   <div class="user"> <?=$theme['login']?></div>
                   <div class="user"> <?=$theme['time']?></div>
               </div>
           </div>
        <?php endforeach; ?>

        <?php else: ?>

        <?php endif; ?>
    </div>


</div>
<form action="<?= \app\core\Route::url('theme','addTheme')?>"
      method="post" name="formAddTheme" id="formModal"
      class="w3-panel  w3-center w3-modal"  >
    <div class="w3-modal-content ">
        <header class="w3-container w3-teal">
            <h1 class="w3-border-left w3-text-red w3-xlarge ">Add Theme</h1>
            <span onclick="document.getElementById('formModal').style.display='none'"
                  class="w3-button w3-display-topright">&times;
            </span>
        </header>
        <div class="w3-margin">
            <label for="id-title">Title</label>
            <input class="w3-input" type="text" name="title" id="id-title" placeholder="Enter title">
        </div>
        <div class="div-colum">
            <label for="id-description">Content</label>
            <textarea  name="description" id="id-description" placeholder="Enter description"> </textarea>
        </div>
        <?php if (!empty($errorsAdd)): ?>
            <!--            <ul class="w3-red w3-left w3-left-align" id="errorsLogin" >-->
            <p class="w3-red w3-center w3-center-align" id="errorsAdd" > <?= $errorsAdd; ?> </p>
        <?php endif; ?>
        <div class="w3-container w3-center w3-margin-bottom w3-margin-top ">
            <button class="w3-btn w3-teal w3-margin-bottom" style="min-width:50%"> Add</button>
        </div>
    </div>
</form>
<?php if (!empty($errorsAdd)): ?>
    <script>
        let form = document.forms.formAddTheme;
        console.log(form);
        form.style.display='block';
    </script>
<?php endif; ?>