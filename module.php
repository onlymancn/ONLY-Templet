<?php 
/**
 * 侧边栏组件、页面模块
 */
if(!defined('EMLOG_ROOT')) {exit('error!');} 
?>
<?php
//blog：导航
function blog_navi(){
	global $CACHE; 
	$navi_cache = $CACHE->readCache('navi');
	?>
	<ul class="menu" id="menu-nav">
	<?php
	foreach($navi_cache as $value):

        if ($value['pid'] != 0) {
            continue;
        }
		if($value['url'] == ROLE_ADMIN && (ROLE == ROLE_ADMIN || ROLE == ROLE_WRITER)):
			?>
			<li class="item common"><a onClick="this.blur()" href="<?php echo BLOG_URL; ?>admin/">管理站点</a></li>
			<li class="item common"><a onClick="this.blur()" href="<?php echo BLOG_URL; ?>admin/?action=logout">退出</a></li>
			<?php 
			continue;
		endif;
		$newtab = $value['newtab'] == 'y' ? 'target="_blank"' : '';
        $value['url'] = $value['isdefault'] == 'y' ? BLOG_URL . $value['url'] : trim($value['url'], '/');
        $current_tab = BLOG_URL . trim(Dispatcher::setPath(), '/') == $value['url'] ? 'current' : 'common';
		?>
		<li class="item <?php echo $current_tab;?>">
			<a href="<?php echo $value['url']; ?>" <?php echo $newtab;?>><?php echo $value['naviname']; ?></a>
		</li>
	<?php endforeach; ?>
	</ul>
<?php }?>
<?php
//blog：分类
function blog_sort($blogid){
	global $CACHE; 
	$log_cache_sort = $CACHE->readCache('logsort');
	?>
	<?php if(!empty($log_cache_sort[$blogid])): ?>
    <a onClick="this.blur()" href="<?php echo Url::sort($log_cache_sort[$blogid]['id']); ?>"><?php echo $log_cache_sort[$blogid]['name']; ?></a>
	<?php endif;?>
<?php }?>
<?php
//blog：文章作者
function blog_author($uid){
	global $CACHE;
	$user_cache = $CACHE->readCache('user');
	$author = $user_cache[$uid]['name'];
	$mail = $user_cache[$uid]['mail'];
	$des = $user_cache[$uid]['des'];
	$title = !empty($mail) || !empty($des) ? "title=\"$des $mail\"" : '';
	echo '<a href="'.Url::author($uid)."\" $title>$author</a>";
}
?>
<?php
//blog：相邻文章
function neighbor_log($neighborLog){
	extract($neighborLog);?>
	<?php if($prevLog):?>
	&laquo; <a href="<?php echo Url::log($prevLog['gid']) ?>"><?php echo $prevLog['title'];?></a>
	<?php endif;?>
	<?php if($nextLog && $prevLog):?>
		|
	<?php endif;?>
	<?php if($nextLog):?>
		 <a onClick="this.blur()" href="<?php echo Url::log($nextLog['gid']) ?>"><?php echo $nextLog['title'];?></a>&raquo;
	<?php endif;?>
<?php }?>
<?php
//blog-tool:判断是否是首页
function blog_tool_ishome(){
    if (BLOG_URL . trim(Dispatcher::setPath(), '/') == BLOG_URL){
        return true;
    } else {
        return FALSE;
    }
}
?>
<?php
//获取附件第一张图片
function getThumbnail($blogid){
    $db = MySql::getInstance();
    $sql = "SELECT * FROM ".DB_PREFIX."attachment WHERE blogid=".$blogid." AND (`filepath` LIKE '%jpg' OR `filepath` LIKE '%gif' OR `filepath` LIKE '%png') ORDER BY `aid` ASC LIMIT 0,1";
    //die($sql);
    $imgs = $db->query($sql);
    $img_path = "";
    while($row = $db->fetch_array($imgs)){
         $img_path .= BLOG_URL.substr($row['filepath'],3,strlen($row['filepath']));
    }
    return $img_path;
}
?>
<?php
//widget：最新评论
function widget_newcomm($title){
	global $CACHE; 
	$com_cache = $CACHE->readCache('comment');
	?>
	<li>
	<h3><span><?php echo $title; ?></span></h3>
	<ul id="newcomment">
	<?php
	foreach($com_cache as $value):
	$url = Url::comment($value['gid'], $value['page'], $value['cid']);
	?>
	<li id="comment"><?php echo $value['name']; ?>
	<br /><a href="<?php echo $url; ?>"><?php echo $value['content']; ?></a></li>
	<?php endforeach; ?>
	</ul>
	</li>
<?php }?>
<?php
function echo_levels($comment_author_email,$comment_author_url){
  $DB = MySql::getInstance();
global $CACHE;
	$user_cache = $CACHE->readCache('user'); 
	$adminEmail = '"'.$user_cache[1]['mail'].'"';
  if($comment_author_email==$adminEmail)
  {
    echo ' 博主<a class="vip" title="管理员认证"></a>';
  }
  $sql = "SELECT cid as author_count,mail FROM ".DB_PREFIX."comment WHERE mail != '' and mail in ($comment_author_email) and hide ='n'";
  $res = $DB->query($sql);
  $author_count = mysql_num_rows($res);
   if($author_count>=2 && $author_count<10 && $comment_author_email!=$adminEmail)
    echo '<a class="vip1" title="路过酱油 LV.1"></a>';
  else if($author_count>=10 && $author_count<20 && $comment_author_email!=$adminEmail)
    echo '<a class="vip2" title="偶尔光临 LV.2"></a>';
  else if($author_count>=20 && $author_count<40 && $comment_author_email!=$adminEmail)
    echo '<a class="vip3" title="常驻人口 LV.3"></a>';
  else if($author_count>=40 && $author_count<80 && $comment_author_email!=$adminEmail)
    echo '<a class="vip4" title="以博为家 LV.4"></a>';
  else if($author_count>=80 &&$author_count<160 && $comment_author_email!=$adminEmail)
    echo '<a class="vip5" title="情牵小博 LV.5"></a>';
  else if($author_count>=160 && $author_coun<320 && $comment_author_email!=$adminEmail)
    echo '<a class="vip6" title="为博终老 LV.6"></a>';
  else if($author_count>=50 && $author_coun<60 && $comment_author_email!=$adminEmail)
    echo '<a class="vip7" title="三世情牵 LV.7"></a>';
}
?>
<?php
//blog：评论列表
function blog_comments($comments){extract($comments);if($commentStacks):?>

	<?php endif;?>
  <div class="comm_charu"></div>
  <div class="comment-list">
<?php	$isGravatar = Option::get('isgravatar');$comnum = count($comments);foreach($comments as $value){if($value['pid'] != 0){$comnum--;}}$page = isset($params[5])?intval($params[5]):1;$i= $comnum - ($page - 1)*Option::get('comment_pnum');foreach($commentStacks as $cid):$comment = $comments[$cid];$comm_name = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];
$comment['content'] = preg_replace("/\[S(([1-4]?[0-9])|50)\]/",'<img src="'.TEMPLATE_URL.'moe/$1.gif" alt="" />',
$comment['content']);$comment['content'] = preg_replace("/\{smile:(([1-4]?[0-9])|50)\}/",'<img src="'.TEMPLATE_URL.'moe/$1.gif" alt="" />',
$comment['content']);$comment['content'] = preg_replace("/\[img=?\]*(.*?)(\[\/img)?\]/e", '"<a href=\"$1\" target=\"_blank\" rel=\"nofollow\" title=\"新窗口查看图片\"><img style=\"width:20px;height:20px;margin:0 5px\" src=\"'.TEMPLATE_URL.'images/img.gif\" alt=\"" . basename("$1") . "\" /></a>"',
 $comment['content']);$comment['content'] = preg_replace("/\[code=?\]*(.*?)(\[\/code)?\]/e", '"<pre>$1</pre>"', 
 $comment['content']);$comment['content'] = preg_replace("/\[link=?\]*(.*?)(\[\/link)?\]/e", '"<a href=\"$1\" target=\"_blank\" rel=\"external nofollow\">$1</a>"', $comment['content']);?>
	<div class="comment" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo mygetGravatar($comment['mail']); ?>" width="48" height="48"  /></div><?php endif; ?>
		<div class="comment-info">
			<span class="poster"><i class="fa fa-user mar-r-4 green"></i><?php $mail_str="\"".strip_tags($comment['mail'])."\"";echo_levels($mail_str,"\"".$comment['url']."\"");?> <?php echo $comment['poster']; ?><?php echo $comm_name;?></span><span class="comment-time"><i class="fa fa-clock-o mar-r-4"></i><?php echo $comment['date']; ?></span><span class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)"><i class="fa fa-share mar-r-4"></i>回复</a></span>
			<div class="comment-content"><?php echo $comment['content']; ?></div>			
		</div>
		<?php blog_comments_children($comments, $comment['children']); ?>
	</div>
	<?php $i--;endforeach;?></div><div class="clear"></div>
    <div id="pagenavi" style="border-top:1px solid rgba(0,0,0,0.13);border-bottom:1px solid rgba(0,0,0,0.13);"><?php echo $commentPageUrl;?></div>
