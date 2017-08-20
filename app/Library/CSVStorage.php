<?php
use Storage;

namespace App\Library{
    class CSVStorage{
        private static function getFilePath(){
            return \Storage::disk('csv')->getDriver()->getAdapter()->applyPathPrefix('registrations.csv');
        }
        
        static function store($data){
            $filepath = self::getFilePath();
            $fp = fopen($filepath, 'a');
            fputcsv($fp, $data);
            fclose($fp);
        }
        
        static function getRegisteredUsers($from=0, $limit=10){
            $reg_data = [];
            $row = 1;
            $to = $from + $limit;
            $filepath = self::getFilePath();
            if (($handle = fopen($filepath, "r")) !== FALSE) {
                while (($data = fgetcsv($handle)) !== FALSE) {
                    if($row > $from && $row <= $to){
                        $reg_data[] = $data;
                    }
                    $row++;
                    if($row > $to){
                        break;
                    }
                }
                fclose($handle);
            }
            
            $users = [];
            foreach($reg_data as $user_raw_data){
                $userData = [
                    'name' => $user_raw_data[0], 
                    'email' => $user_raw_data[1],
                    'phone' => $user_raw_data[2], 
                    'pref_comm' => $user_raw_data[3],
                    'gender' => $user_raw_data[4], 
                    'dob' => $user_raw_data[5], 
                    'nationality' => $user_raw_data[6], 
                    'address' => json_decode($user_raw_data[7]), 
                    'education' => json_decode($user_raw_data[8]),
                    'registration_time' => $user_raw_data[9]
                ];
                
                $users[] = $userData;
            }
            
            return $users;
        }
    }
}
