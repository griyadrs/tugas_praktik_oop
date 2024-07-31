<?php
require_once 'Book.php';
require_once 'Member.php';
require_once 'Librarian.php';

class Library {
    private array $books = []; 
    private array $members = [];
    private array $librarians = [];

    // Add book objects into $books array with ISBN as key.
    public function addBook(Book $book) 
    {
        $this->books[$book->getBookInfo()['isbn']] = $book;
    }

    // Remove book objects in $books array with ISBN as key
    public function removeBook(Book $book) 
    {
        unset($this->books[$book->getBookInfo()['isbn']]);
    }

    // Register new Member into the library system with memberID as key
    public function registerMember(Member $member) 
    {
        $this->members[$member->getMemberInfo()['memberID']] = $member;
    }

    // Register new librarians into the library system with employeeID as key
    public function registerLibrarian(Librarian $librarian) 
    {
        $this->librarians[$librarian->getLibrarianInfo()['employeeID']] = $librarian;
    }

    public function findBookByISBN($isbn) 
    {

        return isset($this->books[$isbn]) ? $this->books[$isbn] : null;
    }

    public function listAvailableBooks() 
    {

        return array_filter($this->books, function($book) {
            return $book->getBookInfo()['availableCopies'] > 0;
        });
    }

    public function listMembers() 
    {

        return $this->members;
    }

    public function listLibrarians() 
    {

        return $this->librarians;
    }
}