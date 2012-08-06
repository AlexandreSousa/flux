<?php
/*
LICENÇA PÚBLICA GERAL GNU
Vers�o 3, 29 de junho de 2007
    Copyright (C) <2010>  <PORTAL PÚBLICO INFORMÁTICA LTDA>

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



<fieldset style="width:800px"><legend>Arquivo</legend>
<?php
require_once("../conect.php");
require_once("../nocache.php");
require_once("../../funcoes/util.php");

$codarquivo = $_GET['codarquivo'];
$sql_arquivo = mysql_query("SELECT codigo, arquivo, competencia FROM notas_arquivos WHERE codigo = '$codarquivo'");
list($codigo, $arquivo, $competencia) = mysql_fetch_array($sql_arquivo);
?>
<table width="100%" border="0" cellspacing="2" cellpadding="2">
	<tr>
		<td colspan="2" align="left"><input type="button" value="Voltar" onclick="document.getElementById('btPesquisar').click()" class="botao" /></td>
	</tr>
	<tr>
		<td width="11%" align="left">Arquivo: </td>
		<td width="89%" align="left"><strong><?php echo $arquivo;?></strong></td>
	</tr>
	<tr>
		<td align="left">Compet&ecirc;ncia: </td>
		<td align="left"><strong><?php echo DataPt($competencia);?></strong></td>
	</tr>
</table>
<?php
$query = ("
	SELECT
		l.codigo,
		c.cnpj,
		c.cpf,
		l.periodo,
		l.vencimento,
		l.geracao,
		l.basecalculo,
		l.reducaobc,
		l.valoriss,
		l.valorissretido,
		l.valorisstotal,
		l.estado
	FROM
		livro as l
	INNER JOIN cadastro as c ON
		l.codcadastro = c.codigo
	INNER JOIN 
		notas_arquivo_livro as nal ON nal.codlivro = l.codigo
	WHERE 
		nal.codarquivo = '$codarquivo'
	ORDER BY
		l.geracao DESC
");

$sql = Paginacao($query,'frmRelEscrituracoes','divResultado');

if (mysql_num_rows($sql) == 0) {
	?><strong><center>Nenhum resultado encontrado.</center></strong><?php
} else {
	?>
	<form method="post" id="frmLivro">
	<table width="100%" border="0" cellspacing="2" cellpadding="2">
		<tr>
			<td  align="center">C&oacute;digo</td>
			<td  align="center">Per&iacute;odo</td>
            <td  align="center">Estado</td>
			<td  align="center">CNPJ prestador</td>
			<td  align="center">Base de calculo</td>
			<td  align="center">Iss</td>
			<td  align="center">Iss retido</td>
			<td  align="center">Iss total</td>
			<td  width="150" align="center">A&ccedil;&atilde;o</td>
		</tr>
		<?php
		while ($dados = mysql_fetch_array($sql)) {
		//junta o cnpj com o cpf para ficar no mesmo campo
		$dados['cnpj'] .= $dados['cpf'];
		?>
		<tr>
			<td bgcolor="#FFFFFF" align="right"><?php echo $dados['codigo']; ?></td>
			<td bgcolor="#FFFFFF" align="center"><?php echo implode('/', array_reverse(explode('-', $dados['periodo']))); ?></td>
             <td bgcolor="#FFFFFF" align="center">
                <?php
                    switch($dados['estado']){
                        case "N": echo "Normal"; $cancel = ""; break;
                        case "B": echo "Boleto"; $cancel = ""; break;
                        case "C": echo "<font color='red'>Cancelado</font>"; $cancel = "disabled='disabled'"; break;
                    }
                ?>
            </td>
			<td bgcolor="#FFFFFF" align="center"><?php echo $dados['cnpj']; ?></td>
			<td bgcolor="#FFFFFF" align="right"><?php echo DecToMoeda($dados['basecalculo']); ?></td>
			<td bgcolor="#FFFFFF" align="right"><?php echo DecToMoeda($dados['valoriss']); ?></td>
			<td bgcolor="#FFFFFF" align="right"><?php echo DecToMoeda($dados['valorissretido']); ?></td>
			<td bgcolor="#FFFFFF" align="right"><?php echo DecToMoeda($dados['valorisstotal']); ?></td>
			<td bgcolor="#FFFFFF" align="center">				
                <input type="submit" class="botao" id="btnImprimirr" name="btnImprimir" 
            onclick="document.getElementById('frmLivro').action='../livro/imprimirlivrogeral.php?livro=<?php echo base64_encode($dados['codigo']); ?>';document.getElementById('frmLivro').target='_blank'" value="Imprimir"/>&nbsp;              
			</td>
		</tr>
		<?php
		}//fim while
		?>
	</table>
	</form>
<?php
}//fim else se tem resultado
?>
