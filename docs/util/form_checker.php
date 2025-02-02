<?php

/**
 * 情報が正しければ true を返す
 * 情報が正しくなければエラーメッセージを返す
 */
class FormChecker {
	private static $instance = null;
	
	private function __construct() {
		// 自動でPOSTの中身をtrimする
		if($_POST){
			foreach($_POST as $key => $val){
				$_POST[$key] = trim($val);
			}
		}
	}
	
	public function notEmpty($str){
		$str = str_replace("　", "", $str);
		$str = trim($str);
		if(empty($str)){
			return "入力がありません";
		} else {
			return true;
		}
	}
	
	public function email($str){
		if (preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-]|\+)*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/', $str)) {
	        return true;
	    } else {
	        return "不正なメールアドレスです";
	    }
	}
	
	public function regex($str, $regex){
		if (preg_match('/'.$regex.'/', $str)) {
	        return true;
	    } else {
	        return "入力形式が不正です";
	    }
	}
	
	public function confirm($str1, $str2){
		if($str1 == $str2){
			return true;
		} else {
			return "確認用データが一致しません";
		}
	}
	
	public static function getInstance(){
		if(is_null(self::$instance)){
			self::$instance = new self;
		}
		
		return self::$instance;
	}
}

?>