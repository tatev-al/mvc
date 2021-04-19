<div class = "d-flex bd-highlight mb-3">
    <div class="col-sm-3">
        <img src="/Public/Images/Avatars/<?= $this->accountData['avatar_img'] ?>" class="img-fluid img-thumbnail " width='180' height='180' alt="avatar">
        <?php if($_SESSION['id'] == $this->accountData['id'])
        {?>
            <div class="custom-file">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" id="avatar_img" name="avatar_img" class = 'custom-file-input' onchange="this.form.submit();">
                    <label class="custom-file-label" for='avatar_img'>Change Avatar Photo</label>
                    
                    <small id="imgWarning" class="form-text text-danger"><?= $this->imgUploadError ?></small>
                    <small id="imgWarning" class="form-text text-danger"><?= $this->imgTypeError ?></small>
                    <small id="imgWarning" class="form-text text-danger"><?= $this->imgSizeError ?></small>
                    <small id="imgWarning" class="form-text text-danger"><?= $this->imgExistError ?></small>
                </form>
            </div>
        <?php } ?>
    </div>
    <div class='col-sm-3'>     
        <h2 class="d-flex justify-content-center mt-2">Personal Page <?= $this->accountData['name'] ?></h2>
    </div>

</div>