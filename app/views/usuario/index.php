<div class="container">
    <div class="row">
        <a href="/usuario/cadastro" class="btn btn-primary pull-right">
            <i class="glyphicon glyphicon-plus-sign"></i>
            Novo Usuário</a>
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

        <?php if (!count($viewVar['listUsers'])) { ?>
        <div class="alert alert-info" role="alert">Nenhum usuário encontrado</div>
        <?php 
    } else { ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <tr>
                    <td class="info">Nome</td>
                    <td class="info">email</td>
                    <td class="info"></td>
                </tr>
                <?php foreach ($viewVar['listUsers'] as $user) { ?>
                <tr>
                    <td>
                        <?php echo $user->getNome(); ?>
                    </td>
                    <td>
                        <?php echo $user->getEmail(); ?>
                    </td>
                    <td>
                        <a href="/usuario/edicao/<?php echo $user->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                        <a href="/usuario/exclusao/<?php echo $user->getId(); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Deseja realmente excluír esta notícia?')">Excluir</a>
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