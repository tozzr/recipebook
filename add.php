<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./RecipeRepository.php');

$repo = new RecipeRepository();

if (isset($_POST['title'])) {
  $id = $repo->createRecipe(
    $_POST['title'],
    $_POST['subtitle'],
    $_POST['text'],
    file_get_contents($_FILES['image']['tmp_name'])
  );
  header('Location: ./edit.php?id=' . $id);
}

echo "<!DOCTYPE html>\n" .
     "<html>\n" .
     "  <head>\n" .
     "    <title>Rezeptbuch f&uuml;r Anke und Martin</title>\n" .
     "    <meta charset=\"utf-8\" />\n" .
     "  </head>\n" .
     "  <body>\n" .
     "    <form method=\"POST\" enctype=\"multipart/form-data\">\n" .
     "      <label>Titel</label><input type=\"text\" name=\"title\" value=\"\" />\n" .
     "      <br />\n" .
     "      <label>Untertitel</label><input type=\"text\" name=\"subtitle\" value=\"\" />\n" .
     "      <br />\n" .
     "      <label>Text</label><textarea name=\"text\" rows=\"25\" cols=\"80\"></textarea>\n" .
     "      <br />\n" .
     "      <input type=\"file\" name=\"image\" />\n" .
     "      <br />\n" .
     "      <button type=\"submit\">save</button>\n" .
     "      <a href=\"list.php\">cancel</a>\n" .
     "    </form>\n" .
     "  </body>\n" .
     "</html>\n";

?>
