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
      <h3 class="text-center">Login</h3><br>
      <form method="POST" action="">
        <div class="form-group">
          <label for="exampleInputEmail1">Email address</label>
          <input name="firstname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
          <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
          <label for="exampleInputPassword1">Password</label>
          <input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div class="col-sm-4"></div>
  </div>
{if $view.bodyjs == 1}
{include file='bodyjs.tpl'}
{/if}

</body>
</html>