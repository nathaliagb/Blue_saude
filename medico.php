<!DOCTYPE html>
<html>

<head>
  <meta charset='utf-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <title>Blue</title>
  <link rel="icon" href="./img/logooo.png">
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <link rel='stylesheet' type='text/css' media='screen' href='./Plano/css/medico.css'>

</head>

<body>
  <style>
    <?php
    include './css/medico.css';
    ?>
  </style>
  <header class="parte-1">
    <main>
      <img id="logo" src="./img/logooo.png" />
      <h1>Blue Saúde</h1>
    </main>
  </header>
  <?php

  session_start();

  $medicos = simplexml_load_file("dados.xml");
  $a = $_SESSION['usuario'];
  echo '<h2>' . "Bem-Vindo " . $medicos->user[$a]->nome . '</h2><br>';
  ?>
  <div class="historico">
    <main>
      <h3>Histórico de consultas:</h3>
      <?php
      $cont_consultas = 0;
      $i = 0;

      foreach ($medicos->user[$a]->consultas->observacoes as $b) {
        $cont_consultas++;
      }
      echo '<table class="tabela-historico">' . "<tr> <td> Paciente </td> <td> Data </td> <td> Doença Preexistente </td> <td> Observações </td> </tr>";
      for ($i == 0; $i < $cont_consultas; $i++) {
        echo " <tr> <td> " . $medicos->user[$a]->consultas->paciente[$i] . " </td> ";
        echo " <td> " . $medicos->user[$a]->consultas->data[$i] . " </td> ";
        echo " <td> " . $medicos->user[$a]->consultas->doenca[$i] . " </td> ";
        echo " <td> " . $medicos->user[$a]->consultas->observacoes[$i] . " </td> </tr>";
      }
      echo "</table><br>";
      ?>
      <h3>Cadastrar nova consulta:</h3>
      <div class="form">
        <form name="formulario" method="POST" action="medico.php">
          <label for="nome"><a>Nome do paciente:</a></label>
          <input type="text" name="nome" />
          <label for="cpf"><a>CPF do paciente:</a></label>
          <input type="number" name="cpf" />
          <label for="data"><a>Data da consulta:</a></label>
          <input type="date" value="" name="data" />
          <label for="doenca"><a>Alguma doença preexistente?</a></label>
          <textarea type="text" name="doenca"></textarea>
          <label for="obs"><a>Observações:</a> </label>
          <textarea type="text" name="obs"> </textarea>
          <input id="botao" type="submit" name="registra" value="Registrar" />
        </form>
      </div>
      <br>
      <br>
      <br>
      <h3>Alterar Cadastro:</h3>
      <div class="form">
        <form name="formulario" method="POST" action="medico.php">
          <label for="nome"><a>Nome</a></label>
          <input type="text" name="nome" />
          <label for="email"><a>Email:</a></label>
          <input type="email" name="email" />
          <label for="senha"><a>Senha:</a></label>
          <input type="password" name="senha" />
          <label for="endereco"><a>Endereço:</a></label>
          <input type="text" name="endereco" />
          <label for="fone"><a>Telefone</a> </label>
          <input type="number" name="fone" />
          <label for="especialidade"><a>Especialidade:</a></label>
          <input type="text" name="especialidade" />
          <label for="crm"><a>CRM:</a></label>
          <input type="number" name="crm" />
          <input id="botao" type="submit" name="cadastro" value="Registrar">
        </form>
      </div>
      <br>
      <br>
      <br>

      <?php

      if (isset($_POST['registra'])) {
        $nome_paciente = $_POST["nome"];
        $cpf_paciente = $_POST["cpf"];
        $data_consulta = date('d/m/Y', strtotime($_POST["data"]));
        $doenca_pre = $_POST["doenca"];
        $observacoes = $_POST["obs"];
        if (empty($nome_paciente)) {
          echo "<script>
              alert ('Preencha o campo nome');
              window.location.href='medico.php';
              </script>";
        } elseif (empty($cpf_paciente)) {
          echo "<script>
              alert ('Preencha o campo cpf');
              window.location.href='medico.php';
              </script>";
        } elseif (empty($data_consulta)) {
          echo "<script>
              alert ('Preencha o campo data');
              window.location.href='medico.php';
              </script>";
        } else {

          $medicos = simplexml_load_file("dados.xml");
          $a = $_SESSION['usuario'];
          $c = 0;
          $i = 0;

          foreach ($medicos->user as $b) {
            $c++;
          }
          $nome_medico = $medicos->user[$a]->nome;

          for ($i = 0; $i < $c; $i++) {
            $auxcpf = $medicos->user[$i]->CPF;
            if ($auxcpf == $cpf_paciente) {
              $medicos->user[$a]->consultas->addChild("paciente", $nome_paciente);
              $medicos->user[$a]->consultas->addChild("CPF", $cpf_paciente);
              $medicos->user[$a]->consultas->addChild("data", $data_consulta);
              $medicos->user[$a]->consultas->addChild("doenca", $doenca_pre);
              $medicos->user[$a]->consultas->addChild("observacoes", $observacoes);

              $medicos->user[$i]->consultas->addChild("medico", $nome_medico);
              $medicos->user[$i]->consultas->addChild("especialidade", $medicos->user[$a]->especialidade);
              $medicos->user[$i]->consultas->addChild("data", $data_consulta);
              break;
            }
          }
          if ($i == $c) {
            echo "<script>
                alert ('Paciente não encontrado no banco');
                window.location.href='medico.php';
                </script>";
          }

          if (file_put_contents("dados.xml", $medicos->asXML())) {
            echo "<script>
                    alert ('Consulta Cadastrada com Sucesso');
                    window.location.href='medico.php';
                    </script>";
          }
        }
      }
      if (isset($_POST['cadastro'])) {
        $nome_medico = $_POST["nome"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $endereco = $_POST["endereco"];
        $fone = $_POST["fone"];
        $especialidade = $_POST["especialidade"];
        $CRM = $_POST["crm"];

        $medicos = simplexml_load_file("dados.xml");
        $a = $_SESSION['usuario'];

        if ($nome_medico != Null) {
          unset($medicos->user[$a]->nome);
          $medicos->user[$a]->addChild("nome", $nome_medico);
        }
        if ($email != Null) {
          $i = 0;
          $c = 0;
          foreach ($medicos->user as $b) {
            $c++;
          }
          for ($i = 0; $i < $c; $i++) {
            if ($medicos->user[$i]->email == $email) {
              echo "<script>
                    alert ('Email já possui cadastro!');
                    window.location.href='medico.php';
                    </script>";
              break;
            }
          }
          if ($c == $i) {
            unset($medicos->user[$a]->email);
            $medicos->user[$a]->addChild("email", $email);
          }
        }
        if ($senha != Null) {
          unset($medicos->user[$a]->senha);
          $medicos->user[$a]->addChild("senha", $senha);
        }
        if ($endereco != Null) {
          unset($medicos->user[$a]->endereco);
          $medicos->user[$a]->addChild("endereco", $endereco);
        }
        if ($fone != Null) {
          unset($medicos->user[$a]->telefone);
          $medicos->user[$a]->addChild("telefone", $fone);
        }
        if ($especialidade != Null) {
          unset($medicos->user[$a]->especialidade);
          $medicos->user[$a]->addChild("especialidade", $especialidade);
        }
        if ($CRM != Null) {
          $i = 0;
          $c = 0;
          foreach ($medicos->user as $b) {
            $c++;
          }
          for ($i = 0; $i < $c; $i++) {
            if ($medicos->user[$i]->CRM == $CRM) {
              echo "<script>
                    alert ('CRM já possui cadastro!');
                    window.location.href='medico.php';
                    </script>";
              break;
            }
          }
          if ($c == $i) {
            unset($medicos->user[$a]->CRM);
            $medicos->user[$a]->addChild("CRM", $CRM);
          }
        }
        if (file_put_contents("dados.xml", $medicos->asXML())) {
          echo "<script>
                    alert ('Cadastro Atualizado!');
                    window.location.href='medico.php';
                    </script>";
        }
      }
      ?>
    </main>
  </div>

</body>

</html>