<?php
session_start();

require_once 'includes.php';
require_once 'Connection.php';
require_once 'EntidadeInterface.php';
require_once 'Aluno.php';
require_once 'Usuario.php';
require_once 'AlunoModel.php';
require_once 'UsuarioModel.php';

if (isset($_POST['submitted'])) {
    
    processForm($conexao);
} else {
    
    showForm();
}

function processForm($conexao) {
    
    global $gsErrMsg, $gbErrLogin, $gbErrPassword;
    
    // user and password required:
    if (!$_POST['inputUsername'] || !$_POST['inputPassword']) {
        
        if (isset($_GET['msg']) && ($_GET['msg'] == 'se')) {
            $gsErrMsg = 'Sessão Expirada<br/>Por favor Logue novamente<br/><br/><br/>';
            
        } else {
        
            $gsErrMsg = 'Por favor, preencha corretamente os campos de Login e Senha';
            $gbErrLogin = true;
            $gbErrPassword = true;
        } 
        
    } else {
            
        $sUsername  = trim($_POST['inputUsername']);
        $sPassword  = $_POST['inputPassword'];
        
        $usuario    = new Usuario();
        $usuario->setTable('usuarios');
        $usuarioModel = new UsuarioModel($conexao, $usuario);
        
        $rs = $usuarioModel->findNomePassword($sUsername, $sPassword);
        
//        print_r($rs);
//        exit();
        
        if ($rs > 0) {

            // session_start();
            
            // echo 'entrou Session<br>'; 
//            ob_start();
//            session_start();
            
            $_SESSION['logado']      = true;
            $_SESSION['nome']        = $rs['nome'];
            $_SESSION['password']    = $rs['password'];
            
            
//            print_r($_SESSION);
//            EXIT();

            
            
            
            header('Location: index.php');

        } else {
//            echo 'teste';
//            exit();
            
            $gsErrMsg       = 'Usuário não encontrado!';
            $gbErrLogin     = true;
            header('Location: login.php');
            
        }  

    }
    
} //processForm()

function    showForm() {
    global $gsName, $gsErrMsg, $gbErrLogin, $gbErrPassword;
        
?>
<body>

<!-- ------------------------------------------------------------------------------------------------------------------------------------------ -->
<!-- LOGIN FORM                                                                                                                                 -->
<!-- ------------------------------------------------------------------------------------------------------------------------------------------ -->    

<h4><span class="label label-danger"><?php echo $gsErrMsg; ?></span></h4>   
    
<div id="loginbox" style="margin-top:50px;" class="col-sm-5 col-sm-offset-3">           
    
<div class="panel panel-info">
    
<div class="panel-heading">
    <div class="panel-title">Logar</div>
    <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Esqueceu Senha?</a></div>
</div>     

<div class="panel-body" style="padding-top:30px">

    <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
    <form id="loginForm" class="form-horizontal" role="form" method="POST" action="login.php">
  
    <div class="form-group">
        <div class="col-sm-11 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input type="text" class="form-control" id="inputUsername" name="inputUsername" placeholder="Username" />
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-11 inputGroupContainer">
            <div class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                <input type="password" class="form-control" id="inputPassword" name="inputPassword"  placeholder="Senha" />
            </div>
        </div>
    </div>          
       
    <div class="form-group">
        <div class="col-sm-11 inputGroupContainer">
            <button type="submit" id="submitted" name="submitted" class="btn btn-sm btn-success">Enviar</button>
            <button type="reset" class="btn btn-sm btn-default">Limpar</button>
        </div>
    </div>         
        
    </form>
</div>      
    
<div class="panel-footer">
    <div class="form-group">
        <div class="col-sm-11">
            <div class="input-group">
                Não tem uma conta? 
                <a href="register.php" onClick="$('#loginbox').hide(); $('#registerbox').show()">
                Cadastre-se aqui
                </a>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Esqueceu a Senha?
                <a href="forgot_password.php">Resete aqui</a>                                
            </div>
        </div>
    </div>    
    </form>   
</div>
    
</div>  
</div>

</body>
</html>

<style type="text/css">

    #loginForm .inputGroupContainer .form-control-feedback,     
    #loginForm .selectContainer     .form-control-feedback {
    top: 0;
    right: -15px;
}
</style>

<script type="text/javascript">    

