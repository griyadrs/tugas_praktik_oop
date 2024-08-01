<?php
require_once 'Person.php';
require_once 'Book.php';
require_once 'Library.php';

// Create Class Librarian inherited from Class Person
class Librarian extends Person 
{
    private string $employeeID;

    // Initializing Librarian Property
    public function __construct(string $name, string $employeeID) 
    {
        parent::__construct($name);
        $this->employeeID = $employeeID;
    }

    // Add Book Method
    public function addBook(Book $book, Library $library) 
    {
        $library->addBook($book);

        return $library;
    }

    // Remove Book Method
    public function removeBook(Book $book, Library $library) 
    {
        $library->removeBook($book);
    }

    // Get info of Librarian
    public function getLibrarianInfo() 
    {
        return [
            'name' => $this->name,
            'employeeID' => $this->employeeID
        ];
    }
}