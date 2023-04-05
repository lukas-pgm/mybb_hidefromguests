<?php
/** Plugin : Hide From Guests
 *  Author : lukaspgm
 *  GPL Version 3, 29 June 2007
 *  (c) Copyright 2023
 */

 
/**
 * Disallow direct access to this file for security reasons
 */
if(!defined("IN_MYBB")) {
	die("Direct initialization of this file is not allowed.<br /><br />Please make sure IN_MYBB is defined.");
}


/**
 * Register & Add plugin hooks
 */
$plugins->add_hook("postbit", "hidefromguests_postbit");
$plugins->add_hook("printthread_post", "hidefromguests_print");
$plugins->add_hook("archive_thread_post", "hidefromguests_archive");
$plugins->add_hook("syndication_get_posts", "hidefromguests_syndicate");
$plugins->add_hook("portal_announcement", "hidefromguests_portal");


/**
 * Plugin Info
 */
function hidefromguests_info() {
	return array(
		"name"			=> "Hide From Guests",
		"description"	=> "Hide specific content from guests",
		"website"		=> "http://mybb.com",
		"author"		=> "lukaspgm",
		"version"		=> "1.0",
		"compatibility" => "18*"
	);
}


/**
 * Plugin Functions
 */
function hidefromguests_validate($fid) {
	global $mybb;
	if($mybb->settings['hidefromguests_exclude']) {
	    $fids = explode(",", $mybb->settings['hidefromguests_exclude']);
		if(in_array($fid, $fids)) {
			return False;
		}
	}
	return True;
}
function hidefromguests_checkUserAgent() {
	$userAgents = array("Googlebot", "Slurp", "MSNBot", "ia_archiver", "Yandex", "Rambler","bingbot","GurujiBot","Baiduspider","facebook");
	return preg_match('/'.strtolower(implode('|', $userAgents)).'/i', strtolower($_SERVER['HTTP_USER_AGENT']));
}
function hidefromguests_checkUser(&$post, $type) {
	global $mybb, $lang, $thread;
	$lang->load("hidefromguests");
	if ($mybb->settings['hidefromguests_show'] == 1 && $mybb->user['uid'] == 0 && hidefromguests_validate($post['fid']) && !hidefromguests_checkUserAgent()) {
		if($type == "syn") {
			return trim(true);
        } else if($type == "portal") {
		    return trim($lang->hide_guest_msg_portal);
        }else {
		    return trim($lang->hide_guest_msg);
	    }
    }
}


/**
 * Plugin Hook-Functions
 */
function hidefromguests_postbit(&$post) {
	$temp = hidefromguests_checkUser($post,"");
	if(!$temp==false) {
		$post['attachments'] = "";
		$post['message'] = $temp;
	}
}
function hidefromguests_print() {
	global $postrow;
	$temp = hidefromguests_checkUser($postrow,"");
	if(!$temp==false) $postrow['message'] = $temp;
}
function hidefromguests_archive() {
	global $post;
	$temp = hidefromguests_checkUser($post,"");
	if(!$temp==false) $post['message'] = $temp;
}
function hidefromguests_syndicate() {
	global $firstposts, $post;
	if(hidefromguests_checkUser($post, "syn") == true)	$firstposts = null;
}
function hidefromguests_portal() {
	global $announcement, $mybb;
	$temp = hidefromguests_checkUser($announcement,"portal");
	if(!$temp==false) {
		$announcement['message'] = $temp;
		$mybb->settings['enableattachments']=0;
	}
}


/**
 * Activation & Deactivation of the plugin
 */
function hidefromguests_activate() {
    global $db;
    $hidefromguests_group = array(
        'gid'    => 'NULL',
        'name'  => 'hidefromguests',
        'title'      => 'Hide From Guests',
        'description'    => 'Hide your thread content from your guests',
        'disporder'    => "1",
        'isdefault'  => "0",
    ); 
    $db->insert_query('settinggroups', $hidefromguests_group);
    $gid = $db->insert_id();

    $hidefromguests_setting1 = array(
        'sid'            => 'NULL',
        'name'        => 'hidefromguests_show',
        'title'            => 'Enable or Disable',
        'description'    => 'On enable this plugin will hide content from the posts.',
        'optionscode'    => 'yesno',
        'value'        => '1',
        'disporder'        => 1,
        'gid'            => intval($gid),
    );
    $hidefromguests_setting2 = array(
        'sid'            => 'NULL',
        'name'        => 'hidefromguests_exclude',
        'title'            => 'Forum ID to exclude from hiding content',
        'description'    => 'If you do not want to exclude content on a forum or forums put ID separated by comma. Example 1,2,3',
        'optionscode'    => 'text',
        'value'        => '0',
        'disporder'        => 2,
        'gid'            => intval($gid),
    );
    $db->insert_query('settings', $hidefromguests_setting1);
    $db->insert_query('settings', $hidefromguests_setting2);
    rebuild_settings();
}
function hidefromguests_deactivate() {
  global $db;
  $db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE name = 'hidefromguests_show'");
  $db->query("DELETE FROM ".TABLE_PREFIX."settings WHERE name = 'hidefromguests_exclude'");
  $db->query("DELETE FROM ".TABLE_PREFIX."settinggroups WHERE name='hidefromguests'");
  rebuild_settings();
}
?>
