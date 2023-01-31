<?php require_once"components/header.php" ?>
<?php require_once"components/navbar.php" ?>
<?php require_once"components/loader.php" ?>

<div class="d-flex">

    <?php require_once"components/sidebar.php" ?>

    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo" data-bind="text: 'Editar categoria ' + category().toLowerCase()"></h2>
                </div>
                <a href="ver-categorias">
                    <div class="p-2">
                        <button class="btn btn-outline-info btn-sm">
                            Listar
                        </button>
                    </div>
                </a>
            </div><hr>
            <form data-bind="submit: handleEditCategory">

                <!-- ko if: has_feedback -->
                <div>
                    <h4 data-bind="attr: { class: has_class_feedback }, text: has_message_feedback"></h4>
                </div>
                <!-- /ko -->

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="category">Nome da categoria</label>
                        <input name="category" type="text" class="form-control" id="category" maxLength="50" data-bind="value: category" placeholder="Nome do produto">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Editar</button>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalSuccessEdit" tabindex="-1" role="dialog" aria-labelledby="modalSuccessEditTitle" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Sucesso</h5>
            </div>
            <div class="modal-body">
                Categoria editada com sucesso!
            </div>
            <div class="modal-footer">
                <a href="ver-categorias" class="btn btn-primary btn-lg" class="btn btn-primary">Ok</a>
            </div>
        </div>
    </div>
</div>

<?php require_once"components/footer.php" ?>

<script src="assets/js/edit-category.js"></script>