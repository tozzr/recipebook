<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./RecipeRepository.php');

$repo = new RecipeRepository();

if (isset($_POST['title'])) {
  if(file_exists($_FILES['image']['tmp_name']))
    $file_data = file_get_contents($_FILES['image']['tmp_name']);
  else
    $file_data = '';
  $id = $repo->createRecipe(
    utf8_decode($_POST['title']),
    utf8_decode($_POST['subtitle']),
    utf8_decode($_POST['authors']),
    utf8_decode($_POST['text']),
    $file_data
  );
  header('Location: ./edit.php?id=' . $id);
}

include('./views/layout_top.php');
include('./views/add.php');
include('./views/layout_bottom.php');

?>
