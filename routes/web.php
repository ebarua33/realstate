<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\EmailVerificationPromptController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'userIndex']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserController::class, 'userProfile'])->name('profile_user');
    Route::post('/profile/store', [UserController::class, 'userStoreProfile'])->name('store.profile');
    Route::get('/user/logout', [UserController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/password', [UserController::class, 'userChangePassword'])->name('edit.password');
    Route::post('/store_password', [UserController::class, 'userStorePassword'])->name('store.password');
});


    //___________Admin Route Group_________//

Route::middleware(['auth', 'role:admin'])->group(function(){

    Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('/admin/profile', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store/{id}', [AdminController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminController::class, 'adminUpdatePassword'])->name('admin.update.password');

});

 //___________End Of Admin Route_________//


//___________Agent Route Group_________//

Route::middleware(['auth', 'role:agent'])->group(function () {

    Route::get('/agent/dashboard', [AgentController::class, 'agentDashboard'])->name('agent.dashboard');
});

//___________End Of Agent Route_________//


Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');

Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('admin/property/all-type', 'propertyAllType')->name('property.all.type');
    });
});









require __DIR__.'/auth.php';
