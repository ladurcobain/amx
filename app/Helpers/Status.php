<?php

namespace App\Helpers;
use Carbon\Carbon;

class Status
{
    public static function tipeUser($type)
    {
        switch($type) {
            case 1 : 
                $string = "Administrator";
            break;
            case 2 : 
                $string = "Operator";
            break;
            
            default : 
                $string = "Administrator";
            break;
        }

        return $string;
    }

    public static function tipeStatus($type)
    {
        switch($type) {
            case true : 
                $string = "Aktif";
            break;
            case false : 
                $string = "Tdk Aktif";
            break;

            default : 
                $string = "Tdk Aktif";
            break;
        }

        return $string;
    }

    public static function generateYear()
    {
        $now = Carbon::now();
        $yearNow  = Carbon::createFromFormat('Y-m-d H:i:s', $now)->format('Y'); 
        
        $arr = array();
        for($i=0; $i<=2; $i++) {
            $arr[] = intval($yearNow) - $i;
        }
        
        return $arr;
    }

    public static function generateStar($val)
    {
        $string = '';
        $string .= '<div class="stars-wrapper">';

        if($val >= 5) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
        } 
        else if(($val >= 4.5) && ($val < 5)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star-half" style="color: orange;"></i>';
        }  
        else if(($val >= 4) && ($val < 4.5)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
        } 
        else if(($val >= 3.5) && ($val < 4)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star-half" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
        }    
        else if(($val >= 3) && ($val < 3.5)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        } 
        else if(($val >= 2.5) && ($val < 3)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star-half" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        }  
        else if(($val >= 2) && ($val < 2.5)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        } 
        else if(($val >= 1.5) && ($val < 2)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star-half" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        }
        else if(($val >= 1) && ($val < 1.5)) {
            $string .= '<i class="fas fa-star" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        } 
        else if(($val >= 0.5) && ($val < 1)) {
            $string .= '<i class="fas fa-star-half" style="color: orange;"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        }
        else {
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
            $string .= '<i class="fas fa-star"></i>';
        }

        $string .= '</div>';
        return $string;
    }

    public static function generateColor($val) {
        switch($val) {
            case 1 : 
                $string = "#734ba9";
            break;
            case 2 : 
                $string = "#2baab1";
            break;
            case 3 : 
                $string = "#0088cc";
            break;
            case 4 : 
                $string = "#e2a917";
            break;
            case 5 : 
                $string = "#e36159";
            break;
            default : 
                $string = "#EA4C89";
            break;
        }

        return $string;
    }

    public static function convertHtmlToText($str) {
        $str = strip_tags($str);
        $str = utf8_decode($str);
        $str = str_replace("&nbsp;", " ", $str);
        $str = preg_replace('/\s+/', ' ',$str);
        $str = trim($str);

        return $str;
    }

    public static function str_ellipsis($text, $length) {
        $text = Status::convertHtmlToText($text);
        if(strlen($text) > $length) {
            $str = substr($text, 0, $length) ." ...";
        }
        else {
            $str = $text;
        }

        return $str;
    }

    public static function monthName($value) {
        switch($value) {
            case "01" :
                $string = 'Januari';
            break;
            case "02" :
                $string = 'Februari';
            break;
            case "03" :
                $string = 'Maret';
            break;
            case "04" :
                $string = 'April';
            break;
            case "05" :
                $string = 'Mei';
            break;
            case "06" :
                $string = 'Juni';
            break;
            case "07" :
                $string = 'Juli';
            break;
            case "08" :
                $string = 'Agustus';
            break;
            case "09" :
                $string = 'September';
            break;
            case "10" :
                $string = 'Oktober';
            break;
            case "11" :
                $string = 'November';
            break;
            case "12" :
                $string = 'Desember';
            break;
            
            default :
                $string = '-';
            break;
        }

        return $string;
    }
}
