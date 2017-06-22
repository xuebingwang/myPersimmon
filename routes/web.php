<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
define('DATE', date("Y-m-d"));
define('NOW', date("Y-m-d H:i:s"));

/**
 * 前台
 */
include_once 'app.php';

/**
 * 后台
 */
include_once 'backend.php';


