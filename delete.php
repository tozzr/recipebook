<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./RecipeRepository.php');

$repo = new RecipeRepository();

if (isset($_GET['id'])) {
  $repo->deleteRecipe($_GET['id']);
}
header('Location: ./list.php');

?>
