<?php require_once"components/header.php" ?>
<?php require_once"components/navbar.php" ?>
<?php require_once"components/loader.php" ?>

<div class="d-flex">

    <?php require_once"components/sidebar.php" ?>

    <div class="content p-1">
        <div class="list-group-item">
            <div class="d-flex">
                <div class="mr-auto p-2">
                    <h2 class="display-4 titulo" data-bind="text: 'Editar ' + product().toLowerCase()"></h2>
                </div>
                <a href="ver-produtos">
                    <div class="p-2">
                        <button class="btn btn-outline-info btn-sm">
                            Listar
                        </button>
                    </div>
                </a>
            </div><hr>
            <form data-bind="submit: handleEditProduct">

                <!-- ko if: has_feedback -->
                <div>
                    <h4 data-bind="attr: { class: has_class_feedback }, text: has_message_feedback"></h4>
                </div>
                <!-- /ko -->

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="product">Nome</label>
                        <input name="product" type="text" class="form-control" id="product" maxLength="50" data-bind="value: product" placeholder="Nome do produto">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="category">Categoria</label>
                        <select name="category" id="category" class="form-control" 
                            data-bind="options: categories,
                            optionsText: 'name',
                            optionsValue: 'id',
                            value: selected_option_category,
                            optionsCaption: 'Selecione a categoria deste produto'">
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="description">Descrição do produto</label>
                        <input name="description" type="text" class="form-control" id="description" maxLength="256" data-bind="value: description" placeholder="Descrição do produto">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="payment-methods">Aceita formas de pagamento</label>
                        <select name="payment-methods" id="payment-methods" class="form-control" 
                        data-bind="options: payment_methods,
                        optionsText: 'name',
                        optionsValue: 'value',
                        value: selected_option_method_payment,
                        optionsCaption: 'Selecione a forma de pagamento para este produto',
                        event:{ change: setMethodPayment() }">
                        </select>
                    </div>
                </div>

                <div class="form-row" data-bind="visible: show_price() && !show_price_credit() && !show_price_debit()">
                    <div class="form-group col-md-12">
                        <label for="price">Valor a vista</label>
                        <input name="price" type="text" class="form-control" id="price" maxLength="50" data-bind="value: price" placeholder="Valor">
                    </div>
                </div>

                <div class="form-row" data-bind="visible: !show_price() && show_price_credit() && !show_price_debit()">
                    <div class="form-group col-md-12">
                    <label for="price-credit">Valor cartão de crédito</label>
                        <input name="price-credit" type="text" class="form-control" id="price-credit" maxLength="50" data-bind="value: priceCredit" placeholder="Valor">
                    </div>
                </div>

                <div class="form-row" data-bind="visible: !show_price() && !show_price_credit() && show_price_debit">
                    <div class="form-group col-md-12">
                        <label for="price-debit">Valor no débito</label>
                        <input name="price-debit" type="text" class="form-control" id="price-debit" maxLength="50" data-bind="value: priceDebit" placeholder="Valor">
                    </div>
                </div>

                <div class="form-row" data-bind="visible: show_price() && show_price_credit() && !show_price_debit()">
                    <div class="form-group col-md-6">
                        <label for="price">Valor a vista</label>
                        <input name="price" type="text" class="form-control" id="price" maxLength="50" data-bind="value: price" placeholder="Valor">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price-credit">Valor cartão de crédito</label>
                        <input name="price-credit" type="text" class="form-control" id="price-credit" maxLength="50" data-bind="value: priceCredit" placeholder="Valor">
                    </div>
                </div>

                <div class="form-row" data-bind="visible: !show_price() && show_price_credit() && show_price_debit()">
                    <div class="form-group col-md-6">
                        <label for="price-credit">Valor cartão de crédito</label>
                        <input name="price-credit" type="text" class="form-control" id="price-credit" maxLength="50" data-bind="value: priceCredit" placeholder="Valor">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="price-debit">Valor no débito</label>
                        <input name="price-debit" type="text" class="form-control" id="price-debit" maxLength="50" data-bind="value: priceDebit" placeholder="Valor">
                    </div>
                </div>

                 <div class="form-row" data-bind="visible: show_price() && show_price_credit() && show_price_debit()">
                    <div class="form-group col-md-4">
                        <label for="price">Valor a vista</label>
                        <input name="price" type="text" class="form-control" id="price" maxLength="50" data-bind="value: price" placeholder="Valor">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="price-credit">Valor cartão de crédito</label>
                        <input name="price-credit" type="text" class="form-control" id="price-credit" maxLength="50" data-bind="value: priceCredit" placeholder="Valor">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="price-debit">Valor no débito</label>
                        <input name="price-debit" type="text" class="form-control" id="price-debit" maxLength="50" data-bind="value: priceDebit" placeholder="Valor">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="payment-methods">Disponibilidade do produto</label>
                        <select name="payment-methods" id="payment-methods" class="form-control" 
                        data-bind="options: available_product,
                        optionsText: 'name',
                        optionsValue: 'value',
                        value: selected_option_available_product,
                        optionsCaption: 'Selecione a disponibilidade deste produto'">
                        </select>
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
                Produto editado com sucesso!
            </div>
            <div class="modal-footer">
                <a href="ver-produtos" class="btn btn-primary btn-lg" class="btn btn-primary">Ok</a>
            </div>
        </div>
    </div>
</div>

<?php require_once"components/footer.php" ?>

<script src="assets/js/edit-product.js"></script>

<script>
    $(function() {
        $('#price, #price-credit, #price-debit').maskMoney();
    })
</script>

