<!DOCTYPE html>
<html lang="en">	

{if isset($view.headjs)}
{include file='headjs.tpl'}
{else}
{include file='head.tpl'}
{/if}

  <body>
  {include file='navbar.tpl'}
    <div class="container">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
          {foreach from=$view.navMenu key=navMenuEntry item=navMenuLink}
            <li><a href="{$navMenuLink}">{$navMenuEntry}</a></li>
          {/foreach}
          </ul>
        </div>
        <div id="pageBody">
          <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
             <form action="" method="post" enctype="multipart/form-data">
				<label for="username"><b>Username</b></label><input type="text" name="username" class="login"><br><br>
				<label for="password"><b>Password</b></label><input type="password" name="password" class="login"><br><br>
				<input type="submit" value="Submit" name="submit" >
			</form>
				{if $view.saved == 1}
					<div class="alert-success"><p>You are logged in as {$smarty.session.REMOTE_USER}!</p></div>
				{/if}
				{if $view.error == 1}
					<div class="alert-danger"><p>There was an error! Please try again.</p></div>
				{/if}			
          </div>
        </div> <!-- END pageBody -->
        
      </div>
    </div>

{if $view.bodyjs == 1}
{include file='bodyjs.tpl'}
{/if}

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
    
  </body>
</html>