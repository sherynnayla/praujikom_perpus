<?php
use App\Models\Book;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UlasanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;

use App\Http\Controllers\KategoribukuController;
use App\Http\Controllers\KoleksipribadiController;

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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'check.role']);



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

Route::get('/peminjaman', [PeminjamanController::class, 'index'])->name('index');
Route::post('/peminjaman/{books}', [PeminjamanController::class, 'store'])->name('pinjam.store');
Route::get('/peminjaman-selesai/{id}', [PeminjamanController::class, 'selesai'])->name('peminjamanSelesai');
Route::get('/peminjaman-export', [PeminjamanController::class, 'export'])->name('export.peminjamanan');
Route::get('/peminjaman-search', [PeminjamanController::class, 'search'])->name('peminjamanan.search');



Route::get('/koleksi', [KoleksipribadiController::class, 'koleksi'])->name('koleksi');
Route::post('/koleksi/tambah/{book}', [KoleksipribadiController::class, 'tambah'])->name('koleksi.tambah');

//Route::get('/ulasan', [UlasanController::class, 'ulasan'])->name('ulasan');
// Route::get('/add-ulasan', [UlasanController::class, 'add'])->name('ulasanAdd');
// Route::post('/add-ulasan', [UlasanController::class, 'addUlasan'])->name('ulasan.store');


Route::get('/ulasan/create/{bookId}', [UlasanController::class, 'create'])->name('ulasan.create');
Route::post('/ulasan/store/{bookId}', [UlasanController::class, 'store'])->name('ulasan.store');
Route::get('/ulasan/{bookId}', [UlasanController::class, 'show'])->name('ulasan.show');










});

    Route::get('/category', [KategoribukuController::class, 'index']);
    Route::get('/add-category', [KategoribukuController::class, 'add'])->name('categoryAdd');
    Route::post('/add-category', [KategoribukuController::class, 'addCategory'])->name('categoryStore');
    Route::get('/edit-category/{id}', [KategoribukuController::class, 'edit'])->name('categoryEdit');
    Route::patch('/update-category/{id}', [KategoribukuController::class, 'update'])->name('categoryUpdate');
    Route::delete('/delete-category/{id}/', [KategoribukuController::class, 'destroy'])->name('categoryDelete');

    Route::get('/books', [BookController::class, 'books']);
    Route::get('/add-books', [Bookcontroller::class, 'add'])->name('bookAdd');
    Route::post('/add-books', [Bookcontroller::class, 'addBook'])->name('bookStore');
    Route::get('/edit-books/{id}', [BookController::class, 'editBook'])->name('editBook');
    Route::patch('/update-books/{id}', [BookController::class, 'update'])->name('bookUpdate');
    Route::delete('/delete-books/{id}/', [BookController::class, 'destroy'])->name('bookDelete');

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/add-user', [UserController::class, 'add'])->name('userAdd');
    Route::post('/add-user', [UserController::class, 'addUser'])->name('userStore');
    Route::get('/edit-user/{id}', [UserController::class, 'editUser'])->name('editUser');
    Route::patch('/update-user/{id}', [UserController::class, 'update'])->name('userUpdate');
    Route::delete('/delete-user/{id}', [UserController::class, 'destroy'])->name('userDelete');