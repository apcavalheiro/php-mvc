<?php

namespace App\Controllers;

use App\Utils\Session;
use App\Utils\Redirect;
use App\Utils\Paginacao;
use App\Models\Dao\ProdutoDao;
use App\Models\Entities\Produto;
use App\Models\Validation\ValidationProduct;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtoDao = new ProdutoDao();
        self::setViewParam('listProducts', $produtoDao->list());
        $this->render('/produto/index');

        $this->render('/produto/index');

        Session::clearSession(['success', 'errors', 'form']);
    }

    public function getByPagination()
    {
        $produtoDao = new ProdutoDao();
        $paginaSelecionada = isset($_GET['paginaSelecionada']) ? $_GET['paginaSelecionada'] : 1;
        $totalPorPagina = isset($_GET['totalPorPagina']) ? $_GET['totalPorPagina'] : 5;

        if (isset($_GET['buscaProduto'])) {
            $buscaProduto = $_GET['buscaProduto'];
            $listaProdutos = $produtoDao->buscaComPaginacao($_GET['buscaProduto'], $totalPorPagina, $paginaSelecionada);
            $paginacao = new Paginacao($listaProdutos);
            echo $buscaProduto;
            self::setViewParam('buscaProduto', $buscaProduto);
            self::setViewParam('paginacao', $paginacao->criarLink($buscaProduto));
            self::setViewParam('listProducts', $listaProdutos['resultado']);
        }

        self::setViewParam('totalPorPagina', $totalPorPagina);
        $this->render('/produto/index');
    }

    public function totalPorPagina()
    {
        if (isset($_POST['totalPorPagina'])) {
            $_SESSION['totalPorPagina'] = $_POST['totalPorPagina'];
        } else {
            $_SESSION['totalPorPagina'] = 5;
        }

        exit;
    }

    public function cadastro()
    {
        $this->render('produto/cadastro');
        Session::clearSession(['success', 'errors', 'form']);
    }

    public function salvar()
    {
        $produto = new Produto();
        $produto->setNome($_POST['nome']);
        $produto->setStatus($_POST['status']);
        $produto->setPreco($_POST['preco']);
        $produto->setQuantidade($_POST['quantidade']);
        $produto->setEan($_POST['ean']);
        $produto->setDescricao($_POST['descricao']);

        Session::setSession('form', $_POST);
        $validation = new ValidationProduct();
        $result = $validation->validate($produto);
        if ($result->getErrors()) {
            return Redirect::route("/produto/cadastro", [
                'errors' => $result->getErrors()
            ]);
            Session::clearSession('errors');
        }
        $produtoDao = new ProdutoDao();
        $produtoDao->toSave($produto);
        return Redirect::route("/produto/index", [
            'success' => ['Produto salvo com sucesso!']
        ]);

        Session::clearSession(['form', 'errors', 'success']);
    }

    public function edicao($params)
    {
        $id = filter_var($params[0], FILTER_SANITIZE_NUMBER_INT);
        $produtoDao = new produtoDao();

        $produto = $produtoDao->list($id);

        if (!$produto) {
            return Redirect::route("/produto", [
                'errors' => $result->getErrors()
            ]);
            Session::clearSession('errors');
        }

        self::setViewParam('produto', $produto);
        $this->render('/produto/edit');
        Session::clearSession(['form', 'errors', 'success']);
    }

    public function atualizar()
    {
        $produto = new Produto();
        $produto->setId($_POST['id']);
        $produto->setNome($_POST['nome']);
        $produto->setPreco($_POST['preco']);
        $produto->setStatus($_POST['status']);
        $produto->setQuantidade($_POST['quantidade']);
        $produto->setDescricao($_POST['descricao']);
        Session::setSession('form', $_POST);
        $produtoDao = new ProdutoDao();

        $validation = new ValidationProduct();
        $result = $validation->validate($produto);

        if ($result->getErrors()) {
            return Redirect::route("/produto/edicao/" . $_POST['id'], [
                'errors' => $result->getErrors()
            ]);
            Session::clearSession('errors');
        }
        $produtoDao->atualizar($produto);
        return Redirect::route("/produto", [
            'success' => ['Produto atualizado!']
        ]);
        Session::clearSession(['form', 'errors', 'success']);
    }

    public function exclusao($params)
    {
        $id = filter_var($params[0], FILTER_SANITIZE_NUMBER_INT);
        $produtoDao = new ProdutoDao();
        $produto = $produtoDao->list($id);
        if (!$produto) {
            return Redirect::route("/produto", [
                'errors' => $result->getErrors()
            ]);
            Session::clearSession('errors');
        }
        self::setViewParam('produto', $produto);
        $this->render('/produto/exclusao');

        Session::clearSession(['errors', 'success']);
    }
    public function excluir()
    {
        $produto = new Produto();
        $produto->setId($_POST['id']);
        $produtoDao = new ProdutoDao();
        if (!$produtoDao->excluir($produto)) {
            return Redirect::route("/produto", [
                'errors' => $result->getErrors()
            ]);
            Session::clearSession('errors');
        }
        return Redirect::route("/produto", [
            'success' => ['Produto excluído com sucesso!']
        ]);
    }
}