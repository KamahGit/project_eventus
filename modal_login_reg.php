
<div class="modal fade" id="loginDiv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span class="fa fa-times-circle" aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="login-tab" data-toggle="tab" href="#loginPane" role="tab" aria-controls="loginPane" aria-selected="true">Log In</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="reg-tab" data-toggle="tab" href="#regPane" role="tab" aria-controls="regForm" aria-selected="false">Sign Up</a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="loginPane" role="tabpanel" aria-labelledby="login-tab">
                        <?php
                        require_once './forms/login_form.php';
                        ?>
                    </div>
                    <div class="tab-pane" id="regPane" role="tabpanel" aria-labelledby="reg-tab">
                        <?php
                        require_once './forms/sign_up.php';
                        ?>

                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
