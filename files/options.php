<?php


function ldv_theme_styles()  
{ 
  // Register the style like this for a theme:  
  // (First the unique name for the style (custom-style) then the src, 
  // then dependencies and ver no. and media type)
  wp_register_style( 'custom-style', 
    plugins_url() . '/like-dislike-voting/style.css', 
    array(), 
    '20120208', 
    'all' );

  // enqueing:
  wp_enqueue_style( 'custom-style' );
}
add_action('wp_enqueue_scripts', 'ldv_theme_styles');

/** Step 2 (from text above). */
add_action( 'admin_menu', 'ldv_plugin_menu' );

/** Step 1. */
function ldv_plugin_menu() {
	add_menu_page( 'My Plugin Options', 'Like Dislike', 'manage_options', 'like-dislike-voting', 'ldv_plugin_options' );
}

/** Step 3. */
function ldv_plugin_options() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	?>
    <?php
		if($_REQUEST['vtype']!="")
		{
			if(get_option('vote_type')=='')
			{
			add_option('vote_type',$_REQUEST['vtype']);
			}
			else
			{
			update_option('vote_type',$_REQUEST['vtype']);
			}
		}
		if($_REQUEST['vloc']!="")
		{
			if(get_option('vloc')=='')
			{
			add_option('vloc',$_REQUEST['vloc']);
			}
			else
			{
			update_option('vloc',$_REQUEST['vloc']);
			}
		}
		if($_REQUEST['hloc']!="")
		{
			if(get_option('hloc')=='')
			{
			add_option('hloc',$_REQUEST['hloc']);
			}
			else
			{
			update_option('hloc',$_REQUEST['hloc']);
			}
		}
	
	echo '<div class="wrap_admin">';
	
	?>
    <h1>Button Placement Option</h1>
    <hr />
    <b>Choose Position</b><br /> 
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>?page=like-dislike-voting">
    <table><tr>
    <td><input type="radio" name="vloc" value="bottom" <?php if(get_option('vloc')=='bottom' || get_option('vloc')==''){ ?>checked="checked"<?php } ?>  /> After Content</td>
    <td>&nbsp;&nbsp;&nbsp;<input type="radio" name="vloc" value="top" <?php if(get_option('vloc')=='top'){ ?>checked="checked"<?php } ?>  /> Before Content</td>
    </tr></table>
    <br /> 
    <b>Button Alignment</b><br />
    <table><tr>
    <td><input type="radio" name="hloc" value="left" <?php if(get_option('hloc')=='left' || get_option('hloc')==''){ ?>checked="checked"<?php } ?> /> Left</td>
    <td>&nbsp;&nbsp;&nbsp;<input type="radio" name="hloc" value="right" <?php if(get_option('hloc')=='right'){ ?>checked="checked"<?php } ?> /> Right</td>
    </tr></table>
    <hr />
    <b>Who Can Vote</b><br /> 
    <table><tr>
    <td valign="top" width="100"><input type="radio" name="vtype" value="ano" <?php if(get_option('vote_type')=='ano' || get_option('vote_type')==''){ ?>checked="checked"<?php } ?> /> Anyone </td>
    <td><input type="radio" name="vtype" value="reg" <?php if(get_option('vote_type')=='reg'){ ?>checked="checked"<?php } ?> /> Only Registered</td></tr></table><br /> 
    <input type="submit" value="Save"/>
    </form>
    <?php
	echo '</div>';
}
?>