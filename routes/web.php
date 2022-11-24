<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Authentication;

//Admin Imports
use App\Http\Controllers\Admin\Dashboard;
use App\Http\Controllers\Admin\Users;
use App\Http\Controllers\Admin\Category;
use App\Http\Controllers\Admin\Tags;
use App\Http\Controllers\Admin\Tips;
use App\Http\Controllers\Admin\Quotes;
use App\Http\Controllers\Admin\Facts;
use App\Http\Controllers\Admin\Posts;
use App\Http\Controllers\Admin\Subscribers;
use App\Http\Controllers\Admin\BuyButtons;
use App\Http\Controllers\Admin\Videos;
use App\Http\Controllers\Admin\Comments_;
//Frontend Imports
use App\Http\Controllers\Frontend\Home;
use App\Http\Controllers\Frontend\Tip_front;
use App\Http\Controllers\Frontend\Quote_front;
use App\Http\Controllers\Frontend\Fact_front;
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

Route::get('/', [Home::class, 'index'])->name("home");
Route::get('/about-us',[Home::class,'about_us'])->name("about");
Route::get('/contact',[Home::class,'contact']);

Route::get('/detail/{post_title}/{post_id}', [Home::class, 'post_detail']);

Route::get('/category/{category}/{category_id}',[Home::class,'category_post'])->name("category");
Route::get('/author/{author}/{author_id}',[Home::class,'author_post']);

Route::get('/hashtag/{tags}',[Home::class,'tags_post']);

Route::get('/archives/{year}/{month}',[Home::class,'archives_post']);
Route::post('/comment',[Home::class,'comment_add']);
Route::get('/tip',[Tip_front::class,'index']);

Route::get('/facts',[Fact_front::class,'index'])->name("facts");

Route::get('/quotes',[Quote_front::class,'index'])->name("quotes");
Route::get('/logout',[Authentication::class,'logout']);
Route::get('/register',[Authentication::class,'register']);
// Route::get('/login', function(){
//     session()->put("user_id",1);
//     session()->put("role",'author');
//     return redirect('/');
// });

Route::get('/login', [Authentication::class,'login']);
Route::post('/login', [Authentication::class,'login']);

