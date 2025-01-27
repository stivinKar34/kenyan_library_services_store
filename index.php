<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Kenyan Books Library Store</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="logo">The Kenyan Books Library Store (K.B.L.S)</h1>
            <nav>
                <ul class="nav-links">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#library">Library</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section id="home" class="hero">
        <div class="hero-content">
            <h2 class="welcoming">Welcome to The Kenyan Books Library Store</h2>
            <p>Open your gateway to a world of knowledge, stories, and inspiration with books.</p>
            <p>Grab your order and get your delivery at your nearest location</p>
            <a href="#library" class="btn">Explore Our Library Store</a>
        </div>
    </section>

    <section id="about" class="about">
        <div class="container">
            <h2>About Us</h2>
            <p>Explore the Kenyan Books Library Store—a modern platform offering an extensive
                 collection of books across various genres. 
                Browse our diverse selection below and provide your contact information to continue your 
                purchasing|ordering. You will receive feedback email immedietly !
                </p>
        </div>
    </section>

    <section id="library" class="library">
        <div class="container">
            <h2>Explore Our Library</h2>

            <input type="text" id="searchInput" placeholder="Search by title or author" 
            onkeyup="searchBooks()">




            <div id="book-list"></div>

              
 
    <div id="pagination" style="color: red; display: flex; justify-content: center; align-items: center; gap: 10px; margin-top: 20px;">></div>
              <!-- Books r added here -->
    



</div>

       








    </section>

    <section id="contact" class="contact">
        <div class="container">
            <h2>Contact Us</h2>

            <form method="POST" action="processForm.php">
                <input type="text"  name="name" placeholder="Your Name" required>
                <input type="email"  name="email" placeholder="Your Email" required>
                <textarea placeholder="Your Message" name="message" required></textarea>
                <button class="btn">Send</button>
            </form>
        </div>






    </section>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 The Kenyan Books Library Store (KBLS). All rights reserved.</p>
        </div>
    </footer>


<script>


document.addEventListener('DOMContentLoaded', () => {
    const booksPerPage = 4;
    let currentPage = 1;
    let books = [];

    // Fetch books from the server
    async function fetchBooks() {
        try {
            const response = await fetch('fetchBooks.php');
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            books = await response.json();
            displayBooks();
            updatePagination();
        } catch (error) {
            console.error('Error fetching books:', error);
            document.getElementById('book-list').textContent = 'Failed to load books.';
        }
    }

    // Display books based on the current page and search query
    function displayBooks() {
        const searchQuery = document.getElementById('searchInput').value.toLowerCase();
        const filteredBooks = books.filter(book => {
            return (
                book.title.toLowerCase().includes(searchQuery) ||
                book.author.toLowerCase().includes(searchQuery)
            );
        });

        const startIndex = (currentPage - 1) * booksPerPage;
        const endIndex = startIndex + booksPerPage;
        const booksToDisplay = filteredBooks.slice(startIndex, endIndex);

        const bookList = document.getElementById('book-list');
        bookList.innerHTML = '';

        if (booksToDisplay.length > 0) {
            const table = document.createElement('table');
            const headerRow = document.createElement('tr');
            ['ID', 'Title', 'Author', 'Price', 'Stock'].forEach(text => {
                const th = document.createElement('th');
                th.textContent = text;
                headerRow.appendChild(th);
            });
            table.appendChild(headerRow);

            booksToDisplay.forEach(book => {
                const row = document.createElement('tr');
                Object.values(book).forEach((text, index) => {
                    const td = document.createElement('td');
                    td.textContent = index === 3 ? `$${parseFloat(text).toFixed(2)}` : text;
                    row.appendChild(td);
                });
                table.appendChild(row);
            });

            bookList.appendChild(table);
        } else {
            bookList.textContent = 'No books found.';
        }
    }

    // Update pagination controls
    function updatePagination() {
        const searchQuery = document.getElementById('searchInput').value.toLowerCase();
        const filteredBooks = books.filter(book => {
            return (
                book.title.toLowerCase().includes(searchQuery) ||
                book.author.toLowerCase().includes(searchQuery)
            );
        });

        const totalBooks = filteredBooks.length;
        const totalPages = Math.ceil(totalBooks / booksPerPage);

        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        const prevButton = document.createElement('button');
        prevButton.textContent = 'Previous';
        prevButton.disabled = currentPage === 1;
        prevButton.addEventListener('click', () => {
            if (currentPage > 1) {
                currentPage--;
                displayBooks();
                updatePagination();
            }
        });
        pagination.appendChild(prevButton);

        const pageInfo = document.createElement('span');
        pageInfo.textContent = ` Page ${currentPage} of ${totalPages} `;
        pagination.appendChild(pageInfo);

        const nextButton = document.createElement('button');
        nextButton.textContent = 'Next';
        nextButton.disabled = currentPage === totalPages;
        nextButton.addEventListener('click', () => {
            if (currentPage < totalPages) {
                currentPage++;
                displayBooks();
                updatePagination();
            }
        });
        pagination.appendChild(nextButton);
    }

    // Search function
    window.searchBooks = function() {
        currentPage = 1; // Reset to first page on new search
        displayBooks();
        updatePagination();
    };

    // Initialize by fetching books
    fetchBooks();
});
</script>





</body>
</html>
