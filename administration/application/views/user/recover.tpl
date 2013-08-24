<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
	
	<link rel="stylesheet" type="text/css" href="{$baseurl}assets/style/style.css" />
    <link rel="stylesheet" type="text/css" href="{$baseurl}assets/style/fixed.css" title="fixed" media="screen" />
	
	<title>Travelly.com | Administration Panel </title>
{literal}
    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if !IE 7]><style>#wrap {display:table;height:100%}</style><![endif]-->
{/literal}
</head>
<body id="loginpage">
<form name="login" id="login" method="post" action="{$baseurl}user/recover" style="margin:0px; padding:0px;" />

				



        <div class="container_16 clearfix">
            <div class="push_5 grid_6">
                <a href="#"><img src="{$baseurl}assets/images/biglogo.png" ></a>
            </div>
            <div class="clear"></div>
            <div class="widget push_5 grid_6" id="login">
                <div class="widget_title">
                    <h2>Forgot Password</h2>
                </div>
				
                 <div class="widget_body">
                    <div class="widget_content">


						{if $display_error eq "yes"}
							<div class="notification error_box png_bg">
									<a href="javascript:void(0);" class="close_notification"><img src="{$baseurl}assets/images/icons/cross_red_small.png" style="border:0" /></a>
									<div>
										<p class="inside_notification">
											{$login_problems_message_error}
										</p>
									</div>
				
							</div>
						{elseif $display_submit_error eq "yes"}
								<div class="notification error_box png_bg">
									<a href="javascript:void(0);" class="close_notification"><img src="{$baseurl}assets/images/icons/cross_red_small.png" style="border:0" /></a>
									<div>
										<p class="inside_notification">{$display_message}</p>
									</div>
				
								</div>
						 {elseif $success_message eq "yes"}
								<div class="notification success_box png_bg">
									<a href="javascript:void(0);" class="close_notification"><img src="{$baseurl}assets/images/icons/cross_grey_small.png" style="border:0" /></a>
									<div>
										<p class="inside_notification">
										{$display_message}
										</p>
									</div>
					
								</div>    
						{/if}




                        <label class="block" for="username">Username:</label>
                        <input type="text" name="username_email" class="large"/>

                        <div style="margin-top:10px">
                            <input type="submit" name="submit" id="submit" class="btn right large" value="Submit">
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
				
            </div>

        </div>
</form>
</body>
</html>