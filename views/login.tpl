<div class="modal magic-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Login</h4>
            </div>
            <div class="modal-body">
                <div class="magic-register-wrapper">
                    <div class="magic-message"></div>
                    <form class="form-horizontal" id="magicForm" onsubmit="return false;">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">Email address <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Email"></div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="password" name="password" placeholder="Password"></div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="magictest.user.login();">Login</button>
            </div>
        </div>
    </div>
</div>