<?php
$imagePath = theme_path("images/login");
?>
<style type="text/css">

    body {
        background-color: #FFFFFF;
        height: 700px;
    }

    img {
        border: none;
    }
    #btnLogin {
        padding: 0;
    }
    input:not([type="image"]) {
        background-color: transparent;
        border: none;
    }

    input:focus, select:focus, textarea:focus {
        background-color: transparent;
        border: none;
    }

    .textInputContainer {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #666666;
        border-color: #2b2922;
    }

    #divLogin {
        background: transparent url(<?php echo "{$imagePath}/login.png"; ?>) no-repeat center top;
        height: 520px;
        width: 100%;
        border-style: hidden;
        margin: auto;
        padding-left: 10px;
    }

    #divUsername {
        padding-top: 153px;
        text-align: center;
    }

    #divPassword {
        padding-top: 35px;
        text-align: center;
    }

    #txtUsername {
        width: 240px;
        border: 1px solid black;
        background-color: transparent;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        background-image: url(<?php echo "{$imagePath}/user.png"?>);
        background-position: 3px center;
        background-repeat: no-repeat;
        padding:0 0 0 20px;
        height: 20px;
    }

    #txtPassword {
        width: 240px;
        border: 1px solid black;
        background-color: transparent;
        -webkit-border-radius: 2px;
        -moz-border-radius: 2px;
        border-radius: 2px;
        background-image: url(<?php echo "{$imagePath}/pass.png"?>);
        background-position: 3px center;
        background-repeat: no-repeat;
        padding:0 0 0 20px;
        height: 20px;
    }

    #txtUsername, #txtPassword {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 11px;
        color: #666666;
        vertical-align: middle;
        padding-top:0;
    }
    
    #divLoginHelpLink {
        width: 270px;
        background-color: transparent;
        height: 20px;
        margin-top: 12px;
        margin-right: 0px;
        margin-bottom: 0px;
        margin-left: 50%;
    }

    #divLoginButton {
        padding-top: 2px;
        /* padding-left: 50%; */
        text-align: center;
        float: none;
        /* width: 350px; */
    }

    #btnLogin {
        /*background: url(<?php echo "{$imagePath}/Login_button.png"; ?>) no-repeat;*/
        background-color: #f6921e;
        border-radius: 10px;
        cursor:pointer;
        width: 94px;
        height: 26px;
        border: none;
        color:#FFFFFF;
        font-weight: bold;
        font-size: 13px;
    }

    #divLink {
        padding-left: 230px;
        padding-top: 105px;
        float: left;
    }

    #divLogo {
        padding-left: 30%;
        padding-top: 70px;
    }

    #spanMessage {
        background: transparent url(<?php echo "{$imagePath}/mark.png"; ?>) no-repeat;
        padding-left: 18px; 
        padding-top: 0px;
        color: #DD7700;
        font-weight: bold;
    }
    
    #logInPanelHeading{
        position:absolute;
        padding-top:100px;
		padding-left:49.5%;
        font-family:sans-serif;
        font-size: 15px;
        color: #544B3C;
        font-weight: bold;
    }
    
    .form-hint {
    color: #878787;
    padding: 4px 8px;
    position: relative;
    left:-254px;
}

    
</style>

<!--<div id="divLogin">-->
    <div id="divLogo">

        <img src="<?php echo "{$imagePath}/logo.png"; ?>" />
    </div>

    <form id="frmLogin" method="post" action="<?php echo url_for('auth/validateCredentials'); ?>">
        <input type="hidden" name="actionID"/>
        <input type="hidden" name="hdnUserTimeZoneOffset" id="hdnUserTimeZoneOffset" value="0" />
        <?php 
            echo $form->renderHiddenFields(); // rendering csrf_token 
        ?>
        <!--<div id="logInPanelHeading"><?php echo __(''); ?></div>-->

        <div id="divUsername" class="textInputContainer">
            <!--<?php echo $form['Username']->render(); ?>-->
            <input name="txtUsername" id="txtUsername" type="text" placeholder="Username" autocomplete="off">
            <!--<span class="form-hint" ><?php echo __('Username'); ?></span> Aqui esta el placeholder -->
        </div>
        <div id="divPassword" class="textInputContainer">
            <!--<?php echo $form['Password']->render(); ?>-->
            <input type="password" name="txtPassword" id="txtPassword" placeholder="Password">
         <!--<span class="form-hint" ><?php echo __('Password'); ?></span>-->
        </div>
        <div id="divLoginHelpLink"><?php
            include_component('core', 'ohrmPluginPannel', array(
                'location' => 'login-page-help-link',
            ));
            ?></div>
        <div id="divLoginButton">
            <input type="submit" name="Submit" class="button" id="btnLogin" value="<?php echo __('LOGIN'); ?>" />
        </div>
        <div>
            <?php if (!empty($message)) : ?>
                <br>
                <span id="spanMessage"><?php echo __($message); ?></span>
            <?php endif; ?>
        </div>
    </form>

<!--</div>-->

<!--<div style="text-align: center">
    <?php include_component('core', 'ohrmPluginPannel', array(
                'location' => 'other-login-mechanisms',
            )); ?>
</div>-->

<!--<?php include_partial('global/footer_copyright_social_links'); ?>-->

<script type="text/javascript">
    
    function calculateUserTimeZoneOffset() {
        var myDate = new Date();
        var offset = (-1) * myDate.getTimezoneOffset() / 60;
        return offset;
    }
            
    function addHint(inputObject, hintImageURL) {
        if (inputObject.val() == '') {
            inputObject.css('background', "url('" + hintImageURL + "') no-repeat 10px 3px");
        }
    }
            
    function removeHint() {
       $('.form-hint').css('display', 'none');
    }
    
    function showMessage(message) {
        if ($('#spanMessage').size() == 0) {
            $('<span id="spanMessage"></span>').insertAfter('#btnLogin');
        }

        $('#spanMessage').html(message);
    }
    
    function validateLogin() {
        var isEmptyPasswordAllowed = false;
        
        if ($('#txtUsername').val() == '') {
            showMessage('<?php echo __('Username cannot be empty'); ?>');
            return false;
        }
        
        if (!isEmptyPasswordAllowed) {
            if ($('#txtPassword').val() == '') {
                showMessage('<?php echo __('Password cannot be empty'); ?>');
                return false;
            }
        }
        
        return true;
    }
    
    $(document).ready(function() {
        /*Set a delay to compatible with chrome browser*/
        setTimeout(checkSavedUsernames,100);
        
        $('#txtUsername').focus(function() {
            removeHint();
        });
        
        $('#txtPassword').focus(function() {
             removeHint();
        });
        
        $('.form-hint').click(function(){
            removeHint();
            $('#txtUsername').focus();
        });
        
        $('#hdnUserTimeZoneOffset').val(calculateUserTimeZoneOffset().toString());
        
        $('#frmLogin').submit(validateLogin);
        
    });

    function checkSavedUsernames(){
        if ($('#txtUsername').val() != '') {
            removeHint();
        }
    }

    if (window.top.location.href != location.href) {
        window.top.location.href = location.href;
    }
</script>
