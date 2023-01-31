<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSC Gás e Água</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script defer src="admin/assets/js/fontawesome-all.min.js"></script>
    <link rel="stylesheet" href="admin/assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/list-products.css">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="./">VSC GÁS E ÁGUA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
            </ul>
            <span class="navbar-text">
                <button type="button" class="btn btn-success mr-4">
                    <i class="fa fa-shopping-cart mr-2" aria-hidden="true"></i>
                    <span class="badge badge-light">0</span>
                </button>
            </span>
        </div>
    </nav>

    <!-- <nav class="navbar fixed-top navbar-light navbar-expand-lg navbar-template">
        <div class="d-flex flex-row order-2 order-lg-3">
            <ul class="navbar-nav flex-row">
                <li class="nav-item">
                    <a class="nav-link px-2" href="#">
                    <button type="button" class="btn btn-success">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        <span class="badge badge-light ml-2">0</span>
                    </button>
                    </a>
                </li>
            </ul>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse order-3 order-lg-2" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">
            </ul>
        </div>
    </nav> -->

    <div class="mt-5">
        <h2 class="text-center text-primary mt-5">Lista de produtos</h2>
    </div>

    <div class="content-table mt-5">

        <!-- ko if: products().length -->
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Produto</th>
                    <th class="d-none d-sm-table-cell">Descrição</th>
                    <th class="d-none d-lg-table-cell">Valor a vista</th>
                    <th class="d-none d-lg-table-cell">Valor no crédito</th>
                    <th class="d-none d-lg-table-cell">Valor no débito</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody data-bind="foreach: products">
                <tr>
                    <td data-bind="text: name_product"></td>
                    <td class="d-none d-sm-table-cell" data-bind="text: description_product"></td>
                    <td class="d-none d-lg-table-cell" data-bind="text: $parent.numberToReal(value_product)"></td>
                    <td class="d-none d-lg-table-cell" data-bind="text: value_product_credit ? $parent.numberToReal(value_product_credit) : 'N/A'"></td>
                    <td class="d-none d-lg-table-cell" data-bind="text: value_product_debit ? $parent.numberToReal(value_product_debit) : 'N/A'"></td>
                    <td class="text-center">
                        <span class="d-none d-md-block">
                            <a class="btn btn-outline-warning btn-sm" data-bind="attr: { title: 'Editar ' + name_product, href: 'editar-produto?id=' + id }">Editar</a>
                            <a data-bind="click: $parent.handleDeleteProduct.bind($parent, id, name_product)" href="#" class="btn btn-outline-danger btn-sm" data-bind="attr: { title: 'Apagar ' + name_product }" data-toggle="modal" data-target="#apagarRegistro">Apagar</a>
                        </span>
                        <div class="dropdown d-block d-md-none">
                            <button class="btn btn-primary dropdown-toggle btn-sm" type="button" id="acoesListar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Ações
                            </button>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="acoesListar">
                                <a class="dropdown-item" data-bind="attr: { title: 'Editar ' + name_product, href: 'editar-produto?id=' + id }">Editar</a>
                                <a class="dropdown-item" href="#" data-bind="click: $parent.handleDeleteProduct.bind($parent, id, name_product)" data-toggle="modal" data-target="#apagarRegistro">Apagar</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <!-- /ko -->

        <!-- ko ifnot: products().length -->
        <div class="text-center mt-5">
            <h4>Nenhum produto cadastrado</h4>
            <a href="cadastrar-produto" class="btn btn-link">Cadatrar produto</a>
        </div>
        <!-- /ko -->

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <script src="admin/assets/js/jquery.maskMoney.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.0/knockout-min.js"></script>
    <script src="assets/js/list-products.js"></script>
</body>
</html>