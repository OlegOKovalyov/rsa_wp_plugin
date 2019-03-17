<?php
 
include plugin_dir_path( dirname( __FILE__ ) ) . 'includes/phpseclib/Crypt/RSA.php';
 
class Rsa_Core
{
    public static $privateKey = '';
    public static $publicKey = '';
    public static $keyPhrase = '';
     
    public static function createKeyPair() {
        $rsa = new Crypt_RSA();
        $keys=$rsa->createKey(2048);     
        Rsa_Core::$privateKey=$keys['privatekey'];
        Rsa_Core::$publicKey=$keys['publickey'];
    }
 
    public static function encryptText($text) {
        $rsa = new Crypt_RSA();
        $rsa->loadKey(Rsa_Core::$privateKey);
        $encryptedText = $rsa->encrypt($text);
        return $encryptedText;
    }
 
    public static function decryptText($encryText) {
        $rsa = new Crypt_RSA();
        $rsa->loadKey(Rsa_Core::$publicKey);
        $plaintext = $rsa->decrypt($encryText);
        return $plaintext;
    }

    public static function rsa_string_show($atts, $content) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'rsa_table';
        Rsa_Core::createKeyPair(2048);
        // $text = "A secret lies here, send the text via a secure mode";
        // $text = $content;
        $secureText = Rsa_Core::encryptText($content);

        // if ( maybe_create_table( $table_name, $create_ddl ) ) {
        //     # code...
        // }

        $wpdb->insert($table_name, array("rsastrings" => $secureText, "publickeys" => self::$publicKey, 'privatkeys' => self::$privateKey, 'strings' => $content), array("%s", "%s", "%s", "%s") );
        // $wpdb->insert('wp_rsa_table', array("publickeys" => self::$publicKey, 'privatkeys' => self::$privateKey, 'strings' => $content), array("%s", "%s", "%s") );
        $id = $wpdb->insert_id;
        // $query = "SELECT FROM 'wp_rsa_table' WHERE 'id' = $id";
        $secureText = $wpdb->get_var( $wpdb->prepare( 
        "
            SELECT rsastrings 
            FROM wp_rsa_table
            WHERE id = %d
        ", 
            $id
        ) );

        // $secureText = $wpdb->get_var( $query, 1, 0 );

        // $wpdb->query( $wpdb->prepare( 
        // "
        //     DELETE FROM wp_rsa_table
        //     WHERE id = %d

        // ",
        //     $id
        // ) );


        $content =  Rsa_Core::decryptText($secureText);
        $content = '<div class="rsa-enc-dec alert-info">' . $content . '</div>';
        // $content = $decrypted_text;
        return $content;
    }    






    public static function rsa_string_to_db($content) {
        global $wpdb;
        // $wpdb->show_errors();
        Rsa_Core::createKeyPair(2048);
        $wpdb->insert('wp_rsa_table', array( "publickeys" => self::$publicKey, 'privatkeys' => self::$privateKey, 'strings' => $content), array("%s", "%s", "%s") );
        // $id = $wpdb->insert_id;
        // $query = "SELECT  FROM $wpdb->users;";
        // $wpdb->get_var( 'query', $column_offset, $row_offset );
        
    }    
}