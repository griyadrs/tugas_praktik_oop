<?php
require_once 'Book.php';
require_once 'Member.php';
require_once 'Librarian.php';

class Library
{
    public array $books = [],
    $members = [],
    $librarians = [],
    $borrowedBooks = [];

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

    public function findBookByISBN($isbn)
    {
        return $this->books[$isbn] ?? null;
    }

    public function listAvailableBooks()
    {
        return array_filter($this->books, function ($book) {
            
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