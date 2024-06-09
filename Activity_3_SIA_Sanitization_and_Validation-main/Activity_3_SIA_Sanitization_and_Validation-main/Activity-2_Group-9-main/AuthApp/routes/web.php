<?php
 
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
 
// Route for the welcome page
Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [TaskController::class, 'index'])->name('tasks.index');
Route::get('/maketask', [TaskController::class, 'create'])->name('tasks.create');
Route::post('store', [TaskController::class, 'store'])->name('tasks.store');
Route::delete('delete/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
Route::post('done/{task}', [TaskController::class, 'complete'])->name('tasks.complete');// New route for editing tasks
Route::get('/edit/{task}', [TaskController::class, 'edit'])->name('tasks.edit');
Route::put('/update/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');

// Routes for registration and login, accessible to guests only
Route::group(['middleware' => 'guest'], function () {
    // Registration routes
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register');
    // Login routes
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
});
 
// Routes for authenticated users, accessible after login
Route::group(['middleware' => 'auth'], function () {
    // Home page route
    Route::get('/home', [HomeController::class, 'index']);
    // Logout route
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});
