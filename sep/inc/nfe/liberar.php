<?php
/*
COPYRIGHT 2008 - 2010 DO PORTAL PUBLICO INFORMATICA LTDA

Este arquivo e parte do programa E-ISS / SEP-ISS

O E-ISS / SEP-ISS e um software livre; voce pode redistribui-lo e/ou modifica-lo
dentro dos termos da Licenca Publica Geral GNU como publicada pela Fundacao do
Software Livre - FSF; na versao 2 da Licenca

Este sistema e distribuido na esperanca de ser util, mas SEM NENHUMA GARANTIA,
sem uma garantia implicita de ADEQUACAO a qualquer MERCADO ou APLICACAO EM PARTICULAR
Veja a Licenca Publica Geral GNU/GPL em portugues para maiores detalhes

Voce deve ter recebido uma copia da Licenca Publica Geral GNU, sob o titulo LICENCA.txt,
junto com este sistema, se nao, acesse o Portal do Software Publico Brasileiro no endereco
www.softwarepublico.gov.br, ou escreva para a Fundacao do Software Livre Inc., 51 Franklin St,
Fith Floor, Boston, MA 02110-1301, USA
*/
?>
<style>
	#divDetalhes{
		display:none;
		position:absolute;
		left:20%;
		top:40%;		
	}
</style>
<div id="divDetalhes"></div>
<table border="0" cellspacing="0" cellpadding="0" bgcolor="#CCCCCC" width="890">
	
	<tr>
		
		<td align="center">
			<form method="post" id="frmLiberarPrestNfe" onsubmit="return false">
				<input name="include" id="include" type="hidden" value="<?php echo $_POST["include"];?>">
				<fieldset>
				<legend>Liberar Cadastro</legend>
				<table width="100%">
					<tr>
						<td width="24%" align="left">N�mero do Documento: </td>
						<td width="76%" align="left">
							<input type="text" class="texto" name="txtNumero" />
						</td>
					</tr>
					<tr>
						<td align="left" colspan="2">
							<input type="submit" class="botao" name="btBuscar" value="Buscar" 
							onclick="acessoAjax('inc/nfe/liberar_ativar.ajax.php','frmLiberarPrestNfe','divlistanfe')" />
						</td>
					</tr>
				</table>
				</fieldset>
				<div id="divlistanfe"></div>
			</form>
		</td>
		
	</tr>
	
</table>
