<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Blue</title>
    <link rel="icon"  href="./img/logooo.png">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='./Plano/css/medico.css'>
    <script src='main.js'></script>
</head>
<body>
<style> 
<?php
include './css/admin.css';
?>
</style>
<header class="parte-1">
      <main>
      <img id="logo" src="./img/logooo.png"/>
      <h1>Blue Saúde</h1>
      </main>
    </header>
    <?php  

        session_start();

        $admin= simplexml_load_file("dados.xml");
        $a= $_SESSION['usuario'];
        echo "<h2>Tela-Administração</h2><br>";
    ?>
      <main>
        <?php
            $cont_usuarios=0;
            $i=0;

            foreach ($admin->user[$a] as $b) {
            $cont_usuarios++;
            }
        ?>
        <h3>Cadastrar Médico:</h3>
        <div class="form">
        <form id="formulario-medico" name="formulario" method="POST" action="admin.php">
        <label for="nome"><a>Nome do médico:</a></label>
        <input type="text" name="nome"/>
        <label for="email"><a>E-mail:</a></label>
        <input type="email" name="email"/>
        <label for="senha"><a>Senha:</a></label>
        <input type="password"  name="senha"/>
        <label for="endereco"><a>Endereço:</a></label>
        <textarea type="text" name="endereco"></textarea>
        <label for="telefone"><a>Telefone:</a></label>
        <input type="number" name="telefone"/>
        <label for="especialidade"><a>Especialidade:</a></label>
        <input type="text" name="especialidade"/>
        <label for="crm"><a>CRM:</a></label>
        <input type="number" name="crm"/>
        <input id="botao" type="submit" name="registra-med" value="Registrar">
        </form>
        </div>
        <br>
        <br>
        <br>
        <h3>Cadastrar Labortório</h3>
        <div class="form">
        <form id="formulario-lab" name="formulario" method="POST" action="admin.php">
        <label for="nome"><a>Nome do laboratório:</a></label>
        <input type="text" name="nome"/>
        <label for="email"><a>E-mail:</a></label>
        <input type="email" name="email"/>
        <label for="senha"><a>Senha:</a></label>
        <input type="password"  name="senha"/>
        <label for="cnpj"><a>CNPJ:</a></label>
        <input type="number" name="cnpj"/>
        <label for="endereco"><a>Endereço:</a></label>
        <textarea type="text" name="endereco"></textarea>
        <label for="telefone"><a>Telefone:</a></label>
        <input type="number" name="telefone"/>
        <input id="botao" type="submit" name="registra-lab" value="Registrar">
        </form>
          </div>
        <br>
        <br>
        <br>
        <h3>Cadastrar Paciente:</h3>
        <div class="form">
        <form id="formulario-paciente" name="formulario" method="POST" action="admin.php">
        <label for="nome"><a>Nome do paciente:</a></label>
        <input type="text" name="nome"/>
        <label for="email"><a>E-mail:</a></label>
        <input type="email" name="email"/>
        <label for="senha"><a>Senha:</a></label>
        <input type="password"  name="senha"/>
        <label for="idade"><a>Idade</a></label>
        <input type="number" name="idade"/>
        <label for="cpf"><a>CPF:</a></label>
        <input type="number" name="cpf"/>
        <label for="endereco"><a>Endereço:</a></label>
        <textarea type="text" name="endereco"></textarea>
        <label for="telefone"><a>Telefone:</a></label>
        <input type="number" name="telefone"/>
        <label for="genero"><a>Gênero</a></label>
        <input type="text" name="genero"/>
        <input id="botao" type="submit" name="registra-paciente" value="Registrar">
        </form>
        </div>
        <br>
        <br>
        <br>
        <?php 
          if (isset($_POST['registra-med'])){
          $nome_medico=$_POST["nome"];
          $email=$_POST["email"];
          $senha=$_POST["senha"];
          $endereco=$_POST["endereco"];
          $fone=$_POST["telefone"];
          $especialidade=$_POST["especialidade"];
          $CRM=$_POST["crm"];
            if(empty($nome_medico)||empty($email)||empty($senha)||empty($endereco)||empty($fone)||empty($especialidade)||empty($CRM)){
              echo "<script>
              alert ('Preencha todos os campos');
              window.location.href='admin.php';
              </script>";
            }
            else{
          $i=0;
          $c=0;

          $admin= simplexml_load_file("dados.xml");
          $a= $_SESSION['usuario'];

          foreach($admin->user as $b){
            $c++;
          }

          for($i=0;$i<$c;$i++){
            if($admin->user[$i]->CRM==$CRM){
              echo "<script>
                    alert ('Médico já possui  cadastro no banco!');
                    window.location.href='admin.php';
                    </script>";
              break;
          }
            if($admin->user[$i]->email==$email){
              echo "<script>
                    alert ('Email já possui cadastro!');
                    window.location.href='admin.php';
                    </script>";
              break;
            }
        }
         
        if($c==$i) {
          $filho=$admin->addChild("user");
          $filho->addChild("tipo", "medico");
          $filho->addChild("email", $email);
          $filho->addChild("senha", $senha);
          $filho->addChild("nome", $nome_medico);
          $filho->addChild("endereco", $endereco);
          $filho->addChild("telefone", $fone);
          $filho->addChild("especialidade", $especialidade);
          $filho->addChild("CRM", $CRM);
          $filho->addChild("consultas"," ");
        }
          if(file_put_contents("dados.xml", $admin->asXML())){
            echo "<script>
                    alert ('Médico cadastrado com sucesso!');
                    window.location.href='admin.php';
                    </script>";
        }
      }
      }
      if (isset($_POST['registra-lab'])){
        $nome_lab=$_POST["nome"];
        $email=$_POST["email"];
        $senha=$_POST["senha"];
        $cnpj=$_POST["cnpj"];
        $endereco=$_POST["endereco"];
        $fone=$_POST["telefone"];

        if(empty($nome_lab)||empty($email)||empty($senha)||empty($endereco)||empty($fone)||empty($cnpj)){
          echo "<script>
          alert ('Preencha todos os campos');
          window.location.href='admin.php';
          </script>";
        }
        else{
        $i=0;
        $c=0;

        $admin= simplexml_load_file("dados.xml");
        $a= $_SESSION['usuario'];

        foreach($admin->user as $b){
          $c++;
        }

        for($i=0;$i<$c;$i++){
          if($admin->user[$i]->CNPJ==$cnpj){
            echo "<script>
                  alert ('Laboratório já possui cadastro no banco!');
                  window.location.href='admin.php';
                  </script>";
            break;
        }
          if($admin->user[$i]->email==$email){
            echo "<script>
                  alert ('Email já possui cadastro!');
                  window.location.href='admin.php';
                  </script>";
            break;
          }
        }
        if($c==$i){
        $filho=$admin->addChild("user");
        $filho->addChild("tipo", "laboratorio");
        $filho->addChild("email", $email);
        $filho->addChild("senha", $senha);
        $filho->addChild("nome", $nome_lab);
        $filho->addChild("CNPJ", $cnpj);
        $filho->addChild("endereco", $endereco);
        $filho->addChild("telefone", $fone);
        $filho->addChild("exames"," ");
        }

        if(file_put_contents("dados.xml", $admin->asXML())){
          echo "<script>
                  alert ('Laboratório cadastrado com sucesso!');
                  window.location.href='admin.php';
                  </script>";
      }
    }
    }
    if (isset($_POST['registra-paciente'])){
      $nome_paciente=$_POST["nome"];
      $email=$_POST["email"];
      $senha=$_POST["senha"];
      $idade=$_POST["idade"];
      $cpf=$_POST["cpf"];
      $endereco=$_POST["endereco"];
      $fone=$_POST["telefone"];
      $genero=$_POST["genero"]; 

      if(empty($nome_paciente)||empty($email)||empty($senha)||empty($idade)||empty($cpf)||empty($endereco)||empty($fone)||empty($genero)){
        echo "<script>
        alert ('Preencha todos os campos');
        window.location.href='admin.php';
        </script>";
      }
      else{
      $i=0;
      $c=0;     

      $admin= simplexml_load_file("dados.xml");
      $a= $_SESSION['usuario'];

      foreach($admin->user as $b){
        $c++;
      }

      for($i=0;$i<$c;$i++){
        if($admin->user[$i]->CPF==$cpf){
          echo "<script>
                alert ('Paciente já possui cadastro no banco!');
                window.location.href='admin.php';
                </script>";
          break;
        }
        if($admin->user[$i]->email==$email){
          echo "<script>
                alert ('Email já possui cadastro!');
                window.location.href='admin.php';
                </script>";
          break;
        }
    }
      if($c==$i){
        $filho=$admin->addChild("user");
        $filho->addChild("tipo", "paciente");
        $filho->addChild("email", $email);
        $filho->addChild("senha", $senha);
        $filho->addChild("nome", $nome_paciente);
        $filho->addChild("idade", $idade);
        $filho->addChild("CPF", $cpf);
        $filho->addChild("endereco", $endereco);
        $filho->addChild("telefone", $fone);
        $filho->addChild("genero", $genero);
        $filho->addChild("consultas"," ");
        $filho->addChild("exames", " ");
      }
      if(file_put_contents("dados.xml", $admin->asXML())){
        echo "<script>
                alert ('Paciente cadastrado com sucesso!');
                window.location.href='admin.php';
                </script>";
    }
  }
  }
        ?>
      </main>
    
</body>
</html>