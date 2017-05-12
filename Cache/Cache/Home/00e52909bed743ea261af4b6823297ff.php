<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE HTML>
<html>
<head>
    <title>木森的博客</title>

    <link href="/Public/Home/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="/Public/Home/css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="/Public/Home/css/lightbox.css">

    <!-- jQuery (necessary JavaScript plugins) -->
    <script type='text/javascript' src="/Public/Home/js/jquery-1.11.1.min.js"></script>
    <!-- Custom Theme files -->
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/common.css" />
    <link rel="stylesheet" type="text/css" href="/Public/Home/css/style4.css" />
    <script type="text/javascript" src="/Public/Home/js/modernizr.custom.79639.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800|Titillium+Web:400,600,700,300' rel='stylesheet' type='text/css'>
    <!-- Custom Theme files -->
    <!--//theme-style-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Game Spot Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template,
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
    <script type="application/x-javascript">
        addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); }
    </script>


</head>
<body>
<!-- header -->
<div class='banner <?php if($action != 'index'): ?>banner2<?php endif; ?>'>
    <div class="container">
        <div class="headr-right">
            <div class="details">
                <ul>
                    <li><a href="mailto:462368783@qq.com"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> 462368783@qq.com</a></li>
                    <li><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>(+86)170 **** 5598</li>
                </ul>
            </div>
        </div>
        <div class="banner_head_top">
            <div class="logo">
                <h1><a href="<?php echo U('Index/index');?>">木森<span class="glyphicon glyphicon-knight" aria-hidden="true"></span><span>Blog</span></a></h1>
            </div>
            <div class="top-menu">
                <div class="content white">
                    <nav class="navbar navbar-default">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <!--/navbar header-->
                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav">
                                <li <?php if($action == 'index'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/index');?>">Home</a></li>
                                <li <?php if($action == 'about'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/about');?>">About</a></li>
                                <?php if(is_array($cate)): $i = 0; $__LIST__ = $cate;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ca): $mod = ($i % 2 );++$i;?><li <?php if($ca[child][0] != null): ?>class="dropdown"<?php endif; ?>>
                                    <?php if($ca[child][0] == null): ?><a href="<?php echo U('Index/review',array('cateid'=>$ca['id']));?>"><?php echo ($ca["name"]); ?>
                                        <?php else: ?>
                                        <a href="#" class="scroll dropdown-toggle" data-toggle="dropdown" ><?php echo ($ca["name"]); ?><b class="caret"></b><?php endif; ?></a>
                                    <?php if($ca['child'][0] != ''): ?><ul class="dropdown-menu">
                                            <?php if(is_array($ca['child'])): $i = 0; $__LIST__ = $ca['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cc): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/review',array('cateid'=>$cc['id']));?>"><?php echo ($cc["name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul><?php endif; ?>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                <!--<li <?php if($action == 'gallery'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/gallery');?>">Gallery</a></li>-->
                                <!--<li <?php if($action == 'shortcodes'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/shortcodes');?>">Shortcodes</a></li>-->
                                <!--<li <?php if($action == 'contact'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/contact');?>">Contact</a></li>-->
                                <!--<li <?php if($action == 'single'): ?>class="active"<?php endif; ?>><a href="<?php echo U('Index/single');?>">Single</a></li>-->
                            </ul>
                        </div>
                        <!--/navbar collapse-->
                    </nav>
                    <!--/navbar-->
                </div>
                <div class="clearfix"></div>
                <script type="text/javascript" src="/Public/Home/js/bootstrap-3.1.1.min.js"></script>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php if($action == 'index'): ?><div class="banner-info">
                <h3>Welcome to my blog</h3>
                <h2>study PHP together</h2>
            </div>
            <div class="social">
                <ul>
                    <li><a href="#"><span class="fa"> </span></a></li>
                    <li><a href="#"><span class="tw"> </span></a></li>
                    <li><a href="#"><span class="g"> </span></a></li>
                    <li><a href="#"><span class="in"> </span></a></li>
                    <li><a href="#"><span class="pin"> </span></a></li>
                </ul>
                <div class="clearfix"></div>
            </div><?php endif; ?>
    </div>
</div>
<!---->
<div class="welcome">
	 <div class="container">
		 <div>
			 <object type="application/x-shockwave-flash" style="outline:none;" data="http://cdn.abowman.com/widgets/hamster/hamster.swf?up_bodyColor=f0e9cc&amp;up_feetColor=D4C898&amp;up_eyeColor=000567&amp;up_wheelSpokeColor=DEDEDE&amp;up_wheelColor=FFFFFF&amp;up_waterColor=E0EFFF&amp;up_earColor=b0c4de&amp;up_wheelOuterColor=FF4D4D&amp;up_snoutColor=F7F4E9&amp;up_bgColor=F0E4E4&amp;up_foodColor=cba920&amp;up_wheelCenterColor=E4EB2F&amp;up_tailColor=E6DEBE&amp;" width="400" height="300">
				 <param name="movie" value="http://cdn.abowman.com/widgets/hamster/hamster.swf?up_bodyColor=f0e9cc&amp;up_feetColor=D4C898&amp;up_eyeColor=000567&amp;up_wheelSpokeColor=DEDEDE&amp;up_wheelColor=FFFFFF&amp;up_waterColor=E0EFFF&amp;up_earColor=b0c4de&amp;up_wheelOuterColor=FF4D4D&amp;up_snoutColor=F7F4E9&amp;up_bgColor=F0E4E4&amp;up_foodColor=cba920&amp;up_wheelCenterColor=E4EB2E&amp;up_tailColor=E6DEBE&amp;">
			 </object>
		 </div>
		 <div class="welcome-info">
			<h3>欢迎！</h3>
			<h4>个人网站，小伙伴们共同维护</h4>
			<p>一同分享，一同学习，一同成长</p>
			<p><embed wmode="transparent" src="http://chabudai.sakura.ne.jp/blogparts/honehoneclock/honehone_clock_wh.swf" quality="high" bgcolor="#ffffff" name="honehoneclock" allowscriptaccess="always" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" width="160" height="70" align="middle"></p>
	     </div>
	 </div>
</div>

<script src="/Public/Home/js/lightbox-plus-jquery.min.js"></script>
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="footer-grids">
            <div class="col-md-6 news-ltr">
                <h4>Newsletter</h4>
                <p>Aenean sagittis est eget elit pulvinar cursus. Lorem ipsum consectetur adipiscing elit. Phasellus non purus at risus consequat finibus.</p>
                <form>
                    <input type="text" class="text" value="Enter Email" onFocus="this.value = '';" onBlur="if (this.value == '') {this.value = 'Enter Email';}">
                    <input type="submit" value="Subscribe">
                    <div class="clearfix"></div>
                </form>
            </div>
            <div class="col-md-3 ftr-grid">
                <h3>Categories</h3>
                <ul class="ftr-list">
                    <li><a href="#">Action</a></li>
                    <li><a href="#">Racing</a></li>
                    <li><a href="#">Adventure</a></li>
                    <li><a href="#">Simulation</a></li>
                    <li><a href="#">Bike</a></li>
                </ul>
            </div>
            <div class="col-md-3 ftr-grid">
                <h3>Message</h3>
                <ul class="ftr-list">
                    <li><a href="#">木森的个人博客</a></li>
                    <li><a href="mailto:462368783@qq.com">email: 462368783@qq.com</a></li>
                    <li><a href="#">网址：****.com</a></li>
                    <li><a href="#">PHPer</a></li>
                    <li><a href="#">HELP</a></li>
                </ul>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>
<!---->
<div class="copywrite">
    <div class="container">
        <p>如有内容侵犯了您的权益，请与本人联系。</p>
        <p>Copyright &copy; 2015.Company name All rights reserved.More Templates <a href="http://www.cssmoban.com/" target="_blank" title="模板之家">模板之家</a> - Collect from <a href="http://www.cssmoban.com/" title="网页模板" target="_blank">网页模板</a></p>
    </div>
</div>
<!---->

</body>
</html>