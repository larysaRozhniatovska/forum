<form action="<?= \app\core\Route::url('theme','updateMessage')?>"
      method="post" name="formEditMessage" id="formEditMessage"
      class="w3-panel  w3-center "  >
    <div class="w3-modal-content ">
        <header class="w3-container w3-teal">
            <h1 class="w3-border-left w3-text-red w3-xlarge ">Edit Message</h1>
            <a href="<?= \app\core\Route::url('theme','backToTheme')?>">
                <span class="w3-button w3-display-topright">&times;
            </span></a>
        </header>
        <input type="hidden" name="idMessage" value="<?=$message['id'] ?>">
        <div class="div-colum">
            <label for="id-message">Content</label>
            <textarea  name="message" id="id-message"
                <?php if(empty($message)): ?>
                placeholder="Enter message"
                <?php endif; ?> ><?php if(!empty($message)):?><?=$message['text']?><?php endif;?></textarea>
        </div>
        <div class="w3-container w3-center w3-margin-bottom w3-margin-top ">
            <button class="w3-btn w3-teal w3-margin-bottom" style="min-width:50%">Edit</button>
        </div>
    </div>
</form>