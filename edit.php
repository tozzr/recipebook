<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./RecipeRepository.php');

$repo = new RecipeRepository();

if (isset($_POST['id'])) {
  $repo->updateRecipe($_POST['id'], $_POST['title'], $_POST['subtitle'], $_POST['text']);
}
$r = $repo->findRecipe($_GET['id']);

echo "<!DOCTYPE html>\n" .
     "<html>\n" .
     "  <head>\n" .
     "    <title>Rezeptbuch f&uuml;r Anke und Martin</title>\n" .
     "    <meta charset=\"utf-8\" />\n" .
     "  </head>\n" .
     "  <body>\n" .
     "    <form method=\"POST\">\n" .
     "      <input type=\"hidden\" name=\"id\" value=\"" . $r['id'] . "\" />\n" .
     "      <label>Titel</label><input type=\"text\" name=\"title\" value=\"" . $r['title'] . "\" />\n" .
     "      <br />\n" .
     "      <label>Untertitel</label><input type=\"text\" name=\"subtitle\" value=\"" . $r['subtitle'] . "\" />\n" .
     "      <br />\n" .
     "      <label>Text</label><textarea name=\"text\" rows=\"25\" cols=\"80\">" . $r['text'] . "</textarea>\n" .
     "      <br />\n" .
     "      <img src=\"data:image/jpeg;base64," . base64_encode($r['image']) . "\" width=\"100%\" />\n" .
     "      <br />\n" .
     "      <button type=\"submit\">save</button>\n" .
     "      <a href=\"list.php\">cancel</a>\n" .
     "    </form>\n" .
     "  </body>\n" .
     "</html>\n";

?>
