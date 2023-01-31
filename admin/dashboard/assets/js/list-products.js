var myViewModel = {
  list_products: ko.observableArray(),
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
      type: "GET",
      url: `${getEndpoint()}/category/products`,
      headers: { Authorization: getTokenBearer() },
      success: function (data) {
        self.show_loader(false);
        self.list_products(data);
      },
      error: function (e) {
        self.show_loader(false);
        self.showMessage(
          self,
          "text-danger",
          "Erro ao retornar produtos, contacte os administradores"
        );
        console.log("Erro ao chamar o serviço de retorno de produtos", e);
      },
    });
  },
  getMethodPayment: function (data) {
    if (data === "AV") {
      return "À vista.";
    } else if (data === "CC") {
      return "Cartão de crédito.";
    } else if (data === "CD") {
      return "Cartão de débito";
    } else if (data === "AVCC") {
      return "À vista e cartão de crédito.";
    } else if (data === "CDCC") {
      return "Cartão de débito e crédito.";
    } else if (data === "AVCCCD") {
      return "À vista, cartão de crédito e de débito.";
    }
  },
  numberToReal: function (number) {
    if (!number) return false;
    var number = Number(number).toFixed(2).split(".");
    number[0] = "R$ " + number[0].split(/(?=(?:...)*$)/).join(".");
    return number.join(",");
  },
  showMessage: function (self, classMessage, text) {
    self.has_message(true);
    self.has_message_class(classMessage);
    self.has_message_text(text);
  },
  setAvailableProduct: function (data) {
    var self = this;

    data.available = !data.available;

    self.editProduct(data);
  },
  handleDeleteProduct: function (id, name) {
    var self = this;
    self.question_product(name);
    self.question_id_product(id);
    $("#modalQuestionDeleteProduct").modal("show");
  },
  deleteProduct: function (id) {
    var self = this;
    self.show_loader(true);
    $.ajax({
      type: "DELETE",
      url: `${getEndpoint()}/product/${id}`,
      headers: { Authorization: getTokenBearer() },
      success: function () {
        self.show_loader(false);
        self.getProducts();
        $("#modalQuestionDeleteProduct").modal("hide");
      },
      error: function (e) {
        self.show_loader(false);
        self.showMessage(
          self,
          "text-danger",
          "Erro ao delletar produtos, contacte os administradores"
        );
        console.log("Erro ao chamar o serviço de deletar produtos", e);
      },
    });
  },
  editProduct: function (data) {
    var self = this;
    self.show_loader(true);
    $.ajax({
      type: "PUT",
      url: `${getEndpoint()}/product`,
      headers: { Authorization: getTokenBearer() },
      data: {
        id: data.id,
        name: data.name,
        price: data.price,
        priceCredit: data.priceCredit,
        priceDebit: data.priceDebit,
        description: data.description,
        available: data.available,
        categoryId: data.category.id,
      },
      success: function () {
        self.show_loader(false);
        self.getProducts();
      },
      error: function (e) {
        self.show_loader(false);
        self.showMessage(
          self,
          "text-danger",
          "Erro ao editar produto, contate os administradores"
        );
        console.log("Erro ao chamar o serviço de editar produto", e);
      },
    });
  },
};

myViewModel.getProducts();
ko.applyBindings(myViewModel);
