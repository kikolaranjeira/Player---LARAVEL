<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExcelController;


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

// Rota Raiz ('/')
Route::get('/', function () {
    return redirect('/players'); // Redireciona para a página de jogadores, que é definida como a página principal.
});

// Rotas de Autenticação (Auth)
Auth::routes();

// Rota 'home'
Route::get('/home', 'HomeController@index')->name('home');

// Rotas de Exportação e Importação de Jogadores
Route::get('players/export/', 'PlayerController@export');
Route::post('players/import/', 'PlayerController@import');
 
Route::get('/', 'PlayerController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('players/truncate', 'PlayerController@truncate');
Route::prefix('players')->group(function () {
Route::get('', 'PlayerController@index');
// Auth Middleware
Route::group(['middleware' => 'auth'], function () {
Route::get('create', 'PlayerController@create');
Route::post('', 'PlayerController@store');
Route::get('{player}/edit', 'PlayerController@edit');
Route::put('{player}', 'PlayerController@update');
Route::delete('{player}', 'PlayerController@destroy');
Route::get('{player}/delete', 'PlayerController@delete');
});
Route::get('{player}', 'PlayerController@show');
});
// Rota de Pesquisa de Jogadores (comentada)
// Route::get('/players/searc

// Rotas CRUD de Jogadores
/*Route::get('/players','PlayerController@index'); // Lista todos os jogadores
Route::get('/players/create','PlayerController@create'); // Exibe o formulário para criar um novo jogador
Route::post('/players','PlayerController@store'); // Armazena um novo jogador no banco de dados
Route::get('/players/truncate','PlayerController@truncate'); // Rota para limpar todos os registos de jogadores (TRUNCATE)
Route::get('/players/{player}','PlayerController@show'); // Exibe os detalhes de um jogador específico
Route::get('/players/{player}/edit','PlayerController@edit'); // Exibe o formulário para editar um jogador
Route::put('/players/{player}','PlayerController@update'); // Atualiza os detalhes de um jogador específico
Route::delete('/players/{player}','PlayerController@destroy'); // Exclui um jogador específico
Route::get('/players/{player}/delete','PlayerController@delete'); // Exibe o formulário para excluir um jogador
Route::get('/players/{player}/restore','PlayerController@restore'); // Restaura um jogador excluído*/