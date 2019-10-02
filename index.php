<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="style.css">

    <title>Projeto TecWeb2</title>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center mb-3">
            <h1>Projeto TecWeb2</h1>
        </div>
    </div>

    <div class="container">        
        <div class="row justify-content-center mb-5">

            <form action="" method="GET" class="col-md-10 form_content">
                <div class="row mb-3">
                    <div class="col-md-7">
                        <div class="form-group">
                            <label for="nome">Nome: </label>
                            <input type="text" class="form-control" name="nome" id="nome" aria-describedby="nome" placeholder="Seu nome">
                        </div>
                        <div class="form-group">
                            <label for="senha">Idade:</label>
                            <input type="text" class="form-control" name="idade" id="idade" placeholder="Idade">
                        </div>       
                    
                        <span>Tem filhos:</span>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radioOptions" id="radio_nao" value="0">
                            <label class="form-check-label" for="radio_nao">Não</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="radioOptions" checked="checked" id="radio_sim" value="1">
                            <label class="form-check-label" for="radio_sim">Sim</label>
                        </div>
                    </div>
                
                    <div class="col-md-2 text-center mt-3">
                        <button type="submit" class="btn btn-primary mt-2">Enviar</button> 
                    </div>
                </div>


                <div class="row justify-content-center">
                    <div class="col-md-8 filhos_group_content">

                        <div class="filhos_group mb-2">
                            <div class="filho_input_group">
                                <label class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" >Nome:</span>
                                    </div>
                                    <input type="text" class="form-control" name="nome_filho" placeholder="Nome do filho" aria-label="nome_filho" aria-describedby="nome_filho">
                                </label>
                                <label class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Idade:</span>
                                    </div>
                                    <input type="text" class="form-control" name="idade_filho" placeholder="Idade do filho" aria-label="idade_filho" aria-describedby="idade_filho">
                                </label>
                            </div>

                            <div class="filho_btn_group">
                                <a href="#" class="btn btn-success mb-2 btn_adicionar">Adicionar</a>
                                <button class="btn btn-danger mb-2 btn_excluir">Excluir</button>
                            </div>
                        </div>

                    </div>
                </div>

            </form>            
        </div>


<?php

  $nome = isset($_GET['nome']) ? $_GET['nome'] : "";
  $idade = isset($_GET['idade']) ? $_GET['idade'] : "";
  $nome_filho = isset($_GET['nome_filho']) ? $_GET['nome_filho'] : "";
  $idade_filho = isset($_GET['idade_filho']) ? $_GET['idade_filho'] : "";


  if(!isset($_SESSION['dados'])) {
    $_SESSION['dados'] = array(); // se não foi criado ainda a variável DADOS, cria e define como um array
  }

  array_push($_SESSION['dados'], array(
    'nome' => $nome,
    'idade' => $idade,
    'nome_filho' => $nome_filho,
    'idade_filho' => $idade_filho
    )); // adiciona os dados recebidos no array utilizando a função array_push passando um novo array com esse dados

?>

        
        <div class="row mt-3">
            <div class="col-md-12">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Idade</th>
                        <th scope="col">Filhos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($_SESSION['dados'] as $value):

                            if(isset($value["radioOptions"]) && $value["radioOptions"] == 0){
                                $idade_filho = "Não possui filho";
                            }else{
                                $idade_filho = isset($value["nome_filho"]) ? $value["nome_filho"]."  ".$value["idade_filho"] :"";
                            }
                        ?>

                        <tr>
                            <td><?php if(isset($value["nome"])){ echo $value["nome"]; } ?></td>
                            <td><?php if(isset($value["idade"])){ echo $value["idade"]; } ?></td>
                            <td>
                            <?php if(isset($idade_filho)){ echo $idade_filho; } ?>
                                
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="js/jquery.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js"></script>

  <script>
    $(document).ready(function(){

      $("#radio_nao").click(function(){ 
        $(".filhos_group").css("display","none");           
          
      });
      $("#radio_sim").click(function(){            
        $(".filhos_group").css("display","flex");
      });

      $(".btn_adicionar").click(function(){                
        $(".filhos_group_content").append('<div class="filhos_group mb-2"><div class="filho_input_group"><label class="input-group mb-3"><div class="input-group-prepend"><span class="input-group-text">Nome:</span></div><input type="text" class="form-control" name="nome_filho" id="nome_filho" placeholder="Nome do filho" aria-label="nome_filho" aria-describedby="nome_filho"></label><label class="input-group mb-3"><div class="input-group-prepend"><label class="input-group-text" for="idade_filho">Idade:</label></div><input type="text" class="form-control" name="idade_filho" id="idade_filho" placeholder="Idade do filho" aria-label="idade_filho" aria-describedby="idade_filho"></label></div><div class="filho_btn_group"><a href="#" class="btn btn-success mb-2 btn_adicionar">Adicionar</a><button class="btn btn-danger mb-2 btn_excluir">Excluir</button></div></div>');            
      });

      $(".btn_excluir").click(function(){
        $(".filhos_group").remove();
      });


    });
  
  </script>
</body>.
</html>