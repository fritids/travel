<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" >
	
    <link rel="stylesheet" type="text/css" href="{$baseurl}assets/style/style.css" />
	<link id='sfluid' class="sswitch" rel="stylesheet" type="text/css" href="{$baseurl}assets/style/fluid.css" title="fluid" media="screen" />
	<link id='sfixed' class="sswitch" rel="stylesheet" type="text/css" href="{$baseurl}assets/style/fixed.css" title="fluid" media="screen" />
        
	<title>Travelly.com | Administration Panel</title>
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
</head>
<body>
<div id="wrap">
    <div id="main">
        
        <div id="toolbar"> <!-- used for demo purpose only. Remove -->
            <div class="container_16 clearfix">
                <div class="grid_4">
                    <span class="left">Header Color</span> <div id="in-header" class="picker"></div>
                </div>
                <div class="grid_4">
                    <span class="left">Navigation Color</span> <div id="in-nav" class="picker"></div>
                </div>
                <div class="grid_4">
                    <span class="left">Widget Color</span> <div id="in-widget" class="picker"></div>
                </div>
                <div class="grid_4">
                    <span class="left">Select Preset</span> 
                        <select name="colors" id="colorChanger">
                            <option value="222936,222936,222936">Dark Azure</option>
                            <option value="300108,4D0713,000000">Royal Red</option>
                            <option value="1b282b,1b4352,212121">Ice Blue</option>
                            <option value="000F1F,002047,1c1c1c">Bright Navy</option>
                            <option value="022100,002e21,373823">Green Earth</option>
                            <option value="210a00,470f01,2e2e2e">Saffron</option>
                            <option value="070021,140e42,1f1c42">Indigo</option>
                            <option value="1a150e,5c1d06,524235">Chocolate Brown</option>
                            <option value="000000,3a093d,7a7a7a">Purple Black</option>
                            <option value="000000,000000,000000">Pure Black</option>
                        </select>
                </div>
            </div>
        </div>
        
        <header>
            <div class="container_16 clearfix">
                <div class="clearfix">
                    <a id="logo" href="{$base_url}"></a>
                    <input type="text" class="search" title="Search..."/>
                </div>
                
                <nav>
                    <div id="navcontainer" class="clearfix">
                    <div id="user" class="clearfix">
                        <img src="{$baseurl}assets/demo/avatar.png" alt="" />
                        <strong class="username">Welcome, <a href="{$baseurl}index.php/dashboard">{$profile_details->username}</a></strong>
                        <ul class="piped">
                            <li><a href="{$baseurl}index.php/dashboard">My Account</a></li>
                            <li><a href="{$baseurl}index.php/user/logout">Logout</a></li>
                        </ul>
                    </div>
                    
                    <div id="navclose"></div>
                    
                    <ul class="sf-menu">
                        <li class="active">
                            <a href="{$baseurl}dashboard">
                                <span class="icon"><img src="{$baseurl}assets/images/menu/dashboard.png" /></span>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="tables.html">
                                <span class="icon"><img src="{$baseurl}assets/images/menu/tables.png" /></span>
                                <span class="title">Tables</span>
                            </a>
                        </li>
                        <li>
                            <a href="forms.html">
                                <span class="icon"><img src="{$baseurl}assets/images/menu/form.png" /></span>
                                <span class="title">Form Elements</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><img src="{$baseurl}assets/images/menu/styles.png" /></span>
                                <span class="title">Styles</span>
                            </a>
                            <ul>
                                <li><a href="#" class="styleswitcher" rel="fluid">Fluid</a></li>
                                <li><a href="#" class="styleswitcher" rel="fixed">Fixed</a></li>
								<li><a href="sidebar_index.html">Sidebar</a></li>
                            </ul>
                        </li>
                        <li class="">
                            <a href="pages.html">
                                <span class="icon"><img src="{$baseurl}assets/images/menu/pages.png" /></span>
                                <span class="title">Sample Pages</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="gallery.html">
                                <span class="icon"><img src="{$baseurl}assets/images/menu/gallery.png" /></span>
                                <span class="title">Gallery</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="charts.html">
                                <span class="icon"><img src="{$baseurl}assets/images/menu/charts.png" /></span>
                                <span class="title">Statistics</span>
                            </a>
                        </li>
                        <li class="sep">
                            <a href="#">
                                <span class="notification">3</span>
                                <span class="icon"><img src="{$baseurl}assets/images/menu/msg.png" /></span>
                                <span class="title">Messages</span>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <span class="icon"><img src="{$baseurl}assets/images/menu/settings.png" /></span>
                                <span class="title">Settings</span>
                            </a>
                        </li>
                    </ul>
                    </div>
                </nav>
                <div id="pagetitle" class="clearfix">
                    <h1 class="left">
                        Dashboard
                    </h1>
                    <a class="btn grey right medium"><span>View Site</span></a>
                </div>
            </div>
        </header>
        <div class="container_16 clearfix" id="actualbody">

<ul class="breadcrumbs first">
    <li><a href="#">Home</a></li>
    <li class="active"><a href="#">Dashboard</a></li>
</ul>

<div class="clear"></div>


<div class="grid_16 widget first">
    <div class="widget_title clearfix">
        <h2>Features</h2>
    </div>
    <div class="widget_body">
        <div class="widget_content">
            <ul class="list-tick" style="width: 33%; display: inline-block;zoom: 1;*display:inline;">
                <li><a href="{$baseurl}manage/user">User Management</a></li>
                <li><a href="{$baseurl}manage/offers">Offer Management</a></li>
                <li><a href="{$baseurl}manage/services">Service Management</a></li>
                <li><a href="{$baseurl}manage/themes">Lastminute Theme Management</a></li>
                <li><a href="{$baseurl}manage/periods">Offer Period Management</a></li>
                <li><a href="{$baseurl}manage/payments">Manage Payments</a></li>
                <li><a href="{$baseurl}site/configuration">Site Configuration</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="clear"></div>



<!--
<div id="dialog" title="Hello, Hello, Twisted Transistor">
	<p>Chameleon Circuit features unlimited color schemes. Try moving the color sliders on the top right corner of your screen and see how you would like YOUR theme to be!</p>
</div>
-->
            </div> <!-- #actualbody -->
        </div> <!-- #main -->
    </div> <!-- #wrap -->
    <footer>
        <div class="container_12">
            <div class="grid_12 clearfix">
                <p class="left">&nbsp;
                    
                </p>
                <p class="right">
                    &copy <a href="http://themio.net">Travelly.com</a> 2012
                </p>
            </div>
        </div>
    </footer>
</body>
</html>