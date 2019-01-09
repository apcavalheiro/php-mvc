<?php

namespace App\Models\Entities;

use DateTime;
use App\Models\Entities\Marca;

class Produto
{
    private $id;
    private $nome;
    private $preco;
    private $ean;
    private $status;
    private $quantidade;
    private $descricao;
    private $dataCadastro;
    private $marca;

    public function __construct()
    {
        $this->marca = new Marca();
    }
    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function setPreco($preco)
    {
        $this->preco = $preco;

        return $this;
    }

    public function getQuantidade()
    {
        return $this->quantidade;
    }

    public function setQuantidade($quantidade)
    {
        $this->quantidade = $quantidade;

        return $this;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    public function getDataCadastro()
    {
        return $this->dataCadastro;
    }

    public function setDataCadastro($dataCadastro)
    {
        $this->dataCadastro = $dataCadastro;

        return $this;
    }

    public function getEan()
    {
        return $this->ean;
    }

    public function setEan($ean)
    {
        $this->ean = $ean;

        return $this;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    public function getMarca()
    {
        return $this->marca;
    }

    public function getMarcaId()
    {
        return $this->marca_id;
    }

    public function setMarcaId($marca_id)
    {
        $this->marca_id = $marca_id;

        return $this;
    }
}