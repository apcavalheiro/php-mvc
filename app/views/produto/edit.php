<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Editar Produto</h3>
            <?php if ($Session::getSession('errors')) { ?>
            <?php foreach ($Session::getSession('errors') as $message) { ?>
            <div class="alert alert-warning" role="alert" id="notice">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <i class="glyphicon glyphicon-ok-sign"></i>
                <strong>
                    <?= $message; ?></strong>
            </div>
            <?php 
        } ?>
            <?php 
        } ?>
            <form action="/produto/atualizar" method="post" id="form_cadastro">
                <input type="hidden" class="form-control" name="id" id="id" value="<?php echo $viewVar['produto']->getId(); ?>">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" id="nome" placeholder="" value="<?php echo $viewVar['produto']->getNome(); ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    <input type="text" class="form-control" name="preco" id="preco" placeholder="" value="<?php echo $viewVar['produto']->getPreco(); ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" name="status" value="<?php echo $viewVar['produto']->getStatus(); ?>">
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" class="form-control" name="quantidade" id="quantidade" placeholder="" value="<?php echo $viewVar['produto']->getQuantidade(); ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" name="descricao" placeholder="Descrição do produto" required><?php echo $viewVar['produto']->getDescricao(); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="marca">Marca</label>
                    <select class="form-control" name="marca_id" required>
                        <?php foreach ($viewVar['listaMarcas'] as $marca) { ?>
                        <option value="<?php echo $marca->getId(); ?>" <?php echo ($Session::getFormSession('marca_id')==$marca->getId())
                            ? "selected" : ""; ?>>
                            <?php echo $marca->getNome(); ?>
                        </option>
                        <?php 
                    } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                <a href="/produto" class="btn btn-info btn-sm">Voltar</a>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>