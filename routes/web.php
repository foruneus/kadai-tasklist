<?php

Route::get('/', 'TasksController@index');
Route::resource('task', 'TasksController');
