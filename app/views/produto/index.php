<div class="container">
    <div class="starter-template">
    <?php if ($Session::getSession('success')) {?>
            <?php foreach ($Session::getSession('success') as $message) {?>
                <div class="alert alert-info" role="alert">
                    <i class="glyphicon glyphicon-ok-sign"></i>
                     <strong> <?=$message;?></strong>
                </div>
            <?php }?>
        <?php }?>
   </div>
    <?php
if (!count($viewVar[''])) {
    ?>
            <div class="alert alert-info" role="alert">Nenhum produto encontrado</div>
        <?php
} else {
    ?>

            <div class="table-responsive">
                <table cllistProductsass="table table-bordered table-hover">
                    <tr>
                        <td class="info">Nome</td>
                        <td class="info">Preço</td>
                        <td class="info">Quantidade</td>
                        <td class="info">Data Cadastro</td>
                        <td class="info"></td>
                    </tr>
                    <?php
foreach ($viewVar['listProducts'] as $produto) {
        ?>
                        <tr>
                            <td><?php echo $produto->getNome(); ?></td>
                            <td>R$ <?php echo $produto->getPreco(); ?></td>
                            <td><?php echo $produto->getQuantidade(); ?></td>
                            <td><?php echo $produto->getDataCadastro()->format('d/m/Y'); ?></td>
                            <td>
                                <a href="http://<?php echo APP_HOST; ?>/produto/edicao/<?php echo $produto->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                                <a href="http://<?php echo APP_HOST; ?>/produto/exclusao/<?php echo $produto->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
                            </td>
                        </tr>
                    <?php
}
    ?>
                </table>
            </div>
        <?php
}
?>
</div>
