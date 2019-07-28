<h2>Регистрация</h2>
<div class="row">
    <div class="col-md-6">
        <form method="post" action="/user/signup">
            <div class="form-group">
                <label for="exampleInputEmail1">Login</label>
                <input type="text" class="form-control" name="login" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?= isset($_SESSION['form_data']['login']) ? h($_SESSION['form_data']['login']) : '';?>" placeholder="Enter Login">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputname1">Name</label>
                <input type="text" name="name"  class="form-control" id="exampleInputname1" value="<?= isset($_SESSION['form_data']['name']) ? h($_SESSION['form_data']['name']) : '';?>" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputemail1">Email</label>
                <input type="email" name="email" class="form-control" id="exampleInputemail1" value="<?= isset($_SESSION['form_data']['email']) ? h($_SESSION['form_data']['email']) : '';?>" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <?php if(isset($_SESSION['form_data'])) unset($_SESSION['form_data'])?>
    </div>
</div>
