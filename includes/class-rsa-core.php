<?php
/**
 * The file that defines RSA encryption/decryption class
 *
 * RSA encryption by private key. RSA decription by public key. PHPSecLib is used.
 * 
 * @link       https://github.com/OlegOKovalyov/rsa_wp_plugin
 * @since      1.0.0
 *
 * @package    Rsa_Enc_Dec
 * @subpackage Rsa_Enc_Dec/includes
 */

/**
 * The core RSA functionality class.
 *
 * @since      1.0.0
 * @package    Rsa_Enc_Dec
 * @subpackage Rsa_Enc_Dec/includes
 * @author     Oleg Kovalyov <koa2003@ukr.net>
 */
 
include plugin_dir_path( dirname( __FILE__ ) ) . 'includes/phpseclib/Crypt/RSA.php';
 
class Rsa_Core
{
    /**
     * RSA private key identifier
     *
     * @since    1.0.0
     * @var      string
     */    
    public static $privateKey = '';
    /**
     * RSA public key identifier
     *
     * @since    1.0.0
     * @var      string
     */      
    public static $publicKey = '';

    /**
     * Create the public and private keys for RSA encryption/decription
     *
     * @since    1.0.0
     */     
    public static function createKeyPair() {
        $rsa = new Crypt_RSA();
        $keys=$rsa->createKey(2048);     
        Rsa_Core::$privateKey=$keys['privatekey'];
        Rsa_Core::$publicKey=$keys['publickey'];
    }

    /**
     * RSA encryption with private key
     *
     * @since    1.0.0
     */    
    public static function encryptText($text) {
        $rsa = new Crypt_RSA();
        $rsa->loadKey(Rsa_Core::$privateKey);
        $encryptedText = $rsa->encrypt($text);
        return $encryptedText;
    }

    /**
     * RSA decryption with public key
     *
     * @since    1.0.0
     */   
    public static function decryptText($encryText) {
        $rsa = new Crypt_RSA();
        $rsa->loadKey(Rsa_Core::$publicKey);
        $plaintext = $rsa->decrypt($encryText);
        return $plaintext;
    }

    /**
     * Show encrypted string from database on the public-facing side of the site (front-end)
     *
     * The function encrypts string with RSA encryption, places received binary code 
     * into database then reads it, RSA-decrypts it and shows it.
     * 
     * @since    1.0.0
     */  
    public static function rsa_string_show($atts, $content) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'rsa_table';

        Rsa_Core::createKeyPair(2048);
        $secureText = Rsa_Core::encryptText($content);

        $wpdb->insert($table_name, array("rsastrings" => $secureText, "publickeys" => self::$publicKey, 'privatkeys' => self::$privateKey, 'strings' => $content), array("%s", "%s", "%s", "%s") );
        $id = $wpdb->insert_id;

        $secureText = $wpdb->get_var( $wpdb->prepare( 
        "
            SELECT rsastrings 
            FROM {$table_name}
            WHERE id = %d
        ", 
            $id
        ) );

        $content =  Rsa_Core::decryptText($secureText);
        $content = '<div class="rsa-enc-dec alert-info">' . $content . '</div>';

        return $content;
    }    
   
}