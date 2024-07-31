<?php
require_once 'Person.php';
require_once 'Book.php';

class Member extends Person {
    private string $memberID;
    private array $borrowedBooks = [];

    // Initializing name and memberID
    public function __construct($name, $memberID) 
    {
        parent::__construct($name);
        $this->memberID = $memberID;
    }

    // Borrow book Method in class Book
    public function borrowBook(Book $book)
    {
        // Calls the borrowBook ​​method of the Book object. If the loan is successful
        if ($book->borrowBook()) {

            // Add the borrowed Book object to the $borrowedBooks array.
            $this->borrowedBooks[] = $book;

            return true;
        }

        return false;
    }

    // Return book Method in class Book
    public function returnBook(Book $book) 
    {

        // Loop through all books borrowed by members
        foreach ($this->borrowedBooks as $key => $borrowedBook) {

            /* Check the ISBN of the book you are borrowing 
            is the same as the ISBN of the book you want to return*/
            if ($borrowedBook->getBookInfo()['isbn'] == $book->getBookInfo()['isbn']) {

                // Unset the book from the borrowedBooks array
                unset($this->borrowedBooks[$key]);
                
                // Increase the number of copies available
                $book->returnBook();
                
                return true;
            }
        }

        return false;
    }

    public function getMemberInfo() 
    {
        
        return [
            'name' => $this->name,
            'memberID' => $this->memberID,
            'borrowedBooks' => array_map(function($book) {
                return $book->getBookInfo();
            }, $this->borrowedBooks)
        ];
    }
}