<?php 
    require_once "includes/header.php";
    require_once "modelos/cadastrar.php";
    $cadastrar = new Cadastrar();

    //Configura o horário para o correto, pois dependendo do fuso, em alguns lugares do mundo o dia já é outro.
    date_default_timezone_set('America/Sao_Paulo');

    //Pega o dia do cadastro, para caso o usuário não preencha no formulário.
    $date = date('y-m-j');

    //caso o botão de cadastro seja acionado, buscar o método de insert dentro da classe
    if(isset($_POST["cadastrar"])){
        //Verifica a quantidade de caracteres do campo nome.
        if(strlen(trim($_POST["entrada_nome"]))<3||strlen(trim($_POST["entrada_nome"]))>150){
            header("Location:cadastro_clientes.php?&m=7");
        }else{
            $entrada_nome=trim($_POST["entrada_nome"]);
        }
        //Validação da quantidade de números que o CPF tem.
        if(strlen(trim(str_replace('/','-',$_POST["entrada_cpf"])))<11||strlen(trim(str_replace('/','-',$_POST["entrada_cpf"]))) > 11){
            header("Location:cadastro_clientes.php?&m=6");
            exit();
        }else{
            $entrada_CPF=trim(str_replace('/','-',$_POST["entrada_cpf"]));
        }
        //Validação da data de nascimento
        if(strtotime(trim(str_replace('/','-',$_POST["entrada_data_nasc"]))) > strtotime($date)){
            header("Location:cadastro_clientes.php?&m=8");
            exit();
        }else{
            $entrada_data_nasc=trim(str_replace('/','-',$_POST["entrada_data_nasc"]));
        }

        //Validação da data de cadastro
        if(strtotime(trim(str_replace('/','-',$_POST["entrada_data_cadastro"]))) > strtotime($date)){
            header("Location:cadastro_clientes.php?&m=8");
            exit();
        }else{
            $entrada_data_cadastro=trim(str_replace('/','-',$_POST["entrada_data_cadastro"]));
        }
        
        //Se a data de cadastro não for preenchida, o sistema deve preecher.
        if(empty($entrada_data_cadastro)){
            $entrada_data_cadastro = $date;
        }
        //Coloca o valor zero no campo de renda caso o usuário não preencha.
        if(trim($_POST["entrada_renda"])==null){
            $entrada_renda = 0;
        }else{
            $entrada_renda=trim($_POST["entrada_renda"]);
        }

        //Chama o método da classe.
        $cadastrar->insertar_cliente($entrada_nome,$entrada_CPF,$entrada_data_nasc, $entrada_data_cadastro,$entrada_renda);
    }
?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Cadastro de Clientes</h4>
                            <p class="card-category">Preencha com os dados abaixo</p>
                            <?PHP
                                //retorna o resultado do cadastramento.
                                if (isset($_GET["m"])) {
                                    switch ($_GET["m"]) {
                                    case "1";
                                        echo "<h4 class='card-title'>
                                        Os campos de Nome, CPF e Data de Nascimentos são obrigatórios!</h4>";
                                        break;

                                    case "2";
                                        echo "<h4 class='card-title'>Falha na comunicação com a base de dados!</h4>";
                                        break;
                                    
                                    case "3";
                                        echo "<h4 class='card-title'>Conteúdo Cadastrado!</h4>";
                                        break;
                                    
                                    case "4";
                                        echo "<h4 class='card-title'>Conteúdo não cadastrado!</h4>";
                                        break;
                                    
                                    case "5";
                                        echo "<h4 class='card-title'>Esse CPF já foi cadastrado!</h4>";
                                        break;
                                    case "6";
                                        echo "<h4 class='card-title'>O CPF Tem que ter no mínimo 11 Dígitos!</h4>";
                                        break;
                                    case "7";
                                        echo "<h4 class='card-title'>O campo nome deve ter no mínimo 3 letras e no máximo 150 letras.</h4>";
                                        break;
                                    case "8";
                                        echo "<h4 class='card-title'>Data de Nascimento/Cadastro não pode ser maior que a data atual!</h4>";
                                        break;
                                    }
                                    
                                }
                            ?>
                        </div>
                        <div class="card-body">
                            <form method="post">
                            <div class="row">
                                <div class="col-md-8">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Nome Completo</label>
                                    <input type="text" name="entrada_nome" minlength="3" maxlength="150" class="form-control" required>
                                </div>
                                </div>
                                <div class="col-md-4">
                                <div class="form-group">
                                    <label class="bmd-label-floating">CPF</label>
                                    <input type="number" minlength="11" maxlength="11" name="entrada_cpf" class="form-control" required>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>Data de Nascimento</label>
                                    <input type="date" name="entrada_data_nasc" class="form-control" required>
                                </div>
                                </div>
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label>Data do Cadastro</label>
                                    <input type="date" name="entrada_data_cadastro" class="form-control">
                                </div>
                                </div>
                            </div>
                            <div class="row">                                
                                <div class="col-md-12">
                                <div class="form-group">
                                    <label class="bmd-label-floating">Renda Familiar R$</label>
                                    <input type="number" pattern="[0-9]+([,\.][0-9]+)?" step="any" name="entrada_renda" class="form-control">
                                </div>
                                </div>
                            </div>
                            <button type="submit" name="cadastrar" class="btn btn-primary pull-right">Cadastrar Usuário</button>
                            <div class="clearfix"></div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
<?php require_once "includes/footer.php";?>