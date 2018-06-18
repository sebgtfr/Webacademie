<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/**
 * User's routes
 */
$router->get("/user", "UserController@show");
$router->get("/user/{id:[0-9]+}", "UserController@show");
$router->post("/user", "UserController@create");
$router->put("/user/{id:[0-9]+}", "UserController@update");
$router->delete("/user/{id:[0-9]+}", "UserController@delete");

/**
 * Skill's routes
 */
$router->get("/skill/{id:[0-9]+}", "SkillController@show");
$router->post("/skill", "SkillController@create");
//$router->put("/skill/{id:[0-9]+}", "SkillController@update");
$router->delete("/skill/{id:[0-9]+}", "SkillController@delete");

/**
 * User and Skill's routes
 */

/**
 * Project's routes
 */
$router->get("/project", "ProjectController@show");
$router->get("/project/{id:[0-9]+}", "ProjectController@show");
$router->post("/project", "ProjectController@create");
$router->put("/project/{id:[0-9]+}", "ProjectController@update");
$router->delete("/project/{id:[0-9]+}", "ProjectController@delete");
