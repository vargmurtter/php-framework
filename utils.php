<?php 
require_once "settings.php";

class Utils 
{
    public static function is_digits(string $str, int $min = 9, int $max = 14): bool 
    {
        return preg_match('/^[0-9]{'.$min.','.$max.'}\z/', $str);
    }
    
    public static function is_valid_phone(string $phone, int $min = 9, int $max = 14): bool 
    {
        $phone = str_replace([' ', '.', '-', '(', ')', '+'], '', $phone);
        return Utils::is_digits($phone, $min, $max); 
    }
    
    public static function hash_str(string $str): string
    {
        return md5(SECRET . "/" . $str);
    }
    
    public static function form_set_value_if_exists(string $name, bool $is_textarea = false): string
    {
        if (isset($_POST[$name])) {
            $value = $_POST[$name];
            return $is_textarea ? $value : "value=\"$value\"";
        }else{
            return "";
        }
    }
    
    public static function form_set_selected_if_exists(string $name, string|int $value): string
    {
        if (isset($_POST[$name])) {
            if ($_POST[$name] == $value)
                return "selected";
            else
                return "";
        }
        else return "";
    }
    
    public static function custom_get_browser()
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $browser = "N/A";
    
        $browsers = [
            '/msie/i' => 'Internet explorer',
            '/firefox/i' => 'Firefox',
            '/safari/i' => 'Safari',
            '/chrome/i' => 'Chrome',
            '/edge/i' => 'Edge',
            '/opera/i' => 'Opera',
            '/mobile/i' => 'Mobile browser',
        ];
    
        foreach ($browsers as $regex => $value) {
            if (preg_match($regex, $user_agent)) {
                $browser = $value;
            }
        }
    
        return $browser;
    }

    public static function get_ip()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }

    public static function get_static(string $path) 
    {
        return APP_URL . $path . "?u=" . uniqid();
    }
}


?>