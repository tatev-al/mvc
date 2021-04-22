<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

<?php if(!isset($_SESSION['id'])){ ?>
    <?php header("Location: /account");?>
<?php } ?>
<div class = "container-fluid mt-5">

    <div class="card border-secondary mb-3 mx-auto" style="max-width:90%">
        <div class="card-header bg-transparent border-secondary">
            <h4 class = 'text-dark'><?=$this->accountData['name']?></h4>
        </div>
        <div style = "height: 500px; overflow-y: auto" class = "d-flex flex-column" id="chatMsg">
        <?php
            foreach ($this->messages as $msg)
            {
                if($msg["body"] != NULL)
                {
                    if($msg["from_id"] == $_SESSION['id'])
                    {?> 
                        <div>
                            <small class = "mr-4 mb-1 float-left p-3"><?=$msg["date"]?></small>
                        </div>
                        <div class = "w-75">
                            <h5 class = "mt-4 ml-3 float-left bg-secondary p-3 text-light" style = "border-radius: 20px;"><?=$msg["body"]?></h5>
                        </div>
                    <?php
                    }
                    else
                    {?>
                        <div>
                            <small class = "mr-4 mb-1 float-right p-1"><?=$msg["date"]?></small>
                        </div>
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
            <input type="text" class="form-control p-2" placeholder="Enter message..." id="TextMsg" name = "chat">
            <button type="button" class="btn btn-dark" id="SendMsg" name = "chat">Send</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('button').click(function()
        {
            let text = document.onsubmit=$("#TextMsg").val();
           
            if(text.length > 0)
            {
                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "/account/chat/<?= $this->accountData['id'] ?>",
                    data: {
                        chat: text
                    },
                    success: function(response)
                    {
                        $("#chatMsg").append("<div class = 'w-75'><h5 class = 'mt-4 mr-3 float-left bg-dark p-3 text-light' style = 'border-radius: 20px;''>" 
                                + response['body'] + "</h5></div>"
                                + "<small class = 'ml-4 mb-1'>" 
                                + response['date'] + "</small>");
                    },
                })
            }
            $("#TextMsg").val("");
        });
    });

</script>