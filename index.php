<?php

principal();

function principal(){
	echo "\n BEM VINDO AO GESTOR DE CURSOS\n";
	
	do {
		$acao = readline (" Informe o que deseja fazer: ");
	
		if($acao == 1) {
			criaRegistro();
		}

		if ($acao == 2){
			exibirRegistros();
		}
		
		$continuar = readline('Continuar? [S/N] ');
	} while( $continuar == 's');
}

function criaRegistro(){

	$curso = [];
	$curso['disciplina'] = readline ('Disciplina: ');
	$curso['descricao'] = readline ('Descrição: ');
	$curso['professor'] = readline ('Professor: ');

	salvarNoArquivo($curso);

}

function salvarNoArquivo($curso){
	$ponteiro = fopen('cursos.txt', 'a');
	$linha = $curso['disciplina'] . ';' . $curso['descricao'] . ';' . $curso['professor'];

	$linha = "\n" . $linha;

	fwrite ($ponteiro, $linha);
	fclose ($ponteiro);

}

function exibirRegistros(){
	$dados = leituraDoArquivo();
	
	foreach ($dados as $chave => $valor){
		$linha = explode(';', $valor);
		echo "\n\n CHAVE: " . $chave . "\n";
		echo "Disciplina: " . $linha[0] . "\n"; 
		echo "Descrição: " . $linha[1] . "\n"; 
		echo "Professor: " . $linha[2] . "\n"; 
	}
}

function leituraDoArquivo(){
	$ponteiro = fopen('cursos.txt', 'r');
	
	$linhas = [];
	
	while(!feof($ponteiro) ){
	$linhas[] = fgets($ponteiro);
	}
	return $linhas;
}