<?php
session_start();

$email_acesso = $_POST["email"];
$senha_acesso = $_POST["senha"];


$medicos = simplexml_load_file("dados.xml");
$i = 0;
$cont_medicos = 0;

foreach ($medicos->user as $a) {
    $cont_medicos++;
}

for ($i = 0; $i < $cont_medicos; $i++) {

    if ($medicos->user[$i]->email == $email_acesso) {
        if ($medicos->user[$i]->senha == $senha_acesso) {
            if ($medicos->user[$i]->tipo == "medico") {
                $_SESSION['usuario'] = $i;
                header("Location: medico.php");
            } elseif ($medicos->user[$i]->tipo == "laboratorio") {
                $_SESSION['usuario'] = $i;
                echo '<script>window.location="laboratorio.php"; </script>';
            } elseif ($medicos->user[$i]->tipo == "paciente") {
                $_SESSION['usuario'] = $i;
                echo '<script>window.location="paciente.php"; </script>';
            } elseif ($medicos->user[$i]->tipo == "admin") {
                $_SESSION['usuario'] = $i;
                echo '<script>window.location="admin.php"; </script>';
            }
        } else {
            echo '<script type="text/javascript"> alert ("Email e/ou Senha incorretos!") ;</script>';
            echo '<script>window.location="index.html"; </script>';
        }
    }
}
if ($medicos->user[$i]->email != $email_acesso) {
    echo '<script type="text/javascript"> alert ("Email e/ou Senha incorretos!") ;</script>';
    echo '<script>window.location="index.html"; </script>';
}
