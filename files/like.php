<?php


function ldv_like_post($content)
{
	
	if($_REQUEST['act']=='like' && $_REQUEST['q']!="" && $_SESSION[$_REQUEST['q'].'_post_like']=="")
	{
		
		$_SESSION[$_REQUEST['q'].'_post_like']='done';
		$counts=get_post_meta($_REQUEST['q'],'ldv_like_post',true)+1;
		add_post_meta($_REQUEST['q'], 'ldv_like_post', $counts, true);  
    	update_post_meta($_REQUEST['q'], 'ldv_like_post', $counts); 
		$url_rdir="http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?p=".$_REQUEST['q'];
		
		if(get_option('vote_type')=='reg')
		{
			$current_user = wp_get_current_user();
			$usr_id=$current_user->ID;
			$vote_done=get_option('vote_done');
			if($vote_done=='')
			{
				$vote_done[$usr_id]=$_REQUEST['q'];
				add_option('vote_done',$vote_done);
			}
			else
			{
				if($vote_done[$usr_id]=='')
				{
					$vote_done[$usr_id]=$_REQUEST['q'];
				}
				else
				{
					$vote_pst=explode(",",$vote_done[$usr_id]);
					for($i=0;$i<=count($vote_pst);$i++)
					{
						if($vote_pst[$i]!=$_REQUEST['q'])
						{
							$do_vote="yes";
							break;
						}
					}
					if($do_vote=='yes')
					{
					$vote_done[$usr_id]=$vote_done[$usr_id].",".$_REQUEST['q'];
					}
				}
			update_option('vote_done',$vote_done);
			}
		}
	?>
            <script type="text/javascript">
   				 window.location = "<?php echo $url_rdir; ?>";
			</script>
            <?php
	}
	if($_REQUEST['act']=='unlike' && $_REQUEST['q']!="" && $_SESSION[$_REQUEST['p'].'_post_like']=="")
	{
	
	
		if(get_option('vote_type')=='reg')
		{
			$current_user = wp_get_current_user();
			$usr_id=$current_user->ID;
			$vote_done=get_option('vote_done');
			if($vote_done=='')
			{
				$vote_done[$usr_id]=$_REQUEST['q'];
				add_option('vote_done',$vote_done);
			}
			else
			{
				if($vote_done[$usr_id]=='')
				{
					$vote_done[$usr_id]=$_REQUEST['q'];
				}
				else
				{
					$vote_pst=explode(",",$vote_done[$usr_id]);
					for($i=0;$i<=count($vote_pst);$i++)
					{
						if($vote_pst[$i]!=$_REQUEST['q'])
						{
							$do_vote="yes";
							break;
						}
					}
					if($do_vote=='yes')
					{
					$vote_done[$usr_id]=$vote_done[$usr_id].",".$_REQUEST['q'];
					}
				}
			update_option('vote_done',$vote_done);
			}
		}
	
	
	
		
		$_SESSION[$_REQUEST['q'].'_post_like']='done';
		$counts=get_post_meta($_REQUEST['q'],'unldv_like_post',true)+1;
		add_post_meta($_REQUEST['q'], 'unldv_like_post', $counts, true);  
    	update_post_meta($_REQUEST['q'], 'unldv_like_post', $counts); 
		$url_rdir="http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?p=".$_REQUEST['q'];
	?>
            <script type="text/javascript">
   				 window.location = "<?php echo $url_rdir; ?>";
			</script>
            <?php
	}
}
add_action('wp_head', 'ldv_like_post');

?>