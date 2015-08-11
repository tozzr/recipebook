<?php
require_once('./views/_helper.php');
?>

<form method="POST" enctype="multipart/form-data">
  <div class="left">
    <input type="hidden" name="id" value="<?php puts($r['id']) ?>" />
    <label>Titel</label><input type="text" name="title" value="<?php puts($r['title']) ?>" />
    <br />
    <label>Untertitel</label><input type="text" name="subtitle" value="<?php puts($r['subtitle']) ?>" />
    <br />
    <label>Autoren</label><input type="text" name="authors" value="<?php puts($r['authors']) ?>" />
    <br />
    <label>Text</label><textarea name="text" rows="28" cols="80"><?php puts($r['text']) ?></textarea>
  </div>
  <div class="right">
    <img src="data:image/jpeg;base64,<?php puts(base64_encode($r['image'])) ?>" max-height="500" width="100%"/>
  </div>
  <div class="full">
    <button type="submit">save</button>
    <a href="list.php">cancel</a>
  </div>
</form>
