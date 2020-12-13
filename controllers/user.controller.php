<?php
        namespace app_controllers;
        //declarando namespaces e requerindo dependências
        
        require_once './../gobeauty/models/Customer.class.php';
        require_once './../gobeauty/models/Employee.class.php';
        require_once './../gobeauty/controllers/functions/myFunctions.php';
        use app_models\Customer;
        use app_models\Employee;
        use app_models\User;
        use PDOException;
        use Exception;

        class UserController {
                private $_user;

                //cria instância de usuário padrão para efetuar login, vem sem role default... setado durante login de acordo com nivel de usuário
                public function __construct() {
                    $this->_user = new User();
                }


                //Tenta validar se usuário pode ser logado por meio da função is_logged que faz validação se o email existe e em seguinda checa se a senha bate com o registro
                public function login() {
                    try{
                        $this->_user->setEmail($_POST['email']);
                        $this->_user->setPass($_POST['password']);

                        if($this->_user->isLogged($this->_user->getEmail(),$this->_user->getPass())){
        
                            if($this->_user->getStatusLogin()) {
                                //captura array com informações de usuário
                                $infos = $this->_user->getUserInfos();
                                //inicia e seta variáveis de sessão
                                if(!isset($_SESSION)){
                                    session_start();
                                }
                                $_SESSION['id'] = $infos['id'];
                                $_SESSION['username'] = $infos['username'];
                                $_SESSION['pass'] = $infos['pass'];
                                $_SESSION['email'] = $infos['email'];
                                $_SESSION['tel'] = $infos['tel'];
                                $_SESSION['role'] = $infos['role'];
                                $_SESSION['logged'] = true;
                                //verifica role do usuário e redireciona para a página home do mesmo
                                if($_SESSION['role'] == 4){
                                    header('Location:./../gobeauty/page-employee.php');                     
                                } else if($_SESSION['role'] == 3){
                                    header('Location:./../gobeauty/page-user.php');     
                                    //header('Location:./../gobeauty/edit-user.php');                 
                                } else if($_SESSION['role'] == 2){
                                    header('Location:./../gobeauty/page-admin.php'); 
                                }
                            } else {
                                unset($this->_user);
                                alertMessage('Algo deu errado!');
                                redirect('index.php');
                            }
                        

                        } else {
                            //caso usuário não exista, sessão é destruida e usuário perde informações recebidas via POST
                            unset($this->_user);
                            alertMessage('Email e/ou senha incorretos!');
                            if(isset($_SESSION))
                                session_destroy();
                            exit;
                        }
                    } catch(Exception $ex) {
                        //captura erro genérico
                        return $ex;
                    }
                }

                //Cria conta de usuário validadndo role
                public function createNewAccount($role_user){
                
                    if(!isset($_SESSION)) {
                        session_start();
                    }
                    if($role_user == 2) {
                        $this->_user = new Employee();
                    } else{
                        $this->_user = new Customer();
                    }
                    if(strlen($_POST['name'])>=3 && strlen($_POST['password'])>=4) {
                        $this->_user -> setUsername($_POST['name']);
                        $this->_user -> setTel($_POST['tel']);
                        $this->_user -> setEmail($_POST['email']);
                        $this->_user -> setPass($_POST['password']);
                        try{
                            if(!$this->_user->exists($this->_user->getEmail(),$this->_user->getPass())){
                                $this->_user -> createUser($this->_user->getUsername(), $this->_user->getEmail(), $this->_user->getTel(), $this->_user->getPass(),$this->_user->getRole());
                                alertMessage('Usuário inserido com sucesso');
                                unset($this->_user);
                                redirect('index.php');
                                
                            } else {
                                //Caso email já exista na plataforma, se passar banco de dados vai retornar um erro porque tem unique no campo
                                alertMessage('Email já foi cadastrado!');
                                unset($this->_user);
                                redirect('register.php');
                            }
        
                        } catch(PDOException $ex) {
                            //captura erro do banco
                            alertMessage('Erro ao inserir usuário');
                            redirect('register.php');
                        }
        
                    } else {
                        //usuário ou senha inválidos no registro para a plataforma
                        alertMessage('Usuário e/ou senha inválidos');
                        redirect('register.php');
                    }
                }


                public function UpdateUser($id) {
                    echo $id;
                    if(md5($_POST['oldPassword'])==$_SESSION['password'] && md5($_POST['newPassword'])==md5($_POST['confirmPassword'])) {
                        if(strlen($_POST['name'])>=3 && strlen($_POST['password'])>=4) {
                            $this->_user -> setUsername($_POST['name']);
                            $this->_user -> setTel($_POST['tel']);
                            $this->_user -> setEmail($_POST['email']);
                            $this->_user -> setPass($_POST['newPassword']);
                            try{
                                $this->_user -> updateUser($id,$this->_user->getUsername(), $this->_user->getEmail(), $this->_user->getTel(), $this->_user->getPass());
                                alertMessage('Usuário atualizado com sucesso!');
                            } catch(PDOException $ex) {
                                //captura erro do banco
                                alertMessage('Erro ao atualizar usuário!');
                            }
                    } else {
                        alertMessage('Verifique se os dados digitados são válidos!');
                        unset($this->_user);
                    }
                }
            }

                public function DeleteUser($id) {
                    $this->_user->deleteUser($id);
                    alertMessage('Usuário deletado com sucesso!');
                }


                public function list() {
                    $arr = $this->_user->getAllUsers();

                    for($i =0; $i<count($arr);$i++) {

                        if($arr[$i]['role_id'] == 2) {
                            $role = "Administrador";
                        } else if($arr[$i]['role_id'] == 3) {
                            $role = "Cliente";
                        } else {
                            $role = 'Funcionário';
                        }
        
                        echo "<tr>
                                <td>".$arr[$i]['username']."</td>
                                <td>".$arr[$i]['email']."</td>
                                <td>".$arr[$i]['tel']."</td>
                                <td>".$role."</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='#' role='button' class='btn btn-sm'><i class='fas fa-trash-alt'></i>&nbsp;&nbsp;Deletar</a></td>
                        </tr>";
                    }
                }

                public function listWithParam($param) {
                    $arr = $this->_user->getUser($param);
                    for($i =0; $i<count($arr);$i++) {

                        if($arr[$i]['role_id'] == 2) {
                            $role = "administrador";
                        } else if($arr[$i]['role_id'] == 3) {
                            $role = "Cliente";
                        } else {
                            $role = "Funcionário";
                        }
        
                        echo "<tr>
                                <td>".$arr[$i]['username']."</td>
                                <td>".$arr[$i]['email']."</td>
                                <td>".$arr[$i]['tel']."</td>
                                <td>".$role."</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <a href='#' role='button' class='btn btn-sm'><i class='fas fa-trash-alt'></i>&nbsp;&nbsp;Deletar</a></td>
                        </tr>";
                    }
                }
            }