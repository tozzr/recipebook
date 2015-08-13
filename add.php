<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('./RecipeRepository.php');

$repo = new RecipeRepository();

if (isset($_POST['title'])) {
  if(file_exists($_FILES['image']['tmp_name'])) {
    $tmpName  = $_FILES['image']['tmp_name'];
    $fp = fopen($tmpName, 'rb'); // read binary
  }
  else
    $fp = null;
  $id = $repo->createRecipe(
    utf8_decode($_POST['title']),
    utf8_decode($_POST['subtitle']),
    utf8_decode($_POST['authors']),
    utf8_decode($_POST['text']),
    $fp
  );
  header('Location: ./edit.php?id=' . $id);
}

include('./views/layout_top.php');
include('./views/add.php');
include('./views/layout_bottom.php');

?>
