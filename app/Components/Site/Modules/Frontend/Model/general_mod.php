<?php

namespace App\Components\Site\Modules\Frontend\Model;

use Illuminate\Database\Eloquent\Model;
use Session;

class general_mod extends Model
{
    public static function checkUserInfo($userInfo=array(), $role=NULL)
    {
        $chk = TRUE;

        if($role == 'caregiver'):
            if(!$userInfo->educations)		$chk = FALSE;
            if(!$userInfo->job_experiences) $chk = FALSE;
        endif;

        return $chk;
    }

    public static function bindingUserType()
    {
        $control['CareClient'] = 'CareClient';
        $control['CareGiver'] = 'CareGiver';

        return $control;
    }

    public static function bindingCountry()
    {
        $control = array(
            ""	=> "Choose Country",
            "Afghanistan" => "Afghanistan",
            "Albania" => "Albania",
            "Algeria" => "Algeria",
            "American Samoa" => "American Samoa",
            "Andorra" => "Andorra",
            "Angola" => "Angola",
            "Anguilla" => "Anguilla",
            "Antarctica" => "Antarctica",
            "Antigua and Barbuda" => "Antigua and Barbuda",
            "Argentina" => "Argentina",
            "Armenia" => "Armenia",
            "Aruba" => "Aruba",
            "Australia" => "Australia",
            "Austria" => "Austria",
            "Azerbaijan" => "Azerbaijan",
            "Bahamas" => "Bahamas",
            "Bahrain" => "Bahrain",
            "Bangladesh" => "Bangladesh",
            "Barbados" => "Barbados",
            "Belarus" => "Belarus",
            "Belgium" => "Belgium",
            "Belize" => "Belize",
            "Benin" => "Benin",
            "Bermuda" => "Bermuda",
            "Bhutan" => "Bhutan",
            "Bolivia" => "Bolivia",
            "Bosnia and Herzegowina" => "Bosnia and Herzegowina",
            "Botswana" => "Botswana",
            "Bouvet Island" => "Bouvet Island",
            "Brazil" => "Brazil",
            "British Indian Ocean Territory" => "British Indian Ocean Territory",
            "Brunei Darussalam" => "Brunei Darussalam",
            "Bulgaria" => "Bulgaria",
            "Burkina Faso" => "Burkina Faso",
            "Burundi" => "Burundi",
            "Cambodia" => "Cambodia",
            "Cameroon" => "Cameroon",
            "Canada" => "Canada",
            "Cape Verde" => "Cape Verde",
            "Cayman Islands" => "Cayman Islands",
            "Central African Republic" => "Central African Republic",
            "Chad" => "Chad",
            "Chile" => "Chile",
            "China" => "China",
            "Christmas Island" => "Christmas Island",
            "Cocos (Keeling) Islands" => "Cocos (Keeling) Islands",
            "Colombia" => "Colombia",
            "Comoros" => "Comoros",
            "Congo" => "Congo",
            "Congo, the Democratic Republic of the" => "Congo, the Democratic Republic of the",
            "Cook Islands" => "Cook Islands",
            "Costa Rica" => "Costa Rica",
            "Cote d'Ivoire" => "Cote d'Ivoire",
            "Croatia (Hrvatska)" => "Croatia (Hrvatska)",
            "Cuba" => "Cuba",
            "Cyprus" => "Cyprus",
            "Czech Republic" => "Czech Republic",
            "Denmark" => "Denmark",
            "Djibouti" => "Djibouti",
            "Dominica" => "Dominica",
            "Dominican Republic" => "Dominican Republic",
            "East Timor" => "East Timor",
            "Ecuador" => "Ecuador",
            "Egypt" => "Egypt",
            "El Salvador" => "El Salvador",
            "Equatorial Guinea" => "Equatorial Guinea",
            "Eritrea" => "Eritrea",
            "Estonia" => "Estonia",
            "Ethiopia" => "Ethiopia",
            "Falkland Islands (Malvinas)" => "Falkland Islands (Malvinas)",
            "Faroe Islands" => "Faroe Islands",
            "Fiji" => "Fiji",
            "Finland" => "Finland",
            "France" => "France",
            "France Metropolitan" => "France Metropolitan",
            "French Guiana" => "French Guiana",
            "French Polynesia" => "French Polynesia",
            "French Southern Territories" => "French Southern Territories",
            "Gabon" => "Gabon",
            "Gambia" => "Gambia",
            "Georgia" => "Georgia",
            "Germany" => "Germany",
            "Ghana" => "Ghana",
            "Gibraltar" => "Gibraltar",
            "Greece" => "Greece",
            "Greenland" => "Greenland",
            "Grenada" => "Grenada",
            "Guadeloupe" => "Guadeloupe",
            "Guam" => "Guam",
            "Guatemala" => "Guatemala",
            "Guinea" => "Guinea",
            "Guinea-Bissau" => "Guinea-Bissau",
            "Guyana" => "Guyana",
            "Haiti" => "Haiti",
            "Heard and Mc Donald Islands" => "Heard and Mc Donald Islands",
            "Holy See (Vatican City State)" => "Holy See (Vatican City State)",
            "Honduras" => "Honduras",
            "Hong Kong" => "Hong Kong",
            "Hungary" => "Hungary",
            "Iceland" => "Iceland",
            "India" => "India",
            "Indonesia" => "Indonesia",
            "Iran (Islamic Republic of)" => "Iran (Islamic Republic of)",
            "Iraq" => "Iraq",
            "Ireland" => "Ireland",
            "Israel" => "Israel",
            "Italy" => "Italy",
            "Jamaica" => "Jamaica",
            "Japan" => "Japan",
            "Jordan" => "Jordan",
            "Kazakhstan" => "Kazakhstan",
            "Kenya" => "Kenya",
            "Kiribati" => "Kiribati",
            "Korea, Democratic People's Republic of" => "Korea, Democratic People's Republic of",
            "Korea, Republic of" => "Korea, Republic of",
            "Kuwait" => "Kuwait",
            "Kyrgyzstan" => "Kyrgyzstan",
            "Lao, People's Democratic Republic" => "Lao, People's Democratic Republic",
            "Latvia" => "Latvia",
            "Lebanon" => "Lebanon",
            "Lesotho" => "Lesotho",
            "Liberia" => "Liberia",
            "Libyan Arab Jamahiriya" => "Libyan Arab Jamahiriya",
            "Liechtenstein" => "Liechtenstein",
            "Lithuania" => "Lithuania",
            "Luxembourg" => "Luxembourg",
            "Macau" => "Macau",
            "Macedonia, The Former Yugoslav Republic of" => "Macedonia, The Former Yugoslav Republic of",
            "Madagascar" => "Madagascar",
            "Malawi" => "Malawi",
            "Malaysia" => "Malaysia",
            "Maldives" => "Maldives",
            "Mali" => "Mali",
            "Malta" => "Malta",
            "Marshall Islands" => "Marshall Islands",
            "Martinique" => "Martinique",
            "Mauritania" => "Mauritania",
            "Mauritius" => "Mauritius",
            "Mayotte" => "Mayotte",
            "Mexico" => "Mexico",
            "Micronesia, Federated States of" => "Micronesia, Federated States of",
            "Moldova, Republic of" => "Moldova, Republic of",
            "Monaco" => "Monaco",
            "Mongolia" => "Mongolia",
            "Montserrat" => "Montserrat",
            "Morocco" => "Morocco",
            "Mozambique" => "Mozambique",
            "Myanmar" => "Myanmar",
            "Namibia" => "Namibia",
            "Nauru" => "Nauru",
            "Nepal" => "Nepal",
            "Netherlands" => "Netherlands",
            "Netherlands Antilles" => "Netherlands Antilles",
            "New Caledonia" => "New Caledonia",
            "New Zealand" => "New Zealand",
            "Nicaragua" => "Nicaragua",
            "Niger" => "Niger",
            "Nigeria" => "Nigeria",
            "Niue" => "Niue",
            "Norfolk Island" => "Norfolk Island",
            "Northern Mariana Islands" => "Northern Mariana Islands",
            "Norway" => "Norway",
            "Oman" => "Oman",
            "Pakistan" => "Pakistan",
            "Palau" => "Palau",
            "Panama" => "Panama",
            "Papua New Guinea" => "Papua New Guinea",
            "Paraguay" => "Paraguay",
            "Peru" => "Peru",
            "Philippines" => "Philippines",
            "Pitcairn" => "Pitcairn",
            "Poland" => "Poland",
            "Portugal" => "Portugal",
            "Puerto Rico" => "Puerto Rico",
            "Qatar" => "Qatar",
            "Reunion" => "Reunion",
            "Romania" => "Romania",
            "Russian Federation" => "Russian Federation",
            "Rwanda" => "Rwanda",
            "Saint Kitts and Nevis" => "Saint Kitts and Nevis",
            "Saint Lucia" => "Saint Lucia",
            "Saint Vincent and the Grenadines" => "Saint Vincent and the Grenadines",
            "Samoa" => "Samoa",
            "San Marino" => "San Marino",
            "Sao Tome and Principe" => "Sao Tome and Principe",
            "Saudi Arabia" => "Saudi Arabia",
            "Senegal" => "Senegal",
            "Seychelles" => "Seychelles",
            "Sierra Leone" => "Sierra Leone",
            "Singapore" => "Singapore",
            "Slovakia (Slovak Republic)" => "Slovakia (Slovak Republic)",
            "Slovenia" => "Slovenia",
            "Solomon Islands" => "Solomon Islands",
            "Somalia" => "Somalia",
            "South Africa" => "South Africa",
            "South Georgia and the South Sandwich Islands" => "South Georgia and the South Sandwich Islands",
            "Spain" => "Spain",
            "Sri Lanka" => "Sri Lanka",
            "St. Helena" => "St. Helena",
            "St. Pierre and Miquelon" => "St. Pierre and Miquelon",
            "Sudan" => "Sudan",
            "Suriname" => "Suriname",
            "Svalbard and Jan Mayen Islands" => "Svalbard and Jan Mayen Islands",
            "Swaziland" => "Swaziland",
            "Sweden" => "Sweden",
            "Switzerland" => "Switzerland",
            "Syrian Arab Republic" => "Syrian Arab Republic",
            "Taiwan, Province of China" => "Taiwan, Province of China",
            "Tajikistan" => "Tajikistan",
            "Tanzania, United Republic of" => "Tanzania, United Republic of",
            "Thailand" => "Thailand",
            "Togo" => "Togo",
            "Tokelau" => "Tokelau",
            "Tonga" => "Tonga",
            "Trinidad and Tobago" => "Trinidad and Tobago",
            "Tunisia" => "Tunisia",
            "Turkey" => "Turkey",
            "Turkmenistan" => "Turkmenistan",
            "Turks and Caicos Islands" => "Turks and Caicos Islands",
            "Tuvalu" => "Tuvalu",
            "Uganda" => "Uganda",
            "Ukraine" => "Ukraine",
            "United Arab Emirates" => "United Arab Emirates",
            "United Kingdom" => "United Kingdom",
            "United States" => "United States",
            "United States Minor Outlying Islands" => "United States Minor Outlying Islands",
            "Uruguay" => "Uruguay",
            "Uzbekistan" => "Uzbekistan",
            "Vanuatu" => "Vanuatu",
            "Venezuela" => "Venezuela",
            "Vietnam" => "Vietnam",
            "Virgin Islands (British)" => "Virgin Islands (British)",
            "Virgin Islands (U.S.)" => "Virgin Islands (U.S.)",
            "Wallis and Futuna Islands" => "Wallis and Futuna Islands",
            "Western Sahara" => "Western Sahara",
            "Yemen" => "Yemen",
            "Yugoslavia" => "Yugoslavia",
            "Zambia" => "Zambia",
            "Zimbabwe" => "Zimbabwe");
        return $control;
    }

