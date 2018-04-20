<!DOCTYPE html>
<html lang="en">

{if isset($view.headjs)}
{include file='headjs.tpl'}
{else}
{include file='head.tpl'}
{/if}



<div class="container">
  <div class="row">

    <div class="col-sm-4"></div>

    <div class="col-sm-4 jumbotron text-center">
      <h3 class="text-center">My account</h3><br>
      <b>Customer ID:</b> {$view.user.id}<br>
      <b>Firstname:</b> {$view.user.firstname}<br>
      <b>Lastname:</b> {$view.user.lastname}<br><br>
      <a href="http://localhost/lightmvctest/public/index.php/user/logout" class="btn btn-danger" role="button">Log out</a>
    </div>
    <div class="col-sm-4"></div>
  </div>

{if $view.bodyjs == 1}
{include file='bodyjs.tpl'}
{/if}

</body>
</html>