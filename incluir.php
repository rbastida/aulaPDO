<?php
require_once 'includes.php';
require_once 'Connection.php';
require_once 'EntidadeInterface.php';
require_once 'Aluno.php';
require_once 'Usuario.php';
require_once 'AlunoModel.php';
require_once 'UsuarioModel.php';

    if (isset($_POST['submitted'])) {
        
        processaForm($conexao);
        
    } else {
        
        showInserir($conexao);
    }

// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    function showInserir($conexao) {
        ?>
        <div class="container">
        <form name="frmEnviar" action="incluir.php" method="POST">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan='3' class="col-sm-2">Inserção</th>
                    </tr>
                </thead>
                <tbody>
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
    }
    
function processaForm($conexao) {
    
    $nome       = $_POST['nome'];
    $nota       = $_POST['nota'];
    $submmitted = $_POST['submitted'];
    
    $aluno      = new Aluno();
    $alunoModel = new AlunoModel($conexao, $aluno);

    $aluno->setNome($nome);
    $aluno->setNota($nota);
    
    $rs         = $alunoModel->inserir();

    if ($rs >0) {
        
        ?>

    <div class="container">
        <div>            
            <form name="frmVolta" action="index.php" method="POST">            
            <table class="table">
                <thead>
                    <tr>
                        <th colspan='3' class="col-sm-2">Inserção</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-12"><?php echo 'Inserção efetuada com sucesso!'; ?></td>
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

