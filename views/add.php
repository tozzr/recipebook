<?php
require_once('./views/_helper.php');
?>

<form method="POST" enctype="multipart/form-data">
  <div class="left">
    <label>Titel</label><input type="text" name="title" value="" />
    <br />
    <label>Untertitel</label><input type="text" name="subtitle" value="" />
    <br />
    <label>Autoren</label><input type="text" name="authors" value="" />
    <br />
    <label>Text</label><textarea name="text" rows="25" cols="80"></textarea>
    <br />
    <label>E-Mail</label><input type="text" name="email" value="" />
  </div>
  <div class="right">
    <input type="file" name="image" />
  </div>
  <div class="full">
    <button type="submit">save</button>
    <a href="list.php">cancel</a>
  </div>
</form>
