<?php
session_start();

require_once 'includes.php';
require_once 'verifica_auth.php';
require_once 'Connection.php';
require_once 'EntidadeInterface.php';
require_once 'Aluno.php';
require_once 'Usuario.php';
require_once 'AlunoModel.php';
require_once 'UsuarioModel.php';

    if ((isset($_POST['pesquisa'])) && (isset($_POST['submitted']))) {
        
        showPesquisa($conexao);
        
    } 

    // /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
    function showPesquisa($conexao) {
    
        $pesquisa   = $_POST['pesquisa'];
        
        
//        echo 'pes='.$pesquisa.'<br>';
//        exit();

        $aluno      = new Aluno();
        $alunoModel = new AlunoModel($conexao, $aluno);
        
        $pesquisa   = $pesquisa.'%';
        
        $rs         = $alunoModel->pesquisa($pesquisa);
        
        
        if ($rs > 0) {
            
            $id         = $rs['id'];
            $nome       = $rs['nome'];
            $nota       = $rs['nota'];
        
        ?>

        <div class="container">
            <form name="frmEnviar" action="index.php" method="POST">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan='3' class="col-sm-2">Pesquisa</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-1">ID:</td>
                        <td class="col-sm-1"><?php echo $id; ?><input type="hidden" id="id" name="id" value="<?php echo $id; ?>"></td>
                    </tr>
                    <tr>
                        <td class="col-sm-10">Nome:</td>
                        <td class="col-sm-10"><input type="text" id="nome" name="nome" value="<?php echo $nome; ?>"></td>
                    </tr>                
                    <tr>
                        <td class="col-sm-1">Nota:</td>
                        <td class="col-sm-1"><input type="text" id="nota" name="nota" value="<?php echo $nota; ?>"></td>
                    </tr>
                </tbody>
            </table>
            <input type="submit" id="submitted" name="submitted" class="btn btn-primary" value="Enviar">
            </form>
        </div>
        <?php
        } else {
            
            ?>
            <div class="container">
                <div>            
                    <form name="frmVolta" action="index.php" method="POST">            
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan='3' class="col-sm-2">Pesquisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-sm-12"><?php echo 'Nao foram achados nenhum aluno!'; ?></td>
                            </tr>
                            <tr>
                                <td class="col-sm-12"><input type="submit" id="submitted" name="submitted" class="btn btn-primary" value="Enviar"></td>
                            </tr>                
                        </tbody>
                    </table>                
                    </form>
                </div>
            </div>
            <?php
            
        }
            
    
    
    }
    

