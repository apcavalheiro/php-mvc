<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">

            <h3>Editar Marca</h3>
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

            <form action="/marca/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['marca']->getId(); ?>">
                <div class="form-group">
                    <label for="nome">Marca</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="" value="<?php echo $viewVar['marca']->getNome(); ?>"
                        required>
                </div>
                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="/usuario" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>