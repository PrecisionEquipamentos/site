<?php

require 'admin/config/conexao.php';

$subjectPrefix = '[Contato do Site]';

$name = $_POST['nomecompleto'];
$email = trim($_POST['email']);
$emaildestinatario = 'elizandra.santos@precisionequipamentos.com.br';
$cidade = $_POST['cidade'];
$telefone = $_POST['telefone'];
$message = $_POST['mensagem'];

$sql = "INSERT INTO contatos SET nome = '$name', cidade = '$cidade', email = '$email', telefone = '$telefone'";

if ($conexao->query($sql) === TRUE) {

	$assunto = 'Contato do Site';

	$mensagemHTML =
		'<P>Confira a mensagem enviada:</P>
	<p><b>Nome:</b> ' . $name . '
	<p><b>E-Mail:</b> ' . $email . '
	<p><b>Cidade:</b> ' . $cidade . '
	<p><b>Telefone:</b> ' . $telefone . '
	<p><b>Mensagem:</b> ' . $message . '
	<hr>';

	$headers = "MIME-Version: 1.1\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: $email\r\n";
	$headers .= 'Bcc: hebertdev82@gmail.com' . "\r\n";
	$headers .= "Return-Path: $emaildestinatario \r\n";
	$envio = mail($emaildestinatario, $assunto, $mensagemHTML, $headers);

	if ($envio)
		echo "<script>alert('Sucesso! Entraremos em contato em breve!'); window.top.location.href = '/';</script>";
} else {
	echo "<script>alert('Erro! Por favor, tente novamente.');</script>";
}