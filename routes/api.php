<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\ReportAlreadyFinalizedException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  return $request->user();
});

Route::get('health', function () {
  $check = DB::query()->selectRaw('1')->count();

  if ($check > 0) {
    return response()->json([
      'status' => 'ok',
      'info' => [
        'database' => [
          'status' => 'up'
        ]
      ]
    ]);
  }
  return response('', 500);
});

Route::apiResource('posts', PostController::class);
Route::apiResource('comments', CommentController::class);
Route::get('comments/list-by-post/{postId}', [CommentController::class, 'listByPost']);
