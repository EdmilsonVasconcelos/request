var myViewModel = {
  category: ko.observable(""),
  show_loader: ko.observable(false),
  has_feedback: ko.observable(false),
  has_message_feedback: ko.observable(),
  has_class_feedback: ko.observable(),
  handleAddCategory: function () {
    var self = this;
    var category = self.category();

    if (!category) {
      self.showMessage(self, "text-danger", "Preencha os campos");
      return;
    }

    self.has_feedback(false);
    self.addCategory(self);
  },
  addCategory: function (self) {
    self.show_loader(true);
    $.ajax({
      type: "post",
      url: `${getEndpoint()}/category`,
      headers: { Authorization: getTokenBearer() },
      data: {
        name: self.category(),
      },
      success: function () {
        self.show_loader(false);
        self.showMessage(
          self,
          "text-success",
          "Categoria cadastrada com sucesso"
        );
        self.category("");
      },
      error: function (e) {
        self.show_loader(false);
        const error = JSON.parse(e.responseText).error;
        self.showMessage(self, "text-danger", error);
        console.log("Erro ao chamar o serviço de registrar produto", e);
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
};

myViewModel.listeningInput();
ko.applyBindings(myViewModel);
