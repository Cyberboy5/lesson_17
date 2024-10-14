<?php

USE App\Controllers\Controller;
use App\Controllers\TaskController;
use App\Controllers\UserController;
use App\Model\Task;
use App\Routes\Route;

// Main
Route::get('/',[Controller::class,'login_page']);
Route::post('/login',[Controller::class,'login']);

Route::get('/register',[Controller::class,'register_page']);
Route::post('/register',[Controller::class,'register']);

Route::get('/admin_page',[UserController::class,'admin_page']);
Route::post('/admin_page',[UserController::class,'admin_page']);

Route::get('/createTask',[TaskController::class,'createTask_page']);
Route::post('/createTask',[TaskController::class,'createTask']);

Route::get('/users',[UserController::class,'users_page']);

Route::post('/activateUser',[UserController::class,'activateUser']);

Route::post('/editTaskPage',[TaskController::class,'editTask_page']);

Route::post('/editTask',[TaskController::class,'editTask']);
Route::post('/deleteTask',[TaskController::class,'deleteTask']);

?>