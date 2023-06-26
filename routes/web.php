<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';


Route::get('/notifications', App\Http\Livewire\Notifications::class);

// WEB
Route::group([
    'namespace' => 'App\Http\Controllers\Web',
], function() {
    Route::get('/', 'WebController@index');
    Route::post('/inbox', 'WebController@inbox')->name('web.inbox');
});
// ADMIN
Route::redirect('admin', 'admin/dashboard');
Route::group([
    'middleware' => 'auth',
    'namespace' => 'App\Http\Controllers',
    'prefix' => 'admin'
], function() {
    Route::get('dashboard', 'AppController@index')->name('dashboard');
    Route::get('profile', ['as' => 'users.profile', 'uses' => 'UserController@profile']);

    Route::patch('users/change_password/{user}', ['as' => 'users.change_password', 'uses' => 'UserController@change_password']);
    Route::get('users/index_data', ['as' => 'users.index_data', 'uses' => 'UserController@index_data']);
    Route::resource('users', 'UserController');

    Route::get('experiences/index_data', ['as' => 'experiences.index_data', 'uses' => 'ExperienceController@index_data']);
    Route::resource('experiences', 'ExperienceController');
    
    
    Route::get('galleries/index_data', ['as' => 'galleries.index_data', 'uses' => 'GalleryController@index_data']);
    Route::resource('galleries', 'GalleryController');

    Route::get('missions/index_data', ['as' => 'missions.index_data', 'uses' => 'MissionController@index_data']);
    Route::resource('missions', 'MissionController');

    Route::get('inboxes/index_data', ['as' => 'inboxes.index_data', 'uses' => 'InboxController@index_data']);
    Route::resource('inboxes', 'InboxController');

    Route::get('inventory-items/index_data', ['as' => 'inventory-items.index_data', 'uses' => 'InventoryItemController@index_data']);
    Route::resource('inventory-items', 'InventoryItemController');

    Route::get('inventory-categories/index_data', ['as' => 'inventory-categories.index_data', 'uses' => 'InventoryCategoryController@index_data']);
    Route::resource('inventory-categories', 'InventoryCategoryController');
    
    Route::get('inventory-validations/index_data', ['as' => 'inventory-validations.index_data', 'uses' => 'InventoryValidationController@index_data']);
    Route::post('inventory-validations/bulk', ['as' => 'inventory-validations.bulk', 'uses' => 'InventoryValidationController@bulk']);
    Route::post('inventory-validations/confirmed/{id}', ['as' => 'inventory-validations.confirmed', 'uses' => 'InventoryValidationController@confirmed']);
    Route::resource('inventory-validations', 'InventoryValidationController');

    Route::get('inventory-logs/index_data', ['as' => 'inventory-logs.index_data', 'uses' => 'InventoryLogController@index_data']);
    Route::get('inventory-logs/out_data', ['as' => 'inventory-logs.out_data', 'uses' => 'InventoryLogController@out_data']);
    Route::get('inventory-logs/in_data', ['as' => 'inventory-logs.in_data', 'uses' => 'InventoryLogController@in_data']);
    Route::get('inventory-logs/all_data', ['as' => 'inventory-logs.all_data', 'uses' => 'InventoryLogController@all_data']);

    Route::get('inventory-logs/items_data/{id}', ['as' => 'inventory-logs.item_data', 'uses' => 'InventoryLogController@item_data']);
    Route::get('inventory-logs/items_data', ['as' => 'inventory-logs.items_data', 'uses' => 'InventoryLogController@items_data']);

    Route::get('inventory-logs/in', ['as' => 'inventory-logs.in', 'uses' => 'InventoryLogController@in']);
    Route::get('inventory-logs/out', ['as' => 'inventory-logs.out', 'uses' => 'InventoryLogController@out']);
    Route::get('inventory-logs/all', ['as' => 'inventory-logs.all', 'uses' => 'InventoryLogController@all']);
    Route::get('inventory-logs/items', ['as' => 'inventory-logs.items', 'uses' => 'InventoryLogController@items']);
    Route::get('inventory-logs/items/{id}', ['as' => 'inventory-logs.item', 'uses' => 'InventoryLogController@item']);

    Route::get('inventory-export/{type}', ['as' => 'inventory-export.view', 'uses' => 'InventoryExportController@view']);
    Route::post('inventory-export/{type}', ['as' => 'inventory-export.export', 'uses' => 'InventoryExportController@export']);

    Route::resource('inventory-logs', 'InventoryLogController');

    Route::get('invoice', ['as' => 'invoice.index', 'uses' => 'InvoiceController@index']);
    Route::post('invoice', ['as' => 'invoice.create', 'uses' => 'InvoiceController@create']);

    Route::resource('setting', 'SettingController')->only(['index', 'store']);
});


