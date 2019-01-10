<?php

namespace App\Models\Validation;

use App\Models\Entities\Produto;

class ValidationProduct
{
    public function validate(Produto $produto)
    {
        $insert = new ValidationResult();

        if (empty($produto->getNome())) {
            $insert->addErrors('nome', "Nome: Este campo não pode ser vazio");
        }

        if (empty($produto->getPreco())) {
            $insert->addErrors('preco', "Preço: Este campo não pode ser vazio");
        }

        if (empty($produto->getStatus())) {
            $insert->addErrors('status', "Status: Este campo não pode ser vazio");
        }

        if (empty($produto->getQuantidade())) {
            $insert->addErrors('quantidade', "Quantidade: Este campo não pode ser vazio ou ter valor nulo");
        }
        if ($produto->getQuantidade() == 0) {
            $produto->setQuantidade('Zerado');
        }

        if (empty($produto->getDescricao())) {
            $insert->addErrors('descricao', "Descrição: Este campo não pode ser vazio");
        }

        if (empty($produto->getMarca()->getId())) {
            $insert->addErrors('marca_id', "Marca: Este campo não pode ser vazio");
        }
        return $insert;
    }
}