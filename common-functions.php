<?php

class CommonFunctions{
    function base_url($path){
        return sprintf(
            '%s://%s/%s',
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME'],
            $path
        );
    }

    function admin_login_check(){
        if(!isset($_SESSION['AdminID'])){
            header('Location: ' . $this->base_url('login-admin.php'));
            die();
        }
    }

    function adviser_login_check(){
        if(!isset($_SESSION['AdviserID'])){
            header('Location: ' . $this->base_url('login-adviser.php'));
            die();
        }
    }

    function company_login_check(){
        if(!isset($_SESSION['CompanyID'])){
            header('Location: ' . $this->base_url('login-company.php'));
            die();
        }
    }

    function student_login_check(){
        if(!isset($_SESSION['StudentID'])){
            header('Location: ' . $this->base_url('login-student.php'));
            die();
        }
    }

    function validate($array, $config_array){
        $ret = array(
            'hasError' => false
        );
        foreach($config_array as $key => $config){
            $ret[$key]['value'] = $array[$key];
        //    echo $config['pattern'] . '<br/>';
            if(preg_match($config['pattern'], $array[$key])){
                $ret[$key]['hasError'] = false;
            }else{
                $ret[$key]['hasError'] = true;
                $ret[$key]['errorMsg'] = $config['errorMsg'];
                $ret['hasError'] = true;
            }
        }
        return $ret;
    }

    function get_regex_of_nationalities(){
        $nationalities = array(
            "Afghan",
            "Albanian",
            "Algerian",
            "American",
            "Andorran",
            "Angolan",
            "Antiguans",
            "Argentinean",
            "Armenian",
            "Australian",
            "Austrian",
            "Azerbaijani",
            "Bahamian",
            "Bahraini",
            "Bangladeshi",
            "Barbadian",
            "Barbudans",
            "Batswana",
            "Belarusian",
            "Belgian",
            "Belizean",
            "Beninese",
            "Bhutanese",
            "Bolivian",
            "Bosnian",
            "Brazilian",
            "British",
            "Bruneian",
            "Bulgarian",
            "Burkinabe",
            "Burmese",
            "Burundian",
            "Cambodian",
            "Cameroonian",
            "Canadian",
            "Cape Verdean",
            "Central African",
            "Chadian",
            "Chilean",
            "Chinese",
            "Colombian",
            "Comoran",
            "Congolese",
            "Costa Rican",
            "Croatian",
            "Cuban",
            "Cypriot",
            "Czech",
            "Danish",
            "Djibouti",
            "Dominican",
            "Dutch",
            "East Timorese",
            "Ecuadorean",
            "Egyptian",
            "Emirian",
            "Equatorial Guinean",
            "Eritrean",
            "Estonian",
            "Ethiopian",
            "Fijian",
            "Filipino",
            "Finnish",
            "French",
            "Gabonese",
            "Gambian",
            "Georgian",
            "German",
            "Ghanaian",
            "Greek",
            "Grenadian",
            "Guatemalan",
            "Guinea-Bissauan",
            "Guinean",
            "Guyanese",
            "Haitian",
            "Herzegovinian",
            "Honduran",
            "Hungarian",
            "I-Kiribati",
            "Icelander",
            "Indian",
            "Indonesian",
            "Iranian",
            "Iraqi",
            "Irish",
            "Israeli",
            "Italian",
            "Ivorian",
            "Jamaican",
            "Japanese",
            "Jordanian",
            "Kazakhstani",
            "Kenyan",
            "Kittian and Nevisian",
            "Kuwaiti",
            "Kyrgyz",
            "Laotian",
            "Latvian",
            "Lebanese",
            "Liberian",
            "Libyan",
            "Liechtensteiner",
            "Lithuanian",
            "Luxembourger",
            "Macedonian",
            "Malagasy",
            "Malawian",
            "Malaysian",
            "Maldivan",
            "Malian",
            "Maltese",
            "Marshallese",
            "Mauritanian",
            "Mauritian",
            "Mexican",
            "Micronesian",
            "Moldovan",
            "Monacan",
            "Mongolian",
            "Moroccan",
            "Mosotho",
            "Motswana",
            "Mozambican",
            "Namibian",
            "Nauruan",
            "Nepalese",
            "New Zealander",
            "Nicaraguan",
            "Nigerian",
            "Nigerien",
            "North Korean",
            "Northern Irish",
            "Norwegian",
            "Omani",
            "Pakistani",
            "Palauan",
            "Panamanian",
            "Papua New Guinean",
            "Paraguayan",
            "Peruvian",
            "Polish",
            "Portuguese",
            "Qatari",
            "Romanian",
            "Russian",
            "Rwandan",
            "Saint Lucian",
            "Salvadoran",
            "Samoan",
            "San Marinese",
            "Sao Tomean",
            "Saudi",
            "Scottish",
            "Senegalese",
            "Serbian",
            "Seychellois",
            "Sierra Leonean",
            "Singaporean",
            "Slovakian",
            "Slovenian",
            "Solomon Islander",
            "Somali",
            "South African",
            "South Korean",
            "Spanish",
            "Sri Lankan",
            "Sudanese",
            "Surinamer",
            "Swazi",
            "Swedish",
            "Swiss",
            "Syrian",
            "Taiwanese",
            "Tajik",
            "Tanzanian",
            "Thai",
            "Togolese",
            "Tongan",
            "Trinidadian or Tobagonian",
            "Tunisian",
            "Turkish",
            "Tuvaluan",
            "Ugandan",
            "Ukrainian",
            "Uruguayan",
            "Uzbekistani",
            "Venezuelan",
            "Vietnamese",
            "Welsh",
            "Yemenite",
            "Zambian",
            "Zimbabwean"
        );
        $ret = "/^(";
        foreach($nationalities as $nationality){
            if($nationality === "Zimbabwean"){
                $ret = $ret . $nationality . ')$/';
            }else{
                $ret = $ret . $nationality . '|';
            }
        }
        return $ret;
    }

    function date_validator($date){
        $date = explode('-', $date);
        if(count($date) < 3){
            return false;
        }

        $yyyy = $date[0];
        $mm = $date[1];
        $dd = $date[2];

        return checkdate($mm, $dd, $yyyy);
    }

    function get_regex_of_cities(){
        $cities = array(
            "Caloocan City",
            "Las Piñas City",
            "Makati City",
            "Malabon City",
            "Mandaluyong City",
            "Manila",
            "Marikina City",
            "Muntinlupa City",
            "Navotas City",
            "Parañaque City",
            "Pasay City",
            "Pasig City",
            "Pateros",
            "Quezon City",
            "San Juan City",
            "Taguig City",
            "Valenzuela City"
        );
        $ret = "/^(";
        foreach($cities as $city){
            if($city === "Valenzuela City"){
                $ret = $ret . $city . ')$/';
            }else{
                $ret = $ret . $city . '|';
            }
        }
        return $ret;
    }

    function get_regex_of_monthly_salary(){
        $salaryrange_tbl =
            GSecureSQL::query(
                "SELECT * FROM listofsalaryrangetbl",
                TRUE
            );

        $ret = "/^(";
        foreach ($salaryrange_tbl as $value) {
            $ret = $ret . $value[1] . '|';
        }
        substr_replace($ret, "", -1);
        $ret = $ret . ')$/';
        return $ret;
    }
}


$common_functions = new CommonFunctions;

