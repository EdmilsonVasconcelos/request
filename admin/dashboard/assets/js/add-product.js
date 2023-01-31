var myViewModel = {
  product: ko.observable(""),
  categories: ko.observable(""),
  price: ko.observable(""),
  price_credit: ko.observable(""),
  price_debit: ko.observable(""),
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
  selected_option_method_payment: ko.observable(""),
  selected_option_category: ko.observable(""),
  has_feedback: ko.observable(false),
  has_message_feedback: ko.observable(),
  has_class_feedback: ko.observable(),

  handleAddProduct: function () {
    var self = this;
    var product = self.product();
    var price = self.price();
    var price_credit = self.price_credit();
    var price_debit = self.price_debit();
    var selected_option_method_payment = self.selected_option_method_payment();
    var selected_option_category = self.selected_option_category();

    if (
      !product ||
      !price ||
      !selected_option_method_payment ||
      !selected_option_category
    ) {
      if (
        selected_option_method_payment === "CC" ||
        selected_option_method_payment === "AVCC" ||
        selected_option_method_payment === "AVCCCD"
      ) {
        if (!price_credit) {
          self.showMessage(self, "text-danger", "Preencha os campos");
        }
      } else if (
        selected_option_method_payment === "CD" ||
        selected_option_method_payment === "AVCCCD"
      ) {
        if (!price_debit) {
          self.showMessage(self, "text-danger", "Preencha os campos");
        }
      } else if (selected_option_method_payment === "CCCD") {
        if (!price_debit || !price_credit) {
          self.showMessage(self, "text-danger", "Preencha os campos");
        }
      } else {
        self.showMessage(self, "text-danger", "Preencha os campos");
      }

      return;
    }

    self.has_feedback(false);
    self.addProduct(self);
  },
  addProduct: function (self) {
    self.show_loader(true);
    $.ajax({
      type: "POST",
      url: `${getEndpoint()}/product`,
      headers: { Authorization: getTokenBearer() },
      data: {
        name: self.product(),
        price: formatMoneyToCallTheApi(self.price()),
        priceCredit: formatMoneyToCallTheApi(self.price_credit()),
        priceDebit: formatMoneyToCallTheApi(self.price_debit()),
        description: self.description(),
        categoryId: self.selected_option_category(),
      },
      success: function () {
        self.show_loader(false);
        self.showMessage(
          self,
          "text-success",
          "Produto cadastrado com sucesso"
        );
        self.product("");
        self.price("");
        self.description("");
        self.selected_option_method_payment("");
        self.selected_option_category("");
      },
      error: function (e) {
        self.show_loader(false);
        self.showMessage(self, "text-danger", "Este produto já existe");
        console.log("Erro ao chamar o serviço de registrar produto", e);
      },
    });
  },
  showMessage: function (self, classMessage, text) {
    self.has_feedback(true);
    self.has_class_feedback(classMessage);
    self.has_message_feedback(text);
  },
  controlViewPaymenthMethodsInputs: function (self) {
    var selected_option_method_payment = self.selected_option_method_payment();
    if (selected_option_method_payment === "AV") {
      self.show_price(true);
      self.show_price_credit(false);
      self.show_price_debit(false);
      self.price_credit("");
      self.price_debit("");
    } else if (selected_option_method_payment === "CC") {
      self.show_price(false);
      self.show_price_credit(true);
      self.show_price_debit(false);
      self.price("");
      self.price_debit("");
    } else if (selected_option_method_payment === "CD") {
      self.show_price(false);
      self.show_price_credit(false);
      self.show_price_debit(true);
      self.price("");
      self.price_credit("");
    } else if (selected_option_method_payment === "AVCC") {
      self.show_price(true);
      self.show_price_credit(true);
      self.show_price_debit(false);
      self.price_debit("");
    } else if (selected_option_method_payment === "CCCD") {
      self.show_price(false);
      self.show_price_credit(true);
      self.show_price_debit(true);
      self.price("");
    } else if (selected_option_method_payment === "AVCCCD") {
      self.show_price(true);
      self.show_price_credit(true);
      self.show_price_debit(true);
    }
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
  setMethodPayment: function () {
    var self = this;
    self.show_loader(true);
    self.controlViewPaymenthMethodsInputs(self);

    setTimeout(function () {
      self.show_loader(false);
    }, 300);
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
};

myViewModel.getCategories();
myViewModel.listeningInput();
ko.applyBindings(myViewModel);
