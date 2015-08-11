<?php

require_once('./Repository.php');

class RecipeRepository extends Repository {

    function findRecipes() {
      return $this->findItems(
        "SELECT * FROM recipe ORDER BY position ASC;"
      );
    }

    function findRecipe($id) {
      return $this->findItemById("recipe", $id);
    }

    function moveRecipe($id, $pos) {
      $item = $this->findItemById("recipe", $id);
      $other = $this->findItemByPosition("recipe", $pos);
      $this->query(
        "UPDATE recipe SET position = :pos WHERE id = :id;",
        array("pos" => $pos, "id" => $id)
      );
      $this->query(
        "UPDATE recipe SET position = :pos WHERE id = :id;",
        array("pos" => $item['position'], "id" => $other['id'])
      );
    }

    function createRecipe($title, $subtitle, $authors, $text, $image) {
      $res = $this->countItems("recipe");
      return $this->create(
        "INSERT INTO recipe (title, subtitle, authors, text, image, position) " .
        "VALUES(:title, :subtitle, :authors, :text, :image, :pos)",
        array(
          "title" => $title,
          "subtitle" => $subtitle,
          "authors" => $authors,
          "text" => $text,
          "image" => addslashes($image),
          "pos" => $res['count']
        )
      );
    }

    function updateRecipe($id, $title, $subtitle, $authors, $text) {
      $this->query(
        "UPDATE recipe SET title = :title, " .
        "subtitle = :subtitle, " .
        "authors = :authors, " .
        "text = :text " .
        "WHERE id = :id;",
        array(
          "id" => $id,
          "title" => $title,
          "subtitle" => $subtitle,
          "authors" => $authors,
          "text" => $text
        )
      );
    }

    function deleteRecipe($id) {
      $this->delete("recipe", $id);
    }
}

?>
