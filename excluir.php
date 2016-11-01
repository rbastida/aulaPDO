<?php
require_once 'includes.php';
require_once 'verifica_auth.php';
require_once 'Connection.php';
require_once 'EntidadeInterface.php';
require_once 'Aluno.php';
require_once 'Usuario.php';
require_once 'AlunoModel.php';
require_once 'UsuarioModel.php';


if (isset($_POST['id'])) {

    showExcluir($conexao);
}

// /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function showExcluir($conexao) {

    $id         = $_POST['id'];
    $aluno      = new Aluno();
    $alunoModel = new AlunoModel($conexao, $aluno);
    $rs         = $alunoModel->deletar($id);

    if ($rs > 0) {
        ?>

        <div class="container">
            <div>            
                <form name="frmVolta" action="index.php" method="POST">            
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan='3' class="col-sm-2">Exclusão</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-sm-12"><?php echo 'Exclusao efetuada com sucesso!'; ?></td>
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
