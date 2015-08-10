<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./RecipeRepository.php');

$repo = new RecipeRepository();
$recipes = $repo->findRecipes();

echo "<table>" .
     "  <tbody>" .
     "    <tr><th>Rezept</th><th>Author</th><th></th></tr>";
          foreach ($recipes as $r) {
            echo "<tr>\n" .
                 "  <td>" . $r['title'] . "</td>" .
                 "  <td>" . $r['author'] . "</td>" .
                 "</tr>";
          }
echo "  </tbody>" .
     "</table>";

?>
