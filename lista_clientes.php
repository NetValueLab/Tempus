<?php   
        require_once "includes/header.php";
        require_once "includes/header.php";
        require_once "modelos/cadastrar.php";
        $cadastrar = new Cadastrar();
        $datos =  $cadastrar -> get_cliente();

        //validando eliminação do cadastro
        if(isset($_GET["eliminar"])){
            $cadastrar->eliminar_cadastro($_GET["eliminar"]);
            exit();
        }
        $datos_nome = 0;
        if(isset($_POST["buscar"])){
            if(strlen(trim($_POST["entrada_nome"]))<3||strlen(trim($_POST["entrada_nome"]))>150){
                header("Location:cadastro_clientes.php?&m=4");
            }else{
                $datos_nome = $cadastrar->buscar_cliente(trim($_POST["entrada_nome"]));
            }
        }

?>
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body">
                                <form method="post">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="bmd-label-floating">Nome Completo</label>
                                                <input type="text" name="entrada_nome" minlength="3" maxlength="150" class="form-control" required>
                                            </div>
                                        </div>                                
                                    </div>
                                    <button type="submit" name="buscar" class="btn btn-primary pull-right">Buscar Usuário</button>
                                    <div class="clearfix"></div>                                
                                </form>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                <h4 class="card-title ">Dados dos Clientes</h4>
                                <p class="card-category">Aqui tem todos os dados dos clientes</p>
                                <?PHP
                                //retorna o resultado do cadastramento.
                                if (isset($_GET["m"])) {
                                    switch ($_GET["m"]) {
                                    case "1";
                                        echo "<h4 class='card-title'>Falha na consulta desse cadastro!</h4>";
                                        break;

                                    case "2";
                                        echo "<h4 class='card-title'>Falha ao excluir - Falha na consulta!</h4>";
                                        break;
                                    
                                    case "3";
                                        echo "<h4 class='card-title'>Usuário Excluído!</h4>";
                                        break;
                                    case "4";
                                        echo "<h4 class='card-title'>O campo nome deve ter no mínimo 3 letras e no máximo 150 letras.</h4>";
                                        break;
                                    case "5";
                                        echo "<h4 class='card-title'>Sem registros!</h4>";
                                        break;
                                    }
                                    
                                }
                            ?>
                                </div>
                                <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                            <th>Nome</th>
                                            <th>Renda Familiar</th>
                                            <th>Editar</th>
                                            <th>Excluir</th>
                                        </thead>
                                        <tbody>
                                            <?PHP 
                                            /* echo "resultado é: ".count($datos_nome); */
                                            if($datos_nome<=0){
                                                for($i=0;$i<count($datos);$i++){
                                            ?>
                                                <tr>
                                                    <td><?PHP echo $datos[$i]["entrada_nome"]; ?></td>
                                                    <td><span class="renda_familia"><?PHP echo $datos[$i]["entrada_renda"]; ?></span></td>
                                                    <td><a href="editar_clientes.php?editar=<?PHP echo $datos[$i]["id_cliente"]?>" class="btn btn-primary text-white">Editar</a></td>
                                                    <td><a href='lista_clientes.php?eliminar=<?PHP echo $datos[$i]["id_cliente"]?>'' class="btn btn-primary text-white">Excluir</a></td>
                                                </tr>
                                            <?php
                                                }
                                            }elseif(count($datos_nome) > 0){
                                                for($i=0;$i<count($datos_nome);$i++){
                                            ?>
                                                <tr>
                                                    <td><?PHP echo $datos_nome[$i]["entrada_nome"]; ?></td>
                                                    <td><span class="renda_familia"><?PHP echo $datos_nome[$i]["entrada_renda"]; ?></span></td>
                                                    <td><a href="editar_clientes.php?editar=<?PHP echo $datos_nome[$i]["id_cliente"]?>" class="btn btn-primary text-white">Editar</a></td>
                                                    <td><a href='lista_clientes.php?eliminar=<?PHP echo $datos_nome[$i]["id_cliente"]?>'' class="btn btn-primary text-white">Excluir</a></td>
                                                </tr>
                                            <?PHP
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        
<?php require_once "includes/footer.php";?>