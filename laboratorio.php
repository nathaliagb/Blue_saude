<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Blue</title>
    <link rel="icon"  href="./img/logooo.png">
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
<style>
    <?php
        include './css/laboratorio.css';
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

        $laboratorios= simplexml_load_file("dados.xml");
        $a= $_SESSION['usuario'];
        echo "<h2>Bem-Vindo ".$laboratorios->user[$a]->nome."</h2><br>";
    ?>
    <div class="historico"> 
      <main>
        <h3>Histórico de exames:</h3>
        <?php
          $cont_exames=0;
          $i=0;

        foreach ($laboratorios->user[$a]->exames->paciente as $b) {
          $cont_exames++;
        }
        echo '<table class="tabela-historico">'. "<tr> <td> Paciente </td> <td> Data </td> <td> Tipo de Exame </td> <td> Resultado </td> </tr>";
        for ($i==0; $i<$cont_exames; $i++) {
          echo " <tr> <td> ".$laboratorios->user[$a]->exames->paciente[$i]." </td> ";
          echo " <td> ".$laboratorios->user[$a]->exames->data[$i]." </td> ";
          echo " <td> ".$laboratorios->user[$a]->exames->tipodeexame[$i]." </td> ";
          echo " <td> ".$laboratorios->user[$a]->exames->resultado[$i]." </td> </tr>";
        }
        echo "</table><br>";
        ?>
        <main>
        <h3>Cadastrar novo exame:</h3>
        <div class="form">
            <form name="formulario" method="POST" action="laboratorio.php">
            <label for="nome"><a>Nome do paciente:</a></label>
            <input type="text" name="nome"/>
            <label for="cpf"><a>CPF do paciente:</a></label>
            <input type="number" name="cpf"/>
            <label for="data"><a>Data do exame:</a></label>
            <input type="date" value="" name="data"/>
            <label for="tipo"><a>Tipo de Exame</a></label> 
            <textarea type="text" name="tipo"></textarea>
            <label for="resultado"><a>Resultado</a> </label>
            <textarea type="text" name="resultado"> </textarea>
            <input id="botao" type="submit" name="registra" value="Registrar">
        </form>
        </div>
        <br>
        <br>
        <br>
        <h3>Alterar Cadastro:</h3>
        <div class="form">
        <form name="formulario" method="POST" action="laboratorio.php">
        <label for="nome"><a>Nome</a></label>
        <input type="text" name="nome"/>
        <label for="email"><a>Email:</a></label>
        <input type="email" name="email"/>
        <label for="senha"><a>Senha:</a></label>
        <input type="password" name="senha"/>
        <label for="endereco"><a>Endereço:</a></label>
        <input type="text" name="endereco"/>
        <label for="fone"><a>Telefone</a> </label>
        <input type="number" name="fone"/>
        <label for="cnpj"><a>CNPJ:</a></label>
        <input type="number" name="cnpj"/>
        <input id="botao" type="submit" name="cadastro" value="Registrar">
        </form>
        </div>
        <br>
        <br>
        <br>
        </main>
        <?php 
        if (isset($_POST['registra'])){
            $nome_paciente=$_POST["nome"];
            $cpf_paciente=$_POST["cpf"];
            $data_exame= date('d/m/Y',strtotime($_POST["data"]));
            $tipo_exame=$_POST["tipo"];
            $resultado_exame=$_POST["resultado"];

            if(empty($nome_paciente)||empty($cpf_paciente)||empty($data_exame)||empty($tipo_exame)||empty($resultado_exame)){
              echo "<script>
              alert ('Preencha todos os campos!');
              window.location.href='laboratorio.php';
              </script>";
            }
            else{

            $laboratorios=simplexml_load_file("dados.xml");
            $a= $_SESSION['usuario'];
            $c=0;

            foreach($laboratorios->user as $b){
                $c++;
            }
            $nome_lab=$laboratorios->user[$a]->nome;
            for ($i=0;$i<$c;$i++){
                $auxcpf=$laboratorios->user[$i]->CPF;
                if($auxcpf==$cpf_paciente){
                    $laboratorios->user[$a]->exames->addChild("paciente", $nome_paciente);
                    $laboratorios->user[$a]->exames->addChild("CPF", $cpf_paciente);
                    $laboratorios->user[$a]->exames->addChild("data", $data_exame);
                    $laboratorios->user[$a]->exames->addChild("tipodeexame", $tipo_exame);
                    $laboratorios->user[$a]->exames->addChild("resultado",$resultado_exame);

                    $laboratorios->user[$i]->exames->addChild("data", $data_exame);
                    $laboratorios->user[$i]->exames->addChild("tipodeexame", $tipo_exame);
                    $laboratorios->user[$i]->exames->addChild("resultado",$resultado_exame);
                    $laboratorios->user[$i]->exames->addChild("laboratorio", $nome_lab);

                    break;
                }
            }
            if ($i==$c){
            echo "<script>
                alert ('Paciente não encontrado no banco');
                window.location.href='laboratorio.php';
                </script>";
            }

            if(file_put_contents("dados.xml", $laboratorios->asXML())){
                echo "<script>
                        alert ('Exame Cadastrado com Sucesso');
                        window.location.href='laboratorio.php';
                        </script>";
            }
          }
        }
        if (isset($_POST['cadastro'])){
            $nome_laboratorio=$_POST["nome"];
            $email=$_POST["email"];
            $senha=$_POST["senha"];
            $endereco=$_POST["endereco"];
            $fone=$_POST["fone"];
            $cnpj=$_POST["cnpj"];
  
            $laboratorios= simplexml_load_file("dados.xml");
            $a= $_SESSION['usuario'];
  
            if ($nome_laboratorio!=Null){
              unset($laboratorios->user[$a]->nome);
              $laboratorios->user[$a]->addChild("nome", $nome_laboratorio);
            }
            if ($email!=Null){
              $i=0;
              $c=0;
              foreach($laboratorios->user as $b){
                $c++;
              }
              for($i=0;$i<$c;$i++){
                if($laboratorios->user[$i]->email==$email){
                  echo "<script>
                    alert ('Email já possui cadastro!');
                    window.location.href='laboratorio.php';
                    </script>";
                    break;
                }
              }
              if($c==$i){
                unset($laboratorios->user[$a]->email);
                $laboratorios->user[$a]->addChild("email", $email);
              }
            }
            if ($senha!=Null){
              unset($laboratorios->user[$a]->senha);
              $laboratorios->user[$a]->addChild("senha", $senha);
            }
            if($endereco!=Null){
              unset($laboratorios->user[$a]->endereco);
              $laboratorios->user[$a]->addChild("endereco", $endereco);
            }
            if($fone!=Null){
              unset($laboratorios->user[$a]->telefone);
              $laboratorios->user[$a]->addChild("telefone", $fone);
            }
            if($cnpj!=Null){
              $i=0;
              $c=0;
              foreach($laboratorios->user as $b){
                $c++;
              }
              for($i=0;$i<$c;$i++){
                if($laboratorios->user[$i]->CNPJ==$cnpj){
                  echo "<script>
                    alert ('CNPJ já possui cadastro!');
                    window.location.href='laboratorio.php';
                    </script>";
                    break;
                }
              }
              if($c==$i){
                unset($laboratorios->user[$a]->CNPJ);
                $laboratorios->user[$a]->addChild("CNPJ", $cnpj);
              }
            }
            if(file_put_contents("dados.xml", $laboratorios->asXML())){
              echo "<script>
                      alert ('Cadastro Atualizado!');
                      window.location.href='laboratorio.php';
                      </script>";
          } 
        }
        ?>
      </main>
    </div>
    
</body>
</html>