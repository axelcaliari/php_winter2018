<!DOCTYPE html>
<html lang="en">

{if isset($view.headjs)}
{include file='headjs.tpl'}
{else}
{include file='head.tpl'}
{/if}

  <body>
    <div class="navbar-wrapper">
      <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="{$view.links.Home}"><img src="{$view.logo}" alt="Logo"><b>{$view.title}</b></a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                {foreach from=$view.links key=name item=link}
                  <li><a href="{$link}">{$name}</a></li>
                {/foreach}
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Main Menu <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    {foreach from=$view.navMenu key=navMenuEntry item=navMenuLink}
                      <li class="dropdown-header">Menu</li>
                      <li><a href="{$navMenuLink}">{$navMenuEntry}</a></li>
                      <li role="separator" class="divider"></li>
                    {/foreach}
                  </ul>
                </li> 
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>

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
            <h1>Products page</h1>
            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Price</th>
                      <th>Description</th>
                      <th>Image</th>
                      <th>Options</th>
                  </tr>
                </thead>
                  {foreach from=$view.results item=product}
                    <tr>
                        <td>{$product.id}</td>
                        <td>{$product.name}</td>
                        <td>{$product.price}</td>
                        <td>{$product.description}</td>
                        <td>{$product.image}</td>
                        <td>
                            <a href="index.php/product/edit/{$product.id}">Modify</a>
                        </td>
                        <td>
                            <a href="index.php/product/delete/{$product.id}">Delete</a>
                        </td>
                    </tr>
                  {/foreach}
              </table>
            </div>
            <p><a href="/lightmvctest/public/index.php/product/add/">Add new product</a></p>
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