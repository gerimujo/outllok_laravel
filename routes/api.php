<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\execute;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post("createaccount", [execute::class, "create"]);
Route::post("merrhyrjemeail1", [execute::class, "merrhyrjemeail"]);
Route::post("hryjetamam1", [execute::class, "hryjetamam"]);
Route::get("marrhyrjedata1", [execute::class, "marrhyrjedata"]);
Route::post("hyrracc1", [execute::class, "hyrracc"]);
Route::get("mesazheSendmarr1", [execute::class, "mesazheSendmarr"]);
Route::post("sendmesazh1", [execute::class, "sendmesazh"]);
Route::get("marrinbox1", [execute::class, "marrinbox"]);
Route::post("hapmesazhe1", [execute::class, "hapmesazhe"]);
Route::get("marrmesazhehap1", [execute::class, "marrmesazhehap"]);
Route::post("sendReply1", [execute::class, "sendReply"]);
Route::get("marrsentlist1", [execute::class, "marrsentlist"]);
Route::get("marrmesazhehap11", [execute::class, "marrmesazhehap1"]);