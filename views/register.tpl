<div class="modal magic-modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="exampleModalLabel">Register new account</h4>
            </div>
            <div class="modal-body">
                <div class="magic-register-wrapper">
                    <div class="magic-message"></div>
                    <form class="form-horizontal" id="magicForm" onsubmit="return false;">
                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                        <div class="form-group">
                            <label for="first_name" class="col-md-4 control-label">First Name <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name"></div>
                        </div>
                        <div class="form-group">
                            <label for="last_name" class="col-md-4 control-label">Last Name <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="text" name="last_name" class="form-control" id="last_name" placeholder="Last Name"></div>
                        </div>
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
                        <div class="form-group">
                            <label for="confirm_password" class="col-md-4 control-label">Confirm Password <span class="required">*</span></label>
                            <div class="col-md-8">
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password"></div>
                        </div>
                        <div class="form-group">
                            <label for="company" class="col-md-4 control-label">Company</label>
                            <div class="col-md-8">
                                <input type="text" name="company" class="form-control" id="company" placeholder="Company"></div>
                        </div>
                        <div class="form-group">
                            <label for="type" class="col-md-4 control-label">Category</label>
                            <div class="col-md-8">
                                <select class="form-control" name="type">
                                    <option value="General">General</option>
                                    <option value="Business">Business</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary magic-btn-submit" onclick="magictest.user.submitRegister();">Register</button>
            </div>
        </div>
    </div>
</div>