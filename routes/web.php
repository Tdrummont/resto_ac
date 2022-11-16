<?php

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

Auth::routes();


Route::group(['prefix' => 'cliente'], function() {
    Route::get('/', 'ClienteController@login');
    Route::post('autenticar', 'ClienteController@autenticar');

    Route::group(['middleware' => ['autentica.cliente','bonificacao.aniversario']], function() {
    	Route::get('bonificacao/historico', 'ClienteController@historicoBonificacao');
    	Route::get('perfil', 'ClienteController@perfil');
    	Route::get('ficha/form-satisfacao', 'FichaController@formSatisfacao');
    	Route::post('ficha/resposta', 'FichaController@resposta');
    	Route::get('ficha/enviada', function() { return view('cliente.ficha-enviada'); });
    	Route::get('regras', 'RegrasController@index');
    	Route::post('logout', 'ClienteController@logout');
    });
});



Route::group(['middleware' => ['auth']], function() {

    Route::get('/', 'BonificacaoController@index');

    //Módulo Admin
    Route::group(['prefix' => 'admin'], function() {

        //Route::get('/', 'BonificacaoController@index');
        Route::get('bonificacoes', 'BonificacaoController@index');
        Route::get('bonificacao/edit/{id}', 'BonificacaoController@edit');
        Route::post('bonificacao/store', 'BonificacaoController@store');
        Route::post('bonificacao/delete', 'BonificacaoController@delete');
        Route::post('bonificacao/marcar-uso', 'BonificacaoController@marcarUso');
        Route::get('bonificacao/historico/{id}', 'BonificacaoController@historico');

        Route::get('clientes', 'ClienteController@index');
        Route::get('cliente/create', 'ClienteController@create');
        Route::get('cliente/edit/{id}', 'ClienteController@edit');
        Route::post('cliente/store', 'ClienteController@store');
        Route::post('cliente/delete', 'ClienteController@delete');

        Route::get('servicos', 'ServicoController@index');
        Route::get('servico/create', 'ServicoController@create');
        Route::get('servico/edit/{id}', 'ServicoController@edit');
        Route::post('servico/store', 'ServicoController@store');
        Route::post('servico/delete', 'ServicoController@delete');

        Route::get('regras', 'RegrasController@create');
        Route::post('regras/store', 'RegrasController@store');

        Route::get('ficha', function () { return view('admin.ficha.index'); });
        Route::get('ficha/create', 'FichaController@create');
        Route::get('ficha/edit/{id}', 'FichaController@edit');
        Route::post('ficha/store', 'FichaController@store');
        Route::post('ficha/update', 'FichaController@update');
        Route::post('ficha/delete', 'FichaController@delete');
        Route::get('ficha/lista', 'FichaController@lista');
        Route::get('ficha/visualizar', 'FichaController@visualizar');
        
        Route::get('usuario/trocar-senha', 'UsuarioController@trocarSenha');
        Route::post('usuario/salvar-nova-senha', 'UsuarioController@salvarNovaSenha');

    });
});









