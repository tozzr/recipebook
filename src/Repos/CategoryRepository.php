<?php

namespace Recipebook\Repos;

require_once(__DIR__ . '/Repository.php');

class CategoryRepository extends Repository {

    function findCategories() {
      return $this->findItems(
        "SELECT id, name FROM category ORDER BY name;"
      );
    }
}

?>
