<?php require_once"components/header.php" ?>
<?php require_once"components/navbar.php" ?>
<?php require_once"components/loader.php" ?>

<div class="d-flex">

    <?php require_once"components/sidebar.php" ?>

    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Listar categorias</h2>
                </div>
                <a href="cadastrar.html">
                    <div class="p-2">
                        <a href="cadastrar-categoria" class="btn btn-outline-success btn-sm">
                            Cadastrar
                        </a>
                    </div>
                </a>
            </div>

            <!-- ko if: categories().length -->
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th class="d-none d-sm-table-cell">Nome</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: categories">
                        <tr>
                            <td data-bind="text: name"></td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <a class="btn btn-outline-warning btn-sm" data-bind="attr: { title: 'Editar ' + name, href: 'editar-categoria?id=' + id }">Editar</a>
                                    <a 
                                    data-bind="click: $parent.handleDeleteCategory.bind($parent, id, name)" 
                                    href="#" class="btn btn-outline-danger btn-sm" 
                                    data-bind="attr: { title: 'Apagar ' + name }" 
                                    data-toggle="modal" 
                                    data-target="#apagarRegistro">Apagar</a>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- /ko -->

            <!-- ko ifnot: categories().length -->
            <div class="text-center mt-5">
                <h4>Nenhum categoria cadastrada</h4>
                <a href="cadastrar-categoria" class="btn btn-link">Cadatrar categoria</a>
            </div>
            <!-- /ko -->

        </div>
    </div>
</div>

<div class="modal fade" id="modalQuestionDeleteProduct" tabindex="-1" role="dialog" aria-labelledby="modalQuestionDeleteProductTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Deletar categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" data-bind="text: 'Deseja deletar categoria ' + question_category() + '?' "></div>
            <div class="modal-footer">
                <a data-bind="click: $data.deleteCategory.bind($data, question_id_category())"  class="btn btn-primary btn-lg" class="btn btn-primary">Ok</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMessageErrorDeleteCategory" tabindex="-1" role="dialog" aria-labelledby="modalQuestionDeleteProductTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Atenção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Existem produtos associados a esta categoria, para deletar esta categoria, você precisa deletar os produtos primeiro
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary btn-lg" class="btn btn-primary" href="ver-categorias">Entendi</a>
            </div>
        </div>
    </div>
</div>

<?php require_once"components/footer.php" ?>

<script src="assets/js/list-categories.js"></script>