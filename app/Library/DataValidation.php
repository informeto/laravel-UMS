<?php

/*
    Contacts Manager Demo
*/
namespace App\Library{
    class DataValidation{
        static function validateField($type, $input){
            switch($type){
                case 'name':
                    return preg_match('/^[a-zA-Z\s]{5,30}$/', $input);

                case 'email':
                    return preg_match('/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/', $input);

                case 'gender':
                    return $input == 'M' || $input == 'F';

                case 'dob':
                    $date = date_create_from_format('d/m/Y', $input);
                    return time() > date_timestamp_get($date);

                case 'phone':
                    return preg_match('/^\+?([0-9]{0,3})\)?[-. ]?([0-9]{9,11})$/', $input);

                case 'nationality':
                case 'country':
                    $countries = ["afghanistan","albania","algeria","american samoa","andorra","angola","anguilla","antarctica","antigua and barbuda","arctic ocean","argentina","armenia","aruba","ashmore and cartier islands","atlantic ocean","australia","austria","azerbaijan","bahamas","bahrain","baltic sea","baker island","bangladesh","barbados","bassas da india","belarus","belgium","belize","benin","bermuda","bhutan","bolivia","borneo","bosnia and herzegovina","botswana","bouvet island","brazil","british virgin islands","brunei","bulgaria","burkina faso","burundi","cambodia","cameroon","canada","cape verde","cayman islands","central african republic","chad","chile","china","christmas island","clipperton island","cocos islands","colombia","comoros","cook islands","coral sea islands","costa rica","croatia","cuba","cyprus","czech republic","democratic republic of the congo","denmark","djibouti","dominica","dominican republic","east timor","ecuador","egypt","el salvador","equatorial guinea","eritrea","estonia","ethiopia","europa island","falkland islands","faroe islands","fiji","finland","france","french guiana","french polynesia","french southern and antarctic lands","gabon","gambia","gaza strip","georgia","germany","ghana","gibraltar","glorioso islands","greece","greenland","grenada","guadeloupe","guam","guatemala","guernsey","guinea","guinea-bissau","guyana","haiti","heard island and mcdonald islands","honduras","hong kong","howland island","hungary","iceland","india","indian ocean","indonesia","iran","iraq","ireland","isle of man","israel","italy","jamaica","jan mayen","japan","jarvis island","jersey","johnston atoll","jordan","juan de nova island","kazakhstan","kenya","kerguelen archipelago","kingman reef","kiribati","kosovo","kuwait","kyrgyzstan","laos","latvia","lebanon","lesotho","liberia","libya","liechtenstein","lithuania","luxembourg","macau","macedonia","madagascar","malawi","malaysia","maldives","mali","malta","marshall islands","martinique","mauritania","mauritius","mayotte","mediterranean sea","mexico","micronesia","midway islands","moldova","monaco","mongolia","montenegro","montserrat","morocco","mozambique","myanmar","namibia","nauru","navassa island","nepal","netherlands","netherlands antilles","new caledonia","new zealand","nicaragua","niger","nigeria","niue","norfolk island","north korea","north sea","northern mariana islands","norway","oman","pacific ocean","pakistan","palau","palmyra atoll","panama","papua new guinea","paracel islands","paraguay","peru","philippines","pitcairn islands","poland","portugal","puerto rico","qatar","republic of the congo","reunion","romania","ross sea","russia","rwanda","saint helena","saint kitts and nevis","saint lucia","saint pierre and miquelon","saint vincent and the grenadines","samoa","san marino","sao tome and principe","saudi arabia","senegal","serbia","seychelles","sierra leone","singapore","slovakia","slovenia","solomon islands","somalia","south africa","south georgia and the south sandwich islands","south korea","southern ocean","spain","spratly islands","sri lanka","sudan","suriname","svalbard","swaziland","sweden","switzerland","syria","taiwan","tajikistan","tanzania","tasman sea","thailand","togo","tokelau","tonga","trinidad and tobago","tromelin island","tunisia","turkey","turkmenistan","turks and caicos islands","tuvalu","uganda","ukraine","united arab emirates","united kingdom","uruguay","usa","uzbekistan","vanuatu","venezuela","viet nam","virgin islands","wake island","wallis and futuna","west bank","western sahara","yemen","zambia","zimbabwe"];
                    return in_array(strtolower($input), $countries);

                case 'education':
                    if(!$input){
                        return true;
                    }
                    foreach ($input as $ed){
                        if(strlen($ed['degree']) < 2 || strlen($ed['degree']) > 50 )
                            return;

                        if(strlen($ed['institute']) < 2 || strlen($ed['institute']) > 100 )
                            return;

                        $completion_date = date_create_from_format('Y', $ed['year']);
                            return date_timestamp_get($completion_date) <= time();

                    }

                    return true;

                case 'address':
                    if(strlen($input['line1']) < 5 || strlen($input['line1']) > 100 )
                        return;

                    if(strlen($input['city']) < 3 || strlen($input['city']) > 100 )
                        return;

                    if(strlen($input['region']) < 2 || strlen($input['region']) > 50 )
                        return;

                    $zipmatch = preg_match('/^[1-9][0-9]{3,7}$/', $input['zip']);
                    if(!$zipmatch)
                        return;

                    if(!self::validateField('country', $input['country'])){
                        return;
                    }

                    return true;
                    
                default:
                    return true;
            }
        }
    }
}