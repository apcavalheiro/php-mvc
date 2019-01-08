<?php

namespace App\Models\Dao;

use App\Models\Entities\Produto;

class ProdutoDao extends BaseDao
{
    public function buscaComPaginacao($buscaProduto, $totalPorPagina, $paginaSelecionada)
    {
        $paginaSelecionada = (!$paginaSelecionada) ? 1 : $paginaSelecionada;
        $inicio = (($paginaSelecionada - 1) * $totalPorPagina);
        $whereBusca = " WHERE nome 
                                LIKE '%$buscaProduto%' OR nome 
                                LIKE '%$buscaProduto%' OR ean = '$buscaProduto'";
        $resultadoTotal = $this->select(
            "SELECT count(*) as total FROM produto $whereBusca "
        );

        $resultado = $this->select(
            "SELECT * FROM produto as produto $whereBusca LIMIT $inicio,$totalPorPagina"
        );
        $totalLinhas = (int)$resultadoTotal->fetchColumn(0);

        return [
            'paginaSelecionada' => $paginaSelecionada,
            'totalPorPagina' => $totalPorPagina,
            'totalLinhas' => $totalLinhas,
            'resultado' => $resultado->fetchAll(\PDO::FETCH_CLASS, Produto::class)
        ];
    }
    public function list($id = null)
    {
        if ($id) {
            $result = $this->select(
                "SELECT * FROM produto WHERE id = $id"
            );
            return $result->fetchObject(Produto::class);
        } else {
            $result = $this->select(
                "SELECT * FROM produto"
            );
            return $result->fetchAll(\PDO::FETCH_CLASS, Produto::class);
        }
    }

    public function toSave(Produto $produto)
    {
        try {
            $nome = $produto->getNome();
            $preco = $produto->getPreco();
            $status = $produto->getStatus();
            $ean = $produto->getEan();
            $quantidade = $produto->getQuantidade();
            $descricao = $produto->getDescricao();

            return $this->insert(
                'produto',
                ":nome,:status,:preco,:quantidade,:ean,:descricao",
                [
                    ':nome' => $nome,
                    ':status' => $status,
                    ':preco' => $preco,
                    ':quantidade' => $quantidade,
                    ':ean' => $ean,
                    ':descricao' => $descricao
                ]
            );
        } catch (\Exception $e) {
            throw new \Exception("Erro ao salvar no banco de dados!", 500);
        }
    }

    public function atualizar(Produto $produto)
    {
        try {
            $id = $produto->getId();
            $nome = $produto->getNome();
            $preco = $produto->getPreco();
            $status = $produto->getStatus();
            $ean = $produto->getEan();
            $quantidade = $produto->getQuantidade();
            $descricao = $produto->getDescricao();

            return $this->update(
                'produto',
                "nome = :nome,  status = :status, preco = :preco, quantidade = :quantidade, ean = :ean, descricao = :descricao",
                [
                    ':id' => $id,
                    ':nome' => $nome,
                    ':preco' => $preco,
                    ':status' => $status,
                    ':ean' => $ean,
                    ':quantidade' => $quantidade,
                    ':descricao' => $descricao,
                ],
                "id = :id"
            );

        } catch (\Exception $e) {
            throw new \Exception("Erro na gravação de dados.", 500);
        }
    }

    public function excluir(Produto $produto)
    {
        try {
            $id = $produto->getId();

            return $this->delete('produto', "id = $id");

        } catch (Exception $e) {

            throw new \Exception("Erro ao deletar", 500);
        }
    }
}