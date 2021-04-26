<div class = "d-flex bd-highlight mb-3">
    <div class="col-sm-3 m-2 p-1">
        <img src="/Public/Images/Avatars/<?= $this->accountData['avatar_img'] ?>" class="img-fluid img-thumbnail" style="max-height: 280px; max-width: 280px" alt="avatar">
        <?php if($_SESSION['id'] == $this->accountData['id'])
        {?>
            <div class="custom-file m-2 float-right">
                <form action="" method="post" enctype="multipart/form-data">
                    <input type="file" id="avatar_img" name="avatar_img" class = 'custom-file-input' onchange="this.form.submit();">
                    <label class="custom-file-label" for='avatar_img' style="max-width: 280px; margin-left: 8px">Change Avatar Photo</label>
                    
                    <small id="imgWarning" class="form-text text-danger"><?= $this->errorUpload ?></small>
                </form>
            </div>
        <?php } ?>
        <?php if($_SESSION['id'] != $this->accountData['id'])
        {?>
            <a class="btn btn-light" href="/account/chat/<?= $this->accountData['id'] ?>">Chat</a>
        <?php } ?>
    </div>
    <div class='col-sm-3'>     
        <h2 class="d-flex justify-content-center mt-2">Personal Page <?= $this->accountData['name'] ?></h2>
    </div>

</div>