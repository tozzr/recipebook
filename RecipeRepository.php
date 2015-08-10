<?php

require_once('./Repository.php');

class RecipeRepository extends Repository {

    function findRecipes() {
      return $this->findItems(
        "SELECT * FROM recipe r;"
      );
    }

    function findRecipe($id) {
      return $this->findItem(
        "SELECT id, title, subtitle, text, image " .
        "FROM recipe " .
        "WHERE id = " . $id . ";"
      );
    }

    function createRecipe($title, $subtitle, $text) {
      return $this->create(
        "INSERT INTO recipe (title, subtitle, text) " .
        "VALUES('" . $title . "', '" . $subtitle . "', '" . $text . "');"
      );
    }

    function updateRecipe($id, $title, $subtitle, $text) {
      $this->query(
        "UPDATE recipe SET title = '" . $title . "', " .
        "subtitle = '" . $subtitle . "', " .
        "text = '" . $text . "' " .
        "WHERE id = " . $id
      );
    }

    function deleteRecipe($id) {
      $this->query(
        "DELETE FROM recipe WHERE id = " . $id . ";"
      );
    }
}

?>
