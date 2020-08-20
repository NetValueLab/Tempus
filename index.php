<?php 
    require_once "includes/header.php";
    require_once "modelos/cadastrar.php";
    $cadastrar = new Cadastrar();
    $datos =  $cadastrar -> get_cliente(); 

    //Calculo da renda média
    $count_clientes = count($datos);
    $valor_total = 0;
    $valor_media = 0;
    
    //Maiores de 18 anos
    $count_nascimento = 0;

    //Classes
    $claseA = 0; $claseB= 0; $claseC = 0;

    
    for($i=0;$i<count($datos);$i++){
        //Renda média geral
        $valor_renda = (float) $datos[$i]["entrada_renda"];
        $valor_total = $valor_total + $valor_renda;
        $valor_media = ($valor_total/$count_clientes);

        //Verifica quantas pessoas são maiore de 18 anos e sua renda é maior que a renda média
        $data_nascimento = $cadastrar ->idade($datos[$i]["entrada_data_nasc"]);
        $renda = $datos[$i]["entrada_renda"];
        if($data_nascimento >= 18 &&  $renda >= $valor_media){
            $count_nascimento = $count_nascimento + 1;
        }

        //Clases
        if($renda <= 980.00){
            $claseA = $claseA + 1;
        }elseif($renda > 2500.00){
            $claseB = $claseB + 1;
        }elseif($renda >= 980.01 || $renda <= 2500.00){
            $claseC = $claseC + 1;
        }
    } 
    
    
?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                    <div class="card-header card-header-danger card-header-icon">
                        <div class="card-icon">
                        <i class="material-icons">info_outline</i>
                        </div>
                        <p class="card-category">Quantidade</p>
                        <h3 class="card-title"><?PHP echo $count_nascimento; ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                        <i class="material-icons">local_offer</i> Maiores de 18 anos com renda maior que a média
                        </div>
                    </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                            <i class="material-icons">store</i>
                            </div>
                            <p class="card-category">Valor</p>
                            <h3 class="card-title">R$ <?PHP echo $valor_media; ?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                            <i class="material-icons">date_range</i> Média geral de todas as rendas.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-stats">
                    <div class="card-header card-header-info card-header-icon">
                        <div class="card-icon">
                        <i class="fa fa-user"></i>
                        </div>
                        <p class="card-category">Pessoas</p>
                        <h3 class="card-title">A <?PHP echo  $claseA; ?></h3>
                        <h3 class="card-title">B <?PHP echo  $claseB; ?></h3>
                        <h3 class="card-title">C <?PHP echo  $claseC; ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                        <i class="material-icons">update</i> Clases
                        </div>
                    </div>
                    </div>
                </div>

<!--             
            
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                    <div class="card-icon">
                    <i class="material-icons">content_copy</i>
                    </div>
                    <p class="card-category">Used Space</p>
                    <h3 class="card-title">49/50
                    <small>GB</small>
                    </h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                    <i class="material-icons text-danger">warning</i>
                    <a href="javascript:;">Get More Space...</a>
                    </div>
                </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                    <div class="card-icon">
                    <i class="material-icons">store</i>
                    </div>
                    <p class="card-category">Revenue</p>
                    <h3 class="card-title">$34,245</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                    <i class="material-icons">date_range</i> Last 24 Hours
                    </div>
                </div>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                    <div class="card-icon">
                    <i class="fa fa-twitter"></i>
                    </div>
                    <p class="card-category">Followers</p>
                    <h3 class="card-title">+245</h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                    <i class="material-icons">update</i> Just Updated
                    </div>
                </div>
                </div>
            </div>
            
-->

            </div>
        </div>
    </div>
<?php require_once "includes/footer.php";?>