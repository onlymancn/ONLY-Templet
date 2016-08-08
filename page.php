<?php 
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="singlecontent">
	<div class="article">
    	<div class="content">
       	 <h2 class="entry-title"><a><?php echo $log_title; ?></a></h2>
         <?php echo $log_content; ?>
		 </div>
    </div>
</div>
<?php include View::getView('footer');?>