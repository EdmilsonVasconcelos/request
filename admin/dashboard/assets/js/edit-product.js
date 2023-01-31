var myViewModel = {
  product: ko.observable(""),
  categories: ko.observable(""),
  selected_option_category: ko.observable(""),
  price: ko.observable(""),
  priceCredit: ko.observable(""),
  priceDebit: ko.observable(""),
  show_loader: ko.observable(false),
  show_price: ko.observable(false),
  show_price_credit: ko.observable(false),
  show_price_debit: ko.observable(false),
  description: ko.observable(""),
  payment_methods: ko.observableArray([
    { name: "Apenas à vista", value: "AV" },
    { name: "Apenas cartão de crédito", value: "CC" },
    { name: "Apenas cartão de débito", value: "CD" },
    { name: "À vista e cartão de crédito", value: "AVCC" },
    { name: "Cartão de crédito e cartão de débito", value: "CCCD" },
    { name: "À vista e cartão de crédito e cartão de débito", value: "AVCCCD" },
  ]),
  available_product: ko.observableArray([
    { name: "Disponível para pedidos", value: true },
    { name: "Indisponível para pedidos", value: false },
  ]),
  selected_option_method_payment: ko.observable(""),
  selected_option_available_product: ko.observable(""),
  has_feedback: ko.observable(false),
  has_message_feedback: ko.observable(),
  has_class_feedback: ko.observable(),

  handleEditProduct: function () {
    var self = this;
    var product = self.product();
    var price = self.price();
    var selected_option_method_payment = self.selected_option_method_payment();

    if (!product || !price || !selected_option_method_payment) {
      self.showMessage(self, "text-danger", "Preencha os campos");
      return;
    }

    self.has_feedback(false);
    self.editProduct(self);
  },
  editProduct: function (self) {
    self.show_loader(true);
    $.ajax({
      type: "PUT",
      url: `${getEndpoint()}/product`,
      headers: { Authorization: getTokenBearer() },
      data: {
        id: getIdByUrl(),
        name: self.product(),
        price: self.price(),
        priceCredit: self.priceCredit(),
        priceDebit: self.priceDebit(),
        description: self.description(),
        available: self.selected_option_available_product(),
        categoryId: self.selected_option_category(),
      },
      success: function (data) {
        self.show_loader(false);
        $("#modalSuccessEdit").modal("show");
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
  showMessage: function (self, classMessage, text) {
    self.has_feedback(true);
    self.has_class_feedback(classMessage);
    self.has_message_feedback(text);
  },
  setMethodPayment: function () {
    var self = this;
    self.show_loader(true);
    self.controlViewPaymenthMethodsInputs(self);

    setTimeout(function () {
      self.show_loader(false);
    }, 300);
  },
  getMethodPayment: function (self) {
    if (self.price() && !self.priceCredit() & !self.priceDebit()) {
      self.selected_option_method_payment("AV");
    } else if (!self.price() && self.priceCredit() & !self.priceDebit()) {
      self.selected_option_method_payment("CC");
    } else if (!self.price() && !self.priceCredit() & self.priceDebit()) {
      self.selected_option_method_payment("CD");
    } else if (self.price() && self.priceCredit() & !self.priceDebit()) {
      self.selected_option_method_payment("AVCC");
    } else if (!self.price() && self.priceCredit() & self.priceDebit()) {
      self.selected_option_method_payment("CCCD");
    } else if (self.price() && self.priceCredit() & self.priceDebit()) {
      self.selected_option_method_payment("AVCCCD");
    }
  },
  controlViewPaymenthMethodsInputs: function (self) {
    if (self.selected_option_method_payment() === "AV") {
      self.show_price(true);
      self.show_price_credit(false);
      self.show_price_debit(false);
      self.priceCredit("");
      self.priceDebit("");
    } else if (self.selected_option_method_payment() === "CC") {
      self.show_price(false);
      self.show_price_credit(true);
      self.show_price_debit(false);
      self.price("");
      self.priceDebit("");
    } else if (self.selected_option_method_payment() === "CD") {
      self.show_price(false);
      self.show_price_credit(false);
      self.show_price_debit(true);
      self.price("");
      self.priceCredit("");
    } else if (self.selected_option_method_payment() === "AVCC") {
      self.show_price(true);
      self.show_price_credit(true);
      self.show_price_debit(false);
      self.priceDebit("");
    } else if (self.selected_option_method_payment() === "CCCD") {
      self.show_price(false);
      self.show_price_credit(true);
      self.show_price_debit(true);
      self.price("");
    } else if (self.selected_option_method_payment() === "AVCCCD") {
      self.show_price(true);
      self.show_price_credit(true);
      self.show_price_debit(true);
    }
  },

  listeningInput: function () {
    var self = this;
    $("#product, #price, #payment-methods, #description").on(
      "click keyup",
      function () {
        if (self.has_feedback()) {
          self.has_feedback(false);
        }
      }
    );
  },
  getProductById: function () {
    var self = this;
    self.show_loader(true);

    $.ajax({
      url: `${getEndpoint()}/product/${getIdByUrl()}`,
      headers: { Authorization: getTokenBearer() },
      success: function (data) {
        self.show_loader(false);
        self.product(data.name);
        self.price(data.price);
        self.priceCredit(data.priceCredit);
        self.priceDebit(data.priceDebit);
        self.description(data.description);
        self.selected_option_available_product(data.available);
        self.selected_option_category(data.category.id);
        self.getMethodPayment(self);
        self.controlViewPaymenthMethodsInputs(self);
      },
      error: function (e) {
        self.show_loader(false);
        self.showMessage(
          self,
          "text-danger",
          "Erro ao registrar produto, contate os administradores"
        );
        console.log("Erro ao chamar o serviço de registrar produto", e);
      },
    });
  },
  getCategories: function () {
    var self = this;
    self.show_loader(true);
    $.ajax({
      type: "GET",
      url: `${getEndpoint()}/category`,
      headers: { Authorization: getTokenBearer() },
      success: function (data) {
        self.show_loader(false);
        self.categories(data);
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
  setAvailabilityProduct: function (self) {},
};

myViewModel.getCategories();
myViewModel.listeningInput();
myViewModel.getProductById();
ko.applyBindings(myViewModel);
