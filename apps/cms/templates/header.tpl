<!DOCTYPE html>
<html lang="en">
<head>
  <title>{$page.title}</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  
  {literal}
      
<style>
.logo {
    max-width: 200px;
}

#main-contents {
    min-height: 600px;
    overflow-x: hidden;
/*    display: inline-block;*/
}

    
</style>      
  {/literal}    
  
  
</head>
<body>    


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/">{$app.title}</a>
    </div>

    <ul class="nav navbar-nav navbar-right">
      <li class="active"><a href="/">Home</a></li>
      {*
      <li><a href="#">Page 1</a></li>
      <li><a href="#">Page 2</a></li>
      *}
            <li><a href="http://www.harpya.net">About</a></li>
{if $page.show_signup}            
      <li><a href="/signup"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
{/if}
            
{if $page.show_signin}                        
      <li><a href="/signin"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
{/if}      

{if $page.show_signout}                        
      <li><a href="/signout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
{/if}      

    </ul>
  </div>
</nav>
    
<div class="container-fluid" id="main-contents">
    