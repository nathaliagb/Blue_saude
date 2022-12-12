<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Blue</title>
  <link rel="icon" href="./img/logooo.png">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='./css/index.css'>
  <script type="text/javascript">
    function valida() {
      var formulario = document.formulario;
      var email = formulario.email;
      var senha = formulario.senha;

      if (email.value == "" || email.value == null) {
        alert('Preencha o E-mail!');
        formuser.email.focus();
        return false;
      } else if (email.value.indexOf("@") == -1) {
        alert('E-mail sem "@"!');
      } else if (email.value.indexOf(".") == -1) {
        alert('E-mail sem "."')
      }
      if (senha.value == "" || senha.value == null) {
        alert('Preencha a Senha!');
        formuser.senha.focus();
        return false;
      }
      return true;
    }
  </script>
</head>

<body>
  <header class="parte-1">
    <main>
      <div class="cabecalho">
        <img id="logo" src="./img/logooo.png" />
        <h1>Blue Saúde</h1>
      </div>
    </main>
  </header>
  <main>
    <div class="corpo-formulario">
      <h2>Entrar</h2>
      <form name="formulario" method="POST" action="processamento.php">
        <input type="email" name="email" placeholder="E-mail">
        <input type="password" name="senha" placeholder="Senha">
        <input type="submit" name="acesso" value="Acessar" onclick="return valida ()">
      </form>
    </div>

  </main>
  <footer class="rodape">
  </footer>
</body>
</html>