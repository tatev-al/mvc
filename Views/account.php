<div class = "container">
    <img src="Public/Images/Avatars/<?= $this->userAvatar ?>" class="rounded float-left" width='180' height='180' alt="avatar">
    <div class="col-sm-10">        
        <h2 class="d-flex justify-content-center mt-2">Personal Page <?= $this->userName ?></h2>
    </div>
    <div class="block col-sm-3">
        <form action="" method="post"> 
            <input type="file" name="avatar_img" onchange="this.form.submit();">
        </form>
    </div>
</div>