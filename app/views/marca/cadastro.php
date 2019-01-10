<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Marca</h3>
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
            <form action="/marca/salvar" method="post" id="form_cadastro">
                <div class="form-group">
                    <label for="nome">Marca</label>
                    <input type="text" class="form-control" name="nome" placeholder="Marca" value="<?= $Session::getFormSession('nome') ?>"
                        required>
                </div>
                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>