<?php if(!empty($error)) :  ?>
    <div id="errorModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('errorModal').style.display='none'">&times;</span>
            <p><?= $error ?></p>
        </div>

    </div>
<?php endif;?>
<div class="div-admin">
    <div>
        <div class="w3-container w3-padding w3-teal">
            <button class="w3-right " type="button" >
                <a href="<?= \app\core\Route::url('user','signOutUser')?>"> <i class="fa fa-sign-out" aria-hidden="true"></i></a></button>
            <div class="w3-right w3-margin-right "><i class="fa fa-user-o" aria-hidden="true"></i><?= $login ?></div>
        </div>
        <a href="<?= \app\core\Route::url('theme')?>">Themes</a>
        <h1><?= $theme['title']?></h1>
        <div><?= $theme['description']?></div>
        <div>
            <div class="w3-container w3-margin-bottom">
                <button id="id-add" type="button" class="w3-left w3-btn w3-light-blue"
                        onclick="document.getElementById('formModalAdd').style.display='block'">Add Message</button>
            </div>

        </div>
    </div>
    <div>
        <?php if(!empty($messages)) : ?>
            <?php foreach($messages as $message) : ?>
                <div class="container">
                    <div class="div-row">
                        <div class="div-colum">
                            <div class="user"> <?=$message['login']?></div>
                            <div class="div-row">
                                <form action="<?= \app\core\Route::url('theme','editMessage')?>" method="post">
                                    <input type="hidden" name="idEditMessage" value="<?=$message['id']?>">
                                    <button ><i class="fa fa-pencil-square-o" aria-hidden="true" style="color:rgb(255,125,0)"></i></button>
                                </form>
                                <form action="<?= \app\core\Route::url('theme','delMessage')?>" method="post">
                                    <input type="hidden" name="idDelMessage" value="<?=$message['id'] ?>">
                                    <button><i class="fa fa-trash-o" aria-hidden="true" style="color:red"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="div-description"> <?=$message['text']?></div>
                        <div class="div-colum">
    <!--                        <div class="user"> --><?php //=$theme['login']?><!--</div>-->
                            <div class="user"> <?=$message['created_at']?></div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p> No Message </p>
        <?php endif; ?>
    </div>
</div>
<form action="<?= \app\core\Route::url('theme','addMessage')?>"
      method="post" name="formAddMessage" id="formModalAdd"
      class="w3-panel  w3-center w3-modal"  >
    <div class="w3-modal-content ">
        <header class="w3-container w3-teal">
            <h1 class="w3-border-left w3-text-red w3-xlarge ">Add Message</h1>
            <span onclick="document.getElementById('formModal').style.display='none'"
                  class="w3-button w3-display-topright">&times;
            </span>
        </header>
        <input type="hidden" name="idTheme" value="<?=$theme['id'] ?>">
        <div class="div-colum">
            <label for="id-message">Content</label>
            <textarea  name="message" id="id-message" placeholder="Enter message"> </textarea>
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
