<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CancelledproductController;
use App\Http\Controllers\CartproductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CookbookCategoryController;
use App\Http\Controllers\CookbookItemController;
use App\Http\Controllers\CookbookNavbarController;
use App\Http\Controllers\CookbookSubcategoryController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestorderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SocialMediaController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorCategoryController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorOrderController;
use App\Http\Controllers\VendorProductController;
use App\Http\Controllers\VendorSubcategoryController;
use App\Http\Controllers\WishlistproductController;
use App\Models\CookbookItem;
use App\Models\Ingredient;
use App\Models\Product;
use App\Models\Review;
use App\Models\Slider;
use App\Models\Subcategory;
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

Route::get('/', function () {
    $slider = Slider::latest()->get();
    $subcategories = Subcategory::latest()->get();
    $featuredproducts = Product::latest()->where('featured', 1)->where('status', 1)->take(15)->get();
    $offerproducts = Product::latest()->where('discount', '>', 0)->where('status', 1)->take(6)->get();
    $filterproducts = Product::latest()->where('status', 1)->take(8)->get();
    $ratedproducts = Review::orderBy('rating', 'DESC')->with('product')->take(8)->get();
    return view('frontend.index', compact('subcategories', 'featuredproducts', 'offerproducts', 'filterproducts', 'ratedproducts', 'slider'));
})->name('index');

Route::get('/home', [FrontController::class, 'index'])->name('home');
Route::get('/shop', [FrontController::class, 'shop'])->name('shop');
Route::get('/offers', [FrontController::class, 'offers'])->name('offers');
Route::get('/about', [FrontController::class, 'about'])->name('about');
Route::get('/termsandconditions', [FrontController::class, 'termsandconditions'])->name('termsandconditions');
Route::get('/privacypolicy', [FrontController::class, 'privacypolicy'])->name('privacypolicy');
Route::get('/contact', [FrontController::class, 'contact'])->name('contact');
Route::get('/products/{slug}/{id}', [FrontController::class, 'products'])->name('products');
Route::get('/checkout', [FrontController::class, 'checkout'])->name('checkout');
Route::get('/subcategories/{subcategoryslug}', [FrontController::class, 'subcategories'])->name('subcategories');

// Cart
Route::get('/cart', [FrontController::class, 'cart'])->name('cart');
Route::post('/addtocart/{id}', [FrontController::class, 'addtocart'])->name('addtocart');
Route::get('/removefromcart/{id}', [FrontController::class, 'removefromcart'])->name('removefromcart');
Route::post('/updatequantity/{id}', [FrontController::class, 'updatequantity'])->name('updatequantity');

// Checkout
Route::get('/checkout/{id}', [FrontController::class, 'checkout'])->name('checkout');
Route::post('/placeorder', [FrontController::class, 'placeorder'])->name('placeorder');

// Wishlist
Route::get('/wishlist', [FrontController::class, 'wishlist'])->name('wishlist');
Route::get('/addtowishlist/{id}', [FrontController::class, 'addtowishlist'])->name('addtowishlist');
Route::get('/removefromwishlist/{id}', [FrontController::class, 'removefromwishlist'])->name('removefromwishlist');

//User Review
Route::post('/addreview', [FrontController::class, 'addreview'])->name('addreview');
Route::put('/updatereview/{id}', [FrontController::class, 'updatereview'])->name('updatereview');
Route::delete('/deleteuserreview/{id}', [FrontController::class, 'deleteuserreview'])->name('deleteuserreview');
Route::get('/myreviews', [FrontController::class, 'myreviews'])->name('myreviews');

//User Account
Route::get('/myaccount', [FrontController::class, 'myaccount'])->name('myaccount');
Route::get('/myprofile', [FrontController::class, 'myprofile'])->name('myprofile');
Route::get('/editinfo', [FrontController::class, 'editinfo'])->name('editinfo');
Route::get('/sendemailchange', [FrontController::class, 'sendemailchange'])->name('sendemailchange');
Route::get('/useremailchange', [FrontController::class, 'useremailchange'])->name('user.emailchange');
Route::get('/send-otpemail', [FrontController::class, 'sendotpEmail'])->name('sendotp');
Route::get('/otpvalidation', [FrontController::class, 'otpvalidation'])->name('otpvalidation');
Route::put('/updatepassword', [FrontController::class, 'updatePassword'])->name('updatepassword');
Route::get('/myorders', [FrontController::class, 'myorders'])->name('myorders');
Route::put('/cancelorder/{id}', [FrontController::class, 'cancelorder'])->name('cancelorder');

Route::get('/editcustomeraddress', [FrontController::class, 'editcustomeraddress'])->name('editcustomeraddress');
Route::put('/updateaddress/{id}', [FrontController::class, 'updateaddress'])->name('updateaddress');

// Customer Email
Route::get('/customerEmail', [FrontController::class, 'customerEmail'])->name('customerEmail');

