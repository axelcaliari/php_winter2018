<!DOCTYPE html>
<html lang="en">

{if isset($view.headjs)}
{include file='headjs.tpl'}
{else}
{include file='head.tpl'}
{/if}

<div class="container">
  <div class="alert alert-danger">
    <strong>Error</strong> You must be <a href="http://localhost/lightmvctest/public/index.php/user/login" class="alert-link">connected</a>.
  </div>
</div>
{if $view.bodyjs == 1}
{include file='bodyjs.tpl'}
{/if}

</body>
</html>