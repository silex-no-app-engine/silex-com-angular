<?php 
chdir(dirname(__DIR__));

require 'vendor/autoload.php';

use Silex\Application;
use CodeExperts\View;

$app = new Application();

$app['debug'] = true;

$app->get('/', function(Application $app){
   $view = new View(__DIR__ . '/../views/index.phtml', $app);
   $view->name = "Nanderson";
   return $view->render();
});

$app->mount('/api', function($api) use ($app){
	$api->mount('/users', require __DIR__ . '/../src/Controller/UserController.php');
});

/**
 * Registrando Twig
 */
$app->register(new Silex\Provider\TwigServiceProvider(),
		['twig.path' => 'views/']
	);

$app['conn'] = function(Application $app) {
	$pdo = new \PDO(
		"mysql:dbname=sae;host:127.0.0.1",
		"root", ""
	);

	if($app['debug']) {
		$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	return $pdo;
};

$app->run();