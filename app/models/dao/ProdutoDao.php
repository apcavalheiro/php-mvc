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
        $totalLinhas = $resultadoTotal->fetch()['total'];

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
                "SELECT p.id as idProduto,
                        m.id as idMarca,
                        p.nome as nomeProduto, 
                        p.preco, 
                        p.quantidade, 
                        p.descricao, 
                        m.nome as nomeMarca 
                    FROM produto as p
                INNER JOIN marca as m ON p.marca_id = m.id
                WHERE p.id = $id"
            );
            $dataSetProdutos = $result->fetch();
            if ($dataSetProdutos) {
                $produto = new Produto();
                $produto->setId($dataSetProdutos['idProduto']);
                $produto->setNome($dataSetProdutos['nomeProduto']);
                $produto->setPreco($dataSetProdutos['preco']);
                $produto->setQuantidade($dataSetProdutos['quantidade']);
                $produto->setDescricao($dataSetProdutos['descricao']);
                $produto->getMarca()->setNome($dataSetProdutos['nomeMarca']);
                $produto->getMarca()->setId($dataSetProdutos['idMarca']);

                return $produto;
            }
            return false;
        } else {
            $result = $this->select(
                'SELECT  p.id as idProduto, 
                              p.nome as nomeProduto, 
                              p.preco, 
                              m.nome as nomeMarca 
                              FROM produto as p
                      INNER JOIN marca as m ON p.marca_id = m.id 
                      '
            );
            $dataSetProdutos = $result->fetchAll();
            if ($dataSetProdutos) {

                $listaProdutos = [];

                foreach ($dataSetProdutos as $dataSetProduto) {
                    $produto = new Produto();
                    $produto->setId($dataSetProduto['idProduto']);
                    $produto->setNome($dataSetProduto['nomeProduto']);
                    $produto->setPreco($dataSetProduto['preco']);
                    $produto->getMarca()->setNome($dataSetProduto['nomeMarca']);

                    $listaProdutos[] = $produto;
                }

                return $listaProdutos;
            }

            return false;
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
            $marca_id = $produto->getMarca()->getId();

            return $this->insert(
                'produto',
                ":nome,:status,:preco,:quantidade,:ean,:descricao,:marca_id",
                [
                    ':nome' => $nome,
                    ':status' => $status,
                    ':preco' => $preco,
                    ':quantidade' => $quantidade,
                    ':ean' => $ean,
                    ':descricao' => $descricao,
                    ':marca_id' => $marca_id
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
            $marca_id = $produto->getMarca()->getId();

            return $this->update(
                'produto',
                "nome = :nome,  status = :status, preco = :preco, quantidade = :quantidade, ean = :ean, descricao = :descricao, marca_id = :marca_id",
                [
                    ':id' => $id,
                    ':nome' => $nome,
                    ':preco' => $preco,
                    ':status' => $status,
                    ':ean' => $ean,
                    ':quantidade' => $quantidade,
                    ':descricao' => $descricao,
                    ':marca_id' => $marca_id
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