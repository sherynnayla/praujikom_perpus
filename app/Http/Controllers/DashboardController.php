<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use App\Models\Book;
use App\Models\User;
use App\Models\Kategoribuku;


class DashboardController extends Controller
{
    public function index()
    {
       $bookCount = Book::all()->count(); 
       $userCount = User::all()->count(); 
       $user = User::all();
       $categoryCount  = Kategoribuku::all()->count(); 
           
       return view ('dashboard', compact('bookCount', 'userCount', 'categoryCount', 'user'));
    }
}