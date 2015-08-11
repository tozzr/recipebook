<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./RecipeRepository.php');

$repo = new RecipeRepository();

if (isset($_GET['id']) && isset($_GET['pos']))
  $repo->moveRecipe($_GET['id'], $_GET['pos']);

$recipes = $repo->findRecipes();

include('./views/layout_top.php');
include('./views/list.php');
include('./views/layout_bottom.php');

?>
