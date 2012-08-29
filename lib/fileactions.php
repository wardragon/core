<?php
/**
 * Copyright (c) 2012 Robin Appelman <icewind@owncloud.com>
 * This file is licensed under the Affero General Public License version 3 or
 * later.
 * See the COPYING-README file.
 */

/**
 * manage fileaction for the File browser
 */
class OC_FileActions{
	private static $defaults=array();
	private static $actions=array();

	/**
	 * register a new action for files of type $mime
	 * @param string $mime either the full mimetype ('image/png'), the partial mimetype, ('image'), 'dir', 'file' or 'all'
	 * @param string $action
	 * @param string $app
	 * @param string $script the script file of the app holding $function
	 * @param string $function the name of the function to handle the fileaction
	 * @param string icon (optional)
	 */
	public function register($mime, $action, $app, $script, $function, $permissions=OCP\Share::PERMISSION_READ, $icon=''){
		if(!isset(self::$actions[$mime])){
			self::$actions[$mime]=array();
		}
			self::$actions[$mime][$action]=array('app'=>$app, 'script'=>$script, 'func'=>$function, 'permissions'=>$permissions, 'icon'=>$icon);
	}

	/**
	 * set the default action for files of type $mime
	 * @param string $mime (see register)
	 * @param string action
	 */
	public function setDefault($mime, $action){
		self::$actions[$mime]=$action;
	}

	/**
	 * get the json export of the action
	 */
	static public function export(){
		return json_encode(array('actions'=>self::$actions, 'defaults'=>self::$defaults));
	}
}