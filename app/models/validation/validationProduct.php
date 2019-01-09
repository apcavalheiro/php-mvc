<?php

namespace App\Models\Validation;

use App\Models\Entities\Produto;

class ValidationProduct
{
    public function validate(Produto $produto)
    {
        $insert = new ValidationResult();

        if (empty($produto->getNome())) {
            $insert->addErro('nome', "Nome: Este campo não pode ser vazio");
        }

        if (empty($produto->getPreco())) {
            $insert->addErro('preco', "Preço: Este campo não pode ser vazio");
        }

        if (empty($produto->getQuantidade())) {
            $insert->addErro('quantidade', "Quantidade: Este campo não pode ser vazio");
        }

        if (empty($produto->getDescricao())) {
            $insert->addErro('descricao', "Descrição: Este campo não pode ser vazio");
        }

        if (empty($produto->getMarca()->getId())) {
            $insert->addErro('marca_id', "Marca: Este campo não pode ser vazio");
        }
        return $insert;
    }
}