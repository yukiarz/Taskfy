<?php

  function userID(){
    return session()->get('user_id');
  }
  function branchID(){
    return session()->get('branch_id');
  }

  function checkPermission($permissions){
    $userAccess = getMyPermission(auth()->user()->userSetting->level);
    foreach ($permissions as $key => $value) {
      if($value == $userAccess){
        return true;
      }
    }
    return false;
  }


  function getMyPermission($id){
    if($id == 1){
      return 'superuser';
    }else{
      return 'user';
    }
  }


?>