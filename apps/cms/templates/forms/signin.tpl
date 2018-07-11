<form method="POST" action='/signin' role="form">
<div class="row">        
<div class="col-md-12">
    <div class="modal-dialog" style="margin-bottom:0">
        <div class="modal-content">
                    <div class="panel-heading">
                        <h3 class="panel-title">Sign In</h3>
                    </div>
                
                    <div class="panel-body">
                        <div class="row">
    {if isset($msg)}
        
    <div class="col-sm-12 bg-danger">
        {$msg}
    </div>
    <hr>
    {/if}
                        <div class="col-sm-12">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="true" required="required"  value="{$email}">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required="required">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <a href="/forgot_password" class="btn btn-sm btn-link pull-left">I forgot my password</a>
                                <button  type="submit" class="btn btn-sm btn-success pull-right">Login</button>
                            </fieldset>
              
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>        
        
</div>        
        
</form>
