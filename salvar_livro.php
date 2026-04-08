<?php
error_reporting(E_ALL);
ini_set('display_erros',1);

//criar pasta para salvar os livros
if(!is_dir("capas"));//criação de capa
mkdir("capas",0777,true);//se não tiver capa existente, vai fazer obrigatóriamente
//salvar os pdfs
if(!is_dir("pdfs"));
mkdir("pdfs",0777,true);

//Recebendo os dados do formulario
$titulo = $_POST["titulo"];
$autor = $_POST["autor"];
$ano = $_POST["ano"];
$categoria = $_POST["categoria"];

//tratamentos dos nomes
$capa = time()."_".preg_replace("/[^a-zA-Z0-9.]/","_",$_FILES["capa"]["name"]);//se tiver qualquer tipo de caractere, irá retira-lo automaticamente
$pdf = time()."_".preg_replace("/[^a-zA-Z0-9.]/","_",$_FILES["arquivo"]["name"]);

move_uploaded_file($_FILES["capa"]["tmp_name"], "capas/" . $capa);
move_uploaded_file($_FILES["arquivo"]["tmp_name"], "pdfs/" . $pdf);

//colocar como disponivel o livro
$status = "disponivel";
//como estamos usando texto iremos inserir o caracter | para separar as informações
$linha = "$titulo|$autor|$ano|$categoria|$capa|$pdf|$status\n";
//gravar as informações em um arquivo 
file_put_contents("livros.txt",$linha,FILE_APPEND);
//redirecionar para a pagina livros
header("location:index.php");
exit;
?>