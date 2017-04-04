<?php 
use Silex\Application;

$user = $app['controllers_factory'];

$user->get('/', function(Application $app){
	$users = $app['conn']->query('SELECT name, email FROM users');

	return $app->json($users->fetchAll(\PDO::FETCH_ASSOC));
});

return $user;