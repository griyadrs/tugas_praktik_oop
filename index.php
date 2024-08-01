<!DOCTYPE html>
  <html lang="en">
  
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" 
      content="width=device-width, 
      initial-scale=1.0">
    <title>Library Management System</title>
  
    <!-- My Simple Style -->
    <style>
      body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
      }

      .container {
        width: 80%;
        margin: auto;
        overflow: hidden;
      }

      header {
        background: #333;
        color: #fff;
        padding-top: 30px;
        min-height: 70px;
        border-bottom: #0779e4 3px solid;
      }

      header a {
        color: #fff;
        text-decoration: none;
        text-transform: uppercase;
        font-size: 16px;
      }
  
      header ul {
        padding: 0;
        list-style: none;
      }
  
      header li {
        display: inline;
        padding: 0 20px 0 20px;
      }
  
      .main {
        padding: 20px;
        background: #fff;
        margin-top: 20px;
        border: 1px solid #ddd;
      }
  
      .main h2 {
        text-align: center;
        color: #333;
      }
  
      .book,
      .member {
        padding: 10px;
        border: 1px solid #ddd;
        margin-bottom: 10px;
        background: #f9f9f9;
      }
  
      .book h3,
      .member h3 {
        margin-top: 0;
      }
  
      .btn {
        display: inline-block;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        outline: none;
        color: #fff;
        background-color: #333;
        border: none;
        border-radius: 15px;
        box-shadow: 0 9px #999;
      }
  
      .btn:hover {
        background-color: #555
      }
  
      .btn:active {
        background-color: #555;
        box-shadow: 0 5px #666;
        transform: translateY(4px);
      }
    </style>
  </head>
  
  <body>
    <header>
      <div class="container">
        <h1>Library Management System</h1>
      </div>
    </header>

    <div class="container main">
      <?php
  
      // Include/Require File
      require_once 'Book.php';
      require_once 'Member.php';
      require_once 'Librarian.php';
      require_once 'Library.php';
  
      // Create New Object => Library
      $library = new Library();
  
      // Create New Object => Librarian
      $librarian = new Librarian('Adi', 'L001');
      $library->registerLibrarian($librarian);
  
      // Create New Object => Member
      $member1 = new Member('Arya', 'M001');
      $member2 = new Member('Luke', 'M002');
  
      // Insert New Member
      $library->registerMember($member1);
      $library->registerMember($member2);
  
      // Create New Object => Book
      $book1 = new Book('Woman Heart', 'Kobe Bryant', '0001', 1998, 1);
      $book2 = new Book('November Rain', 'Giorno Giovana', '0002', 1999, 14);
      $book3 = new Book('Man World II',   'Valen de Caste', '0003', 2003, 23);
  
      // Librarian Insert Book Into Library
      $library = $librarian->addBook($book1, $library);
      $library = $librarian->addBook($book2, $library);
      $library = $librarian->addBook($book3, $library);
  
      // Librarian Remove Book Into Library
      $library->removeBook($book2);
  
      // Member Borrow Books
      $member1->borrowBook($library, $book2);
      $member2->borrowBook($library, $book2);
  
      // Member Return Books
      $member2->returnBook($book3);
  
      // Search Book
      echo '<h2>Search</h2>';
      $foundBook = $library->findBookByISBN('0003');
      if ($foundBook) {
          echo '<h3> Book found : ' . $foundBook->getBookInfo()['title'] . '</h3>';
      } else {
          echo 'Book not found.';
      }
      echo '<br><br><br>';
  
      // Displays books available in the library
      echo '<h2>Library Books</h2>';
      echo "<div class='book-list'>";
      foreach ($library->listAvailableBooks() as $book) :
        $bookInfo = $book->getBookInfo();
        echo "<div class='book'>
          <h3>{$bookInfo['title']}</h3>
          <p>Author: {$bookInfo['author']}</p>
          <p>ISBN: {$bookInfo['isbn']}</p>
          <p>Publication Year: {$bookInfo['publicationYear']}</p>
          <p>Available Copies: {$bookInfo['availableCopies']}</p>
        </div>";
      endforeach;
      echo "</div>";
  
      // Display Members of Library
      echo '<h2>Members</h2>';
      echo "<div class='member-list'>";
      foreach ($library->listMembers() as $member) :
        $memberInfo = $member->getMemberInfo();
        echo "<div class='member'>
          <h3>{$memberInfo['name']}</h3>
          <p>Member ID: {$memberInfo['memberID']}</p>
          <p>Borrowed Books: " . count($memberInfo['borrowedBooks']) . "</p>
        </div>";
      endforeach;
      echo "</div>";
  
  
      // Display Librarians of Library
      echo '<h2>Librarians</h2>';
      echo "<div class='member-list'>";
      foreach ($library->listLibrarians() as $librarian) :
        $librarianInfo = $librarian->getLibrarianInfo();
        echo "<div class='member'>
          <h3>{$librarianInfo['name']}</h3>
          <p>Member ID: {$librarianInfo['employeeID']}</p>
        </div>";
      endforeach;
      echo "</div>";
      ?>
    </div>
  </body>
</html>