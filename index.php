<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'vendor/autoload.php';
require 'src/Repos/RecipeRepository.php';

$repo = new \Recipebook\Repos\RecipeRepository();

$app = new \Slim\Slim(array(
    'templates.path' => './views',
    'view' => new \Slim\Views\Twig()
));
$app->contentType('text/html; charset=utf-8');

$app->get('/', function() use($app, $repo) {
  $app->redirect('/recipes');
});

$app->get('/recipes(/)', function() use($app, $repo) {
  if ($app->request->get('id') != null && $app->request->get('pos') != null) {
    $repo->moveRecipe($app->request->get('id'), $app->request->get('pos'));
    $app->redirect('/recipes?active=' . $app->request->get('id'));
  }
  $app->render('list.html', array(
    'recipes' => $repo->findRecipes(),
    'activeId' => $app->request->get('active')
  ));
});

$app->get('/recipes/form', function () use($app) {
  $app->render('create.html');
})->name('create-form');

$app->post('/recipes', function() use($app, $repo){
  if(file_exists($_FILES['image']['tmp_name'])) {
    $tmpName  = $_FILES['image']['tmp_name'];
    $fp = fopen($tmpName, 'rb'); // read binary
  }
  else
    $fp = null;
  $id = $repo->createRecipe(
    utf8_decode($app->request->post('title')),
    utf8_decode($app->request->post('subtitle')),
    utf8_decode($app->request->post('authors')),
    utf8_decode($app->request->post('email')),
    utf8_decode($app->request->post('text')),
    $fp
  );
  $app->redirect('/recipes/' . $id);
})->name('create');

$app->get('/recipes/:id', function ($id) use($app, $repo) {
  $r = $repo->findRecipe($id);
  $app->render('edit.html', array(
    'r' => $r,
    'image' => utf8_encode(base64_encode($r['image']))
  ));
})->name('read')->conditions(array('id' => '\d+'));

$app->put('/recipes/:id', function ($id) use($app, $repo) {
  if(file_exists($_FILES['image']['tmp_name'])) {
    $tmpName  = $_FILES['image']['tmp_name'];
    $fp = fopen($tmpName, 'rb'); // read binary
  }
  else
    $fp = null;
  $repo->updateRecipe(
    $id,
    utf8_decode($app->request->post('title')),
    utf8_decode($app->request->post('subtitle')),
    utf8_decode($app->request->post('authors')),
    utf8_decode($app->request->post('email')),
    utf8_decode($app->request->post('text')),
    $fp
  );
  $app->redirect('/recipes/' . $id);
})->name('update')->conditions(array('id' => '\d+'));

$app->delete('/recipes/:id', function ($id) use($app, $repo) {
  $repo->deleteRecipe($id);
  $app->redirect('/recipes');
})->name('delete')->conditions(array('id' => '\d+'));

$app->run();
