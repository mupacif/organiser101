<?php
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
// Home page
/*
$app->get('/', function () {
 require '../src/model.php';
 $emos = getEmotions();

    ob_start();             // start buffering HTML output
     require '../views/view.php';
    $view = ob_get_clean(); // assign HTML output to $view
    return $view;
});use Symfony\Component\HttpFoundation\JsonResponse;

*/

// Home page
 

$app->get('/addDom', function (Request $request) use($app) {
   
    $domaine = $request->get('domaine');

   
    return  $app['sql.DAO']->insertDomain($domaine);  // 201 = Created
});

$app->get('/addMat', function (Request $request) use($app) {
   
 $idDomaine = $request->get('idDom');
 $matiere = $request->get('matiere');
 
   return $app['sql.DAO']->insertMat($idDomaine,$matiere);;
});

$app->get('/addChap', function (Request $request) use($app) {
   
 $idMat = $request->get('idMat');
 $chapitre = $request->get('chapitre');
 
   return $app['sql.DAO']->insertChap($idMat,  $chapitre);
});



$app->get('/getAll', function (Request $request) use($app){
   
 
   return new JsonResponse($app['sql.DAO']->getAll());
});
$app->get('/test', function () use($app){
   
 
 $app['sql.DAO']->insert("hahaha");
   return "segpa";
});
