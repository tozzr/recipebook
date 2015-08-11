<?php

require_once('./Repository.php');

class RecipeRepository extends Repository {

    function findRecipes() {
      return $this->findItems(
        "SELECT * FROM recipe r ORDER BY position ASC;"
      );
    }

    function findRecipe($id) {
      return $this->findItem(
        "SELECT id, title, subtitle, authors, text, image " .
        "FROM recipe " .
        "WHERE id = " . $id . ";"
      );
    }

    function moveRecipe($id, $pos) {
      $this->query(
        "UPDATE recipe SET pos = pos+1 " .
        "WHERE pos = " . $pos
      );
      $this->query(
        "UPDATE recipe SET pos = pos-1 " .
        "WHERE id = " . $id
      );
    }

    function createRecipe($title, $subtitle, $authors, $text, $image) {
      $res = $this->findItem("SELECT COUNT(id) AS count FROM recipe");
      $id = $this->create(
        "INSERT INTO recipe (title, subtitle, authors, text, image, position) " .
        "VALUES('" . $title . "', " .
        "'" . $subtitle . "', " .
        "'" . $authors . "', ".
        "'" . $text . "', " .
        "'" . addslashes($image) . "', " .
        $res['count'] .
        ");"
      );

      return $id;
    }

    function updateRecipe($id, $title, $subtitle, $authors, $text) {
      $this->query(
        "UPDATE recipe SET title = '" . $title . "', " .
        "subtitle = '" . $subtitle . "', " .
        "authors = '" . $authors . "', " .
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
