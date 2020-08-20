<?PHP
    class Cadastrar extends Conectar{
        private $db;
        private $cadastrar;
        public function __construct(){
            $this->db=Conectar::conexion();
            $this->cadastrar=array();
        }


        //Insere os dados dos clientes
        public function insertar_cliente($entrada_nome,$entrada_CPF,$entrada_data_nasc, $entrada_data_cadastro,$entrada_renda){
            //Válidamos se os campos estão vazios
            if (empty($entrada_nome) or
            empty($entrada_CPF) or
            empty($entrada_data_nasc))
            {
                header("Location:cadastro_clientes.php?m=1");
                exit();
            }else{       
                //Verifica se o CPF já existe na base de dados
                $resultado = $this->db->prepare("SELECT * FROM CLIENTES WHERE entrada_cpf=?");
                $resultado->bindValue(1,$entrada_CPF);
                if(!$resultado->execute()){
                    header("Location:categorias.php?m=2");                    
                    exit();
                }else{
                    if($resultado->rowCount()>0){
                        header("Location:cadastro_clientes.php?m=5");
                        exit();
                    }else{
                        //Insere as informações na base de dados
                        $resultado =  $this->db->prepare("INSERT INTO CLIENTES VALUES(NULL,?,?,?,?,?)");
                        $resultado->bindValue(1,$entrada_nome);
                        $resultado->bindValue(2,$entrada_CPF);
                        $resultado->bindValue(3,$entrada_data_nasc);
                        $resultado->bindValue(4,$entrada_data_cadastro);
                        $resultado->bindValue(5,$entrada_renda);
                        if (!$resultado->execute()) {
                            header("Location:cadastro_clientes.php?&m=2");
                        }else{
                            if ($resultado->rowCount() > 0) {
                                header("Location:cadastro_clientes.php?&m=3");
                                exit();
                            } else {
                                header("Location:cadastro_clientes.php?&m=4");
                                exit();
                            }
                        }
                    }
                }
            }
        }

        //Pega os dados dos clientes para que seja apresentados na lista
        public function get_cliente(){
            $conectar = $this->db;
            $resultado = $conectar->prepare("SELECT* FROM clientes");
            if(!$resultado->execute()){
                die("A consulta falhou");
            }else{
                while($reg = $resultado->fetch()){
                    $this->categorias[]=$reg;
                }
                return $this->categorias;
            }
        }

        //Elimina os dados dos clientes
        public function eliminar_cadastro($id_cliente){
            //validamos se existe o ID da categoria na base de dados
            $resultado = $this->db->prepare("SELECT * FROM clientes WHERE ID_cliente=?");
            $resultado->bindValue(1,$id_cliente);
            if(!$resultado->execute()){
                header("Location:categorias.php?m=1");   //falha na consuta                
                exit();
            }else{ //existe o usuário
                $resultado = $this->db->prepare("DELETE FROM clientes WHERE ID_cliente=?");
                $resultado->bindValue(1,$id_cliente);
                if(!$resultado->execute()){
                    header("Location:categorias.php?m=2");  //falha ao excluir - falha na consulta                  
                    exit();
                }else{
                    if($resultado->rowCount()>0){
                        header("Location:lista_clientes.php?m=3"); //excluído com sucesso
                        exit();
                    }
                }
            }    
        }

        //Pega os dados dos clientes para que possam ser editados
        public function get_cliente_por_id($id_cliente){
            $resultado = $this->db->prepare("SELECT * FROM clientes WHERE id_cliente=?");
            $resultado->bindValue(1, $id_cliente);
            if (!$resultado->execute()) {
                header("Location:editar_clientes.php?m=1");
            } else {
                if($resultado->rowCount()>0){
                    while ($reg = $resultado->fetch()) {
                        $this->clientes_por_id[] = $reg;
                    } 
                    return  $this->clientes_por_id;
                }else{
                    header("Location:editar_clientes.php?m=2");
                }
            }
        }

        //Edita os dados dos clientes
        public function editar_cliente($id_cliente,$entrada_nome,$entrada_CPF,$entrada_data_nasc, $entrada_data_cadastro,$entrada_renda){
            {
                //Válidamos se os campos estão vazios
                if (empty($entrada_nome) or
                empty($entrada_CPF) or
                empty($entrada_data_nasc))
                {
                    header("Location:cadastro_clientes.php?m=1");
                    exit();
                }else{       
                    //Verifica se o mesmo número de CPF vai ser cadastrado
                    /* $resultado = $this->db->prepare("SELECT * FROM CLIENTES WHERE id_cliente=? AND entrada_cpf=?");
                    $resultado->bindValue(1,$id_cliente);
                    $resultado->bindValue(2,$entrada_CPF);
                    if(!$resultado->execute()){
                        header("Location:editar_clientes.php?&m=2&editar=$id_cliente");                    
                        exit();
                    }else{ 
                        if($resultado->rowCount()>0){
                            header("Location:editar_clientes.php?&m=5&editar=$id_cliente");
                            exit();
                        }else{ */
                            //Insere as informações na base de dados
                            $resultado =  $this->db->prepare("UPDATE clientes SET entrada_nome=?, entrada_CPF=?, entrada_data_nasc=?, entrada_data_cadastro=?, entrada_renda=? WHERE id_cliente=?");
    
                            $resultado->bindValue(1,$entrada_nome);
                            $resultado->bindValue(2,$entrada_CPF);
                            $resultado->bindValue(3,$entrada_data_nasc);
                            $resultado->bindValue(4,$entrada_data_cadastro);
                            $resultado->bindValue(5,$entrada_renda);
                            $resultado->bindValue(6,$id_cliente);
                            if (!$resultado->execute()) {
                                header("Location:editar_clientes.php?&m=2&editar=$id_cliente");
                            }else{
                                if ($resultado->rowCount() > 0) {
                                    header("Location:editar_clientes.php?&m=3&editar=$id_cliente");
                                    exit();
                                } else {
                                    header("Location:editar_clientes.php?&m=4&editar=$id_cliente");
                                    exit();
                                }
                            }
                        /* }
                    } */
                }
            }
        }

        //Verifica a idade da pessoa em anos
        public function idade($data_nascimento){
            //Configura o fuso para o de SP
            date_default_timezone_set('America/Sao_Paulo');

            //Pega o parâmetro
            $dn = new DateTime($data_nascimento);     
            
            //Pega a data atual
            $data_atual = new DateTime();

            //Compara a diferença entre a data atual e o dia de nascimento
            $idade = $data_atual->diff($dn);

            //Retorna a idade em anos
            return $idade->y;
        }

        public function buscar_cliente($nome){
            $resultado = $this->db->prepare("SELECT * FROM clientes WHERE entrada_nome LIKE'%$nome%'");
            if (!$resultado->execute()) {
                header("Location:lista_clientes.php?m=1");
            } else {
                if($resultado->rowCount()>0){
                    while ($reg = $resultado->fetch()) {
                        $this->clientes_por_nome[] = $reg;
                    } 
                    return  $this->clientes_por_nome;
                }else{
                    header("Location:lista_clientes.php?m=5");
                }
            }
        }
    }
?>