<?php

namespace App\Controllers;

use App\Controllers\Controller;
use App\Models\Dao\UsuarioDao;
use App\Models\Entities\Usuario;
use App\Utils\Redirect;
use App\Utils\Session;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarioDao = new UsuarioDao();
        self::setViewParam('listUsers', $usuarioDao->list());
        $this->render('/usuario/index');
        Session::clearSession(['form', 'errors', 'success']);
    }

    public function cadastro()
    {
        $this->render('/usuario/cadastro');
        Session::clearSession(['form', 'errors', 'success']);
    }

    public function salvar()
    {
        $usuario = new Usuario();
        $usuario->setNome($_POST['nome']);
        $usuario->setEmail($_POST['email']);

        Session::setSession('form', $_POST);

        $usuarioDao = new UsuarioDao();

        if ($usuarioDao->emailExist($_POST['email'])) {
            return Redirect::route("/usuario/cadastro", [
                'errors' => ['Email já existe na base de dados!']]);
        }

        if ($usuarioDao->toSave($usuario)) {
            return Redirect::route("/usuario/index", [
                'success' => ['Usuário salvo']]);
            Session::clearSession(['form', 'errors', 'success']);
        } else {
            return Redirect::route("/usuario/cadastro", [
                'errors' => ['Erro ao salvar!']]);
            Session::clearSession(['form', 'errors', 'success']);
        }
    }

    public function edicao($params)
    {
        $id = filter_var($params[0], FILTER_SANITIZE_NUMBER_INT);
        $usuarioDao = new UsuarioDao();

        $usuario = $usuarioDao->list($id);

        if (!$usuario) {
            return Redirect::route("/usuario", [
                'errors' => ['Usuário inexistente!']]);
            Session::clearSession('errors');
        }

        self::setViewParam('usuario', $usuario);
        $this->render('/usuario/edit');
        Session::clearSession(['form', 'errors', 'success']);
    }

    public function atualizar()
    {
        $usuario = new Usuario();
        $usuario->setId($_POST['id']);
        $usuario->setNome($_POST['nome']);
        $usuario->setEmail($_POST['email']);
        Session::setSession('form', $_POST);
        $usuarioDao = new UsuarioDao();
        if ($usuarioDao->edit($usuario)) {
            return Redirect::route("/usuario/index", [
                'success' => ['Usuário atualizado']]);
            Session::clearSession('success');
        } else {
            return Redirect::route("/usuario/edicao/" . $usuario->getId(), [
                'errors' => ['Erro ao atualizar!']]);
            Session::clearSession('errors');
        }
    }

    public function exclusao($params)
    {
        $id = filter_var($params[0], FILTER_SANITIZE_NUMBER_INT);
        $usuarioDao = new UsuarioDao();
        $usuario = new Usuario();
        $usuario->setId($id);

        if (!$usuarioDao->remove($usuario)) {
            return Redirect::route("/usuario/cadastro", [
                'errors' => ['Erro ao excluir!']]);
            Session::clearSession('errors');
        }
        return Redirect::route("/usuario/index", [
            'success' => ['Usuário excluído!']]);
        Session::clearSession(['form', 'errors', 'success']);
    }
}
