<?php
?>

    <div class="card card-primary card-outline direct-chat direct-chat-primary">

        <div class="card-header">

            <h3 class="card-title"><?= Yii::t('app', 'Chat') ?></h3>


            <div class="card-tools">

                <button type="button" class="btn btn-tool" data-card-widget="collapse">

                    <i class="fas fa-minus"></i>

                </button>

            </div>

        </div>

        <!-- /.card-header -->

        <div class="card-body">

            <!-- Conversations are loaded here -->

            <div class="direct-chat-messages" id="chat">

                <!-- /.direct-chat-msg -->

            </div>

            <!-- /.direct-chat-pane -->

        </div>

        <!-- /.card-body -->

        <div class="card-footer">

            <div class="input-group">

                <input type="text" id="message" name="message" placeholder="<?= Yii::t('app', 'Type Message ...') ?>"
                       class="form-control">

                <span class="input-group-append">

          <button id="btnSend" class="btn btn-primary"><?= Yii::t('app', 'Send') ?></button>

        </span>

            </div>

        </div>

        <!-- /.card-footer-->

    </div>

<?php $this->registerJs('

    $(function() {

        var chat = new WebSocket("ws://localhost:8084");

        chat.onmessage = function(e) {

            var response = JSON.parse(e.data);

            if (response.type && response.type == "chat") {

                if(response.from == "' . Yii::$app->user->identity->id . '" ){

                      

                    $("#chat").append("<div class=\"direct-chat-msg\"><div class=\"direct-chat-infos clearfix\"><span class=\"direct-chat-name float-left\">"+response.from+" </span><span class=\"direct-chat-timestamp float-right\">"+response.date+"</span></div><i class=\"direct-chat-img fas fa-user-circle\" style=\"font-size:40px\"></i><div class=\"direct-chat-text\">"+response.message+"</div></div>");

                         

                }else{

                    $("#chat").append("<div class=\"direct-chat-msg right\"><div class=\"direct-chat-infos clearfix\"><span class=\"direct-chat-name float-right\">"+response.from+" </span><span class=\"direct-chat-timestamp float-left\">"+response.date+"</span></div><i class=\"direct-chat-img fas fa-user-circle\" style=\"font-size:40px\"></i><div class=\"direct-chat-text\">"+response.message+"</div></div>");

                }



            } else if (response.message) {

                console.log(response.message);

            }

        };

        chat.onopen = function(e) {

            console.log("Connection established! Please, set your username.");

            chat.send( JSON.stringify({"action" : "setName", "name" : "' . Yii::$app->user->identity->id . '"}) );

        };

        $("#btnSend").click(function() {

            if ($("#message").val()) {

                chat.send( JSON.stringify({"action" : "chat", "message" : $("#message").val()}) );

                $("#message").val("");

                console.log(chat);

            } else {

                alert("' . Yii::t('app', 'Enter the message') . '");

            }

        });



           

       

        

        

    })

', \yii\web\View::POS_END); ?>