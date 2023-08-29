<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyTypeController;

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\backend\AmenitiesController;
use App\Http\Controllers\Backend\PropertyController;

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
    Route::get('password', [UserController::class, 'userUpdatePassword'])->name('password');
    Route::post('store/password', [UserController::class, 'userStorePassword'])->name('store.password');
});


//___________Admin Route Group_________//

Route::middleware(['auth', 'role:admin'])->group(function () {

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

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::controller(PropertyTypeController::class)->group(function () {
        Route::get('admin/property/all-type', 'propertyAllType')->name('property.all.type');
        Route::get('admin/property/add-type', 'propertyAddType')->name('add.type');
        Route::post('admin/property/store-type', 'propertyStoreType')->name('store.type');
        Route::get('admin/property/edit-type/{id}', 'propertyEditType')->name('edit.type');
        Route::post('admin/property/update-type/{id}', 'propertyUpdateType')->name('update.type');
        Route::get('admin/property/destroy-type/{id}', 'propertyDestroyType')->name('destroy.type');
    });

    Route::controller(AmenitiesController::class)->group(function(){
        Route::get('admin/amenities/all', 'amenitiesAll')->name('all.amenities');
        Route::get('admin/amenities/add', 'amenitiesAdd')->name('add.amenities');
        Route::post('admin/amenities/store', 'amenitiesStore')->name('store.amenities');
        Route::get('admin/amenities/edit/{id}', 'amenitiesEdit')->name('edit.amenities');
        Route::post('admin/amenities/update/{id}', 'amenitiesUpdate')->name('update.amenities');
        Route::get('admin/amenities/destroy/{id}', 'amenitiesDestroy')->name('destroy.amenities');
    });

    Route::controller(PropertyController::class)->group(function () {
        Route::get('admin/property/all', 'propertyAll')->name('all.property');
        Route::get('admin/property/add', 'propertyAdd')->name('add.property');
        Route::post('admin/property/store', 'propertyStore')->name('store.property');
        Route::get('admin/property/edit/{id}', 'propertyEdit')->name('edit.property');
        Route::post('admin/property/update/{id}', 'propertyUpdate')->name('update.property');
        Route::get('admin/property/destroy/{id}', 'propertyDestroy')->name('destroy.property');
    });
});









require __DIR__ . '/auth.php';
