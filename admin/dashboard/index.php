<?php require_once"components/header.php" ?>
<?php require_once"components/navbar.php" ?>

<div class="d-flex">

    <?php require_once"components/sidebar.php" ?>

    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Cadastrar Usuário</h2>
                </div>
                <a href="listar.html">
                    <div class="p-2">
                        <button class="btn btn-outline-info btn-sm">
                            Listar
                        </button>
                    </div>
                </a>
            </div><hr>
            <form>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label><span class="text-danger">*</span> Nome</label>
                        <input name="nome" type="text" class="form-control" id="nome" placeholder="Nome completo">
                    </div>
                    <div class="form-group col-md-6">
                        <label><span class="text-danger">*</span> E-mail</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Seu melhor e-mail">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Senha</label>
                        <input name="senha" type="password" class="form-control" id="senha" placeholder="Senha com mínimo 6 caracteres">
                    </div>
                    <div class="form-group col-md-6">
                        <label>Confirma Senha</label>
                        <input name="conf_senha" type="password" class="form-control" id="conf_senha" placeholder="Confirma a senha">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Endereço</label>
                        <input name="endereco" type="text" class="form-control" id="endereco" placeholder="Rua João...">
                    </div>
                    <div class="form-group col-md-2">
                        <label>Número</label>
                        <input name="numero" type="text" class="form-control" id="numero" placeholder="123">
                    </div>
                    <div class="form-group col-md-4">
                        <label>Complemento</label>
                        <input name="complemento" type="text" class="form-control" id="complemento" placeholder="Sala, Apartamento...">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label>Estado</label>
                        <select name="estado" id="estado" class="form-control">
                            <option selected>Selecione</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-5">
                        <label>Cidade</label>
                        <select name="cidade" id="cidade" class="form-control">
                            <option selected>Selecione</option>
                            <option>...</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>CEP</label>
                        <input name="cep" type="text" class="form-control" id="cep" placeholder="12345-678">
                    </div>
                </div>
                <div class="form-group">
                    <label>Exemplo 1</label>
                    <input name="exemplo_1" type="text" class="form-control" id="exemplo_1" placeholder="Exemplo 1">
                </div>
                <p>
                    <span class="text-danger">* </span>Campo obrigatório
                </p>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="apagarRegistro" tabindex="-1" role="dialog" aria-labelledby="apagarRegistroLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="exampleModalLabel">EXCLUIR ITEM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir o item selecionado?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger">Apagar</button>
            </div>
        </div>
    </div>
</div>

<?php require_once"components/footer.php" ?>

