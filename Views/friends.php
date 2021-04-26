<div class = "card p-4">
    <div class="row p-1">
        <?php
        foreach ($this->friends as $friend){ ?>
            <?php if($friend['avatar_img'] == NULL){ ?>
                <?php $friend['avatar_img'] = "avatar.png"; ?>
            <?php }?>
            <a class='col-sm-4 mb-3' style = 'text-decoration: none;' href = '/account/user/<?=$friend['id']?>'>
                <div class='bg-light border border-dark rounded mt-2 border border-dark'>
                    <div class = 'bg-dark'>
                        <h5 class='text-light d-flex justify-content-center p-3'><?=$friend['name']?></h5>
                    </div>
                    <div class = 'd-flex justify-content-center'>
                        <img src='/Public/Images/Avatars/<?=$friend['avatar_img']?>' alt='avatar' class = 'img-fluid p-1 m-2' style="max-height: 280px">
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>
</div>