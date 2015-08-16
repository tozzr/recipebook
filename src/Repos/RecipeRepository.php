<?php

namespace Recipebook\Repos;

require_once(__DIR__ . '/Repository.php');

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

    function createRecipe($title, $subtitle, $authors, $email, $text, $image) {
      $res = $this->countItems("recipe");
      $id = $this->create(
        "INSERT INTO recipe (title, subtitle, authors, email, text, position) " .
        "VALUES(:title, :subtitle, :authors, :email, :text, :pos)",
        array(
          "title" => $title,
          "subtitle" => $subtitle,
          "authors" => $authors,
          "email" => $email,
          "text" => $text,
          "pos" => $res['count']
        )
      );
      if ($image)
        $this->saveBlob(
          "UPDATE recipe SET image = :image WHERE id = :id",
          $id,
          $image
        );
      return $id;
    }

    function updateRecipe($id, $title, $subtitle, $authors, $email, $text, $image) {
      $this->query(
        "UPDATE recipe SET title = :title, " .
        "subtitle = :subtitle, " .
        "authors = :authors, " .
        "email = :email, " .
        "text = :text " .
        "WHERE id = :id;",
        array(
          "id" => $id,
          "title" => $title,
          "subtitle" => $subtitle,
          "authors" => $authors,
          "email" => $email,
          "text" => $text
        )
      );
      if ($image)
        $this->saveBlob(
          "UPDATE recipe SET image = :image WHERE id = :id",
          $id,
          $image
        );
    }

    function deleteRecipe($id) {
      $this->delete("recipe", $id);
    }
}

?>
