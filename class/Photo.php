<?php

class Photo {

    protected $id;
    protected $title;
    protected $description;
    protected $is_item;
    protected $is_photo;

    public function __constructor(){

    }

    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;
    }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setIsItem($is_item){
        $this->is_item = $is_item;
    }
    public function getIsItem(){
        return $this->is_item;
    }

    public function setIsPhoto($is_photo){
        $this->is_photo = $is_photo;
    }

    public function getIsPhoto(){
        return $this->is_photo;
    }

} 