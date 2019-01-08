<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Exclusão de Produto</h3>
            <?php if ($Session::getSession('errors')) { ?>
            <?php foreach ($Session::getSession('errors') as $message) { ?>
            <div class="alert alert-danger" role="alert" id="notice">
                <i class="glyphicon glyphicon-ban-circle"></i>
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>
                    <?= $message; ?></strong>
            </div>
            <?php 
        } ?>
            <?php 
        } ?>
            <form action="/produto/excluir" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['produto']->getId(); ?>">

                <div class="panel panel-danger">
                    <div class="panel-body">
                        Deseja realmente excluir o produto:
                        <?php echo $viewVar['produto']->getNome(); ?> ?
                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                        <a href="/produto" class="btn btn-info btn-sm">Voltar</a>
                    </div>
                </div>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>