Route::get('/no-access', function(){
    echo "No access";
});
/*
|----------------------------------------------------------------------------
|User Authenticated Routes
|----------------------------------------------------------------------------
*/
    //Admin Routes
    //==============================================================================
    Route::middleware(['guard'])->group(function () {

        Route::group(['prefix' => 'admin'], function () {

            //Dashboard Routes
            //==========================================================================
            
        
            Route::get('/', [Dashboard::class, 'index']);
            Route::get('/logout',[Authentication::class,'logout']);

            Route::middleware(['adminGuard'])->group(function () {
                // User Panel Routes
                //===========================================================================
                Route::get('/user-list',[Users::class, 'index']);
                Route::get('/add-user', [Users::class, 'add_user']);
                Route::post('/add-user',[Users::class,'add_user']);
                Route::get('/edit-user/{id}',[Users::class,'editUser']);
                Route::post('/edit-user', [Users::class, 'editUser']);
                Route::get('/change-user-status/{id}', [Users::class, 'changeUserStatus']);
            });
            

            Route::middleware(['moderatorGuard'])->group(function () {
                
                // Categories Routes
            //==========================================================================
            Route::get('/category-list',[Category::class,'index']);
            Route::get('/add-category',[Category::class,'add_category']);
            Route::post('/add-category',[Category::class,'add_category']);
            Route::get('/edit-category/{id}',[Category::class,'edit_category']);
            Route::post('/edit-category',[Category::class,'edit_category']);
            Route::get('/change-category-status/{id}',[Category::class,'changeCategoryStatus']);

            // Sub-category Routes
            //============================================================================
            Route::get('/sub-category-list',[Category::class,'sub_category_list']);
            Route::get('/add-sub-category',[Category::class,'add_sub_category']);
            Route::post('/add-sub-category',[Category::class,'add_sub_category']);
            Route::get('/edit-sub-category/{id}',[Category::class,'edit_sub_category']);
            Route::post('/edit-sub-category',[Category::class,'edit_sub_category']);
            Route::get('/change-sub-category-status/{id}',[Category::class,'changeSubCategoryStatus']);

            //Tags Routes
            //=============================================================================
            Route::get('/tags-list',[Tags::class,'index']);
            Route::get('/add-tags',[Tags::class,'add_tags']);
            Route::post('/add-tags',[Tags::class,'add_tags']);
            Route::get('/edit-tags/{id}',[Tags::class,'edit_tags']);
            Route::post('/edit-tags',[Tags::class,'edit_tags']);
            Route::get('/change-tags-status/{id}',[Tags::class,'changeTagsStatus']);

            //Tips Routes
            //============================================================================
            Route::get('/tips-list',[Tips::class,'index']);
            Route::get('/add-tips',[Tips::class,'add_tips']);
            Route::post('/add-tips',[Tips::class,'add_tips']); 
            Route::get('/edit-tips/{id}',[Tips::class,'edit_tips']);
            Route::post('/edit-tips',[Tips::class,'edit_tips']);
            Route::get('/change-tips-status/{id}',[Tips::class,'changeTipsStatus']);

            //Facts Routes
            //============================================================================
            Route::get('/facts-list',[Facts::class,'index']);
            Route::get('/add-facts',[Facts::class,'add_facts']);
            Route::post('/add-facts',[Facts::class,'add_facts']); 
            Route::get('/edit-facts/{id}',[Facts::class,'edit_facts']);
            Route::post('/edit-facts',[Facts::class,'edit_facts']);
            Route::get('/change-facts-status/{id}',[Facts::class,'changeFactStatus']);

            //Quotes Routes
            //============================================================================
            Route::get('/quotes-list',[Quotes::class,'index']);
            Route::get('/add-quotes',[Quotes::class,'add_quotes']);
            Route::post('/add-quotes',[Quotes::class,'add_quotes']); 
            Route::get('/edit-quotes/{id}',[Quotes::class,'edit_quotes']);
            Route::post('/edit-quotes',[Quotes::class,'edit_quotes']);
            Route::get('/change-quotes-status/{id}',[Quotes::class,'changeQuotesStatus']);

            //Subscribers Routes
            /*============================================================================
            | Email Subscribers
            ==============================================================================*/
            Route::get('/subscribers',[Subscribers::class,'index']);
            Route::get('/add-subscribers',[Subscribers::class,'add_subscribers']);
            Route::post('/add-subscribers',[Subscribers::class,'add_subscribers']);
            Route::get('/edit-subscribers/{id}',[Subscribers::class,'edit_subscribers']);
            Route::post('/edit-subscribers',[Subscribers::class,'edit_subscribers']);
            Route::get('/change-subscriber-status/{id}',[Subscribers::class,'changeSubscriberStatus']);

            /*============================================================================
            | Whatsapp Subscribers
            ==============================================================================*/
            Route::get('/whatsapp-subscribers',[Subscribers::class,'whatsapp_subscribers_list']);
            Route::get('/add-whatsapp-subscribers',[Subscribers::class,'add_whatsapp_subscribers']);
            Route::post('/add-whatsapp-subscribers',[Subscribers::class,'add_whatsapp_subscribers']);
            Route::get('/edit-whatsapp-subscribers/{id}',[Subscribers::class,'edit_whatsapp_subscribers']);
            Route::post('/edit-whatsapp-subscribers',[Subscribers::class,'edit_whatsapp_subscribers']);
            Route::get('/change-whatsapp-subscriber-status/{id}',[Subscribers::class,'changeWhatsappSubscriberStatus']);


            /*============================================================================================
            | Buy Buttons Routes
            =============================================================================================*/
            Route::get('/buy-button-list',[BuyButtons::class,'index']);
            Route::get('/add-buy-button',[BuyButtons::class,'add_buy_button']);
            Route::post('/add-buy-button',[BuyButtons::class,'add_buy_button']);
            Route::get('/edit-buy-button/{id}',[BuyButtons::class,'edit_buy_button']);
            Route::post('/edit-buy-button',[BuyButtons::class,'edit_buy_button']);
            Route::get('/change-buy-button-status/{id}',[BuyButtons::class,'changeBuyButtonStatus']);


            /*==============================================================================================
            | Videos Manager Routes
            ================================================================================================*/
            Route::get('/videos',[Videos::class,'index']);
            Route::get('/add-video',[Videos::class,'add_video']);
            Route::post('/add-video',[Videos::class,'add_video']);
            Route::get('/edit-video/{id}',[Videos::class,'edit_video']);
            Route::post('/edit-video',[Videos::class,'edit_video']);
            Route::get('/change-video-status/{id}',[Videos::class,'changeVideoStatus']);

            /*==============================================================================================
            | Comment Manager Routes
            ================================================================================================*/
            Route::get('/comments',[Comments_::class,'index']);
            Route::get('/change-comment-status/{id}',[Comments_::class,'changeCommentStatus']);
            });

            
            
            Route::middleware(['authorGuard'])->group(function () {
            /*==============================================================================================
            | Post Manager Routes
            ================================================================================================*/
            Route::get('/all-posts',[Posts::class,'index']);
            Route::get('/add-new-single-post',[Posts::class,'add_single_post']);
            Route::post('/add-new-single-post',[Posts::class,'add_single_post']);
            Route::get('/edit-post/{id}',[Posts::class,'edit_post']);
            Route::post('/edit-post',[Posts::class,'edit_post']);
            Route::get('/change-post-status/{id}',[Posts::class,'changePostStatus']);
            });
            
            

        });

    });