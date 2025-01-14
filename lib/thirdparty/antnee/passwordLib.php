<?php
/**
 * PHP 5.5-like password hashing functions
 *
 * Provides a password_hash() and password_verify() function as appeared in PHP 5.5.0
 * 
 * @see: http://php.net/password_hash and http://php.net/password_verify
 * @see https://crackstation.net/hashing-security.htm
 * @see http://streampow.net/tu-hoc-php-nang-cao-6/ma-hoa-chuoi-va-tap-tin-thu-vien-mcrypt-46.html
 * @see https://vn.teratail.com/questions/789
 * @see http://danweb.vn/lap-trinh-website/php-mysql/142-mat-ma-va-hieu-biet-co-ban.html
 * @see http://fsd14.com/post/175-su-dung-ham-bam-de-bao-ve-mat-khau
 * @see https://webvn.com/crypt/
 * 
 * 
 * @link https://github.com/Antnee/phpPasswordHashingLib
 * 
 * Thư viện này rất mạnh: 2 mật khẩu giống nhau nhưng khi mã hóa lại
 * cho ra hai chuỗi mã hóa khác nhau, ví dụ:
 * pass1 = Abcd@1234 ---> $2y$10$nwGZrQEdCcQdmbf3m7.TmOBPfYMVBFj4FZtGUf2tMUqU93Ngozu5a
 * pass2 = Abcd@1234 ---> $2y$10$IJRWvCAKkmfbWOjD0A.KnuuY0tdJzZFNXugEIetqL9Rzud6LZ0d7m
 * 
 * Đoạn mã test:
 * 
// Cấu hình hệ thống
include_once 'configs.php';

echo "Abcd@1234 = ".password_hash($data['Abcd@1234'],PASSWORD_BCRYPT);
echo "<br>";
echo "Abcd@1234 = ".password_hash($data['Abcd@1234'],PASSWORD_BCRYPT);
 */
include_once('passwordLibClass.php');

if (!function_exists('password_hash')){
    function password_hash($password, $algo=PASSWORD_DEFAULT, $options=array()){
//        $crypt = NEW Antnee\PhpPasswordLib\PhpPasswordLib;
        $crypt = new PhpPasswordLib();
        $crypt->setAlgorithm($algo);
        
        $debug  = isset($options['debug'])
                ? $options['debug']
                : NULL;
        
        $password = $crypt->generateCryptPassword($password, $options, $debug);
        
        return $password;
    }
}

if (!function_exists('password_verify')){
    function password_verify($password, $hash){
        return (crypt($password, $hash) === $hash);
    }
}

if (!function_exists('password_needs_rehash')){
    function password_needs_rehash($hash, $algo, $options=array()){
//        $crypt = NEW Antnee\PhpPasswordLib\PhpPasswordLib;
        $crypt = new PhpPasswordLib();
        return !$crypt->verifyCryptSetting($hash, $algo, $options);
    }
}

if (!function_exists('password_get_info')){
    function password_get_info($hash){
//        $crypt = NEW Antnee\PhpPasswordLib\PhpPasswordLib;
        $crypt = new PhpPasswordLib();
        return $crypt->getInfo($hash);
    }
}