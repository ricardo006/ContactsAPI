<?php 

use App\Http\Controllers\PersonController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;

// Rotas para pessoas
Route::prefix('people')->group(function () {
    Route::get('/', [PersonController::class, 'index']);           // Listar todas as pessoas
    Route::post('/', [PersonController::class, 'store']);          // Criar uma nova pessoa
    Route::get('/{id}', [PersonController::class, 'show']);        // Obter uma pessoa específica
    Route::put('/{id}', [PersonController::class, 'update']);      // Atualizar uma pessoa específica
    Route::delete('/{id}', [PersonController::class, 'destroy']);  // Excluir uma pessoa específica

    // Rotas para contatos
    Route::get('/{id}/contacts', [ContactController::class, 'index']);       // Listar contatos de uma pessoa
    Route::post('/{id}/contacts', [ContactController::class, 'store']);      // Adicionar contato a uma pessoa
    Route::get('/{id}/contacts/{contactId}', [ContactController::class, 'show']); // Obter um contato específico
    Route::put('/{id}/contacts/{contactId}', [ContactController::class, 'update']); // Atualizar um contato específico
    Route::delete('/{id}/contacts/{contactId}', [ContactController::class, 'destroy']); // Excluir um contato
});

Route::get('/types', [PersonController::class, 'getTypes']);
