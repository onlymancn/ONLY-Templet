<?php
/*
Template Name:only
Description: 
Version:1.0
Author:only
Author Url:http://www.onlyman.cn
Sidebar Amount:0
*/
if(!defined('EMLOG_ROOT')) {exit('error!');}
require_once View::getView('module');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="zh-CN" class="sb-init">
<head>
<?php if (blog_tool_ishome()) :?> 
<title><?php echo $blogname; ?>丨<?php echo $bloginfo; ?></title>
<?php elseif($params[1]=='author'):?> 
<title><?php echo $user_username;?> 的所有文章 - <?php echo $blogname; ?></title> 
<?php else:?> 
<title><?php echo $site_title;?></title> 
<?php endif;?>
<meta http-equiv="expires" content="7" />
<meta name="keywords" content="<?php echo $site_key; ?>" />
<meta name="description" content="<?php echo $site_description; ?>" />
<meta name="ROBOTS" content="external nofollow">
<meta http-equiv="Cache-Control" content="no-siteapp">
<meta name="renderer" content="webkit">	
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="<?php echo BLOG_URL;?>xmlrpc.php?rsd">
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="<?php echo BLOG_URL;?>wlwmanifest.xml">
<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php echo BLOG_URL;?>rss.php">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Content-Style-Type" content="text/css">
<meta http-equiv="Content-Script-Type" content="text/javascript">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="shortcut icon" href="<?php echo BLOG_URL;?>favicon.ico">
<link rel="stylesheet"  href="<?php echo TEMPLATE_URL;?>style.css" type="text/css" media="screen"> 
<link rel="stylesheet" href="<?php echo TEMPLATE_URL;?>css/animation.css">
<!--[if lt IE 9]>
<script src="<?php echo TEMPLATE_URL;?>js/selectivizr-min.js"></script>
<![endif]-->
<link rel="stylesheet" d="slidebars-css" href="<?php echo TEMPLATE_URL;?>css/slidebars.min.css" type="text/css" media="">
<link rel="stylesheet" id="font-awesome-css" href="<?php echo TEMPLATE_URL;?>css/font-awesome.min.css" type="text/css" media="">
</head>
<body class="windsays">	
<div class="container"></div>
<i class="fa fa-sort-asc back-to-top" style="display: none;"></i>
<script type="text/javascript">
/* <![CDATA[ */
var mejsL10n = {"language":"zh-CN","strings":{"Close":"\u5173\u95ed","Fullscreen":"\u5168\u5c4f","Download File":"\u4e0b\u8f7d\u6587\u4ef6","Download Video":"\u4e0b\u8f7d\u89c6\u9891","Play\/Pause":"\u64ad\u653e\/\u6682\u505c","Mute Toggle":"\u5207\u6362\u9759\u97f3","None":"\u65e0","Turn off Fullscreen":"\u5173\u95ed\u5168\u5c4f","Go Fullscreen":"\u5168\u5c4f","Unmute":"\u53d6\u6d88\u9759\u97f3","Mute":"\u9759\u97f3","Captions\/Subtitles":"\u5b57\u5e55"}};
var _wpmejsSettings = {"pluginPath":"\/wp-includes\/js\/mediaelement\/"};
/* ]]> */
</script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>js/jquery.min.js"></script>
<script type="text/javascript"  src="<?php echo TEMPLATE_URL;?>js/slidebars.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_URL;?>js/html5.js"></script>	
<script>
      (function($) {
        $(document).ready(function() {
          $.slidebars();
        });
      }) (jQuery);

      $(document).ready(function(){


          // hide #back-top first
          jQuery(".back-to-top").hide();
          
          // fade in #back-top
          jQuery(function () {
            jQuery(window).scroll(function () {
              if (jQuery(this).scrollTop() > 300) {
                jQuery('.back-to-top').fadeIn();
              } else {
                jQuery('.back-to-top').fadeOut();
              }
            });

            // scroll body to 0px on click
            jQuery('.back-to-top').click(function () {
              jQuery('body,html,header').animate({
                scrollTop: 0
              }, 600);
              return false;
            });
          });
      });

</script>
<div  id="sb-site" class="hfeed site">
	<div id="banner" class="site-header" role="banner">

		 <div class="my-button sb-toggle-right">
			<div class="navicon-line"></div>
			<div class="navicon-line"></div>
			<div class="navicon-line"></div>
		 </div>


		<div class="clear"></div>
           <div class="cycle_div">
            <div class="head_anima">
                <img class="green_cycle_img" src="<?php echo TEMPLATE_URL;?>images/green_cycle.svg">
                <img class="yellow_cycle_img" src="<?php echo TEMPLATE_URL;?>images/yellow_cycle.svg">
                <img class="blue_cycle_img" src="<?php echo TEMPLATE_URL;?>images/blue_cycle.svg">                
             
           <img class="head_img" src="<?php echo TEMPLATE_URL;?>gravatar/me.png">
            </div>
        </div>

		<div class="clear"></div>
	<div class="blogtitle">
			<h1><a onClick="this.blur()" href="<?php echo BLOG_URL;?>" rel="home" title="<?php echo $blogname;?>"><?php echo $blogname;?></a></h1>		
		</div>
		<h3><?php echo $bloginfo;?></h3>
		  <span class="call">
        <a onClick="this.blur()" href="http://blog.onlyman.cn/rss.php" target="_blank"><i class="fa fa-2x fa-rss"></i></a>
        <a onClick="this.blur()" href="http://shang.qq.com/open_webaio.html?sigt=9c2045ef4df6441bae6d58abc46ad136b472a4a3e9f312517c59947a17e3a02ecf1347fe8c6979a61eef1b71d425e0e8&sigu=e290d236d2cece5c2e8e3e247abd8c798193d68f88456f0cecebf8ed75bf3b12a3142234811e2cc0&tuin=1666565871"><i class="fa fa-2x fa-qq"  target="_blank"></i></a>
        <a onClick="this.blur()" href="http://weibo.com/onlymancn" target="_blank"><i class="fa fa-2x fa-weibo"></i></a>
        <a data-evt="this.blur()" href="http://blog.onlyman.cn/img/wx.png" title="oＬｙ" target="_blank" onclick="window.open(this.href,'','width=255,height=255');return false" ><i class="fa fa-2x fa-weixin" target="_blank"></i></a>
        <a onClick="this.blur()" href="https://github.com/onlymancn" target="_blank" title="github" target="_blank"><i class="fa fa-github-square fa-2x"></i></a>
        <span>
	</div>
<div id="main" class="wrapper">
		<div id="primary" class="site-content">
