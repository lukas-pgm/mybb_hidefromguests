<?php
/** Plugin : Hide From Guests
 *  Author : lukaspgm
 *  GPL Version 3, 29 June 2007
 *  (c) Copyright 2023
 */

 
$l['hide_guest_msg'] = '<table border="0" cellspacing="0" cellpadding="5" class="tborder tfixed clear"><tbody><tr><td style="background-color:orange;"><div><strong>Hello Guest! You have to <a style="color: #333;text-decoration:underline;" href="member.php?action=register" class="register">create an account</a> or <a style="color: #333;text-decoration:underline;" href="member.php?action=login" onclick="$(\'#quick_login\').modal({ fadeDuration: 250, keepelement: true, zIndex: (typeof modal_zindex !== \'undefined\' ? modal_zindex : 9999) }); return false;" class="login">login</a> to see the content!</strong></div></td></tr></tbody></table>';
$l['hide_guest_msg_portal'] = '[align=center][size=medium][b][color=#333333][font=Tahoma,Verdana,Arial,sans-serif][font=verdana]Hello Guest! You need to [url=http://localhost/forum/member.php?action=register][color=#0072bc]create an account[/color][/url] or [url=http://localhost/forum/member.php?action=login][color=#0072bc]login[/color][/url] to view the content![/font][/font][/color][/b][/size][/align]';
?>
