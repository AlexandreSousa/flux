<?php
/*
LICENÇA PÚBLICA GERAL GNU
Vers�o 3, 29 de junho de 2007
    Copyright (C) <2010>  <PORTAL PÚBLICO INFORM�TICA LTDA>

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.

Este programa � software livre: voc� pode redistribuí-lo e / ou modificar sob os termos da GNU General Public License como publicado pela Free Software Foundation, tanto a vers�o 3 da Licen�a, ou (por sua op��o) qualquer vers�o posterior.

Este programa � distribuído na esperan�a que possa ser �til, mas SEM QUALQUER GARANTIA, sem mesmo a garantia implícita de COMERCIALIZAÇÃO ou ADEQUAÇÃO A UM DETERMINADO PROP�SITO. Veja a GNU General Public License para mais detalhes.

Voc� deve ter recebido uma c�pia da GNU General Public License  junto com este programa. Se n�o, veja <http://www.gnu.org/licenses/>.


This is an unofficial translation of the GNU General Public License into Portuguese. It was not published by the Free Software Foundation, and does not legally state the distribution terms for software that uses the GNU GPL — only the original English text of the GNU GPL does that. However, we hope that this translation will help Portuguese speakers understand the GNU GPL better.

Esta � uma tradu��o n�o oficial em portugu�s da Licen�a P�blica Geral GNU (da sigla em ingl�s GNU GPL). Ela n�o � publicada pela Free Software Foundation e n�o declara legalmente os termos de distribui��o para softwares que a utilizam — somente o texto original da licen�a, escrita em ingl�s, faz isto. Entretanto, acreditamos que esta tradu��o ajudar� aos falantes do portugu�s a entend�-la melhor.


// Originado do Projeto ISS Digital – Portal P�blico que tiveram colabora��es de Vinícius Kampff, 
// Rafael Romeu, Lucas dos Santos, Guilherme Flores, Maikon Farias, Jean Farias e Daniel Bohn
// Acesse o site do Projeto www.portalpublico.com.br             |
// Equipe Coordena��o Projeto ISS Digital: <informatica@portalpublico.com.br>   |

*/
?>



<fieldset style="width:800px"><legend>Resultado da Pesquisa</legend>
<?php
require_once("../conect.php");
require_once("../nocache.php");
require_once("../../funcoes/util.php");

$nome_arquivo = $_GET['txtNomeArquivo'];
$mes = $_GET['cmbMes'];
$ano = $_GET['cmbAno'];


$string = "";
if(($mes) && ($ano)){
	if(strlen($mes) == 1){
		$mes = "0".$mes;
	}
	$competencia = $ano."-".$mes;
	$string .= " AND competencia = '$competencia'";
}elseif($mes){
	if(strlen($mes) == 1){
		$mes = "0".$mes;
	}
	$string .= " AND SUBSTRING(competencia,6,2) = '$mes'";
}elseif($ano){
	$string .= " AND SUBSTRING(competencia,1,4) = '$ano'";
}

$query = ("SELECT codigo, arquivo, competencia FROM notas_arquivos WHERE arquivo LIKE '%$nome_arquivo%' $string ORDER BY codigo DESC");
$sql = Paginacao($query,'frmRelEscrituracoes','divResultado');
?>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
	<?php 
	if(mysql_num_rows($sql)>0){ ?>
		<tr >
			<td width="78" align="center"><strong>Cod. Arquivo</strong></td>
			<td width="486" align="center"><strong>Nome do Arquivo</strong></td>
			<td width="134" align="center"><strong>Compet&ecirc;ncia</strong></td>
			<td width="76" align="center">&nbsp;</td>
	</tr>
		<tr>
			<td colspan="7" height="1" ></td>
		</tr>
	<?php
	while(list($codigo, $arquivo, $competencia) = mysql_fetch_array($sql)) {
	?>    
		<tr bgcolor="#FFFFFF">
			<td align="center"><?php echo $codigo; ?></td>
			<td align="left"><?php echo $arquivo;  ?></td>	
			<td align="center"><?php echo DataPt($competencia); ?></td>
			<td align="center">
				<input type="button" value="Ver" title="Ver Notas escrituradas" class="botao"
				onclick="acessoAjax('inc/guia/relatorio_escrituracoes_arquivos.ajax.php?codarquivo=<?php echo $codigo;?>&a=a&','frmRelEscrituracoes','divResultado')" />
			</td>
		</tr>
	  <?php
		} // fim while  
	}else{//fim if se tem resultados
	?>
		<tr>
			<td colspan="5"><strong><center>Nenhum resultado encontrado.</center></strong></td>
		</tr>
	<?php
	}//else se nao tem resultados da busca
  ?> 
</table>
</fieldset>