    public static function upload_image_crop200x200($img_name=NULL, $dir=NULL, $x1=NULL, $y1=NULL, $w=NULL, $h=NULL)
    {
        $msg = array();
        $newImgName = md5(time().rand()).".jpg";
        $iWidth = 200;
        $iHeight = 200; // desired image result dimensions
        $iJpgQuality = 90;

        $newimg = imagecreatetruecolor($iWidth, $iHeight);
        $ext = General_mod::getExt($img_name);

        if($ext=="jpg" || $ext=="jpeg" ){
            $source = imagecreatefromjpeg($dir.'/'.$img_name);
        }
        else if($ext=="png"){
            $source = imagecreatefrompng($dir.'/'.$img_name);
        }
        else {
            $source = imagecreatefromgif($dir.'/'.$img_name);
        }

        imagecopyresampled($newimg, $source, 0, 0, (int)$x1, (int)$y1, $iWidth, $iHeight, (int)$w, (int)$h);
        imagejpeg($newimg, $dir.'/'.$newImgName, $iJpgQuality);
        @unlink($dir.'/'.$img_name);
        imagedestroy($newimg);

        return $newImgName;
    }

    public static function getExt($img) {
        $pos = strrpos($img,".");
        if (!$pos) {
            return "null";
        }
        $len = strlen($img) - $pos;
        $ext = substr($img,$pos+1,$len);
        return strtolower($ext);
    }

    public static function debug($data, $wPre=1, $title=''){
        $title = (!empty($title)) ? "<h2>$title</h2>" : "";
        echo "<div style='clear:both; background:white; border:red 1px solid; padding:10px; margin-left: 270px;'>$title Debug Time: ".time()."<br>";
        if($wPre==1){
            echo "<pre>";print_r($data);echo "</pre>";
        }else{
            echo "<hr>";print_r($data);echo "<hr>";
        }
        echo "</div>";
    }

    public static function formatRoleUserName($roleUser=''){
        if(empty($roleUser) || strlen($roleUser)<5 || (strpos($roleUser, 'care') === FALSE)) return $roleUser;

        switch ($roleUser) {
            case 'caregiver':
                return 'CareGiver';

            case 'careclient':
                return 'CareClient';

            default:
                return '';
        }
    }

}