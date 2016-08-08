<?php 
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<div class="content">
<?php if (!empty($logs)):foreach($logs as $value):?>
 <?php $thum_src = getThumbnail($value['logid']);
 	$imgsrc = preg_match_all("|<img[^>]+src=\"([^>\"]+)\"?[^>]*>|is", $value['content'], $img);
	$imgsrc = !empty($img[1]) ? $img[1][0] : '';?> 
<?php if ($thum_src):
		
 elseif($imgsrc): 
 		
  else: ?>
<?php endif;?>
<div class="postbg" style="background-image: url('<?php if ($thum_src):echo $thum_src;elseif($imgsrc):echo $imgsrc;else:endif;?>')">
<div id="post-<?php echo $value['logid']; ?>" class="post-<?php echo $value['logid']; ?> post type-post status-publish format-status hentry category-whisper">
	<div class="article">
	<div class="entry-header">
		<h2 class="entry-title">
			<a onClick="this.blur()" href="<?php echo $value['log_url']; ?>" target="_blank" rel="bookmark" title="<?php echo $value['log_title']; ?>">
				<?php echo $value['log_title']; ?>
			</a>
		</h2>
		<div class="post_meta">
			<span class="date"><?php echo gmdate('Y年n月j日', $value['date']); ?></span>
		</div>
	</div>
	<div class="entry-content">
    <p><?php echo $value['log_description']; ?></p>
	<div class="readmore">
	<a onClick="this.blur()" href="<?php echo $value['log_url']; ?>">继续阅读</a>
	</div>
	</div>
	</div>
</div><!-- end post -->
</div>
<?php endforeach;else:?>

<?php endif;?>
<div class="footernavi"><div class="page_navi"><?php echo $page_url;?></div></div>
<?php include View::getView('footer');?>