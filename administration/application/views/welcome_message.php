<!doctype html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/style/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/style/fixed.css" title="fixed" media="screen" />
	
	<title>Foooblr.com | Administration Panel </title>

    <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
    <!--[if !IE 7]><style>#wrap {display:table;height:100%}</style><![endif]-->

</head>
<body id="loginpage">

        <div class="container_16 clearfix">
            <div class="push_5 grid_6">
                <a href="#"><img src="<?php echo base_url(); ?>assets/images/biglogo.png" ></a>
            </div>
            <div class="clear"></div>
            <div class="widget push_5 grid_6" id="login">
                <div class="widget_title">
                    <h2>Login</h2>
                </div>
                <div class="widget_body">
                    <div class="widget_content">
                        <label class="block" for="username">Username:</label>
                        <input type="text" name="username" class="large"/>
                        <label class="block" for="password">Password:</label>
                        <input type="password" name="password" class="large" />

                        <div style="margin-top:10px">
                            <label class="left"><input type="checkbox" />Remember me</label>
                            <a class="btn right large" href="">Login</a>
                        </div>
                        <div class="clear"></div>
                    </div>
                </div>
            </div>

        </div>
    </div> <!-- main -->
</div> <!-- wrap -->

</body>
</html>