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

    <div class="col-sm-2"></div>

    <div class="col-sm-8 jumbotron text-center">
      <h3 class="text-center">Add a product</h3><br>
      <form method="POST" action="http://localhost/lightmvctest/public/index.php/product/update">
        <div class="row">
        <div class="form-group col-md-6 col-md-offset-3">
          <label for="exampleInputEmail1">Name</label>
          <input  value = "{$product.name}" name="name" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
      </div>
        <div class="form-group">
          <label for="exampleInputEmail1">Description</label>
          <input value = "{$product.description}" name="description" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="form-group">
          <label for="exampleInputEmail1">image link</label>
          <input value = "{$product.picture}" name="picture" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>

        <div class="row">
        <div class="form-group col-md-4 col-md-offset-4">
          <label for="exampleInputEmail1">price</label>
          <input value = "{$product.price}" maxlength="10" name="price" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
      </div>
      <input type="hidden" name="id" value="{$product.id}">

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div class="col-sm-2"></div>
  </div>
  {/foreach}

{if $view.bodyjs == 1}
{include file='bodyjs.tpl'}
{/if}

</body>
</html>