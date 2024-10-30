<?php
function ldv_add_list_content($content)
{	
	if(get_option('hloc')=="right")
	{
		$hloc=" style='overflow: auto;'><p style='float:right;margin:0'>";
	}
	
	else{
		$hloc=" style='overflow: auto;'><p>";
	}
	
	
	$current_user = wp_get_current_user();
	$usr_id=$current_user->ID;
	$vote_done=get_option('vote_done');
	
		if(get_option('vote_type')=='reg')
		{
			$vote_pst=explode(",",$vote_done[$usr_id]);
			for($i=0;$i<=count($vote_pst);$i++)
			{
				if($vote_pst[$i]==get_the_ID())
				{
					$do_vote[get_the_ID()]="done";
					break;
				}
			}
		}

           $likepost=get_post_meta(get_the_ID(),'ldv_like_post',true);
			$unlikepost=get_post_meta(get_the_ID(),'unldv_like_post',true);
	?>		
            
    <?php         
			if($likepost=="")
			{
				$likepost='0';
			}
			if($unlikepost=="")
			{
				$unlikepost='0';
			}
         $likepost="<span class='likepost'> =".$likepost."</span>";
			$unlikepost="<span class='unlikepost'> =".$unlikepost."</span>";  
	if(get_post_type( get_the_ID() ) == 'post'){
		if($_SESSION[get_the_ID().'_post_like']!="done" )
			{			
				
				if(get_option('vote_type')=='reg' && $usr_id=='')
				{
					if(get_option('vloc')=="top")
					{
					$content_new = '<div class="likeImgContainer" '.$hloc.' <img class="likepostimg"  src="'.plugins_url().'/like-dislike-voting/img/like_done.png"> '.$likepost.' <img class="unlikepostimg"  src="'.plugins_url().'/like-dislike-voting/img/unlike_done.png"> '.$unlikepost.'</p></div>'.$content_new;
					}
					else
					{
					$content_new .= '<div class="likeImgContainer" '.$hloc.' <img class="likepostimg"   src="'.plugins_url().'/like-dislike-voting/img/like_done.png"> '.$likepost.' <img class="unlikepostimg"   src="'.plugins_url().'/like-dislike-voting/img/unlike_done.png"> '.$unlikepost.'</p></div>';
					}
				}
				else if( $do_vote[get_the_ID()]=="done")
				{
					if(get_option('vloc')=="top")
					{
					$content_new = '<div class="likeImgContainer" '.$hloc.'<img class="likepostimg"  src="'.plugins_url().'/like-dislike-voting/img/like_done.png"> '.$likepost.' <img class="unlikepostimg"   src="'.plugins_url().'/like-dislike-voting/img/unlike_done.png"> '.$unlikepost.'</p></div>'.$content_new;
					}
					else
					{
					$content_new .= '<div class="likeImgContainer" '.$hloc.'<img class="likepostimg"   src="'.plugins_url().'/like-dislike-voting/img/like_done.png"> '.$likepost.' <img class="unlikepostimg"   src="'.plugins_url().'/like-dislike-voting/img/unlike_done.png"> '.$unlikepost.'</p></div>';
					}
				}
				else
				{	
					if(get_option('vloc')=="top")
					{
					$content_new  ='<div '.$hloc.'<a href="'.$_SERVER['PHP_SELF'].'?q='.get_the_ID().'&act=like"><img class="likepostimg"  src="'.plugins_url().'/like-dislike-voting/img/like.png"></a> '.$likepost.' <a href="'.$_SERVER['PHP_SELF'].'?q='.get_the_ID().'&act=unlike"><img class="unlikepostimg"  src="'.plugins_url().'/like-dislike-voting/img/unlike.png"></a> '.$unlikepost.'</p></div>'.$content_new;	
					

					}
					else
					{		
					$content_new .= '<div '.$hloc.'<a href="'.$_SERVER['PHP_SELF'].'?q='.get_the_ID().'&act=like"><img class="likepostimg"  src="'.plugins_url().'/like-dislike-voting/img/like.png"></a> '.$likepost.' <a href="'.$_SERVER['PHP_SELF'].'?q='.get_the_ID().'&act=unlike"><img class="unlikepostimg" src="'.plugins_url().'/like-dislike-voting/img/unlike.png"></a> '.$unlikepost.'</p></div>';
					}
				}

			
			}
			else
			{

				
				if(get_option('vloc')=="top")
					{
					$content_new = '<div class="likeImgContainer" '.$hloc.'<img class="likepostimg"  src="'.plugins_url().'/like-dislike-voting/img/like_done.png"> '.$likepost.' <img class="unlikepostimg"  src="'.plugins_url().'/like-dislike-voting/img/unlike_done.png"> '.$unlikepost.'</p></div>'.$content_new;
					}
					else
					{
					$content_new .= '<div class="likeImgContainer" '.$hloc.'<img class="likepostimg"  src="'.plugins_url().'/like-dislike-voting/img/like_done.png"> '.$likepost.' <img class="unlikepostimg"  src="'.plugins_url().'/like-dislike-voting/img/unlike_done.png"> '.$unlikepost.'</p></div>';
					}
					
				
							
			}
		
		}
		
	
		if(get_option('vloc')=="top")
		{
		return $content_new.$content;
		}
		else
		{
		return $content.$content_new;
		}
}

add_filter('the_content', 'ldv_add_list_content',1,2);

add_filter('the_excerpt', 'ldv_add_list_content');

add_filter('get_the_excerpt', 'ldv_no_share_links',-1); 
    function ldv_no_share_links( $content ) { 
     remove_filter('the_content', 'add_post_content'); 
	 remove_filter('the_content', 'ldv_add_list_content',1,2);
     return $content; 
   } 
?>