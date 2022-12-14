<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\Admin\AdminDashboard;
use App\Http\Livewire\User\UserDashboard;
use App\Http\Livewire\ProductDetail;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\Admin\AdminCategory;
use App\Http\Livewire\Admin\AdminAddCategory;
use App\Http\Livewire\Admin\AdminEditCategory;

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

// Route::get('/', function () {
//     return view('welcome');
// });

//Livewire
Route::get('/', HomeComponent::class);
Route::get('/shop', ShopComponent::class);
Route::get('/cart', CartComponent::class)->name('product.carts');
Route::get('/checkout', CheckoutComponent::class);
Route::get('/product/{slug}', ProductDetail::class)->name('product.details');
Route::get('/product-category/{category_id}/{category_name}', CategoryComponent::class)->name('product.category');
Route::get('/search', SearchComponent::class)->name('product.search');

//Authentication Using Livewire & jetstream
/* Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
}); */

//User Route
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/user/dashboard', UserDashboard::class)->name('user.dashboard');
});

//Admin Route
Route::middleware(['auth:sanctum', 'verified', 'adminauth'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/admin/category', AdminCategory::class)->name('admin.category');
    Route::get('/admin/category/add', AdminAddCategory::class)->name('admin.categoryadd');
    Route::get('/admin/category/edit/{category_slug}', AdminEditCategory::class)->name('admin.editcategory');
});

