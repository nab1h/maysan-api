<?php

use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\BookingController;
use App\Http\Controllers\Front\ReviewsController;
use App\Http\Controllers\Front\ResultsController;
use App\Http\Controllers\Front\BranchesController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\TeamController;
use App\Http\Controllers\Front\AlldepartController;
use App\Http\Controllers\Front\OfferpageController;
use App\Http\Controllers\Front\DepartmentController as FrontDepartmentController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatisticController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BeforeAfterController;
use App\Http\Controllers\Admin\OfferController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\DoctorController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\HomeContentController;
use App\Http\Controllers\Admin\GiftController as AdminGiftController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/terms', [HomeController::class, 'terms'])->name('terms');
Route::get('/privcy', [HomeController::class, 'privcy'])->name('privcy');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews.index');
Route::get('/branches', [BranchesController::class, 'index'])->name('branches.index');
Route::get('/branch/{branch}', [BranchesController::class, 'show'])->name('branch.show');
Route::get('/results', [ResultsController::class, 'index'])->name('results.index');
Route::get('/alldepart', [AlldepartController::class, 'index'])->name('alldepart.index');
Route::get('/offers', [OfferpageController::class, 'index'])->name('offers.index');
Route::get('/team', [TeamController::class, 'index'])->name('team.index');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
Route::get('/department/{department}/services', [FrontDepartmentController::class, 'showServices'])->name('departments.services');
Route::get('/articles', [\App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{slug}', [\App\Http\Controllers\ArticleController::class, 'show'])->name('articles.show');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// الدفع
Route::post('/payment/process', [PaymentController::class, 'paymentProcess'])->name('payment.process');
Route::get('/payment/callback', [PaymentController::class, 'callBack'])->name('payment.callback');
Route::get('/payment/success', [PaymentController::class, 'success'])->name('payment.success');
Route::get('/payment/failed', [PaymentController::class, 'failed'])->name('payment.failed');
Route::middleware('auth')->group(
    function () {
        Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        Route::put('/profile/update-data', [ProfileController::class, 'updateData'])->name('profile.update.data');

        // admin
        Route::middleware('role:admin')->group(function () {
            Route::prefix('admin')->name('admin.')->group(function () {
                Route::get('/home-contents', [HomeContentController::class, 'index'])->name('home-contents.index');
                Route::post('/home-contents/{id}', [HomeContentController::class, 'update'])->name('home-contents.update');
            });

            Route::prefix('admin')->name('admin.')->group(function () {
                Route::get('/media', [MediaController::class, 'index'])->name('media.index');
                Route::post('/media', [MediaController::class, 'store'])->name('media.store');
                Route::patch('/media/{id}', [MediaController::class, 'update'])->name('media.update');
                Route::delete('/media/{id}', [MediaController::class, 'destroy'])->name('media.destroy');
            });

            Route::prefix('admin')->name('admin.')->group(function () {
                Route::resource('faqs', FaqController::class);
            });

            Route::prefix('admin')->name('admin.')->group(function () {
                Route::resource('statistics', StatisticController::class);
            });

            Route::prefix('settings')->name('settings.')->group(function () {
                Route::get('/settings', [SettingsController::class, 'index'])->name('index');
                Route::post('/settings/{id}', [SettingsController::class, 'update'])->name('update');
            });

            Route::prefix('admin')->name('admin.')->group(function () {
                Route::resource('services', ServiceController::class);
                Route::resource('branches', BranchController::class);
                Route::resource('departments', DepartmentController::class);
                Route::resource('locations', LocationController::class);
                Route::resource('offers', OfferController::class);
                Route::resource('partners', PartnerController::class);
                Route::resource('doctors', DoctorController::class);
                Route::resource('before-afters', BeforeAfterController::class);
            });

            Route::prefix('admin')->name('admin.')->group(function () {
                Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials.index');
                Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
                Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');
                Route::get('/testimonials/{id}/edit', [TestimonialController::class, 'edit'])->name('testimonials.edit');
                Route::put('/testimonials/{id}', [TestimonialController::class, 'update'])->name('testimonials.update');
                Route::put('/testimonials/{id}/status', [TestimonialController::class, 'updateStatus'])->name('testimonials.update-status');
                Route::delete('/testimonials/{id}', [TestimonialController::class, 'destroy'])->name('testimonials.destroy');
                Route::get('/payments', [AdminPaymentController::class, 'index'])->name('payments.index');
                Route::get('/gifts', [AdminGiftController::class, 'index'])->name('gifts.index');
                Route::patch('/gifts/{gift}/consume', [AdminGiftController::class, 'consume'])->name('gifts.consume');
            });

            Route::get('/users', [UserController::class, 'index'])->name('users.index');
            Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
            Route::put('/users/{user}/password', [UserController::class, 'updatePassword'])->name('users.updatePassword');
            Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        });

        // admin + supervisor
        Route::middleware('role:admin,sales')->group(function () {
            Route::get('/reservations', [ReservationController::class, 'index'])
                ->name('reservations.index');

            Route::patch('/reservations/{id}/confirm', [ReservationController::class, 'confirmStatus'])
                ->name('reservations.confirm');

            Route::patch('/reservations/{id}/complete', [ReservationController::class, 'completeStatus'])
                ->name('reservations.complete');
            Route::delete('/reservations/{id}', [ReservationController::class, 'destroy'])
                ->name('reservations.destroy');

            Route::post('/reservations/{id}/archive-action', [ReservationController::class, 'moveToArchive'])
                ->name('reservations.moveToArchive');

            Route::get('/reservations/archive', [ReservationController::class, 'archive'])
                ->name('reservations.archive');

            Route::patch('/reservations/{id}/restore', [ReservationController::class, 'restore'])
                ->name('reservations.restore');

            Route::prefix('admin')->name('admin.')->group(function () {
                Route::resource('articles', ArticleController::class);
                Route::resource('reels', \App\Http\Controllers\Admin\ReelController::class);
            });
        });
    }
);

Route::get('/u/{theme_id}/{slug}', [ProfileController::class, 'show'])->name('profile.show');
require __DIR__ . '/auth.php';
