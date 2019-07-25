<h2>Log in</h2>

<div class="row">
    <div class="col-md-6">
        <form method="post" action="/user/login">
            <div class="form-group">
                <label for="exampleInputEmail1">Login</label>
                <input type="text" class="form-control" name="login" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= isset($_SESSION['form_data']['login']) ? h($_SESSION['form_data']['login']) : '';?>" placeholder="Enter Login">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
<!--        --><?php //if($_SESSION['form_data']) unset($_SESSION['form_data'])?>
        <?= debug($_SESSION)?>
    </div>
</div>
