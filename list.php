<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./RecipeRepository.php');

$repo = new RecipeRepository();
$recipes = $repo->findRecipes();

echo "<!DOCTYPE html>\n" .
     "<html>\n" .
     "  <body>\n" .
     "    <table>\n" .
     "      <colspan>\n" .
     "        <col width=\"50%\" />\n" .
     "        <col width=\"40%\" />\n" .
     "        <col width=\"5%\" />\n" .
     "        <col width=\"5%\" />\n" .
     "      </colspan>\n" .
     "      <tbody>\n" .
     "        <tr><th>Rezept</th><th>Author</th><th></th><th></th></tr>\n";
              foreach ($recipes as $r) {
                echo "<tr>\n" .
                     "  <td>" . $r['title'] . "</td>\n" .
                     "  <td>" . $r['author'] . "</td>\n" .
                     "  <td><a href=\"edit.php?id=" . $r['id'] . "\">edit</a></td>\n" .
                     "  <td><a href=\"\">delete</a></td>\n" .
                     "</tr>\n";
              }
echo "      </tbody>\n" .
     "    </table>\n" .
     "</html>\n";

?>
