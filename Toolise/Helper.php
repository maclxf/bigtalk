<?php
defined('HASH_SALT') OR define('HASH_SALT', 'xGf17L2n'); // ADIDE

function array_each_add_item($item, array $array = []):array {
	if (!$item || !is_array($item)) {
		return $array;
	}
	return array_map(function($val) use ($item) {
		if (is_array($val)) {
			$v = array_merge($val, $item);
		} else {
			$v = $val;
		}

		return $v;

	}, $array);
}

function array_find($array, Closure $closure) {
	foreach ($array as $key => $value) {
		if ($closure($value, $key)) {
			return $value;
		}
	}

	return;
}

/**
 * 函数返回给定的值，然而，如果你传递一个闭包到该函数，该闭包将会被执行并返回执行结果
 * from laravel
 * @author lxf 2019-05-04
 * @param  [type] $value [description]
 * @return [type]        [description]
 */
function value($value) {
    return $value instanceof Closure ? $value() : $value;
}

/**
 * 返回第一个参数数组中，第一个满足条件的元素
 * from laravel
 * @author lxf 2019-05-04
 * @param  [type]        $array    [description]
 * @param  callable|null $callback [description]
 * @param  [type]        $default  [description]
 * @return [type]                  [description]
 */
function array_first($array, callable $callback = null, $default = null) {
    if (is_null($callback)) {
        if (empty($array)) {
            return value($default);
        }
        foreach ($array as $item) {
            return $item;
        }
    }

    foreach ($array as $key => $value) {
        if (call_user_func($callback, $value, $key)) {
            return $value;
        }
    }

    return value($default);
}

////////////////////////////////////////////////////////////////////////////////////////////

/**
 * 判断指定字符串是否是有效的邮箱地址
 * @param  string $str 要判断的字符串
 * @return bool
 */
function is_email($str) {
	return filter_var(trim($str), FILTER_VALIDATE_EMAIL);
}

/**
 * 判断给定的字符串是否有效的密码
 * 有效密码是指：不以空格开头或结尾的字符串
 *
 * @param  [type] $pswd [description]
 * @return bool         [description]
 */
function is_valid_pswd($pswd) {
	if ($pswd === '' || start_with_blank($pswd) || end_with_blank($pswd)) {
		return FALSE;
	}

	return TRUE;
}

////////////////////////////////////////////////////////////////////////////////////////////

/**
 * 生成N位随机盐值
 *
 * @param  int $length 要求返回的盐值的长度
 *
 * @return string      N位随机字符串
 */
function generate_salt($length = 8) {
	if ($length < 8 || $length > 40) {
		$length = 8;
	}

	// 生成随机字符串
	$rand_str = rand_pswd(16);
	// 使用sha1加密
	$rand_str = sha1($rand_str);
	// 取最后8位字符作为盐值
	$salt = substr($rand_str, -1 * $length);

	return $salt;
}

/**
 * 对密码进行加密
 * @param  string $pswd 要加密的密码
 * @param  string $salt 生成密码用到的盐值
 * @return string       加密后的密码
 */
function encrypt_pswd($pswd, $salt) {
	$encrypted_pswd = md5($pswd . $salt);
	return $encrypted_pswd;
}

/**
 * 对密码进行hash运算
 * @param  string $pswd 要进行hash的密码
 * @return string       hash之后的密码
 */
function hash_pswd($pswd) {
	$hashed_pswd = sha1($pswd . HASH_SALT);
	return $hashed_pswd;
}

/**
 * 生成一串N位的随机密码，默认是8位
 * @param  integer $length 密码长度
 * @return string  		   生成的新的随机密码
 * 去除 1 l $
 */
function rand_pswd($length = 8) {
	$chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ023456789_^.!';
	$chars = str_shuffle($chars);
	$randpwd = substr($chars, 0, $length);
	return $randpwd;
}