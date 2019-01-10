<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Entities\Marca;
use App\Models\Dao\MarcaDao;
use App\Utils\Session;
use App\Models\Validation\ValidationMark;
use App\Utils\Redirect;

class MarcaController extends Controller
{
    public function index()
    {
        $marcaDao = new MarcaDao();
        self::setViewParam('listaMarcas', $marcaDao->list());
        $this->render('/marca/index');
        Session::clearSession(['errors', 'success']);
    }

    public function cadastro()
    {
        $this->render('/marca/cadastro');
        Session::clearSession(['errors', 'success', 'form']);
    }

    public function salvar()
    {
        $marca = new Marca();
        $marcaDao = new MarcaDao();
        $marca->setNome($_POST['nome']);
        Session::setSession('form', $_POST);
        $validation = new ValidationMark();
        $result = $validation->validate($marca);
        if ($result->getErrors()) {
            return Redirect::route("/marca/cadastro", [
                'errors' => $result->getErrors()
            ]);
        }
        Session::clearSession('errors');

        $marcaDao->toSave($marca);
        return Redirect::route(
            "/marca",
            [
                'success' => ['Marca foi salva!']
            ]
        );
        Session::clearSession(['errors', 'success', 'form']);
    }

    public function edicao($params)
    {
        $id = filter_var($params[0], FILTER_SANITIZE_NUMBER_INT);
        $marcaDao = new MarcaDao();
        $marca = $marcaDao->list($id);
        if (!$marca) {
            return Redirect::route("/marca", [
                'errors' => ['Marca não existe!']
            ]);
            Session::clearSession('errors');
        }
        self::setViewParam('marca', $marca);
        $this->render('/marca/edit');

        Session::clearSession(['errors', 'success', 'form']);
    }

    public function atualizar()
    {
        $marca = new Marca();
        $marca->setId($_POST['id']);
        $marca->setNome($_POST['nome']);
        Session::setSession('form', $_POST);
        $validation = new ValidationMark();
        $result = $validation->validate($marca);
        if ($result->getErrors()) {
            return Redirect::route("/marca/edit", [
                'errors' => $result->getErrors()
            ]);
        }
        Session::clearSession('errors');
        $marcaDao = new MarcaDao();
        $marcaDao->atualizar($marca);
        return Redirect::route(
            "/marca",
            [
                'success' => ['Marca foi atualizada!']
            ]
        );
        Session::clearSession(['errors', 'success', 'form']);
    }

    public function exclusao($params)
    {
        $id = filter_var($params[0], FILTER_SANITIZE_NUMBER_INT);
        $marcaDao = new MarcaDao();
        $marca = $marcaDao->list($id);
        if (!$marca) {
            return Redirect::route("/marca", [
                'errors' => ['Marca não existe!']
            ]);
            Session::clearSession('errors');
        }
        self::setViewParam('marca', $marca);
        $this->render('/marca/exclusao');

        Session::clearSession(['errors', 'success']);
    }

    public function excluir()
    {
        $marca = new Marca();
        $id = $_POST['id'];
        $marca->setId($id);
        $marcaDao = new MarcaDao();
        if ($totalDeProdutos = $marcaDao->getQuantidadeProdutos($id)) {
            return Redirect::route("/marca/exclusao/$id", [
                'errors' => ["Esta marca não pode ser excluída pois existem "
                    . $totalDeProdutos . " produtos vinculados a ela."]
            ]);
            Session::clearSession('errors');
        }
        if (!$marcaDao->excluir($marca)) {
            return Redirect::route("/marca", [
                'errors' => ['Marca não existe!']
            ]);
            Session::clearSession('errors');
        }
        return Redirect::route(
            "/marca",
            [
                'success' => ['Marca foi excluída!']
            ]
        );
        Session::clearSession(['errors', 'success', 'form']);
    }
}