<div class = "container-fluid mt-5">

    <div class="card border-secondary mb-3 mx-auto" style="max-width:90%">
        <div class="card-header bg-transparent border-secondary">
            <h4 class = 'text-dark'><?=$this->accountData['name']?></h4>
        </div>
        <div style = "height: 500px; overflow-y: auto" class = "d-flex flex-column" id="chatMsg">
        <?php $lastMsgId = 0; ?>
        <?php
            foreach ($this->messages as $msg)
            {
                if($msg["from_id"] == $_SESSION['id'])
                {?> 
                    <div>
                        <small class = "mr-4 mb-1 float-left p-1"><?=$msg["date"]?></small>
                    </div>
                    <div class = "w-75">
                        <h5 class = "mt-2 ml-3 float-left bg-secondary p-3 text-light" style = "border-radius: 20px;"><?=$msg["body"]?></h5>
                    </div>
                <?php
                }
                else
                {?>
                    <div>
                        <small class = "mr-4 mb-1 float-right"><?=$msg["date"]?></small>
                    </div>
                    <div>
                        <h5 class = "mt-2 mr-3 float-right bg-dark p-3 text-light" style = "border-radius: 20px;"><?=$msg["body"]?></h5>
                    </div>
                <?php
                }
                $lastMsgId = $msg['id'];
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
    var lastMsgId = <?=$lastMsgId?>;
    $("#TextMsg").keyup(function(event)
    {
        if (event.keyCode === 13)
        {
            $('button').click();
        }
    });
    $('button').click(function()
    {
        let text = document.onkeypress=$("#TextMsg").val();
        if(text.length > 0)
        {
            $.ajax({
                type: "POST",
                dataType: "json",
                url: location.pathname,
                data: {
                    chat: text
                },
                success: function(response)
                {
                    $("#chatMsg").append("<div><small class = 'mr-4 mb-1 float-left p-1'>" + response['date'] + "</small></div>" +
                        "<div class = 'w-75'><h5 class = 'mt-2 ml-3 float-left bg-secondary p-3 text-light' style = 'border-radius: 20px;'>"
                        + response['body'] + "</h5></div>");
                    $('#chatMsg').scrollTop($('#chatMsg')[0].scrollHeight);
                },
                error: function()
                {
                    $("#chatMsg").append("<div class = 'w-75'><h5 class = 'mt-2 ml-3 float-left bg-secondary p-3 text-light' style = 'border-radius: 20px;'>"
                        + text + "</h5></div>" +
                        "<div><small class = 'mr-4 mb-1 float-left p-3' style='color: red'>" + 'message not delivered ' + "</small></div>");
                },
            })
        }
        $("#TextMsg").val("");
    });
    setInterval(function()
    {
        $.ajax({
            type: "GET",
            dataType: "json",
            url: `/account/getLastMessage/<?=$this->accountData['id']?>/${lastMsgId}`,
            success: function(response)
            {
                if(response.length > 0)
                {
                    lastMsgId = response[response.length - 1]['id'];
                    response.forEach(function(response)
                    {
                        if(response['from_id'] != <?=$_SESSION['id']?>)
                        {
                            $("#chatMsg").append("<div><small class = 'mr-4 mb-1 float-right'>" + response['date'] + "</small></div>"
                                + "<div><h5 class = 'mt-2 mr-3 float-right bg-dark p-3 text-light' style = 'border-radius: 20px;'>" 
                                + response['body'] + "</h5></div>");
                            $('#chatMsg').scrollTop($('#chatMsg')[0].scrollHeight);
                        }
                    });
                }
            }
        });
    }, 1000)

</script>