<?php

require_once('./Repository.php');

class RecipeRepository extends Repository {

    function findRecipes() {
      return $this->findItems(
        "SELECT r.title, a.name AS author " .
        "FROM recipe r, author a, recipeauthors ra " .
        "WHERE ra.recipe = r.id AND ra.author = a.id;"
      );
    }
}

?>
