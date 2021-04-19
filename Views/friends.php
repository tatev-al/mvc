<div class = "card">
    <div class="row">
        <?php
        foreach ($this->friends as $friend){ ?>
            <?php if($friend['avatar_img'] == NULL){ ?>
                <?php $friend['avatar_img'] = "avatar.png"; ?>
            <?php }?>
            <a class='col-sm-4 mb-3' style = 'text-decoration: none;' href = '/account/user/<?=$friend['id']?>'>
                <div class='bg-light border border-secondary rounded mt-2 border border-secondary'>
                    <div class = 'bg-secondary'>
                        <h5 class='text-light d-flex justify-content-center p-3'><?=$friend['name']?></h5>
                    </div>
                    <div class = 'd-flex justify-content-center'>
                        <img src='/Public/Images/Avatars/<?=$friend['avatar_img']?>' alt='avatar' class = 'img-fluid' >
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
</div>