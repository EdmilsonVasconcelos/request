var myViewModel = {
  category: ko.observable(""),
  show_loader: ko.observable(false),
  has_feedback: ko.observable(false),
  has_message_feedback: ko.observable(),
  has_class_feedback: ko.observable(),

  handleEditCategory: function () {
    var self = this;
    var category = self.category();

    if (!category) {
      self.showMessage(self, "text-danger", "Preencha os campos");
      return;
    }

    self.has_feedback(false);
    self.editCategory(self);
  },
  editCategory: function (self) {
    self.show_loader(true);
    $.ajax({
      type: "PUT",
      url: `${getEndpoint()}/category`,
      headers: { Authorization: getTokenBearer() },
      data: `id=${getIdByUrl()}&name=${self.category()}`,
      success: function () {
        self.show_loader(false);
        $("#modalSuccessEdit").modal("show");
      },
      error: function (e) {
        const error = JSON.parse(e.responseText).error;

        self.show_loader(false);
        self.showMessage(self, "text-danger", error);
        console.log("Erro ao chamar o serviço de editar categoria", e);
      },
    });
  },
  showMessage: function (self, classMessage, text) {
    self.has_feedback(true);
    self.has_class_feedback(classMessage);
    self.has_message_feedback(text);
  },
  listeningInput: function () {
    var self = this;
    $("#category").on("click keyup", function () {
      if (self.has_feedback()) {
        self.has_feedback(false);
      }
    });
  },
  getCategoryById: function () {
    var self = this;
    self.show_loader(true);

    $.ajax({
      type: "GET",
      url: `${getEndpoint()}/category/${getIdByUrl()}`,
      headers: { Authorization: getTokenBearer() },
      success: function (data) {
        self.show_loader(false);
        self.category(data.name);
      },
      error: function (e) {
        self.show_loader(false);
        self.showMessage(
          self,
          "text-danger",
          "Erro ao editar categoria, contate os administradores"
        );
        console.log("Erro ao chamar o serviço de registrar produto", e);
      },
    });
  },
};

myViewModel.listeningInput();
myViewModel.getCategoryById();
ko.applyBindings(myViewModel);
