<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        $userModel = new User;
        $datauser = [
            'datauser' => $userModel->getUser(),
            'datalevel' => $userModel->getLevel(),
        ];
        return view('general/v_user', $datauser);
    }

    public function createUser(Request $req){
        $userModel = new User;
        return $userModel->createUser($req);
    }

    public function updateUser($kodeuser){
        $userModel = new User;
        $datauser = $userModel->getUserByCode($kodeuser);
        if(count($datauser) != 0 ){
            $data = [
                'datauser' => $datauser[0],
                'datalevel' => $userModel->getLevel(),
            ];
            return view('/general/v_user_update', $data);
        }
        return redirect('/user/setup');
    }

    public function updateUserPost(Request $req){
        $userModel = new User;
        return $userModel->updateUser($req);
    }

    public function resetPass(Request $req){
        $userModel = new User;
        return $userModel->resetPass($req['idu']);
    }

    public function delUser(Request $req){
        $userModel = new User;
        return $userModel->delUser($req['idu']);
    }
}
