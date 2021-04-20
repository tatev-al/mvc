<?php if(!isset($_SESSION['id'])){ ?>
    <?php header("Location: /account");?>
<?php } ?>
<div class = "container-fluid mt-5">

    <div class="card border-secondary mb-3 mx-auto" style="max-width:90%">
        <div class="card-header bg-transparent border-secondary">
            <h4 class = 'text-dark'><?=$this->accountData['name']?></h4>
        </div>
        <div style = "height: 500px; overflow-y: auto" class = "d-flex flex-column">
        <?php
            foreach ($this->messages as $msg)
            {
                if($msg["body"] != NULL)
                {
                    if($msg["from_id"] == $_SESSION['id'])
                    {?>
                        <div class = "w-75">
                            <h5 class = "mt-4 ml-3 float-left bg-secondary p-3 text-light" style = "border-radius: 20px;"><?=$msg["body"]?></h5>
                        </div>
                    <?php
                    }
                    else
                    {?>
                        <div>
                            <h5 class = "mt-4 mr-3 float-right bg-dark p-3 text-light" style = "border-radius: 20px;"><?=$msg["body"]?></h5>
                        </div>
                    <?php
                    }
                }
            }
        ?>
        </div>
        <div class = "input-group">
            <input type="text" class="form-control p-2" placeholder="Enter message...">
            <button type="button" class="btn btn-dark">Send</button>
        </div>
    </div>
</div>