$(document).ready(function() {
    
//    $('#loginForm').bootstrapValidator({
//        
//        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
//        feedbackIcons: {
//            valid: 'glyphicon glyphicon-ok',
//            invalid: 'glyphicon glyphicon-remove',
//            validating: 'glyphicon glyphicon-refresh'
//        },
//        fields: {
//
//            inputEmail: {
//                validators: {
//                    notEmpty: {
//                        message: 'O e-mail é obrigatório e não pode estar vazio!'
//                    },                    
//                    regexp: {
//                        regexp: /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/,
//                        message: 'Por favor entre com um e-mail válido!'
//                    }
//                }
//            },  
//          
//            inputPassword: {
//                validators: {
//                    notEmpty: {
//                        message: 'A senha é obrigatória e não pode ser vazia!'
//                    },
//                    stringLength: {
//                        min: 8,
//                        message: 'A senha precisa ter no mínimo 8 caracteres!'
//                    }
//                }
//            },            
//           
//
//        }
//    });
});
</script>    

<?php
}

































































































































































































/*
function processRegisterForm() {
    
    $conn = conn();

    global $gbErrMsg, $gbErrRegister, $gbErrPassword;

    $gbErrRegister = false;
    $gbErrMsg = array();

    if ((isset($_POST['submitted'])) OR ( $_POST['username'] != '' )) {

        $username = trim($_POST['username']);
        $email    = trim($_POST['email']);
        $cpf      = trim($_POST['cpf']);
        $password = trim($_POST['password']);
        $password = md5($password);

        if (empty($username)) {

            array_push($gbErrMsg, 'Você esqueceu o Nome de Usuário!');
            $gbErrRegister = true;
        }

        if (empty($email)) {

            array_push($gbErrMsg, 'Você esqueceu o Email!');
            $gbErrRegister = true;
        }

        if (empty($cpf)) {

            array_push($gbErrMsg, 'Você esqueceu o CPF!');
            $gbErrRegister = true;
        }

        if (empty($password)) {

            array_push($gbErrMsg, 'Você esqueceu a senha!');
            $gbErrRegister = true;
        }
        
        if (checkRegisteredUser($username, $email, $conn)) {
            
            array_push($gbErrMsg, 'Usuário não registrado!');
            $gbErrRegister = true;    
        }

        if ($gbErrRegister == false) {
      
            $dt_create      = date('Y-m-d');
            $dt_update      = $dt_create;
            $dt_subscribe   = $dt_create;
            $dt_expire      = $dt_create;
            $status         = 2;
            $id_user_role   = 2;

            // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////            
            // INSERE USUARIO            
            // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////             
            $sql = "INSERT INTO user(nm_username, nm_password, nm_email, id_user_role, dt_create, dt_update, id_status, dt_subscribe, dt_expire, is_synced) "
                 . "VALUES(:username, :password, :email, :user_role, :dt_create, :dt_update, :status, :dt_subscribe, DATE_ADD(:dt_expire, INTERVAL 100 YEAR), '0')";
            
            $stmt = $conn->prepare($sql); 
            $stmt->bindParam(':username',     $username, PDO::PARAM_STR);
            $stmt->bindParam(':password',     $password, PDO::PARAM_STR);
            $stmt->bindParam(':email',        $email, PDO::PARAM_STR);
            $stmt->bindParam(':user_role',    $id_user_role, PDO::PARAM_INT);
            $stmt->bindParam(':dt_create',    $dt_create, PDO::PARAM_STR);
            $stmt->bindParam(':dt_update',    $dt_update, PDO::PARAM_STR);   
            $stmt->bindParam(':status',       $status, PDO::PARAM_STR);
            $stmt->bindParam(':dt_subscribe', $dt_subscribe, PDO::PARAM_STR);            
            $stmt->bindParam(':dt_expire',    $dt_expire, PDO::PARAM_STR);            
            $stmt->execute();

            // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////            
            // SELECIONA MAX USUARIO            
            // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////                        
            $sql2   = "SELECT max(id_user) as id FROM user";
            $stmt2  = $conn->prepare($sql2); 
            $stmt2->execute();
            $rs2    = $stmt2->fetch();
            $id     = $rs2['id'];
            
            // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////            
            // CONFIRMACAO EMAIL
            // ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////             
            doEmailConfirmation($username, $email, $id, $conn);

            $msg         = 'Nós enviamos a você um email de confirmação. Por favor confirme.';
            $footer_msg  = 'Já registrado?';
            $title       = 'Registro';
            $action      = 'login.php';
            $action_name = 'Login';
            $label       = 1;

            showMsg($msg, $title, $footer_msg, $action, $action_name, $label);
            exit();
            
        } else {

            $gbErrRegister = true;
            array_push($gbErrMsg, 'Usuário não pode ser registrado!');
        }
    }
}

function doEmailConfirmation($username, $email, $userid, $conn) {

    // CREATE A RANDOM KEY
    $confirm_key = $username . $email . date('mY');
    $confirm_key = md5($confirm_key);
    $nm_type = 'C';

    // CURRENT DATE
    $today = date('Y-m-d');

    // ADD CONFIRM ROW
    $sql = "INSERT INTO confirm(id_user, nm_key, nm_email, nm_type, dt_create) VALUES(:userid, :confirm_key, :email, :nm_type, :today)";
    $stmt = $conn->prepare($sql); 
    $stmt->bindParam(':userid',       $userid,      PDO::PARAM_STR);
    $stmt->bindParam(':confirm_key',  $confirm_key, PDO::PARAM_STR);
    $stmt->bindParam(':email',        $email,       PDO::PARAM_STR);
    $stmt->bindParam(':nm_type',      $nm_type,     PDO::PARAM_STR);
    $stmt->bindParam(':today',        $today,       PDO::PARAM_STR);
    $result = $stmt->execute();    
    
    if ($result == true) {

        $nome_arq       = (dirname(__FILE__)).'/inc/template/email.tpl.php';
        $conteudo       = file_get_contents($nome_arq);
        $nome_campo     = "username";
        $obj            = new Template('[@', '%]', $nome_campo, $username, $conteudo, 'tela');
        $resultado1     = $obj->replaceText();
        
        $address        = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $address        = str_replace(basename(__FILE__), "", $address);
        $address        = $address . 'confirm.php?email=' . $email . '&key=' . $confirm_key;
        $conteudo       = $resultado1;
        $nome_campo     = "address";
        $obj            = new Template('[@', '%]', $nome_campo, $address, $conteudo, 'tela');
        $resultado2     = $obj->replaceText();

        $from_email     = "roger.bastida@campinas.sp.gov.br";
        $from_name      = "Sistema de Cadastro de Aluno(SCAP)";
        $subject        = "(SACP) - Confirmação de Registro de Conta";
        $to_name        = $username;
        $to_email       = $email;
        
        $objEmail = new SendEmail();
        $objEmail->setFrom_name($from_name);
        $objEmail->setFrom_email($from_email);
        $objEmail->setTo_name($to_name);
        $objEmail->setTo_email($to_email);
        $objEmail->setSubject($subject);
        $objEmail->setConfirm_Key($confirm_key);
        $objEmail->setTemplate_Name($resultado2);
        $objEmail->send();

    } else {
        echo 'não confirmou';
    }
}

function showForm() {
    global $gsName, $gbErrMsg, $gbErrLogin, $gbErrPassword;
    ?>
    <body>

        <!-- ------------------------------------------------------------------------------------------------------------------------------------------ -->
        <!-- REGISTER FORM                                                                                                                              -->
        <!-- ------------------------------------------------------------------------------------------------------------------------------------------ -->    

        <div id="registerbox" style="margin-top:50px" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

    <?php
    if (count($gbErrMsg) > 0) {

        $total = count($gbErrMsg);
        for ($a = 0; $a < $total; $a++) {
            ?>
                    <h4><span class="label label-danger"><?php echo $gbErrMsg[$a]; ?></span></h4>
            <?php
        }
    }
    ?>  

            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">
                        <i class="fa fa-sign-in"></i> Registrar
                    </div>
                    <div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#registerbox').hide(); $('#loginbox').show()">Logar</a></div>
                </div>  

                <div class="panel-body" >

                    <form id="registerForm" class="form-horizontal" method="POST" action="register.php">               

                        <div id="registeralert" style="display:none" class="alert alert-danger">
                            <p>Error:</p>
                            <span></span>
                        </div>

                        <!-- Nome -->            
                        <div class="form-group">
                            <div class="col-sm-11 inputGroupContainer">
                                <label for="firstname" class="col-md-2 control-label">Nome</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="firstname" placeholder="Nome">
                                </div>
                            </div>
                        </div>    

                        <!-- Nome de Usuário -->        
                        <div class="form-group">
                            <div class="col-sm-11 inputGroupContainer">
                                <label for="username" class="col-md-2 control-label">Nome Usuário</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="username" name="username" placeholder="Nome de Usuário">
                                </div>
                            </div>                
                        </div>    

                        <!-- CPF -->        
                        <div class="form-group">
                            <div class="col-sm-11 inputGroupContainer">        
                                <label for="cpf" class="col-md-2 control-label">CPF</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                                </div>
                            </div>
                        </div>      

                        <!-- Email -->        
                        <div class="form-group">
                            <div class="col-sm-11 inputGroupContainer">
                                <label for="email" class="col-md-2 control-label">Email</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="email" placeholder="Email">
                                </div>
                            </div>
                        </div>

                        <!-- Senha -->    
                        <div class="form-group">
                            <div class="col-sm-11 inputGroupContainer">
                                <label for="password" class="col-md-2 control-label">Senha</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                                </div>
                            </div>            
                        </div>

                        <!-- Confirma Senha -->        
                        <div class="form-group">
                            <div class="col-sm-11 inputGroupContainer">
                                <label for="confirm" class="col-md-2 control-label">Confirma Senha</label>
                                <div class="col-md-9">
                                    <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirma Senha">
                                </div>
                            </div>
                        </div>    

                        <!--    <div class="form-group">
                                <div class="col-sm-11 inputGroupContainer">
                                    <div class="col-md-offset-2 col-md-9">
                                        <button id="btn-register" type="button" class="btn btn-info"><i class="icon-hand-right"></i>Registrar</button>
                                        <span style="margin-left:8px;">ou</span>  
                                    </div>
                                </div>
                            </div>-->

                        <!--    <div class="form-group">
                                <div class="col-md-offset-2 col-md-9">
                                    <button id="btn-fbregister" type="button" class="btn btn-primary"><i class="icon-facebook"></i>Registrar com Facebook</button>
                                </div>                                           
                            </div>
                        -->

                        <!-- Accept box and button s-->
                        <div class="form-group">
                            <div class="col-sm-11 inputGroupContainer">
                                <div class="col-md-offset-2 col-md-9">
                                    <label for="checkbox" class="control-label">
                                        <input type="checkbox" id="isSelected" name="isSelected"> Aceitar Termos e Condições
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-offset-2 col-md-9">        
                                <label class="control-label">
                                    <button type="submit" id="submitted" name="submitted" class="btn btn-sm btn-info">Registrar</button>
                                    <button type="reset" class="btn btn-sm btn-default">Limpar</button>
                                </label>
                            </div>
                        </div>
                </div>
            </div>
        </form>

    </div>
    </div>
    </div> 

    <?php
}

function checkRegisteredUser($username, $email, $conn) {
    
    $sql = "
    SELECT
    count(u.nm_email)
    FROM
    user u
    WHERE
    u.nm_email      = ':email' OR
    u.nm_username   = ':username'";
    $result = $conn->prepare($sql); 
    $result ->bindParam(':email', $email, PDO::PARAM_STR);
    $result ->bindParam(':username', $username, PDO::PARAM_STR);
    $result->execute();
    $c     = $result->fetch(PDO::FETCH_NUM);
    $total = $c[0];   

    if ($total > 0)
        return(1);
    else
        return(0);
}
?>

<style type="text/css">
    #registerForm .inputGroupContainer .form-control-feedback,
    #registerForm .selectContainer .form-control-feedback {
        top: 0;
        right: -15px;
    }
</style>

<script type="text/javascript">

    $(document).ready(function () {

        $('#submitted').click(function () {

            if ($("#isSelected").is(":checked")) {
                //If there is checkbox selected enable submit button
                $('#submitted').prop('disabled', false);
            } else {
                //If there is no checkbox selected disable submit button
                $('#submitted').prop('disabled', true);
            }
        });

        $('#isSelected').click(function () {

            if ($("#isSelected").is(":checked")) {
                //If there is checkbox selected enable submit button
                $('#submitted').prop('disabled', false);
            } else {
                //If there is no checkbox selected disable submit button
                $('#submitted').prop('disabled', true);
            }
        });

        $('#registerForm').bootstrapValidator({
            // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                username: {
                    message: 'The username is not valid',
                    validators: {
                        notEmpty: {
                            message: 'The username is required and cannot be empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 30,
                            message: 'The username must be more than 6 and less than 30 characters long'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9]+$/,
                            message: 'The username can only consist of alphabetical and number'
                        },
                        different: {
                            field: 'password',
                            message: 'The username and password cannot be the same as each other'
                        }
                    }
                },
                email: {
                    validators: {
                        notEmpty: {
                            message: 'The email address is required and cannot be empty'
                        },
                        regexp: {
                            regexp: /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/,
                            message: 'Please enter a valid e-mail address.'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and cannot be empty'
                        },
                        different: {
                            field: 'username',
                            message: 'The password cannot be the same as username'
                        },
                        stringLength: {
                            min: 8,
                            message: 'The password must have at least 8 characters'
                        }
                    }
                },
                confirm: {
                    validators: {
                        notEmpty: {
                            message: 'The password is required and cannot be empty'
                        },
                        different: {
                            field: 'username',
                            message: 'The password cannot be the same as username'
                        },
                        stringLength: {
                            min: 8,
                            message: 'The password must have at least 8 characters'
                        }
                    }
                }

            }
        });
    });
</script>    

</body>
</html>

*/