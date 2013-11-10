<?
session_start();
require_once("../_funcoes/funcoes.php");
include("../componentes/head.php");
echo "<script src='../_javascript/cadastro-de-os/Principal.js' type='text/javascript'></script>\n";
echo "</head>";
echo "<body>";

include("../componentes/cabecalho.php");
?>
<div id="menu-secao">
	<li>
		<a href="../_funcoes/controller.php?opcao=home-orcamentos" class="pedidos">Or�amentos & Pedidos</a>
		OS > Cadastro
	</li>
</div>
<div id="sub-menu">		
	<li>
		<a href="../_funcoes/controller.php?opcao=home-os">Listagem de OS</a>		
	</li>
</div>

<form id="form-funcionarios" name="form-funcionarios" class="form-auto-validated" action="./insert-os.php" method="post" enctype="multipart/form-data">
<h3>
	Ordem de Servi�o
</h3>     
        <fieldset>
        <fieldset>		         
          <fieldset class='cliente onsubmit:notnull'>
            <label for='cliente'>
              Cliente
            </label>
            <select id='cliente' name='cliente' class='onsubmit:notnull'>
             <option value='null'>
                Selecione um cliente
              </option>
			<?		
				$sql = "SELECT cli_cliente, pes_nome ". 
				"FROM clientes ".				
				"INNER JOIN ".
				"pessoas ON cli_cliente = pes_pessoa ".							
				"ORDER BY pes_nome";			
				$resultado = execute_query($sql);
				while ($linha = $resultado->fetchRow()) 
				{		 			
					  $cod_cliente  = $linha[0];
					  $nome_cliente  = $linha[1];					
			?>	
				 <option value='<? echo $cod_cliente;?>' >
				 <? echo $nome_cliente;?> 
				 </option> 
			<?		  
				}				
			?>      
            </select>           
          </fieldset> 
		  </fieldset>	
		  <fieldset>		         
          <fieldset class='responsavel onsubmit:notnull'>
            <label for='responsavel'>
              Respons�vel t�cnico
            </label>
            <select id='responsavel' name='responsavel' class='onsubmit:notnull'>
             <option value='null'>
                Selecione um usu�rio
              </option>
			<?		
				$sql = "SELECT usu_usuario, pes_nome ". 
				"FROM usuarios ".				
				"INNER JOIN ".
				"pessoas ON usu_usuario = pes_pessoa ".							
				"ORDER BY pes_nome";			
				$resultado = execute_query($sql);
				while ($linha = $resultado->fetchRow()) 
				{		 			
					  $cod_usuario  = $linha[0];
					  $nome_usuario  = $linha[1];					
			?>	
				 <option value='<? echo $cod_usuario;?>' >
				 <? echo $nome_usuario;?> 
				 </option> 
			<?		  
				}				
			?>      
            </select>           
          </fieldset> 
		  </fieldset>
		  <fieldset>	
<fieldset id="equipamento" >
	  <label for="equipamento">
		Equipamento
	  </label>
	 
	  <input id="equipamento" name="equipamento" type="text" class="onsubmit:notnull">	 
	</fieldset>		  			  
  </fieldset>	 
 <fieldset>
	<fieldset id="defeito" >
	  <label for="defeito">
		Defeito
	  </label>
	 
	  <textarea id="defeito" name="defeito" type="text" class="onsubmit:notnull" ></textarea>	 
	</fieldset>	
	</fieldset> 
	<fieldset>	
	  <fieldset class='produtos'>
              <label for='produtos'>
                Produtos
              </label>
              <select id='produtos' name='produtos'>
                <option value='null'>
                  Selecione um produto
                </option>
				<?
				$sql = "SELECT pro_produto, pro_nome ". 
				"FROM produtos ";				
				$resultado = execute_query($sql);
				while ($linha = $resultado->fetchRow()) 
				{		 			
					  $cod_produto  = $linha[0];					  
					  $nome_produto = $linha[1];
				?>
                <option value='<? echo $cod_produto; ?>'>
                  <? echo $nome_produto; ?>
                </option>
				<?
				}
				?>                
              </select>
			<input id="adicionar-produto" value="Adicionar" class="bt" type="button">
           </fieldset>
		</fieldset>		
	</fieldset>
	<div class='org_grid grid4'>
  <table id="tabela">
	<thead>
	  <tr>
		<td class="ckecks" width="20px">
		 </td>
		<td class="col-1">Produto</td>
		<td class="col-2">Valor</td>
		<td class="col-3">Qtde.</td>	
		<td class="col-3">Subtotal</td>	
	  </tr>
	</thead>
	<tbody>
    <tr>
      <td></td>
    </tr>
 	</tbody>
	<tfoot>
	<tr>
		<td>		  
		</td>
		<td class="col-1"></td>
		<td class="col-2"></td>
		<td class="col-3">Total: </td>	
		<td class="col-4"><input name='total' id='total' value='0,00' class='onsubmit:notnull input' type='text'></td>	
	</tr>
	<tr>
	<td colspan="9">		
	  <input value="Excluir" class="bt org-grid" id="excluir-produto" type="button">
	  </td>
	 </tr>
 </tfoot>
</table>
</div>
<fieldset id="observacoes" >
	  <label for="observacoes">
		Observa��es
	  </label> 
  <textarea id="observacoes" name="observacoes" type="text" ><?=$observacoes?></textarea>	 
</fieldset>	

<fieldset class="buttons">
<input value="Cancelar" class="reset action:../_funcoes/controller.php?opcao=home-os" type="reset">
<input type="submit" id='submit-button' value="Salvar" class="bt">
</fieldset>
</form>
</body>
</html>
