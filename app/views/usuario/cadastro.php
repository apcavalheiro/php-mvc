<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Usuário</h3>
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
            <form action="/usuario/salvar" method="post" id="form_cadastro">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="Seu nome" value="<?= $Session::getFormSession('nome') ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" class="form-control" name="email" placeholder="Digite um email válido" value="<?= $Session::getFormSession('email') ?>"
                        required>
                </div>
                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>