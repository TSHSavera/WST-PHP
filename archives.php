<!DOCTYPE html>
<html>
    <head>
        <title>Archives</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>

    <body> 
        <div class="container">
            <div class="header">
                <div class="header-el">
                    <h1>Book Keeping <span class="color-three">System</span></h1>
                </div>
                <div class="header-el"></div>
                <div class="header-el">
                    <button class="href-btn bg-one" onclick="window.location.href='index.php'">Go Back to Main Page</button>
                </div>
            </div>

            <div class="grid-container vertical">
                <div class="content">
                    <h2 class="action">Archives</h2>
                    <p class="action-description">Click the button below to add a new book to the system.</p>
                </div>
                <div class="content card">
                    <h3 class="bg-two">Archived Books</h3>
                    <table class="books-table">
                        <thead class="bg-three">
                            <tr>
                                <th>Title</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>Date Published</th>
                                <th>ISBN</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Book Title</td>
                                <td>Author Name</td>
                                <td>Book Category</td>
                                <td>Book Date Published</td>
                                <td>Book ISBN</td>
                                <td><button class="bg-five">More Info</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            // Load the books from the database
            window.onload = function() {
                // Clear the table body
                document.querySelector('.books-table tbody').innerHTML = '';
                // Create a new XMLHttpRequest object
                var xhr = new XMLHttpRequest();

                // Open a new connection to the server
                xhr.open('GET', 'getArchives.php', true);

                // Set the request header
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                // Check the response status
                xhr.onreadystatechange = function() {
                    if(xhr.readyState == 4 && xhr.status == 200) {
                        // Parse the JSON response
                        var books = JSON.parse(xhr.responseText);

                        // Get the table body
                        var tbody = document.querySelector('.books-table tbody');

                        // Loop through the books
                        for(var i = 0; i < books.length; i++) {
                            // Create a new row
                            var row = document.createElement('tr');

                            // Create the columns
                            var title = document.createElement('td');
                            var author = document.createElement('td');
                            var category = document.createElement('td');
                            var datePublished = document.createElement('td');
                            var isbn = document.createElement('td');
                            var moreInfo = document.createElement('td');
                            var actionBtn = document.createElement('button');
                            
                            // Set the button text
                            actionBtn.textContent = 'Unarchive';
                            actionBtn.className = 'bg-five';
                            actionBtn.setAttribute('data-id', books[i].id);
                            actionBtn.addEventListener('click', function() {
                                // Ask the user for confirmation
                                if(!confirm('Are you sure you want to unarchive this book?')) {
                                    return;
                                }

                                // Create a new XMLHttpRequest object
                                var xhr = new XMLHttpRequest();

                                // Open a new connection to the server
                                xhr.open('GET', 'unarchive.php?id=' + this.getAttribute('data-id'), true);

                                // Set the request header
                                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                                // Check the response status
                                xhr.onreadystatechange = function() {
                                    if(xhr.readyState == 4 && xhr.status == 200) {
                                        // Parse the JSON response
                                        var response = JSON.parse(xhr.responseText);

                                        // Check the response
                                        if(response.status == 'success') {
                                            // Reload the page
                                            window.location.reload();
                                        } else {
                                            // Alert the user
                                            alert(response.message);
                                        }
                                    }
                                }

                                // Send the request
                                xhr.send();
                            });

                            // Set the column values
                            title.textContent = books[i].title;
                            author.textContent = books[i].author;
                            category.textContent = books[i].category;
                            datePublished.textContent = books[i].datePublished;
                            isbn.textContent = books[i].isbn;
                            moreInfo.appendChild(actionBtn);
                            

                            // Append the columns to the row
                            row.appendChild(title);
                            row.appendChild(author);
                            row.appendChild(category);
                            row.appendChild(datePublished);
                            row.appendChild(isbn);
                            row.appendChild(moreInfo);

                            // Append the row to the table body
                            tbody.appendChild(row);
                        }
                    }
                }

                // Send the request
                xhr.send();
            }
        </script>
    </body>
</html>