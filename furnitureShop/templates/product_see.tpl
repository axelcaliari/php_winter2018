<!DOCTYPE html>
<html lang="en">

{if isset($view.headjs)}
{include file='headjs.tpl'}
{else}
{include file='head.tpl'}
{/if}



<div class="container">
  
{foreach from=$view.products item=product}
<div class="row">
  <div class="col-sm-4"></div>
  <div class="col-sm-4 jumbotron text-center">
    <h3 class="text-center">{$product.name}</h3><br> 
    <img src="{$product.picture}" alt="Smiley face" height="200" width="200"><br><br>
    <b>Description:</b> {$product.description}<br>
    <b>Price:</b> {$product.price}<br>
    {if isset($smarty.session.user)} 
        <a href="http://localhost/lightmvctest/public/index.php/product/delete?id={$product.id}" class="btn btn-danger" role="button">Delete</a>
      {/if} 
  </div>
  <div class="col-sm-4"></div>
</div>
{/foreach}



{if $view.bodyjs == 1}
{include file='bodyjs.tpl'}
{/if}

</body>
</html>