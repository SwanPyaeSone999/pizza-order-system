<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\UserController as AdminUserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;




// login, register
Route::redirect('/', 'login');

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
});



Route::middleware(['auth'])->group(function () {

    // dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');

    Route::middleware(['is_user'])->group(function () {
        //admin /change-password
        Route::prefix('admin')->group(function () {
            Route::get('change-password', [AuthController::class, 'changePassword'])->name('admin.changepassword');
            Route::post('change-password', [AuthController::class, 'saveChangePassword'])->name('admin.changepassword');
            Route::get('account/details', [AdminController::class, 'accountDetails'])->name('admin.accountdetails');
            Route::get('account/edit/{user}', [AdminController::class, 'edit'])->name('admin.edit');
            Route::post('account/edit/{user}', [AdminController::class, 'save'])->name('admin.save');

            // admin /list
            Route::get('list', [AdminController::class, 'list'])->name('admin.list');
            Route::delete('delete/{user}', [AdminController::class, 'delete'])->name('admin.delete');
            Route::get('change-role/{user}', [AdminController::class, 'role'])->name('admin.role');
            Route::post('change-role/{user}', [AdminController::class, 'changeRole'])->name('admin.changeRole');

            //admin -> user
            Route::get('/user/list', [AdminUserController::class, 'list'])->name('admin.user.list');
            Route::get('/user/{user}/edit', [AdminUserController::class, 'edit'])->name('admin.user.edit');
            Route::post('/user/{user}', [AdminUserController::class, 'update'])->name('admin.user.update');
            Route::delete('/user/{user}', [AdminUserController::class, 'delete'])->name('admin.user.delete');
            Route::get('/user/change-role', [AdminUserController::class, 'changeRole'])->name('admin.user.changeRole');

            Route::get('contact/list', [ContactController::class, 'list'])->name('admin.contact.list');
            Route::delete('contact/{contact}/delete', [ContactController::class, 'delete'])->name('admin.contact.delete');
        });



        //admin /category
        Route::group(['prefix' => 'category'], function () {
            Route::get('list', [CategoryController::class, 'list'])->name('category.list');
            Route::get('create', [CategoryController::class, 'create'])->name('category.create');
            Route::post('store', [CategoryController::class, 'store'])->name('category.store');
            Route::get('edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('update/{category}', [CategoryController::class, 'update'])->name('category.update');
            Route::delete('delete/{category}', [CategoryController::class, 'delete'])->name('category.delete');
        });


        //pizza
        Route::group(['prefix' => 'pizza'], function () {
            Route::get('list', [ProductController::class, 'list'])->name('pizza.list');
            Route::get('details/{pizza}', [ProductController::class, 'show'])->name('pizza.show');
            Route::get('create', [ProductController::class, 'create'])->name('pizza.create');
            Route::post('store', [ProductController::class, 'store'])->name('pizza.store');
            Route::get('edit/{pizza}', [ProductController::class, 'edit'])->name('pizza.edit');
            Route::post('update/{pizza}', [ProductController::class, 'update'])->name('pizza.update');
            Route::delete('delete/{pizza}', [ProductController::class, 'delete'])->name('pizza.delete');
        });

        //admin /order list
        Route::group(['prefix' => 'order'], function () {
            Route::get('list', [OrderController::class, 'list'])->name('order.list');
            Route::get('details/{ordercode}', [OrderController::class, 'details'])->name('order.details');
            Route::get('ajax/status', [OrderController::class, 'changeStatus'])->name('order.status');
        });
    });

    // user /home
    Route::group(['prefix' => 'user', 'middleware' => 'is_admin'], function () {
        Route::get('home', [UserController::class, 'home'])->name('user.home');
        Route::get('contact', [UserController::class, 'contact'])->name('user.contact');
        Route::post('contact', [UserController::class, 'storeContact'])->name('user.storeContact');
        Route::get('history', [UserController::class, 'history'])->name('user.history');
        Route::get('product/details/{product}', [UserController::class, 'show'])->name('user.show');
        Route::get('filter/{category}', [UserController::class, 'filter'])->name('user.filter');
        Route::get('cart/list', [UserController::class, 'cartList'])->name('user.cartList');

        Route::get('change-password', [UserController::class, 'changePassword'])->name('user.change-password');
        Route::post('change-password', [UserController::class, 'passwordUpdate'])->name('user.password-update');
        Route::get('account/edit/{user}', [UserController::class, 'edit'])->name('user.account-edit');
        Route::post('account/edit/{user}', [UserController::class, 'save'])->name('user.account-save');

        Route::prefix('ajax')->group(function () {
            Route::get('pizza/list', [AjaxController::class, 'pizzaList'])->name('ajax.pizza-list');
            Route::post('addToCart', [AjaxController::class, 'addToCart'])->name('ajax.addToCart');
            Route::post('order', [AjaxController::class, 'order'])->name('ajax.order');
            Route::post('cart/add', [AjaxController::class, 'addCart'])->name('ajax.add');
            Route::post('cart/minus', [AjaxController::class, 'minusCart'])->name('ajax.minus');
            Route::post('view-count', [AjaxController::class, 'viewCount'])->name('ajax.viewCount');
        });
    });
});