<?php

use App\Http\Controllers\{CategoryController, FrontendController, HomeController, ProfileController, VendorController, ProductController, WishlistController, CartController, CouponController, CheckoutController, GithubController, GoogleController};
use App\Http\Controllers\SslCommerzPaymentController;
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
Route::get('/location', [HomeController::class, 'location'])->name('location');
Route::get('/my/orders', [HomeController::class, 'myorders'])->name('my.orders');
Route::get('/order/details/{id}', [HomeController::class, 'orderdetails'])->name('order.details');
Route::get('/all/orders', [HomeController::class, 'allorders'])->name('all.orders');
Route::get('/mark/as/recieved/{id}', [HomeController::class, 'markasrecieved'])->name('mark.as.recieved');
Route::get('/invoice/download', [HomeController::class, 'invoicedownload'])->name('invoice.download');
Route::get('/invoice/download/excel', [HomeController::class, 'invoicedownloadexcel'])->name('invoice.download.excel');
Route::post('/location/update', [HomeController::class, 'updatelocation'])->name('location.update');
Route::post('/rating/{id}', [HomeController::class, 'rating'])->name('rating');

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
Route::post('/get/city/list', [CheckoutController::class, 'get_city_list'])->name('get_city_list');

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/example2', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::get('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

// Login with Github Start
Route::get('/github/redirect', [GithubController::class, 'githubredirect'])->name('github.redirect');
Route::get('/github/callback', [GithubController::class, 'githubcallback'])->name('github.callback');
// Login with Github End

// Login with Google Start
Route::get('/google/redirect', [GoogleController::class, 'googleredirect'])->name('google.redirect');
Route::get('/google/callback', [GoogleController::class, 'googlecallback'])->name('google.callback');
// Login with Google End
