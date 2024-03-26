<?php
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoribukuController;
use App\Http\Controllers\PeminjamanController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function ()
{
    return view('dashboard');
})->middleware('auth');


Route::middleware('is.guest')->group(function (){
Route::get('/register', [UserController::class, 'register']);
Route::post('/register', [UserController::class, 'inputRegister'])->name('register.post');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'Auth'])->name('login.post');
});

Route::get('logout', [UserController::class, 'logout']);


Route::middleware('is.login')->group(function (){
Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/list', [BookController::class, 'list']);
Route::get('/books', [BookController::class, 'books'])->name('books');
Route::get('/category', [KategoribukuController::class, 'index'])->name('category');
Route::get('/add', [KategoribukuController::class, 'add'])->name('add');
Route::post('/add', [KategoribukuController::class, 'addBook'])->name('add.Book');
Route::get('/user', [UserController::class, 'index']);
Route::get('/peminjaman', [PeminjamanController::class, 'index']);

});

    Route::get('/category', [KategoribukuController::class, 'index'])->name('category');
    Route::get('/add', [KategoribukuController::class, 'add'])->name('add');
    Route::post('/add', [KategoribukuController::class, 'addBook'])->name('add.Book');
    Route::get('/edit/{id}', [KategoribukuController::class, 'edit'])->name('categoryEdit');
    Route::patch('/update/{id}', [KategoribukuController::class, 'update'])->name('update');

    Route::delete('/delete/{id}/', [KategoribukuController::class, 'destroy'])->name('delete');