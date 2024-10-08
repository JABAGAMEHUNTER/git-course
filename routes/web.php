<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PostController,
    ProdutoController,
    FeiranteController};
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
/*
Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [ProdutoController::class, 'index'])->middleware(['auth'])->name('index');//vai para o index
Route::get('/index', [ProdutoController::class, 'index'])->middleware(['auth'])->name('index');//vai para o index
Route::any('/produtos/search', [ProdutoController::class, 'search'])->middleware(['auth'])->name('produtos.search');//procura item
    Route::any('/produtos/search/hortifruti', [ProdutoController::class, 'searchCategoriaHortifruti'])->middleware(['auth'])->name('produtos.hortifruti');
    Route::any('/produtos/search/peixes', [ProdutoController::class, 'searchCategoriaPeixes'])->middleware(['auth'])->name('produtos.peixes');
    Route::any('/produtos/search/carnes', [ProdutoController::class, 'searchCategoriaCarnes'])->middleware(['auth'])->name('produtos.carnes');
    Route::any('/produtos/search/naturais', [ProdutoController::class, 'searchCategoriaNaturais'])->middleware(['auth'])->name('produtos.naturais');
    Route::get('/produtos', [ProdutoController::class, 'index'])->middleware(['auth'])->name('produtos.index');
    Route::get('/produtos/create', [ProdutoController::class, 'create'])->middleware(['auth'])->name('produtos.create');//cria novo produto
    Route::post('/produtos', [ProdutoController::class, 'store'])->middleware(['auth'])->name('produtos.store');
    Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->middleware(['auth'])->name('produtos.show');
    Route::delete('/produtos/{id}',[ProdutoController::class, 'destroy'])->middleware(['auth'])->name('produtos.destroy');
    Route::get('produtos/edit/{id}', [ProdutoController::class, 'edit'])->middleware(['auth'])->name('produtos.edit');
    Route::put('/produtos/{id}', [ProdutoController::class, 'update'])->middleware(['auth'])->name('produtos.update');
    
    Route::match(['get','post'], '/{idproduto}/carrinho/adicionar',[ ProdutoController::class, 'adicionarCarrinho'])
        ->name('adicionar_carrinho');
    Route::match(['get','post'], '/carrinho',[ ProdutoController::class, 'verCarrinho'])
    ->name('ver_carrinho');
    Route::match(['get','post'], '/{indice}/excluircarrinho',[ ProdutoController::class, 'excluirCarrinho'])
    ->name('carrinho_excluir');
    Route::match(['get','post'], '/cadastrar',[ FeiranteController::class, 'cadastrar'])
    ->name('cadastrar');
    Route::match(['get','post'], '/feirante/cadastrar',[ FeiranteController::class, 'cadastrarFeirante'])
    ->name('cadastrar_feirante');


Route::get('/categorias', [ProdutoController::class, 'categorias'])->middleware(['auth'])->name('categorias');

Route::get('/produtores', [ProdutoController::class, 'produtores'])->middleware(['auth'])->name('produtores');
Route::get('/userconfig', [ProdutoController::class, 'userconfig'])->middleware(['auth'])->name('userconfig');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
