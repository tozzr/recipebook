<?php

require_once('./Repository.php');

class RecipeRepository extends Repository {

    function findRecipes() {
      return $this->findItems(
        "SELECT r.id, r.title, a.name AS author " .
        "FROM recipe r, author a, recipeauthors ra " .
        "WHERE ra.recipe = r.id AND ra.author = a.id;"
      );
    }

    function findRecipe($id) {
      return $this->findItem(
        "SELECT * FROM recipe WHERE id = " . $id
      );
    }

    function updateRecipe($id, $title, $subtitle, $text) {
      $this->update(
        "UPDATE recipe SET title = '" . $title . "', " .
        "subtitle = '" . $subtitle . "', " .
        "text = '" . $text . "' " .
        "WHERE id = " . $id
      );
    }
}

?>
