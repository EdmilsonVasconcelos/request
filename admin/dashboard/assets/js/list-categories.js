var myViewModel = {
  categories: ko.observableArray(),
  question_category: ko.observable(),
  question_id_category: ko.observable(),
  has_message: ko.observable(false),
  show_loader: ko.observable(false),
  has_message_class: ko.observable(),
  has_message_text: ko.observable(),

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
  showMessage: function (self, classMessage, text) {
    self.has_message(true);
    self.has_message_class(classMessage);
    self.has_message_text(text);
  },
  handleDeleteCategory: function (id, name_product) {
    var self = this;
    self.question_category(name_product);
    self.question_id_category(id);
    $("#modalQuestionDeleteProduct").modal("show");
  },
  deleteCategory: function (idCategory) {
    var self = this;
    self.show_loader(true);
    $.ajax({
      type: "DELETE",
      url: `${getEndpoint()}/category/${idCategory}`,
      headers: { Authorization: getTokenBearer() },
      success: function () {
        self.show_loader(false);
        $("#modalQuestionDeleteProduct").modal("hide");
        self.getCategories();
      },
      error: function (e) {
        self.show_loader(false);
        $("#modalQuestionDeleteProduct").modal("hide");
        $("#modalMessageErrorDeleteCategory").modal("show");
      },
    });
  },
};

myViewModel.getCategories();
ko.applyBindings(myViewModel);
