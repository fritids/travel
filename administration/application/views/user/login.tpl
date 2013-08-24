<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
	
	<link rel="stylesheet" type="text/css" href="{$baseurl}assets/style/style.css" />
    <link rel="stylesheet" type="text/css" href="{$baseurl}assets/style/fixed.css" title="fixed" media="screen" />
	
	<title>Travelly.com | Administration Panel </title>
		<script type="text/javascript" src="{$baseurl}assets/js/jquery-1.6.1.min.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/jquery-ui-1.8.14.custom.min.js"></script>

        <script type="text/javascript" src="{$baseurl}assets/js/excanvas.min.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/jquery.flot.min.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/jquery.flot.pie.min.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/jquery.flot.stack.min.js"></script>

        <script type="text/javascript" src="{$baseurl}assets/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/jquery.labelify.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/iphone-style-checkboxes.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/jquery.ui.selectmenu.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/vanadium-min.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/jquery.cleditor.min.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/superfish.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/jquery.colorbox-min.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/styleswitch.js"></script>

        <script type="text/javascript" src="{$baseurl}assets/js/fullcalendar.min.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/jquery.uploadify.v2.1.4.min.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/uploadify.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/jquery.tipsy.js"></script>

        <script type="text/javascript" src="{$baseurl}assets/js/gcal.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/swfobject.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/jquery.pnotify.min.js"></script>
        <script type="text/javascript" src="{$baseurl}assets/js/examples.js"></script>

        <script type="text/javascript" src="{$baseurl}assets/js/sidemenu.js">// Strictly for sidebar </script>

        <!-- Toolbar for Demo Only -->
        <link rel="stylesheet" type="text/css" href="{$baseurl}assets/demo/toolbar.css" />
        <link rel="stylesheet" media="screen" type="text/css" href="{$baseurl}assets/demo/colorpicker/css/colorpicker.css" />
        <script type="text/javascript" src="{$baseurl}assets/demo/colorpicker/js/colorpicker.js"></script>
        <!-- Demo js Only -->
        <script type="text/javascript" src="{$baseurl}assets/js/demo.js"></script>

        <!--[if lt IE 9]>
            <script type="text/javascript" src="{$baseurl}assets/js/html5.js"></script>
        <![endif]-->
        
        <!--[if IE 7]>
            <link rel="stylesheet" type="text/css" href="{$baseurl}assets/style/IE7.css" />
        <![endif]-->
		{literal}
			<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
			<!--[if !IE 7]><style>#wrap {display:table;height:100%}</style><![endif]-->
		{/literal}

		{if $display_captcha eq "yes"}
		{literal}
			<script type="text/javascript">
				var RecaptchaOptions = {
				    theme : 'white',
					tabindex : 2
				 };
			</script>
		{/literal}
		{/if}
{literal}
<style type="text/css">
	#recaptcha_image{ margin:0px !important; padding:0px !important; position:relative !important; top:0px !important;}
	#recaptcha_image img{ margin:0px !important; padding:0px !important; position:relative !important; top:0px !important;}
	#recaptcha_reload{ margin:0px !important; padding:0px !important; position:relative !important; top:0px !important;}
	#recaptcha_switch_audio{ margin:0px !important; padding:0px !important; position:relative !important; top:0px !important;}
	#recaptcha_whatsthis{ margin:0px !important; padding:0px !important; position:relative !important; top:0px !important;}
</style>
{/literal}
</head>
<body id="loginpage">
<form name="login" id="login" method="post" action="{$baseurl}user/login" style="margin:0px; padding:0px;" />
        <div class="container_16 clearfix">
            <div class="push_5 grid_6">
                <a href="#"><img src="{$baseurl}assets/images/biglogo.png" ></a>
            </div>
            <div class="clear"></div>	
            <div class="widget push_5 grid_7" id="login">
                

				<div class="widget_title">
                    <h2>Login</h2>
                </div>
				
                 <div class="widget_body">
                    <div class="widget_content">
                        {if $display_error eq "yes"}
							{include file="notification/error_box.tpl"}
						{/if}

						<label class="block" for="username">Username:</label>
                        <input type="text" name="username_email" class="large"/>
                        <label class="block" for="password">Password:</label>
                        <input type="password" name="password_signup" class="large" />
						
						{if $display_captcha eq "yes"}
							<label for="password_signup" class="block">{$human_string}</label>
							<div class="my_recaptcha">
							{$recaptcha_html}
							</div>
							<input type="hidden" name="recaptcha_validate" id="recaptcha_validate" value="yes">
						{/if}

                        <div style="margin-top:10px">
                            <label class="left"><input type="checkbox" name="sign_in_remember_me" value="1" id="sign_in_remember_me" {if $username_from_cookie!=NULL} checked="checked" {/if}> Remember me</label>
                            <input type="submit" name="signin" id="signin" class="btn right large" value="Login" style="width:100px;">
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
				
            </div>

        </div>
</form>
</body>
</html>