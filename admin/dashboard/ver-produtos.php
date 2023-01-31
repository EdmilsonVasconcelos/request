<?php require_once"components/header.php" ?>
<?php require_once"components/navbar.php" ?>
<?php require_once"components/loader.php" ?>

<div class="d-flex">

    <?php require_once"components/sidebar.php" ?>

    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo">Listar produtos</h2>
                </div>
                <a href="cadastrar.html">
                    <div class="p-2">
                        <a href="cadastrar-produto" class="btn btn-outline-success btn-sm">
                            Cadastrar
                        </a>
                    </div>
                </a>
            </div>

            <!-- ko if: list_products().length -->
            <div class="table-responsive" data-bind="foreach: list_products()">
                <!-- ko if: products.length -->
                <p class="text-success" data-bind="text: 'Produtos para a categoria: ' + category"></p>
                <table class="table table-striped table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th class="d-none d-sm-table-cell">Descrição</th>
                            <th class="d-none d-lg-table-cell">Valor a vista</th>
                            <th class="d-none d-lg-table-cell">Valor no crédito</th>
                            <th class="d-none d-lg-table-cell">Valor no débito</th>
                            <th class="d-none d-lg-table-cell text-center">Disponível</th>
                            <th class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody data-bind="foreach: products">
                        <tr>
                            <td data-bind="text: name"></td>
                            <td class="d-none d-sm-table-cell" data-bind="text: description"></td>
                            <td class="d-none d-lg-table-cell" data-bind="text: $parents[1].numberToReal(price)"></td>
                            <td class="d-none d-lg-table-cell" data-bind="text: priceCredit ? $parents[1].numberToReal(priceCredit) : 'N/A'"></td>
                            <td class="d-none d-lg-table-cell" data-bind="text: priceDebit ? $parents[1].numberToReal(priceDebit) : 'N/A'"></td>
                            <td class="d-none d-sm-table-cell text-center">
                                <button 
                                    data-bind="click: $parents[1].setAvailableProduct.bind($parents[1], $data), 
                                        clickBubble: false,
                                        attr: { 
                                            title: !available ? name + ' está indisponível para pedidos' : name +  ' está disponível para pedidos',
                                            class: available ? 'btn btn-success' : 'btn btn-danger'
                                        }">
                                        <i class="fa" data-bind="css: { 'fa-times': !available, 'fa-check': available }" aria-hidden="true"></i>
                                </button>
                            </td>
                            <td class="text-center">
                                <span class="d-none d-md-block">
                                    <a class="btn btn-outline-warning btn-sm" data-bind="attr: { title: 'Editar ' + name, href: 'editar-produto?id=' + id }">Editar</a>
                                    <a data-bind="click: $parents[1].handleDeleteProduct.bind($parents[1], id, name)" href="#" class="btn btn-outline-danger btn-sm" data-bind="attr: { title: 'Apagar ' + name }" data-toggle="modal" data-target="#apagarRegistro">Apagar</a>
                                </span>
                                <div class="dropdown d-block d-md-none">
                                    <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Ações
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                        <a class="dropdown-item" data-bind="attr: { title: 'Editar ' + name, href: 'editar-produto?id=' + id }">Editar</a>
                                        <a class="dropdown-item" href="#" data-bind="click: $parents[1].handleDeleteProduct.bind($parents[1], id, name)" data-toggle="modal" data-target="#apagarRegistro">Apagar</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!-- /ko -->
            </div>
            <!-- /ko -->

            <!-- ko ifnot: list_products().length -->
            <div class="text-center mt-5">
                <h4>Nenhum produto cadastrado</h4>
                <a href="cadastrar-produto" class="btn btn-link">Cadatrar produto</a>
            </div>
            <!-- /ko -->

        </div>
    </div>
</div>

<div class="modal fade" id="modalQuestionDeleteProduct" tabindex="-1" role="dialog" aria-labelledby="modalQuestionDeleteProductTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Deletar produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" data-bind="text: 'Deseja apagar ' + question_product() + '?' "></div>
            <div class="modal-footer">
                <a data-bind="click: $data.deleteProduct.bind($data, question_id_product())" class="btn btn-primary btn-lg" class="btn btn-primary">Ok</a>
            </div>
        </div>
    </div>
</div>

<?php require_once"components/footer.php" ?>

<script src="assets/js/list-products.js"></script>