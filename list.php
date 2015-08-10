<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./RecipeRepository.php');

$repo = new RecipeRepository();
$recipes = $repo->findRecipes();

echo "<!DOCTYPE html>\n" .
     "<html>\n" .
     "  <head>\n" .
     "    <title>Rezeptbuch f&uuml;r Anke und Martin</title>\n" .
     "    <meta charset=\"utf-8\" />\n" .
     "  </head>\n" .
     "  <body>\n" .
     "    <table>\n" .
     "      <colspan>\n" .
     "        <col width=\"5%\" />\n" .
     "        <col width=\"45%\" />\n" .
     "        <col width=\"40%\" />\n" .
     "        <col width=\"5%\" />\n" .
     "        <col width=\"5%\" />\n" .
     "      </colspan>\n" .
     "      <tbody>\n" .
     "        <tr><th></th><th>Rezept</th><th>Author</th><th></th><th></th></tr>\n";
              foreach ($recipes as $r) {
                echo "<tr>\n" .
                     "  <td>" . $r['id'] . "</td>\n" .
                     "  <td>" . utf8_encode($r['title']) . "</td>\n" .
                     "  <td>" . utf8_encode($r['author']) . "</td>\n" .
                     "  <td><a href=\"edit.php?id=" . $r['id'] . "\">edit</a></td>\n" .
                     "  <td><a href=\"javascript:if(confirm('delete?')) document.location = 'delete.php?id=" . $r['id'] . "'; else document.location = 'list.php';\">delete</a></td>\n" .
                     "</tr>\n";
              }
echo "      </tbody>\n" .
     "      <tfoot>\n" .
     "        <tr><td colspan=\"5\" style=\"color:red;text-align:rigth;\"><a href=\"add.php\">add</a></td></tr>\n" .
     "      </tfoot>\n" .
     "    </table>\n" .
     "</html>\n";

?>
