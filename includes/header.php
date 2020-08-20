<?PHP 
    ob_start();
    require_once("modelos/conexion.php");
    //Função para inverter a data e colocar no banco de dados
    function inverterData($data,$separar="-",$juntar="-"){
        return implode($juntar, array_reverse(explode($separar,$data)));
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Tempus
  </title>
  <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link href="assets/css/style.css" rel="stylesheet" />
  <link href="assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white" data-image="assets/img/sidebar-1.jpg">
      <div class="logo"><img src="assets/img/logo.svg"></div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">
              <i class="material-icons">dashboard</i>
              <p>Painel de Controle</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="cadastro_clientes.php">
              <i class="material-icons">person</i>
              <p>Cadastro de Cliente</p>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="lista_clientes.php">
              <i class="material-icons">list</i>
              <p>Clientes Cadastrados</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="wrapper ">
        <div class="main-panel">
             <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
                <div class="container-fluid">
                <div class="navbar-wrapper">
                  <a class="navbar-brand" href="index.php">Painel de Controle</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end">
                    <ul class="navbar-nav">
                    <li class="nav-item">
                        
                    </li>
                    </ul>
                </div>
                </div>
            </nav>
            <!-- End Navbar -->
