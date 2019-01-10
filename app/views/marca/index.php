<div class="container">
    <div class="row">
        <a href="/marca/cadastro" class="btn btn-primary pull-right">
            <i class="glyphicon glyphicon-plus-sign"></i>
            Nova Marca</a>
    </div>
</div>
<div class="container">
    <div class="starter-template">
        <?php if ($Session::getSession('success')) { ?>
        <?php foreach ($Session::getSession('success') as $message) { ?>
        <div class="alert alert-success" role="alert" id="notice">
            <i class="glyphicon glyphicon-ok-sign"></i>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>
                <?= $message; ?></strong>
        </div>
        <?php 
    } ?>
        <?php 
    } ?>
        <?php if ($Session::getSession('errors')) { ?>
        <?php foreach ($Session::getSession('errors') as $message) { ?>
        <div class="alert alert-warning" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <i class="glyphicon glyphicon-ok-sign"></i>
            <strong>
                <?= $message; ?></strong>
        </div>
        <?php 
    } ?>
        <?php 
    } ?>

        <?php if (!count($viewVar['listaMarcas'])) { ?>
        <div class="alert alert-info" role="alert">Nenhuma Marca encontrada!</div>
        <?php 
    } else { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <td class="info">Marca</td>
                    <td class="info"></td>
                </tr>
                <?php foreach ($viewVar['listaMarcas'] as $marca) { ?>
                <tr>
                    <td>
                        <?php echo $marca->getNome(); ?>
                    </td>

                    <td>
                        <a href="/marca/edicao/<?php echo $marca->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                        <a href="/marca/exclusao/<?php echo $marca->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
                    </td>
                </tr>
                <?php 
            } ?>
                <?php 
            } ?>
            </table>
        </div>
    </div>
</div>