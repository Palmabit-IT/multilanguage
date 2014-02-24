<?php  namespace Palmabit\Multilanguage\Helper;
/**
 * Class TranslateHelper
 *
 * @author jacopo beschi j.beschi@palmabit.com
 */
use L;
use DB;

class TranslateHelper 
{
    protected static $slug_lingua_field = "slug_lingua";
    protected static $lang_field = "lang";
    protected static $slug_field = "slug";

    /**
     * Translates slug based on the current language
     * @param      $slug
     * @param      $table
     * @param bool $is_admin se vedere lingua admin o lingua client
     */
    public static function translateSlug($slug, $table, $is_admin = false)
    {
        $lang = $is_admin ? L::get_admin() : L::get();

        $slug_lingua = DB::table($table)->where(static::$slug_field,"=",$slug)->pluck('slug_lingua');

        return DB::table($table)->where(static::$slug_lingua_field, "=", $slug_lingua)
            ->where(static::$lang_field, "=", $lang)
            ->pluck(static::$slug_field);
    }
} 