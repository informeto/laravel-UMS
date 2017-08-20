<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Library\CSVStorage;
use App\Library\DataValidation;

class ContactController extends Controller
{
    //
    public function receiveInput()
    {
      return view('contact.receiver');
    }
    
    public function register(Request $req){
        $name = $req->input('name');
        $email = $req->input('email');
        $phone = $req->input('phone');
        $gender = $req->input('gender');
        $dob = $req->input('dob');
        $nationality = $req->input('nationality');
        $address = $req->input('address');
        $education = $req->input('education');
        $pref_comm = $req->input('pref_comm');
        
        $receivedData = [
            'name' => $name, 
            'email' => $email,
            'phone' => $phone, 
            'pref_comm' => $pref_comm,
            'gender' => $gender, 
            'dob' => $dob, 
            'nationality' => $nationality, 
            'address' => $address, 
            'education' => $education
        ];
        
        foreach($receivedData as $name => $val){
            if (!DataValidation::validateField($name, $val)){
                echo json_encode(['success'=>false, 'error' => $name.' not filled properly.']);
                return;
            }
        }
        
        $receivedData['address'] = json_encode($receivedData['address']);
        $receivedData['education'] = json_encode($receivedData['education']);
        
        CSVStorage::store($receivedData);
        echo json_encode(['success' => 'true']);
    }
    
    public function viewRegistrations()
    {
      $users = CSVStorage::getRegisteredUsers();
      return view('contact.view', ['first_users_list' => urlencode(json_encode($users))]);
    }
    
    public function getUsers($page){
        echo json_encode(CSVStorage::getRegisteredUsers($page*10, 10));
    }
    
}