<?php }?>
<?php
//blog：子评论列表
function blog_comments_children($comments, $children){$isGravatar = Option::get('isgravatar');foreach($children as $child):$comment = $comments[$child];$comm_name = $comment['url'] ? '<a href="'.$comment['url'].'" target="_blank">'.$comment['poster'].'</a>' : $comment['poster'];$comment['content'] = preg_replace("/\{smile:(([1-4]?[0-9])|50)\}/",'<img src="'.TEMPLATE_URL.'moe/$1.gif" alt="" />',$comment['content']);$comment['content'] = preg_replace("/\[S(([1-4]?[0-9])|50)\]/",'<img src="'.TEMPLATE_URL.'moe/$1.gif" alt="" />',$comment['content']);$comment['content'] = preg_replace("/\[img=?\]*(.*?)(\[\/img)?\]/e", '"<a href=\"$1\" target=\"_blank\" rel=\"nofollow\" title=\"新窗口查看图片\"><img style=\"width:20px;height:20px;margin:0 5px\" src=\"'.TEMPLATE_URL.'images/img.gif\" alt=\"" . basename("$1") . "\" /></a>"', $comment['content']);$comment['content'] = preg_replace("/\[code=?\]*(.*?)(\[\/code)?\]/e", '"<pre>$1</pre>"', $comment['content']);$comment['content'] = preg_replace("/\[link=?\]*(.*?)(\[\/link)?\]/e", '"<a href=\"$1\" target=\"_blank\" rel=\"external nofollow\">$1</a>"', $comment['content']);?>
	<div class="comment-children" id="comment-<?php echo $comment['cid']; ?>">
		<a name="<?php echo $comment['cid']; ?>"></a>
		<?php if($isGravatar == 'y'): ?><div class="avatar"><img src="<?php echo mygetGravatar($comment['mail']); ?>" width="36" height="36"/></div><?php endif;?>
		<div class="comment-info"><span class="poster"><i class="fa fa-user mar-r-4 green"></i><?php $mail_str="\"".strip_tags($comment['mail'])."\"";echo_levels($mail_str,"\"".$comment['url']."\"");?> <?php echo $comment['poster']; ?></span><span class="comment-time"><i class="fa fa-clock-o mar-r-4"></i><?php echo $comment['date']; ?></span><?php if($comment['level'] < 4):?><span class="comment-reply"><a href="#comment-<?php echo $comment['cid']; ?>" onclick="commentReply(<?php echo $comment['cid']; ?>,this)"><i class="fa fa-share mar-r-4"></i>回复</a></span><?php endif;?>
			<div class="comment-content"><?php echo $comment['content']; ?></div>			
		</div>
		<?php blog_comments_children($comments, $comment['children']);?>
	</div>
	<?php endforeach; ?>
<?php }?>
<?php
//blog：发表评论表单
function blog_comments_post($logid,$ckname,$ckmail,$ckurl,$verifyCode,$allow_remark){
	if($allow_remark == 'y'):?>
	<div id="comment-place">
 <script src="<?php echo TEMPLATE_URL; ?>js/ajax_comment.js" type="text/javascript"></script>
	<div class="comment-post" id="comment-post">
	<div id="smilelink">
<a onclick="javascript:grin('[S1]')"><img src="<?php echo TEMPLATE_URL; ?>moe/1.gif" title="汗" alt="汗"></a>
<a onclick="javascript:grin('[S2]')"><img src="<?php echo TEMPLATE_URL; ?>moe/2.gif" title="色" alt="色"></a>
<a onclick="javascript:grin('[S3]')"><img src="<?php echo TEMPLATE_URL; ?>moe/3.gif" title="悲" alt="悲"></a>
<a onclick="javascript:grin('[S4]')"><img src="<?php echo TEMPLATE_URL; ?>moe/4.gif" title="闭嘴" alt="闭嘴"></a>
<a onclick="javascript:grin('[S5]')"><img src="<?php echo TEMPLATE_URL; ?>moe/5.gif" title="调皮" alt="调皮"></a>
<a onclick="javascript:grin('[S6]')"><img src="<?php echo TEMPLATE_URL; ?>moe/6.gif" title="笑" alt="笑"></a>
<a onclick="javascript:grin('[S7]')"><img src="<?php echo TEMPLATE_URL; ?>moe/7.gif" title="惊" alt="惊"></a>
<a onclick="javascript:grin('[S8]')"><img src="<?php echo TEMPLATE_URL; ?>moe/8.gif" title="亲" alt="亲"></a>
<a onclick="javascript:grin('[S9]')"><img src="<?php echo TEMPLATE_URL; ?>moe/9.gif" title="雷" alt="雷"></a>
<a onclick="javascript:grin('[S10]')"><img src="<?php echo TEMPLATE_URL; ?>moe/10.gif" title="馋" alt="馋"></a>
<a onclick="javascript:grin('[S11]')"><img src="<?php echo TEMPLATE_URL; ?>moe/11.gif" title="晕" alt="晕"></a>
<a onclick="javascript:grin('[S12]')"><img src="<?php echo TEMPLATE_URL; ?>moe/12.gif" title="酷" alt="酷"></a>
<a onclick="javascript:grin('[S13]')"><img src="<?php echo TEMPLATE_URL; ?>moe/13.gif" title="奸" alt="奸"></a>
<a onclick="javascript:grin('[S14]')"><img src="<?php echo TEMPLATE_URL; ?>moe/14.gif" title="怒" alt="怒"></a>
<a onclick="javascript:grin('[S15]')"><img src="<?php echo TEMPLATE_URL; ?>moe/15.gif" title="狂" alt="狂"></a>
<a onclick="javascript:grin('[S16]')"><img src="<?php echo TEMPLATE_URL; ?>moe/16.gif" title="萌" alt="萌"></a>
<a onclick="javascript:grin('[S17]')"><img src="<?php echo TEMPLATE_URL; ?>moe/17.gif" title="吃" alt="吃"></a>
<a onclick="javascript:grin('[S18]')"><img src="<?php echo TEMPLATE_URL; ?>moe/18.gif" title="贪" alt="贪"></a>
<a onclick="javascript:grin('[S19]')"><img src="<?php echo TEMPLATE_URL; ?>moe/19.gif" title="囧" alt="囧"></a>
<a onclick="javascript:grin('[S20]')"><img src="<?php echo TEMPLATE_URL; ?>moe/20.gif" title="羞" alt="羞"></a>
<a onclick="javascript:grin('[S21]')"><img src="<?php echo TEMPLATE_URL; ?>moe/21.gif" title="哭" alt="哭"></a>
<a onclick="javascript:grin('[S22]')"><img src="<?php echo TEMPLATE_URL; ?>moe/22.gif" title="嘿" alt="嘿"></a>
</div>
		<form method="post" name="commentform" action="<?php echo BLOG_URL; ?>index.php?action=addcom" id="commentform">
			<input type="hidden" name="gid" value="<?php echo $logid; ?>" />
			<div class="textarea"><textarea name="comment" id="comment" rows="10" tabindex="4" placeholder="既然来了说点什么吧…"></textarea></div>
<div class="comm_toolbar">
  <div class="comm_tool">
  <div class="smilebg"><div class="smile"><div class="arrow"></div> 
  <div title="插入图片" onclick="tool_img()" class="tool_img"><i class="fa fa-image"></i></div>
  <div title="插入链接" onclick="tool_link()" class="tool_link"><i class="fa fa-link"></i></div>
  <div title="插入代码" onclick="tool_code()" class="tool_code"><i class="fa fa-code"></i></div>
  <div title="签到" onclick="tool_qiand()" class="tool_qiand"><i class="fa fa-pencil"></i></div></div></div>
  <div title="插入表情" onclick="tool_bq()" class="tool_bq"><i class="fa fa-cog"></i></div>
  <div id="cmt-loading" style="float:left;padding-left:15px;height:32px;font-size:14px;color:red;line-height:30px;"></div>
  <?php if(ROLE == 'visitor'): ?>
<div class="comm_tijiao">提交评论</div>
<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
</div>
</div>
<div class="comm_infobox"><div class="comm_close"></div>
<p><label for="author">名字：</label><input type="text" name="comname" id="comname" maxlength="49" value="<?php echo $ckname; ?>" size="22" tabindex="1"></p>
<p><label for="email">邮箱：</label><input type="text" name="commail" id="commail" maxlength="128"  value="<?php echo $ckmail; ?>" size="22" tabindex="2"></p>
<p><label for="url">网址：</label><input type="text" name="comurl" id="comurl" maxlength="128"  value="<?php echo $ckurl; ?>" size="22" tabindex="3"></p>
<input  type="submit" id="comment_submit" class="button submit" value="发射(●'◡'●)ﾉ♥" tabindex="6" />
</div>
<?php else:?>
<div class="comm_tijiao"><input type="submit" id="comment_submit" value="发射(●'◡'●)ﾉ♥" tabindex="6" /></div>
<div class="cancel-reply" id="cancel-reply" style="display:none"><a href="javascript:void(0);" onclick="cancelReply()">取消回复</a></div>
</div>
</div>
<?php endif; ?>
<input type="hidden" name="pid" id="comment-pid" value="0" size="22" tabindex="1"/>
</form>
	</div>
	</div>
 	<?php endif; ?>
<?php }?>
<?php
function get_avatar($mail,$size,$default='monsterid')
{
	$email_md5=md5(strtolower($mail));//通过MD5加密邮箱
	$cache_path=TEMPLATE_PATH."cache"; //缓存文件夹路径,ljie需要换上你的主题目录名称
	if(!file_exists($cache_path))
	{
		mkdir($cache_path,0700);
	}
 $avatar_url=TEMPLATE_URL."cache/".$email_md5.'.jpg'; //头像相对路径
	$avatar_abs_url=$cache_path."/".$email_md5.'.jpg'; //头像绝对路径
	$cache_time=24*3600*7; //缓存时间为7天
	 if (empty($default)) $default = $cache_path. '/default.jpg';
	if(!file_exists($avatar_abs_url) || (time()-filemtime($avatar_abs_url)) > $cache_time)//过期或图片不存在
	{
		$new_avatar = getGravatar($mail,$size,$default);
		copy($new_avatar,$avatar_abs_url);
	}
	return $avatar_url;
}
//调用方法
//get_avatar($comment['mail'],"{$comment['poster']}{$comment['comment_nums']}")
?>
<?php 
//blog:多说获取Gravatar头像
function mygetGravatar($email, $s = 80, $d = 'mm', $g = 'g') {
	$hash = md5($email);
	$avatar = "http://gravatar.duoshuo.com/avatar/$hash?s=$s&d=$d&r=$g";
	return $avatar;
}
?>

<?php //判断内容页是否百度收录
function baidu($url){
$url='http://www.baidu.com/s?wd='.$url;
$curl=curl_init();curl_setopt($curl,CURLOPT_URL,$url);curl_setopt($curl,CURLOPT_RETURNTRANSFER,1);$rs=curl_exec($curl);curl_close($curl);if(!strpos($rs,'没有找到')){return 1;}else{return 0;}}
function logurl($id){$url=Url::log($id);
if(baidu($url)==1){echo "百度已收录";
}else{echo "<a style=\"color:red;\" rel=\"external nofollow\" title=\"点击提交收录！\" target=\"_blank\" href=\"http://zhanzhang.baidu.com/sitesubmit/index?sitename=$url\">百度未收录</a>";}}
?>