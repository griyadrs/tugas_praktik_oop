<?php
require_once 'Library.php';
class Book 
{

    // General Types of Book
    private string $title,
        $author,
        $isbn;
    private int $publicationYear,
        $availableCopies;

    // initialize Book Properties
    public function __construct(
        string $title, 
        string $author,
        string $isbn, 
        int $publicationYear, 
        int $availableCopies
    ) {
        $this->title           = $title;
        $this->author          = $author;
        $this->isbn            = $isbn;
        $this->publicationYear = $publicationYear;
        $this->availableCopies = $availableCopies;
    }

    // Borrow Book Method
    public function borrowBook() 
    {
        if ($this->availableCopies > 0) {
            $this->availableCopies--;
            
            return true;
        }
        
        return false;
    }

    // Return Book Method
    public function returnBook() 
    {
        $this->availableCopies++;
    }

    // Return Detail of Book
    public function getBookInfo()
    {
        return [
            'title'           => $this->title,
            'author'          => $this->author,
            'isbn'            => $this->isbn,
            'publicationYear' => $this->publicationYear,
            'availableCopies' => $this->availableCopies
        ];
    }
}