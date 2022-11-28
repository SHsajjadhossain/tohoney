<?php

use App\Http\Controllers\{CategoryController, FrontendController, HomeController, ProfileController, VendorController, ProductController, WishlistController, CartController, CouponController, CheckoutController};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontendController::class, 'index'])->name('frontend');
Route::get('product/details/{slug}', [FrontendController::class, 'productdetails'])->name('productdetails');
Route::get('shoppage', [FrontendController::class, 'shoppage'])->name('shoppage');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/mail/box', [HomeController::class, 'mailbox'])->name('mailbox');
Route::get('/send/mail/{id}', [HomeController::class, 'sendmail'])->name('sendmail');
Route::post('/check/mail', [HomeController::class, 'checkmail'])->name('checkmail');
Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
Route::post('/profile/name/change', [ProfileController::class, 'namechange'])->name('profile.namechange');
Route::post('/profile/password/change', [ProfileController::class, 'passwordchange'])->name('passwordchange');
Route::post('/profile/photo/change', [ProfileController::class, 'photochange'])->name('profile.photochange');

Route::resource('category', CategoryController::class);
Route::resource('vendor', VendorController::class);
Route::resource('product', ProductController::class);
Route::resource('wishlist', WishlistController::class);
Route::resource('coupon', CouponController::class);

Route::get('/wishlist/insert/{product_id}', [WishlistController::class, 'insert'])->name('wishlist.insert');
Route::get('/wishlist/remove/{wishlist_id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
Route::get('/wishtocart/{wishlist_id}', [CartController::class, 'wishtocart'])->name('wishtocart');
Route::post('/add/to/cart/{product_id}', [CartController::class, 'addtocart'])->name('addtocart');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/cart/remove/{cart_id}', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/clear/cart/{user_id}', [CartController::class, 'clearcart'])->name('clearcart');
Route::post('/cart/update', [CartController::class, 'cartupdate'])->name('cartupdate');

Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'checkoutpost'])->name('checkoutpost');
