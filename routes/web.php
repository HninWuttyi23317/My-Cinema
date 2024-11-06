<?php

use App\Models\UpcomingMovie;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TheatersController;
use App\Http\Controllers\ShowTimesController;
use App\Http\Controllers\user\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\BookingListController;
use App\Http\Controllers\MovieGenresController;
use App\Http\Controllers\UpcomingMovieController;

Route::get('homeView',[AuthController::class,'homeView'])->name('user#homeView');

Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'homeView');
    // loginPage in auth
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');
});

Route::middleware(['auth'])->group(function () {
    // Check Admin or User
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Admin_Side.................................................................
    Route::group(['prefix' => 'admin', 'middleware' => 'admin_auth'], function () {

        // Admin acc
        Route::prefix('admin')->group(function () {

            // PasswordChange
            Route::get('changePassword', [AdminController::class, 'changePassword'])->name('admin#changePassword');
            Route::post('changingPassword', [AdminController::class, 'changing'])->name('admin#changingPw');
            // Profile Deteils
            Route::get('adminProfile', [AdminController::class, 'profile'])->name('admin#profile');
            Route::get('editProfile', [AdminController::class, 'editProfile'])->name('admin#editProfile');
            Route::post('updateProfile/{id}', [AdminController::class, 'updateProfile'])->name('admin#updateProfile');

            // Admin list
            Route::get('list', [AdminController::class, 'list'])->name('admin#list');
            Route::get('delete/{id}', [AdminController::class, 'delete'])->name('admin#delete');
            Route::get('changeRole/{id}', [AdminController::class, 'changeRole'])->name('admin#changeRole');
            Route::post('changeRole/{id}', [AdminController::class, 'change'])->name('admin#change');
        });

        // Dashboard
        Route::get('adminDashboard',[AdminController::class,'adminHome'])->name('admin#dashboard');

        // User List
        Route::prefix('user')->group(function () {
            Route::get('list', [UserController::class, 'userList'])->name('user#list');
            Route::get('changeRole/{id}', [UserController::class, 'changeRole'])->name('user#changeRole');
            Route::post('changeRole/{id}', [UserController::class, 'changing'])->name('admin#userChangeRole');
        });

        // UserContact
        Route::get('contact', [UserController::class, 'mailList'])->name('admin#mailList');

        // BookingList
        Route::prefix('booking')->group(function () {
            Route::get('bookingList', [BookingController::class, 'bookingList'])->name('admin#bookingList');
            Route::get('ajax/changeStatus', [BookingController::class, 'changeStatus'])->name('admin#statusChange');
            Route::get('searchStatus',[BookingController::class,'searchStatus'])->name('admin#searchStatus');
        });
        Route::get('codeView/{code}', [BookingController::class, 'codeView'])->name('admin#codeView');

        // Seats
        Route::prefix('seats')->group(function () {
            Route::get('seat', [SeatController::class, 'List'])->name('seat#list');
            Route::get('seatCreate', [SeatController::class, 'create'])->name('seat#create');
            Route::post('seatAdd', [SeatController::class, 'add'])->name('seat#add');
            Route::get('delete/{id}', [SeatController::class, 'delete'])->name('seat#delete');
            Route::get('edit/{id}', [SeatController::class, 'edit'])->name('seat#edit');
            Route::post('update', [SeatController::class, 'update'])->name('seat#update');
            Route::get('ajax/changeStatus', [SeatController::class, 'change'])->name('admin#seatChange');
        });

        // Admin:Theatres
        Route::prefix('theaters')->group(function () {
            Route::get('theaterList', [TheatersController::class, 'Tlist'])->name('theaters#list');

            Route::get('theaterCreate', [TheatersController::class, 'create'])->name('theaters#create');
            Route::post('theaterCreating', [TheatersController::class, 'createTheater'])->name('theaters#creating');

            Route::get('delete/{id}', [TheatersController::class, 'delete'])->name('delete#theater');

            Route::get('edit/{id}', [TheatersController::class, 'edit'])->name('theaters#edit');
            Route::post('update', [TheatersController::class, 'update'])->name('theaters#update');
        });

        // Movies_Generes
        Route::prefix('movie_genres')->group(function () {
            Route::get('genreList', [MovieGenresController::class, 'list'])->name('movieGeneres#list');

            Route::post('genreAdd', [MovieGenresController::class, 'add'])->name('moviesGeneres#add');

            Route::get('delete/{id}', [MovieGenresController::class, 'delete'])->name('moviesGeneres#delete');

            Route::get('edit/{id}', [MovieGenresController::class, 'edit'])->name('moviesGeneres#edit');
            Route::post('update', [MovieGenresController::class, 'update'])->name('moviesGeneres#update');
        });

        // Movie List
        Route::prefix('movies')->group(function () {
            Route::get('movieList', [MovieController::class, 'list'])->name('movies#list');

            Route::get('create', [MovieController::class, 'create'])->name('movies#create');
            Route::post('createMovie', [MovieController::class, 'createMovie'])->name('movies#creating');

            Route::get('delete/{id}', [MovieController::class, 'delete'])->name('movies#delete');

            Route::get('edit/{id}', [MovieController::class, 'edit'])->name('movies#edit');
            Route::post('update', [MovieController::class, 'update'])->name('movies#update');

            Route::get('movieDetail/{id}', [MovieController::class, 'showDetail'])->name('movies#show');
        });

        // Upcoming_Movie List
        Route::prefix('Upcoming-Movies')->group(function () {
            Route::get('movieList', [UpcomingMovieController::class, 'list'])->name('upmovies#list');

            Route::get('create', [UpcomingMovieController::class, 'create'])->name('upmovies#create');
            Route::post('createMovie', [UpcomingMovieController::class, 'createMovie'])->name('upmovies#creating');

            Route::get('delete/{id}', [UpcomingMovieController::class, 'delete'])->name('upmovies#delete');

            Route::get('edit/{id}', [UpcomingMovieController::class, 'edit'])->name('upmovies#edit');
            Route::post('update', [UpcomingMovieController::class, 'update'])->name('upmovies#update');
        });

        // ShowTimes
        Route::prefix('showTimes')->group(function () {
            Route::get('list', [ShowTimesController::class, 'index'])->name('showtimes#index');

            Route::get('create', [ShowTimesController::class, 'create'])->name('showtimes#create');
            Route::post('create', [ShowTimesController::class, 'creating'])->name('showtimes#creating');

            Route::get('delete/{id}', [ShowTimesController::class, 'delete'])->name('showtimes#delete');

            Route::get('edit/{id}', [ShowTimesController::class, 'edit'])->name('showtimes#edit');
            Route::post('update', [ShowTimesController::class, 'update'])->name('showtimes#update');
        });
    });

    // User_Side...................................................................
    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {

        Route::get('/mainPage', [UserController::class, 'home'])->name('user#home');
        Route::get('movies', [UserController::class, 'movie'])->name('user#movie');
        // Route::get('upmovies',[UserController::class,'upmovie'])->name('user#upmovie');
        Route::get('history', [UserController::class, 'history'])->name('user#history');
        Route::get('code/{codeView}', [BookingListController::class, 'codeView'])->name('user#codeView');

        // User Account
        Route::prefix('useAccount')->group(function () {
            Route::get('changePassword', [UserController::class, 'changePassword'])->name('user#changePassword');
            Route::post('changePassword', [UserController::class, 'change'])->name('user#change');

            Route::get('userProfile', [UserController::class, 'profile'])->name('user#profile');

            Route::get('changeProfile', [UserController::class, 'changeProfile'])->name('user#changeProfile');
            Route::post('changeProfile/{id}', [UserController::class, 'update'])->name('user#update');
        });

        // UserView Movie
        Route::prefix('movieHome')->group(function () {

            Route::get('movieDetail/{id}', [UserController::class, 'detail'])->name('userMovie#detail');
            Route::get('movieTrailer/{id}', [UserController::class, 'trailer'])->name('userMovie#trailer');

            // ShowTime
            Route::get('showTime/{id}', [UserController::class, 'showTime'])->name('user#showTime');
            // Cart
            Route::get('ticketList', [UserController::class, 'ticketList'])->name('user#tickets');
        });
        // CommentController
        Route::prefix('comments')->group(function () {
            //Comments
            Route::get('comments', [CommentController::class, 'comment'])->name('user#comments');

            Route::post('postComment',[CommentController::class,'post'])->name('user#post');

            Route::get('delete/{id}',[CommentController::class,'delete'])->name('comment#delete');

            Route::get('edit/{id}',[CommentController::class,'edit'])->name('comment#edit');
            Route::post('update/{id}',[CommentController::class,'update'])->name('comment#update');

            Route::get('commentView/{id}',[CommentController::class,'view'])->name('comment#view');
        });
        // Ajax
        Route::prefix('ajax')->group(function () {
            Route::get('/add/ToCart', [AjaxController::class, 'addToCart'])->name('ajax#addToCart');
            Route::get('/bookingList', [AjaxController::class, 'bookingList'])->name('ajax#bookingList');
            Route::get('/remove', [AjaxController::class, 'remove'])->name('ajax#remove');
        });
        // Contact
        Route::prefix('contact')->group(function () {
            Route::get('/contact', [ContactController::class, 'toContact'])->name('user#contact');
            Route::post('/postMail', [ContactController::class, 'contact'])->name('user#contactPost');
        });
        // Contact
        Route::prefix('contact')->group(function () {
            Route::get('contactForm',[ContactController::class,'contactForm'])->name('user#contact');
            Route::post('contact',[ContactController::class,'contacting'])->name('user#contacting');
         });
    });
});
