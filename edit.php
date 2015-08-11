<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./RecipeRepository.php');

$repo = new RecipeRepository();

if (isset($_POST['id'])) {
  $repo->updateRecipe(
    $_POST['id'],
    utf8_decode($_POST['title']),
    utf8_decode($_POST['subtitle']),
    utf8_decode($_POST['authors']),
    utf8_decode($_POST['text'])
  );
}
$r = $repo->findRecipe($_GET['id']);

include('./views/layout_top.php');
include('./views/edit.php');
include('./views/layout_bottom.php');

?>
