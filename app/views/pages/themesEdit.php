<form action="<?= \app\core\Route::url('theme','updateTheme')?>"
      method="post" name="formEditTheme" id="formEditTheme"
      class="w3-panel  w3-center "  >
    <div class="w3-modal-content ">
        <header class="w3-container w3-teal">
            <h1 class="w3-border-left w3-text-red w3-xlarge ">Edit Theme</h1>
            <a href="<?= \app\core\Route::url('theme','backToThemes')?>">
                <span class="w3-button w3-display-topright">&times;
            </span></a>
        </header>
        <input type="hidden" name="idTheme" value="<?=$theme['id'] ?>">
        <div class="w3-margin">
            <label for="id-title">Title</label>
            <input class="w3-input" type="text" name="title" id="id-title"
                <?php if(empty($theme)):?> placeholder="Enter title" <?php else: ?>value="<?=$theme['title']?>"<?php endif; ?>>
        </div>
        <div class="div-colum">
            <label for="id-description">Content</label>
            <textarea  name="description" id="id-description"
                <?php if(empty($theme)): ?>
                    placeholder="Enter message"
                <?php endif; ?> ><?php if(!empty($theme)):?><?=$theme['description']?><?php endif;?></textarea>
        </div>
        <div class="w3-container w3-center w3-margin-bottom w3-margin-top ">
            <button class="w3-btn w3-teal w3-margin-bottom" style="min-width:50%">Edit</button>
        </div>
    </div>
</form>