// Sign in with google
Route::get('auth/google', [SocialMediaController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [SocialMediaController::class, 'handleGoogleCallback']);

// Sign in with facebook
Route::get('auth/facebook', [SocialMediaController::class, 'redirectToFacebook']);
Route::get('auth/facebook/callback', [SocialMediaController::class, 'facebookSignin']);

//Search
Route::get('/search/{slug}', [FrontController::class, 'search'])->name('search');

//Request Order
Route::get('/requestProduct', [FrontController::class, 'requestProduct'])->name('requestProduct');
Route::post('/storeProductRequest', [FrontController::class, 'storeProductRequest'])->name('storeProductRequest');

//Blogs
Route::get('/blogs',[FrontController::class, 'blogs'])->name('blogs');
Route::get('/categoryblogs/{slug}',[FrontController::class, 'categoryblogs'])->name('categoryblogs');
Route::get('/viewblog/{id}',[FrontController::class, 'viewblog'])->name('viewblog');

//CookBook
Route::get('/cookbook',[FrontController::class, 'cookbook'])->name('cookbook');
Route::get('/cookbooksubcategories/{id}/{slug}',[FrontController::class, 'cookbooksubcategories'])->name('cookbooksubcategories');
Route::get('/recipe/{id}/{slug}',[FrontController::class, 'recipe'])->name('recipe');

//Subscriber
Route::post('registerSubscriber', [FrontController::class, 'registerSubscriber'])->name('registerSubscriber');
Route::get('/subscriberconfirm',[FrontController::class, 'subscriberconfirm'])->name('subscriberconfirm');

Auth::routes();

Route::get('/verify', [RegisterController::class, 'verifyUser'])->name('verify.user');

Route::group(['middleware' => ['auth']], function () {
    Route::get('onlyusers', [UserController::class, 'onlyusers'])->name('onlyusers');
    Route::resource('user', UserController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('subcategory', SubcategoryController::class);
    Route::get('/notificationsread', [OrderController::class, 'notificationsread'])->name('notificationsread');
    Route::put('/editaddress/{id}', [OrderController::class, 'editaddress'])->name('editaddress');
    Route::get('/deletefromorder/{id}', [OrderController::class, 'deletefromorder'])->name('deletefromorder');
    Route::put('/updatequantityadmin/{id}', [OrderController::class, 'updatequantityadmin'])->name('updatequantityadmin');
    Route::put('/changeOrderStatus/{id}', [OrderController::class, 'changeOrderStatus'])->name('changeOrderStatus');
    Route::resource('order', OrderController::class);
    Route::put('/addproductorder', [OrderController::class, 'addproductorder'])->name('addproductorder');
    Route::put('/productorder', [OrderController::class, 'productorder'])->name('productorder');

    Route::resource('cartproduct', CartproductController::class);
    Route::resource('wishlistproduct', WishlistproductController::class);
    Route::resource('cancelledproduct', CancelledproductController::class);
    Route::get('/cancelledordershow/{id}', [CancelledproductController::class, 'cancelledordershow'])->name('cancelledordershow');

    Route::resource('vendors', VendorController::class);
    Route::put('deleteproductimage/{id}', [ProductController::class, 'deleteproductimage'])->name('deleteproductimage');
    Route::post('addmoreproductimages/{id}', [ProductController::class, 'addmoreproductimages'])->name('addmoreproductimages');
    Route::resource('product', ProductController::class);
    Route::resource('setting', SettingController::class);
    Route::get('review', [ReviewController::class, 'getreviews'])->name('review');
    Route::put('enablereview/{id}', [ReviewController::class, 'enableurl'])->name('review.enable');
    Route::put('disablereview/{id}', [ReviewController::class, 'disableurl'])->name('review.disable');
    Route::resource('slider', SliderController::class);

    Route::resource('blogcategory', BlogCategoryController::class);
    Route::resource('blog', BlogController::class);

    //CookBook
    Route::resource('cookbooknavbar', CookbookNavbarController::class);
    Route::resource('cookbookcategory', CookbookCategoryController::class);

    Route::get('/cookbooksubcategory/{id}', [CookbookSubcategoryController::class, 'index'])->name('cookbooksubcategory.index');
    Route::get('/cookbooksubcategory/create/{id}', [CookbookSubcategoryController::class, 'create'])->name('cookbooksubcategory.create');
    Route::resource('cookbooksubcategory', CookbookSubcategoryController::class, ['except' => ['index', 'create']]);

    Route::get('/cookbookitem/{id}', [CookbookItemController::class, 'index'])->name('cookbookitem.index');
    Route::get('/cookbookitem/create/{id}', [CookbookItemController::class, 'create'])->name('cookbookitem.create');
    Route::get('/cookbookitem/show/{id}', [CookbookItemController::class, 'show'])->name('cookbookitem.show');

    Route::resource('cookbookitem', CookbookItemController::class, ['except' => ['index', 'create', 'show']]);

    Route::post('/storeingredient', [CookbookItemController::class, 'storeingredient'])->name('storeingredient');
    Route::post('/updateingredient/{id}', [CookbookItemController::class, 'updateingredient'])->name('updateingredient');
    Route::delete('/removeingredient/{id}', [CookbookItemController::class, 'removeingredient'])->name('removeingredient');

    Route::resource('ingredient', IngredientController::class);
    Route::resource('subscriber', SubscriberController::class);


    // Single Vendor
    Route::resource('singlevendorcategory', VendorCategoryController::class);
    Route::resource('singlevendorsubcategory', VendorSubcategoryController::class);
    Route::resource('singlevendorproduct', VendorProductController::class);
    Route::resource('singlevendororder', VendorOrderController::class);

    Route::resource('requestorder', RequestorderController::class);
});
