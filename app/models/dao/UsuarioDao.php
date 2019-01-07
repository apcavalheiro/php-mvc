<?php

namespace App\Models\Dao;

use App\Models\Dao\BaseDao;
use App\Models\Entities\Usuario;

class UsuarioDao extends BaseDao
{
    public function emailExist($email)
    {
        try {
            $query = $this->select(
                "SELECT * FROM usuario WHERE email = '$email'"
            );
            return $query->fetch();
        } catch (\Exception $e) {
            throw new \Exception("Erro no acesso a dados!", 500);
        }
    }

    function list($id = null) {
        if ($id) {
            $result = $this->select(
                "SELECT * FROM usuario WHERE id = '$id'"
            );
            return $result->fetchObject(Usuario::class);
        } else {
            $result = $this->select(
                'SELECT * FROM usuario'
            );
            return $result->fetchAll(\PDO::FETCH_CLASS, Usuario::class);
        }
        return false;
    }

    public function toSave(Usuario $usuario)
    {
        try {
            $nome = $usuario->getNome();
            $email = $usuario->getEmail();
            return $this->insert(
                'usuario', ':nome,:email',
                [
                    ':nome' => $nome,
                    ':email' => $email,
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar no banco de dados!", 500);
        }
    }

    public function edit(Usuario $usuario)
    {
        try {
            $id = $usuario->getId();
            $nome = $usuario->getNome();
            $email = $usuario->getEmail();
            return $this->update(
                'usuario', "nome = :nome, email = :email",
                [
                    ':id' => $id,
                    ':nome' => $nome,
                    ':email' => $email,
                ],
                "id = :id"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro ao atualizar no banco de dados!", 500);
        }
    }

    public function remove(Usuario $usuario)
    {
        try {
            $id = $usuario->getId();
            return $this->delete('usuario', "id = $id");
        } catch (\Exception $e) {
            throw new \Exception("Erro ao deletar", 500);
        }
    }
}
