<?php

namespace App\Models\Dao;

class MarcaDao extends BaseDao
{
    public function list($id = null)
    {
        if ($id) {
            $result = $this->select(
                "SELECT * FROM marca WHERE id = $id"
            );
            return $result->fetchObject(Marca::class);
        } else {
            $result = $this->select(
                "SELECT * FROM marca"
            );
            return $result->fetchAll(\PDO::FETCH_CLASS, Marca::class);
        }
    }

    public function getQuantidadeProdutos($id)
    {
        if ($id) {
            $result = $this->select(
                "SELECT count(*) as total FROM produto WHERE marca_id= $id"
            );
            return $result->fetch()['total'];
        }
        return false;
    }

    public function toSave(Marca $marca)
    {
        try {
            $nome = $marca->getNome();
            return $this->insert(
                'marca',
                ":nome",
                [
                    ':nome' => $nome
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados." . $e->getMessage(), 500);
        }
    }

    public function atualizar(Marca $marca)
    {
        try {
            $id = $id->getId();
            $nome = $marca->getNome();
            return $this->update(
                'marca',
                'nome = :nome',
                [
                    ':nome' => $nome
                ],
                "id = $id"
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro na atualizaçao de dados." . $e->getMessage(), 500);
        }
    }

    public function excluir(Marca $marca)
    {
        try {
            $id = $marca->getId();
            return $this->delete('marca', "id=$id");
        } catch (\Exception $e) {
            throw new \Exception("Erro na exclusao de dados." . $e->getMessage(), 500);
        }
    }
}