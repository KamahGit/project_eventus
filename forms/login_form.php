<?php ?>
<form id="loginForm" method="post" action="./process_login.php">
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
               placeholder="Enter email" name="email">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with
            anyone else.
        </small>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password"
               placeholder="Password">
    </div>

    <button type="submit" name="login" class="btn btn-primary">Login</button>
</form>