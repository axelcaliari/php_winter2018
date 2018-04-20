<!DOCTYPE html>
<html lang="en">

{if isset($view.headjs)}
{include file='headjs.tpl'}
{else}
{include file='head.tpl'}
{/if}


    

    <div class="container">
      <div class="row">
        
        <div class="col-md-2"></div>
        <div class="col-md-8 text-center">
          {$view.pageBody}  
        </div>
        <div class="col-md-2"></div>
                
      </div> 
        
    </div>



{if $view.bodyjs == 1}
{include file='bodyjs.tpl'}
{/if}

  </body>
</html>