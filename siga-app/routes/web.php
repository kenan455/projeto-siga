<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AtividadeController;

use App\Http\Controllers\AlunoController;

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
    return view('alunos/layout/sistema');
});


*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/professor', [UserController::class,'login'])->name('login.page');
	 
Route::post('/auth-professor', [UserController::class,'auth'])->name('auth.user');

Route::middleware(['auth'])->group(function () {

	Route::get('professor/home', [UserController::class, 'home'])->name('professor.geral.home');  


	Route::get('/professor/exercicios', [AtividadeController::class,'index'])->name('atividades.index');


	Route::get('/professor/cadastroAtividade', [AtividadeController::class,'create'])->name('atividades.create');

	Route::post('/professor/pesquisarAtividade', [AtividadeController::class,'pesquisa'])->name('atividades.pesquisar');


	Route::get('/professor/exercicios/editar/{id}', [AtividadeController::class,'edit'])->name('atividades.edit');

	Route::put('/professor/exercicios/editarUpdate/{id}', [AtividadeController::class,'update'])->name('atividades.update');


	Route::delete('/professor/exluirAtividade/{id}', [AtividadeController::class,'destroy'])->name('atividades.destroy');


	Route::post('/professor/storeAtividade', [AtividadeController::class,'store'])->name('atividades.store');

	Route::get('/professor/alunos', [AlunoController::class,'index'])->name('alunos.index');

	Route::get('/professor/cadastroAluno', [AlunoController::class,'create'])->name('alunos.create');

	Route::post('/professor/storeAluno', [AlunoController::class,'store'])->name('alunos.store');

	Route::post('/professor/pesquisarAluno', [AlunoController::class,'pesquisa'])->name('alunos.pesquisar');

	Route::delete('/professor/exluirAluno/{id}', [AlunoController::class,'destroy'])->name('alunos.destroy');

	Route::get('/professor/alunos/editar/{id}', [AlunoController::class,'edit'])->name('alunos.edit');

	Route::put('/professor/alunos/editarUpdate/{id}', [AlunoController::class,'update'])->name('alunos.update');

	Route::get('/logout', [UserController::class, 'logout'])->name('logout');

});



Route::get('/aluno', [AlunoController::class,'login'])->name('login.aluno');

Route::post('auth-aluno', [UserController::class,'auth'])->name('auth.aluno');

Route::middleware(['auth'])->group(function () {

	Route::get('/aluno/home', [AlunoController::class, 'home'])->name('aluno.geral.home');  

	Route::get('/aluno/atividades', [AtividadeController::class, 'atividades'])->name('aluno.atividades'); 

	Route::get('/aluno/contato-professor', [AlunoController::class, 'contatoProfessor'])->name('aluno.contato_professor');  

	Route::get('/aluno/mudar-senha', [AlunoController::class, 'mudarSenha'])->name('aluno.mudar_senha');

    Route::post('/aluno/atualizar-senha', [AlunoController::class, 'atualizarSenha'])->name('aluno.atualizar_senha');


    Route::post('/aluno/enviarEmail', [AlunoController::class,'enviarEmail'])->name('alunos.enviar_email');

    Route::get('/aluno/downloadArquivo/{id}',  [AtividadeController::class, 'downloadArquivo'])->name('download.arquivo');
});