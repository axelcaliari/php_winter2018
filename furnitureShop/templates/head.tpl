  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="{$view.description}">
    <meta name="author" content="{$view.author}">
    <link rel="icon" href="{$view.favicon}">
    
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <title>{$view.appname}</title>

    <!-- Core CSS -->
    
    {foreach from=$view.css item=script}
        <link href="{$script}" rel="stylesheet">
    {/foreach}

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
    
  </head>
  <body>
 <nav class="navbar navbar-default">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="http://localhost/lightmvctest/public/index.php/index/index" class="navbar-brand"><b>{$view.appname}</b></a>
    </div>
    <!-- Collection of nav links and other content for toggling -->
    <div id="navbarCollapse" class="collapse navbar-collapse">
        <ul class="nav navbar-nav">

            <li><a href="http://localhost/lightmvctest/public/index.php/product/index">List of furnitures</a></li>
            <li><a href="http://localhost/lightmvctest/public/index.php/product/add">Add a funiture</a></li>
            <li><a href="#">Messages</a></li>
        </ul>
          
            {if !isset($smarty.session.user)} 
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://localhost/lightmvctest/public/index.php/user/login">Login</a></li>
            </ul>
            {/if}
            {if isset($smarty.session.user)} 
            <ul class="nav navbar-nav navbar-right">
                <li><a href="http://localhost/lightmvctest/public/index.php/user/account">My account</a></li>
            </ul>
            {/if} 
            
    </div>
</nav>