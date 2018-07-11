<form method="POST" action='/forgot_password' role="form">
<div class="row">        
<div class="col-md-12">
    <div class="modal-dialog" style="margin-bottom:0">
        <div class="modal-content">
                    <div class="panel-heading">
                        <h3 class="panel-title">Reset password</h3>
                    </div>
                
                    <div class="panel-body">
    {if isset($msg)}
    <div class="col-sm-12">
        {$msg}
    </div>
    {/if}
                        
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="true" required="required"  value="{$email}">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <a href="/signin" class="btn btn-sm btn-link pull-left">I know my password</a>
                                <button  type="submit" class="btn btn-sm btn-success pull-right">Request link</button>
                            </fieldset>
              
                    </div>
                </div>
    </div>
</div>        
        
</div>        
        
</form>
