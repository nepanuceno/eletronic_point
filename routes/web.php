<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Acl\RoleController;
use App\Http\Controllers\Acl\RoleUserController;
use App\Http\Controllers\User\UserController;

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

Auth::routes();
Route::get('/',[HomeController::class, 'index']);
Route::get('/home',[HomeController::class, 'index'])->name('home');
Route::get('users/switch-active',[ UserController::class, 'switchUserShowStatus'])->name('users.switch-active');
Route::resource('roles', RoleController::class);
Route::resource('users', UserController::class)->middleware('auth');
Route::resource('role_user', RoleUserController::class);
Route::get('roles_user/{id}', [RoleUserController::class, 'roles_user']);
Route::get('delete_roles_user/{user}/{role}', [RoleUserController::class, 'delete_roles_user']);
Route::get('/get_all_users_active', [UserController::class, 'getAllActiveUsers'])->name('get-all-users-active');
