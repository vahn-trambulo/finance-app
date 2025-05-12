<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

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

Route::get('/', function () {
    return 'Welcome to Lumen';
});

Route::get('/table-data', function () {
    // Example 1: Using DB facade (assuming you have a database connection)
    try {
        $data = DB::table('users')->select('id', 'full_name', 'email', 'username', 'position')->get();
        // Ensure that your 'users' table has these columns: name, email, username, position
        return response()->json($data);
    } catch (\Exception $e) {
        // Handle database connection errors or table not found errors
        return response()->json(['error' => 'Failed to fetch data: ' . $e->getMessage()], 500);
    }

});
