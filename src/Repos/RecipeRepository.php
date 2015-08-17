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

    function createRecipe($title, $subtitle, $chef, $authors, $email, $text, $image1, $image2, $image3) {
      $res = $this->countItems("recipe");
      $id = $this->create(
        "INSERT INTO recipe (title, subtitle, chef, authors, email, text, position) " .
        "VALUES(:title, :subtitle, :chef, :authors, :email, :text, :pos)",
        array(
          "title" => $title,
          "subtitle" => $subtitle,
          "chef" => $chef,
          "authors" => $authors,
          "email" => $email,
          "text" => $text,
          "pos" => $res['count']
        )
      );
      if ($image1)
        $this->saveBlob(
          "UPDATE recipe SET image1 = :image WHERE id = :id",
          $id,
          $image1
        );
      if ($image2)
        $this->saveBlob(
          "UPDATE recipe SET image2 = :image WHERE id = :id",
          $id,
          $image2
        );
      if ($image3)
        $this->saveBlob(
          "UPDATE recipe SET image3 = :image WHERE id = :id",
          $id,
          $image3
        );
      return $id;
    }

    function updateRecipe($id, $title, $subtitle, $chef, $authors, $email, $text, $image1, $image2, $image3) {
      $this->query(
        "UPDATE recipe SET title = :title, " .
        "subtitle = :subtitle, " .
        "chef = :chef, " .
        "authors = :authors, " .
        "email = :email, " .
        "text = :text " .
        "WHERE id = :id;",
        array(
          "id" => $id,
          "title" => $title,
          "subtitle" => $subtitle,
          "chef" => $chef,
          "authors" => $authors,
          "email" => $email,
          "text" => $text
        )
      );
      if ($image1)
        $this->saveBlob(
          "UPDATE recipe SET image1 = :image WHERE id = :id",
          $id,
          $image1
        );
      if ($image2)
        $this->saveBlob(
          "UPDATE recipe SET image2 = :image WHERE id = :id",
          $id,
          $image2
        );
      if ($image3)
        $this->saveBlob(
          "UPDATE recipe SET image3 = :image WHERE id = :id",
          $id,
          $image3
        );
    }

    function deleteRecipe($id) {
      $this->delete("recipe", $id);
    }
}

?>
