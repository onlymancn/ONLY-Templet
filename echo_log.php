<?php 
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="singlecontent">
	<div class="article">
    	<div class="content">
       	 <h2 class="entry-title"><a><?php echo $log_title; ?></a></h2>	
       <div style="text-align:center;">
		   <i class="fa fa-user"></i>&nbsp;<?php blog_author($author); ?>&nbsp;&nbsp;&nbsp;<i class="fa fa-clock-o"></i>&nbsp;<?php echo gmdate('Y-n-j', $date); ?>
			</div>
			<br>
         <?php echo $log_content; ?>
		 <?php doAction('log_related', $logData); ?>
		 </div>		
		<div style=" float: right;" >
		<div class="bdsharebuttonbox" ><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_fbook" data-cmd="fbook" title="分享到Facebook"></a><a href="#" class="bds_linkedin" data-cmd="linkedin" title="分享到linkedin"></a><a href="#" class="bds_twi" data-cmd="twi" title="分享到Twitter"></a></div>
<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"1","bdMiniList":false,"bdPic":"","bdStyle":"1","bdSize":"24"},"share":{}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://blog.onlyman.cn/img/share.js?cdnversion='+~(-new Date()/36e5)];</script>
		 </div>	
			<div id="author">
        <h4>作者</h4>
        <img src="<?php echo TEMPLATE_URL;?>gravatar/me.png" alt="avatar" id="avatar">
         <div id="right">
         <h4>oＬｙ</h4>
         <div id="description">
			 <a>九零后青年,ATM工程师、IOT工程师、Web设计师。<br />爱互联网,爱美术,爱游戏,爱电影,爱音乐.</a>
    </div>
  </div>
    <div style="clear:both;"></div>
</div>
    </div>
<?php include View::getView('footer');?>