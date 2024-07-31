<?php
class Person {
    protected string $name;

    // Initializing  
    public function __construct($name) 
    {
        $this->name = $name;
    }

    // Return Name
    public function getName() 
    {

        return $this->name;
    }
}