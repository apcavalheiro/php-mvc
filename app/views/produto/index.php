<div class="container">
    <div class="row">
        <form action="/produto/getByPagination" method="get" class="form-inline ">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Total por pagina:</label>
                    <select name="totalPorPagina" id="totalPorPagina" class="form-control input-sm" onchange="this.form.submit()">
                        <option value="5" <?php echo ($viewVar['totalPorPagina']=="5" ) ? "selected" : "" ; ?>>5</option>
                        <option value="15" <?php echo ($viewVar['totalPorPagina']=="15" ) ? "selected" : "" ; ?>>15</option>
                        <option value="30" <?php echo ($viewVar['totalPorPagina']=="30" ) ? "selected" : "" ; ?>>30</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group pull-right">
                    <div class="input-group">
                        <span class="input-group-addon input-sm" id="basic-addon1">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </span>
                        <input type="text" placeholder="Buscar conteudo" required value="<?php echo $viewVar['buscaProduto']; ?>"
                            class="form-control input-sm" name="buscaProduto" />
                        <div class="input-group-btn">
                            <button class="btn btn-success btn-sm" type="submit">Buscar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="container">
    <div class="row">
        <a href="/produto/cadastro" class="btn btn-primary pull-right">
            <i class="glyphicon glyphicon-plus-sign"></i>
            Novo Produto</a>
    </div>
</div>
<div class="container">
    <div class="starter-template">
        <?php if ($Session::getSession('success')) { ?>
        <?php foreach ($Session::getSession('success') as $message) { ?>
        <div class="alert alert-info" role="alert" id="notice">
            <i class="glyphicon glyphicon-ok-sign"></i>
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>
                <?= $message; ?></strong>
        </div>
        <?php 
    } ?>
        <?php 
    } ?>
    </div>
    <?php if (!count($viewVar)) { ?>
    <div class="alert alert-info" role="alert">Nenhum produto encontrado</div>
    <?php 
} else { ?>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <tr>
                <td class="info">Nome</td>
                <td class="info hidden-sm hidden-xs">EAN</td>
                <td class="info hidden-sm hidden-xs">Status</td>
                <td class="info hidden-sm hidden-xs">Data Cadastro</td>
                <td class="info">Preço</td>
                <td class="info">Quantidade</td>
                <td class="info"></td>
            </tr>
            <?php foreach ($viewVar['listProducts'] as $produto) { ?>
            <tr class="<?php echo ($produto->getStatus() == 'N') ? " linhaDesativado" : "" ; ?>">
                <td>
                    <?php echo $produto->getNome(); ?>
                </td>

                <td class=" hidden-sm hidden-xs">
                    <?php echo $produto->getEan(); ?>
                </td>
                <td class=" hidden-sm hidden-xs">
                    <?php echo ($produto->getStatus() == 'S') ? 'Ativo' : 'Desativado'; ?>
                </td>
                <td class=" hidden-sm hidden-xs">
                    <?php echo date("d/m/Y H:i", $produto->getDataCadastro()); ?>
                </td>
                <td>R$
                    <?php echo $produto->getPreco(); ?>
                </td>
                <td>
                    <?php echo $produto->getQuantidade(); ?>
                </td>

                <td>
                    <a href="/produto/edicao/<?php echo $produto->getId(); ?>" class="btn btn-info btn-sm">Editar</a>
                    <a href="/produto/exclusao/<?php echo $produto->getId(); ?>" class="btn btn-danger btn-sm">Excluir</a>
                </td>
            </tr>
            <?php 
        } ?>
        </table>
    </div>
    <?php echo $viewVar['paginacao']; ?>
    <?php 
} ?>
</div>