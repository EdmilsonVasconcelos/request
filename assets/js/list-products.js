var myViewModel = {

    products: ko.observableArray(),
    question_product: ko.observable(),
    question_id_product: ko.observable(),
    has_message: ko.observable(false),
    show_loader: ko.observable(false),
    has_message_class: ko.observable(),
    has_message_text: ko.observable(),

    getProducts: function () {
        var self = this;
        self.show_loader(true);
        $.ajax({
            type: 'get',
            url: 'admin/dashboard/services/listProducts',
            success: function (data) {
                self.show_loader(false);
                if (data && data != 0) {
                    var products = JSON.parse(data);
                    self.products(products);
                }

                if (data && data == 0) {
                    self.products([]);
                    self.showMessage(self, 'text-danger', "Nenhum produto cadastrado até o momento");
                }

            },
            error: function (e) {
                self.show_loader(false);
                self.showMessage(self, 'text-danger', "Erro ao retornar produtos, contacte os administradores");
                console.log("Erro ao chamar o serviço de retorno de produtos", e)
            }
        });
    },
    numberToReal: function(number) {
        if(!number) return false;
        var number = Number(number).toFixed(2).split('.');
        number[0] = "R$ " + number[0].split(/(?=(?:...)*$)/).join('.');
        return number.join(',');
    },
    showMessage: function(self, classMessage, text) {
        self.has_message(true);
        self.has_message_class(classMessage);
        self.has_message_text(text);
    },
    handleAvailabeProduct: function(parent, data, event) {
        var self = this;
        var id_product = data.id;
        var available_product = event.target.innerText.toLowerCase() === 'on' ? false : true;
        self.setAvailableProduct(self, id_product, available_product)
    },  
    handleDeleteProduct: function(id, name_product) {
        var self = this;
        self.question_product(name_product);
        self.question_id_product(id);
        $('#modalQuestionDeleteProduct').modal('show');
    }
}

myViewModel.getProducts();
ko.applyBindings(myViewModel);