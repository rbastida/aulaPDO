<?php
require_once 'includes.php';
require_once 'verifica_auth.php';
require_once 'Connection.php';
require_once 'EntidadeInterface.php';
require_once 'Aluno.php';
require_once 'Usuario.php';
require_once 'AlunoModel.php';
require_once 'UsuarioModel.php';

session_start();

$aluno = new Aluno();
$alunoModel = new AlunoModel($conexao, $aluno);
   
showForm($alunoModel);

function showForm($alunoModel) {
    ?>    
    <div class="container">
        
        <form id="formEdit" class="form-horizontal" method="POST" action="alterar.php">  
            <input type="hidden" name="id_aluno" id="id_aluno" value="">
        </form>
        
        <form action="pesquisa.php" method="POST">
            <table class="table">
                <thead>
                    <tr>
                        <th>Busca de Alunos</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="col-sm-4">
                            Nome do Aluno:
                            &nbsp;<input type="text" id="pesquisa" name="pesquisa" value="">
                            &nbsp;<input type="submit" id="submitted" name="submitted" value="Pesquisa">
                        </td>                
                    </tr>
                </tbody>
            </table>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th class="col-sm-1">Id</th>
                    <th class="col-sm-7">Nome</th>
                    <th class="col-sm-1">Nota</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($alunoModel->listar("id asc") as $aluno) {
                    ?>
                    <tr>
                        <td class="col-sm-1"><?php echo $aluno['id']; ?></td>
                        <td class="col-sm-7"><?php echo $aluno['nome']; ?></a></td>
                        <td class="col-sm-1">
                            <?php echo $aluno['nota']; ?>
                        </td>
                        <td class="col-sm-2">
                            
                            <a href="#" id="incluir" data-id="<?php echo $aluno['id']; ?>" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-plus"></span>
                            </a>  
                            &nbsp;
                            <a href="#" id="excluir"  data-id="<?php echo $aluno['id']; ?>" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-remove"></span>
                            </a>
                            &nbsp;
                            <a href="#" id="alterar" data-id="<?php echo $aluno['id']; ?>" class="btn btn-primary btn-xs">
                                <span class="glyphicon glyphicon-edit"></span>
                            </a>                
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <?php
    }
?>

<script type="text/javascript">

    $(document).ready(function () {

        $('a#incluir').on('click', function () {

            $(location).attr('href', 'incluir.php');
            
        });

        $('a#excluir').on('click', function () {

            var myData = 'id=' + $(this).data('id');
            
            jQuery.ajax({
                type: "POST", // HTTP method POST or GET
                url: "excluir.php", //Where to make Ajax calls
                dataType: "html", // Data type, HTML, json etc.
                data: myData, //Form variables
                success: function (response) {

                    $(location).attr('href', 'index.php');

                },
                error: function (xhr, ajaxOptions, thrownError) {
//                        $("#submitted").show(); //show submit button
//                        $("#LoadingImage").hide(); //hide loading image
                    alert(thrownError);
                }
            });            
        });
        
        $('a#alterar').on('click', function () {

            var id = $(this).data('id');
            
            $('#id_aluno').val(id);
            $('#formEdit').submit();            
            
        });        

    });

</script>  
    
