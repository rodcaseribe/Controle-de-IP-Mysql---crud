<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <meta charset="utf-8"/>
        <meta name="descricao" content="DIControle na Web"/>
        <style>
        .col-2 {
            width: 8.66666667% !important;
        }
        </style>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <link href="https://getbootstrap.com/docs/4.1/examples/sticky-footer/sticky-footer.css" rel="stylesheet">
    </head>
<body>
<?php
    include('View/envinronments.php');
    require('./Controller/controllerRequest.php');
    echo '<main role="main" class="container">';
    echo '<h1 class="mt-5">DIControle na Web</h1>';
    echo '</main>';
    echo '<div align="center">';
    echo '<form align="center" style="background-color: black;width:50%;border-radius: 5px;background-color: #e5e5e5;padding: 20px;" id="formularioInsercao">  ';
    echo '<div class="form-group">';
    echo '<input type="text" class="form-control" placeholder="Digite o IP:" id="ipInsercao">';
    echo '</div>';
    echo '<br>';
    echo '<div class="form-group">';
    echo '<input type="text" class="form-control" placeholder="Descricao do Equipamento" id="descricaoInsercao">';
    echo '</div>';
    echo '<br>';
    echo '<div align="left" class="form-group">';
    echo '<select class="custom-select valorSetorInsercao" id="inlineFormCustomSelect">';
    echo '<option selected>Setor</option>';
    foreach ($setores as $nomeSetores) {
        echo '<option value="'.$nomeSetores.'" >'.$nomeSetores.'</option>';
    }
    echo '</select>';
    echo '</div>';
    echo '<br>';
    echo '<button type="submit" class="btn btn-primary" id="InserirDados">Inserir</button>';
    echo '</form>';
    echo '</div>';




$registros = visualizaoInicial();
foreach ($registros as $value) {
    echo '<form>';
    echo '<div class="row">';
    echo '<div class="col ">';
    echo '<input  type="text" id="idNumeroIP-'. $value->id .'" class="form-control " placeholder="IP" value="'. $value->ip .'"  disabled>';
    echo '</div>';
    echo '<div class="col ">';
    echo '<input type="text" id="idNumeroDescricao-'. $value->id .'" class="form-control"  placeholder="Descricao" value="'. $value->descricao .'"  disabled>';
    echo '</div>';
    echo '<div class="col-auto my-1">';
    echo '<select class="custom-select mr-sm-2" id="selectPadrao-'. $value->id .'" disabled>';
    echo '<option selected>'. $value->setor .'</option>';
    foreach ($setores as $nomeSetores) {
        echo '<option value="'. $nomeSetores .'">'.$nomeSetores.'</option>';
    }
    echo '</select>';
    echo '</div>';
    echo '<div class="col-2" id="botaoAlterar-'. $value->id .'">';
    echo '<p onclick="alterarView('. $value->id .')" class="btn btn-success alterar '. $value->ip .'">Alterar</p>';
    echo '</div>';
    echo '<div class="col-2" style="display: none;" id="confirmaAlteracao-'. $value->id .'">';
    echo '<p onclick="confirmaAlteracao('. $value->id .')" class="btn btn-primary alterar2 '. $value->ip .'">Confirmar Alteração</p>';
    echo '</div>';
    echo '<div class="col-2">';
    echo '<p onclick="confirmaRemocao('. $value->id .')" class="btn btn-danger remover '. $value->ip .'">Remover</p>';
    echo '</div>';
    echo '</div>';
    echo '</form>';
}

?>

</body>
</html>
<script src="View/validaInsercao.js"></script>
