<?php

require_once './initialize.php';
require_once './classes/user.php';
require_once 'header_main.php';
getMessage();
if (isset($_GET['id'])) {

    $db = new dataBase();
    $id = $_GET['id'];
    $sql = "SELECT id, fname, lname, email, photo, password, account_bal, role_id 
            from project_eventus.user
            where id=" . $id;
    $db->setSql($sql)->execQuery();
    while ($row = mysqli_fetch_object($db->getResult(), "User")) {
        ?>

        <div class="form-wrapper justify-content-center">
            <div class="form-header">EDIT USER</div>
            <form id="regForm" method="post" action="./update_user.php?id=<?php echo $id?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="fname">First Name<span>*</span></label>
                    <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname"
                           value="<?php echo $row->getFname() ?>" required>
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="lname">Last Name<span>*</span></label>
                    <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname"
                           value="<?php echo $row->getLname() ?>" required>
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="email">Email address<span>*</span></label>
                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                           placeholder="Enter email" name="email"  value="<?php echo $row->getEmail() ?>" required>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                        anyone else.
                    </small>
                </div>
                <div class="form-group">
                    <label for="password">Password<span>*</span></label>
                    <input type="password" class="form-control" id="password" name="password"
                           placeholder="Enter your password"  value="<?php echo $row->password ?>" required>
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="cpassword">Confirm Password<span>*</span></label>
                    <input type="password" class="form-control" id="cpassword"
                           placeholder="Confirm your password"  value="<?php echo $row->password ?>" required>
                    <span></span>
                </div>
                <div class="form-group">
                    <label for="image">Profile Photo<span>(Optional)</span> <a href="./assets/images/<?php echo $row->getPhoto()?>">Current Image(don't edit if you won't change )</a></label>
                    <input type="file" class="form-control" id="image" name="photo"
                           accept="image/png, image/jpeg, image/gif"
                </div>
                <div class="form-group">
                    <label for="account">Account Balance<span>*</span></label>
                    <input type="number" class="form-control" id="account" placeholder="Deposit Cash (KES)"
                           name="account_bal" value="<?php echo $row->getAccountBal() ?>"
                           required>
                    <span></span>
                </div>
                <?php
                if (isAdmin()) {
                    ?>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Role ID<span>*</span></label><br/>
                            <input type="radio" name="role_id" id="admin" value="1" <?php if ($row->role_id=='1'){echo 'checked';}?>>Admin <br/>
                            <input type="radio" name="role_id" id="member" value="2" <?php if ($row->role_id=='2'){echo 'checked';}?>>Member
                            <span></span>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <button type="submit" name="save" class="btn btn-primary">Add User</button>
            </form>
        </div>

        <?php
    }
}
?>
