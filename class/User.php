<?php


class User {

    protected $id;
    protected $name;
    protected $secname;
    protected $adress;
    protected $city;
    protected $jbg;
    protected $email;
    protected $passwd;
    protected $phone;
    protected $mphone;
    protected $is_staff;
    protected $image_url;
    protected $photo_id;
    protected $enabled;
    protected $checkuser_id;

    public function __construct(){

    }

    public function setID($id){
        $this->id = $id;
    }

    public function getID(){
        return $this->id;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setSecName($secname){
        $this->secname = $secname;
    }

    public function getSecName(){
        return $this->secname;
    }

    public function setAdress($adress){
        $this->adress = $adress;
    }

    public function getAdress(){
        return $this->adress;
    }

    public function setCity($city){
        $this->city = $city;
    }

    public function getCity(){
        return $this->city;
    }

    public function setJbg($jbg){
        $this->jbg = $jbg;
    }

    public function getJbg(){
        return $this->jbg;
    }

    public function setEmail($email){
        $this->email = $email;
    }

    public function getEmail(){
        return $this->email;
    }

    public function setPasswd($passwd){
        $this->passwd = $passwd;
    }

    public function getPasswd(){
        return $this->passwd;
    }

    public function setPhone($phone){
        $this->phone = $phone;
    }

    public function getPhone(){
        return $this->phone;
    }

    public function setMphone($mphone){
        $this->mphone = $mphone;
    }

    public function getMphone(){
        return $this->mphone;
    }

    public function setIsStaff($is_staff){
        $this->is_staff = $is_staff;
    }

    public function getIsStaff(){
        return $this->is_staff;
    }

    public function setImageUrl($image_url){
        $this->image_url = $image_url;
    }

    public function getImageUrl(){
        return $this->image_url;
    }

    public function setPhotoId($photo_id){
        $this->photo_id = $photo_id;
    }

    public function getPhotoId(){
        return $this->photo_id;
    }

    public function setEnabled($enabled){
        $this->enabled = $enabled;
    }

    public function getEnabled(){
        return $this->enabled;
    }

    public function setCheckUserId($checkuser_id){
        $this->checkuser_id = $checkuser_id;
    }

    public function getCheckUserId(){
        return $this->checkuser_id;
    }

} 