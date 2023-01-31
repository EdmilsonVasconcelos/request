<?php require_once"components/header.php" ?>
<?php require_once"components/navbar.php" ?>
<?php require_once"components/loader.php" ?>

<div class="d-flex">

    <?php require_once"components/sidebar.php" ?>

    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Cadastrar categoria</h2>
                </div>
                <a href="ver-categorias">
                    <div class="p-2">
                        <button class="btn btn-outline-info btn-sm">
                            Listar
                        </button>
                    </div>
                </a>
            </div><hr>
            <form data-bind="submit: handleAddCategory">

                <!-- ko if: has_feedback -->
                <div>
                    <h4 data-bind="attr: { class: has_class_feedback }, text: has_message_feedback"></h4>
                </div>
                <!-- /ko -->

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="category">Nome da categoria</label>
                        <input name="category" 
                            type="text" 
                            autofocus
                            class="form-control" 
                            id="category" 
                            maxLength="50" 
                            data-bind="value: category" 
                            placeholder="Nome da categoria">
                    </div>
                </div>

                <button type="submit" class="btn btn-success">Cadastrar</button>
            </form>
        </div>
    </div>
</div>

<?php require_once"components/footer.php" ?>

<script src="assets/js/add-category.js"></script>