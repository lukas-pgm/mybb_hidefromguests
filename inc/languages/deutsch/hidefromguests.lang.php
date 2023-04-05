<?php
/** Plugin : Hide From Guests
 *  Author : lukaspgm
 *  GPL Version 3, 29 June 2007
 *  (c) Copyright 2023
 */

 
$l['hide_guest_msg'] = '<table border="0" cellspacing="0" cellpadding="5" class="tborder tfixed clear"><tbody><tr><td style="background-color:orange;"><div><strong>Hallo Gast! Sie müssen <a style="color: #333;text-decoration:underline;" href="member.php?action=register" class="register">ein Konto erstellen</a> oder sich <a style="color: #333;text-decoration:underline;" href="member.php?action=login" onclick="$(\'#quick_login\').modal({ fadeDuration: 250, keepelement: true, zIndex: (typeof modal_zindex !== \'undefined\' ? modal_zindex : 9999) }); return false;" class="login">anmelden</a> um den Content sehen zu können!</strong></div></td></tr></tbody></table>';
$l['hide_guest_msg_portal'] = '[align=center][size=medium][b][color=#333333][font=Tahoma,Verdana,Arial,sans-serif][font=verdana]Hallo Gast! Sie müssen [url=http://localhost/forum/member.php?action=register][color=#0072bc]ein Konto erstellen[/color][/url] oder sich [url=http://localhost/forum/member.php?action=login][color=#0072bc]anmelden[/color][/url] um den Content sehen zu können![/font][/font][/color][/b][/size][/align]';
?>
