<?php

include "User.php";

class Staff extends User {

    protected $id;
    protected $work_place;
    protected $salary;
    protected $is_admin;
    protected $user_id;
    protected $user;

    public function __construct(){

    }

    public function getId(){
        return $this->id;
    }

    public function setWorkPlace($work_place){
        $this->work_place = $work_place;
    }

    public function getWorkPlace(){
        return $this->work_place;
    }

    public function setSalary($salary){
        $this->salary = $salary;
    }

    public function getSalary(){
        return $this->salary;
    }

    public function setIsAdmin($is_admin){
        $this->is_admin = $is_admin;
    }

    public function getIsAdmin(){
        return $this->is_admin;
    }

    public function setUserId($user_id){
        $this->user_id = $user_id;
    }

    public function getUserId(){
        return $this->user_id;
    }

    /*
    public function setUser(User $user=null){
        $this->user = $user;
        return $this;
    }

    public function getUser(){
        return $this->user;
    }
    */
}