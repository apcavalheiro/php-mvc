<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <h3>Cadastro de Produto</h3>
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
            <form action="/produto/salvar" method="post" id="form_cadastro">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" class="form-control" name="nome" placeholder="Nome do Produto" value="<?php echo $Session::getFormSession('nome'); ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="preco">Preço</label>
                    R$ <input type="text" class="form-control" name="preco" placeholder="100" value="<?php echo $Session::getFormSession('preco'); ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="quantidade">Quantidade</label>
                    <input type="number" class="form-control" name="quantidade" placeholder="0" value="<?php echo $Session::getFormSession('quantidade'); ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="ean">Ean</label>
                    <input type="number" class="form-control" name="ean" placeholder="0" value="<?php echo $Session::getFormSession('ean'); ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <input type="text" class="form-control" name="status" placeholder="S" value="<?php echo $Session::getFormSession('status'); ?>"
                        required>
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea class="form-control" name="descricao" placeholder="Descrição do produto" required><?php echo $Session::getFormSession('descricao'); ?></textarea>
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
                <button type="reset" class="btn btn-default btn-sm">Limpar</button>
            </form>
        </div>
        <div class=" col-md-3"></div>
    </div>
</div>