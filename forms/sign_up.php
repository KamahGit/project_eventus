
<form id="regForm" method="post" action="./process_signup.php" enctype="multipart/form-data">
    <div class="form-group">
        <label for="fname">First Name<span>*</span></label>
        <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname" required>
        <span></span>
    </div>
    <div class="form-group">
        <label for="lname">Last Name<span>*</span></label>
        <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname" required>
        <span></span>
    </div>
    <div class="form-group">
        <label for="email">Email address<span>*</span></label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
               placeholder="Enter email" name="email" required>
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with
            anyone else.
        </small>
    </div>
    <div class="form-group">
        <label for="password">Password<span>*</span></label>
        <input type="password" class="form-control" id="password" name="password"
               placeholder="Enter your password" required>
        <span></span>
    </div>
    <div class="form-group">
        <label for="cpassword">Confirm Password<span>*</span></label>
        <input type="password" class="form-control" id="cpassword"
               placeholder="Confirm your password" required>
        <span></span>
    </div>
    <div class="form-group">
        <label for="image">Profile Photo<span>(Optional)</span></label>
        <input type="file" class="form-control" id="image" name="photo"
               accept="image/png, image/jpeg, image/gif">
    </div>
    <div class="form-group">
        <label for="account">Account Balance<span>*</span></label>
        <input type="number" class="form-control" id="account" placeholder="Deposit Cash (KES)" name="account_bal"
               required>
        <span></span>
    </div>
    <?php
    if (isAdmin()){
    echo <<<HTML
    <div class="form-row">
        <div class="form-group">
            <label>Role ID<span>*</span></label><br/>
            <input type="radio" name="role_id" id="admin" value="1">Admin <br/>
            <input type="radio" name="role_id" id="member" value="2">Member
            <span></span>
        </div>
    </div>

HTML;

    }
    ?>

    <button type="submit" name="save" class="btn btn-primary">Add User</button>
</form>
