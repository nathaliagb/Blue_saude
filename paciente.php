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
        include './css/paciente.css';
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

        $pacientes= simplexml_load_file("dados.xml");
        $a= $_SESSION['usuario'];
        echo '<h2>'."Bem-Vindo ".$pacientes->user[$a]->nome.'</h2><br>';
    ?>
    <div class="historico">
        <main>
        <h3>Histórico de consultas:</h3>
        <?php 
            $cont_consultas=0;
            $cont_exames=0;
            $i=0;
        
        foreach($pacientes->user[$a]->consultas->medico as $b){
            $cont_consultas++;
        }
        if($cont_consultas>0){
            echo '<table class="tabela-historico">'. "<tr><td> Médico </td> <td> Especialidade </td> <td> Data</td> </tr>";
            for ($i==0; $i<$cont_consultas; $i++) {
                echo " <tr><td> ".$pacientes->user[$a]->consultas->medico[$i]." </td>";
                echo " <td> ".$pacientes->user[$a]->consultas->especialidade[$i]." </td> ";
                echo " <td> ".$pacientes->user[$a]->consultas->data[$i]." </td> </tr>";  
        }
            echo "</table><br>"; 
            echo "<h3>Total de consultas:".$cont_consultas."</h3><br>"; 
        }
        $i=0;
        foreach($pacientes->user[$a]->exames->tipodeexame as $d){
            $cont_exames++;
        }
        if($cont_exames>0){
            echo "<h3>Histórico de exames:</h3>";
            echo '<table class="tabela-historico">'. "<tr><td> Data </td> <td> Exame </td> <td> Resultado </td> </tr>";
            for ($i==0; $i<$cont_exames; $i++) {
                echo " <tr><td> ".$pacientes->user[$a]->exames->data[$i]." </td>";
                echo " <td> ".$pacientes->user[$a]->exames->tipodeexame[$i]." </td> ";
                echo " <td> ".$pacientes->user[$a]->exames->resultado[$i]." </td> </tr>";  
            }
            echo "</table><br>"; 
            echo "<h3>Total de exames:".$cont_exames."</h3><br>";
        }
        ?>
        </main>
    </div>
</body>
</html>