var myViewModel = {
  email: ko.observable(""),
  password: ko.observable(""),
  has_feedback: ko.observable(false),
  has_message_feedback: ko.observable(),
  has_class_feedback: ko.observable(),

  handleLogin: function () {
    var self = this;
    var email = self.email();
    var password = self.password();

    if (!email || !password) {
      self.showMessage(self, "text-danger", "Preencha os campos");
      $("#email").focus();
      return;
    }

    self.has_feedback(false);
    self.executeLogin(self);
  },
  executeLogin: function (self) {
    $.ajax({
      type: "POST",
      url: getEndpoint() + "/v1/auth",
      data: {
        email: self.email(),
        password: self.password(),
      },
      success: function (data) {
        localStorage.setItem("token", data.token);
        window.location.href = "dashboard/";
      },
      error: function (e) {
        self.showMessage(
          self,
          "text-danger",
          "Erro ao fazer login, contacte os administradores"
        );
        console.log("Erro ao chamar o serviço de executar login", e);
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
    $("#email").click(function () {
      if (self.has_feedback()) {
        self.has_feedback(false);
      }
    });
  },
};

myViewModel.listeningInput();
ko.applyBindings(myViewModel);
