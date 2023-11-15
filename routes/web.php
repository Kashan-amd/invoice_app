<?php

use Illuminate\Support\Facades\Route;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Customer;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\InvoiceController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/customers', CustomerController::class)->middleware(['auth']);
Route::resource('/items', ItemController::class)->middleware(['auth']);

Route::resource('invoices', InvoiceController::class)->middleware(['auth']);
Route::get('/rate', [InvoiceController::class, 'rate'])->middleware(['auth']);

Route::get('/invoice/pdf/{id}', [InvoiceController::class, 'invoicePDF'])->name('pdf');

