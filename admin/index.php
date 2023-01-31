<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">        
        <title>Request - Admin Login</title>
        <link rel="icon" href="imagem/favicon.ico">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/signin.css">
    </head>
    <body class="text-center">
        <form class="form-signin" data-bind="submit: handleLogin">
            <img class="mb-4" src="assets/imagem/logo_celke.png" alt="Celke" width="72" height="72">
            <h1 class="h3 mb-3 font-weight-normal">Área Restrita</h1>

            <!-- ko if: has_feedback -->
            <div>
                <h4 data-bind="attr: { class: has_class_feedback }, text: has_message_feedback"></h4>
            </div>
            <!-- /ko -->

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" class="form-control" maxLength="50" data-bind="value: email" placeholder="Digite o E-mail">               
            </div>

            <div class="form-group">
                <label for="password">Senha</label>
                <input type="password" id="password" class="form-control" maxLength="50" data-bind="value: password" placeholder="Digite a senha">
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
        </form>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/knockout/3.5.0/knockout-min.js"></script>
        <script src="assets/js/genericFunctions.js"></script>
        <script src="assets/js/login.js"></script>
    </body>
</html>
