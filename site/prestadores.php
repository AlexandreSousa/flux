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
<?php
  
  // arquivo de conex�o com o banco
  include("../include/conect.php"); 
  
  // arquivo com funcoes uteis
  include("../funcoes/util.php");
  //print("<a href=index.php target=_parent><img src=../img/topos/$TOPO></a>");
 ?>
 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>e-Nota</title>
<script src="../scripts/java_site.js" language="javascript" type="text/javascript"></script>
<script src="../scripts/padrao.js" language="javascript" type="text/javascript"></script>
<script type="text/javascript" src="js/java.js"></script>
<script type="text/javascript" src="js/prototype.js"></script>
<script type="text/javascript" src="js/scriptaculous.js?load=effects,builder"></script>
<script type="text/javascript" src="js/lightbox.js"></script>
<link href="../css/padrao_site.css" rel="stylesheet" type="text/css" />
 <?  include ("../include/site-head.php");?>
 </head>


<body>
    <?php include("../include/topo.php"); ?>
    <section>
    <div class=" container_12">
    <div class="wrapper">
    
<!-- box de conteudos -->
    <?php  include("inc/prestadores/links.php"); ?>
  		<div class="boxbase">
			<div class="grid_8 padRT2">
				<h2 class="padbot"></h2>
				
				 <?php
				 	
				 	if($_POST["txtMenu"])
						{
							include("inc/prestadores/".$_POST["txtMenu"].".php");
						}else {
							echo("
							<img src='../include/images/prestador.png' style='float: left; padding-right: 20px; padding-top: 15px;'>
							<p class='textoInicial'>
								Ol�, seja bem vindo ao sistema digital de emiss�o de notas fiscais de servi�os. Neste ambiente voc�, prestador de 
								servi�o, poder� cadastrar-se no sistema, consultar a libera��o de seu cadastro e ap�s sua aprova��o pela prefeitura 
								voc� j� poder� emitir notas fiscais de servi�o via internet agregando ao seu trabalho modernidade e comodidade.
							</p>");
						}
				 ?>   
				
				<!--Conteudo -->
			</div>
		</div>
	</div>
</div>
    </section>
<?php include("../include/rodape.php"); ?>

</body>
</html>
