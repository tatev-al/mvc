<div class = "container">
    <h2 class="d-flex justify-content-center mt-2">Login</h2>
    <form class = "m-5" action = "/auth/login" method = "POST">
        <div class="form-group row">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
            <small id="emailWarning" class="form-text text-danger"><?= $this->emailError ?></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
            <small id="passwordWarning" class="form-text text-danger"><?= $this->passwordError ?></small>
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-10">
            <button type="submit" class="btn btn-outline-dark">Login</button>
            </div>
        </div>
    </form>
</div>