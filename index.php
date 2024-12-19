


<!DOCTYPE HTML>
<html>
    <head>
        <title>Book Keeping System</title>
        <link rel="stylesheet" href="css/styles.css" />
    </head>

    <body>
        <div class="container">
            <div class="header">
                <div class="header-el">
                    <h1>Book Keeping <span class="color-three">System</span></h1>
                </div>
                <div class="header-el"></div>
                <div class="header-el">
                    <button class="nav-btn add bg-one" data-view="add-book-form">Add</button>
                    <button class="nav-btn view bg-one" data-view="view-books-form">View</button>
                    <button class="nav-btn update bg-one" data-view="update-book-form">Update</button>
                    <button class="href-btn bg-one" onclick="window.location.href='archives.php'">Archives</button>
                </div>
            </div>
            <div class="content head">
                <h1>Welcome to the Book Keeping System</h1>
                <p>Choose an action from the menu above to get started.</p>
                <hr>
            </div>

            <div class="grid-container add-book-form">
                <div class="content">  
                    <h2 class="action">Add a New Book</h2>
                    <p class="action-description">Fill up the details to add a new book to the system</p>
                </div>
                <div class="content card">
                    <h3 class="bg-two">Add a New Book</h3>
                    <form action="add.php" method="post" name="add" enctype="multipart/form-data">
                        <div class="form-input-container">
                            <label for="title">Title:</label>
                            <input type="text" name="title" id="title" placeholder="Enter Book Title" required />
                        </div>

                        <div class="form-input-container">
                            <label for="author">Author:</label>
                            <input type="text" name="author" id="author" placeholder="Enter Author/s' Name" required />
                        </div>

                        <div class="form-input-container">
                            <label for="publisher">Publisher:</label>
                            <input type="text" name="publisher" id="publisher" placeholder="Enter Publisher's Name" required />
                        </div>

                        <div class="form-input-container">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" placeholder="Enter Book Description" rows="5" required></textarea>
                        </div>

                        <div class="form-input-container">
                            <label for="category">Category:</label>
                            <select name="category" id="category" required>
                                <option value="fiction">Fiction</option>
                                <option value="non-fiction">Non-Fiction</option>
                                <option value="biography">Biography</option>
                                <option value="autobiography">Autobiography</option>
                            </select>
                        </div>

                        <div class="form-input-container">
                            <label for="date-published">Date Published:</label>
                            <input type="date" name="date-published" id="date-published" required />
                        </div>

                        <div class="form-input-container">
                            <label for="isbn">ISBN:</label>
                            <input type="text" name="isbn" id="isbn" required />
                        </div>

                        <div class="form-input-container">
                            <label for="image">Image:</label>
                            <input type="file" name="image" id="image" accept="image/*" />
                        </div>
                        
                        <div class="form-input-container">
                            <label for="image-preview">Preview:</label>
                            <img src="" alt="No Book Image Available" class="add-preview-image" />
                        </div>

                        <!-- <button type="button" onsubmit="return false" class="bg-two preview-btn-add">Preview Image</button> -->
                        <button type="button" onsubmit="return false" class="bg-five clear-btn">Clear Form</button>
                        <button type="submit" class="bg-two">Add Book</button>
                    </form>
                </div>
            </div>

            <div class="grid-container view-books-form">
                <div class="content">  
                    <h2 class="action">View Books</h2>
                    <p class="action-description">You can view all the books in the system below.</p>
                </div>
                <div class="content card">
                    <h3 class="bg-two">View Books</h3>
                    <input type="text" name="search" id="search" placeholder="Search for a book" />
                    <div class="search-container">
                        <button class="bg-five search-btn" data-search="title">Search by Title</button>
                        <button class="bg-five search-btn" data-search="author">Search by Author</button>
                        <button class="bg-five search-btn" data-search="category">Search by Category</button>
                        <button class="bg-five search-btn" data-search="date">Search by Date Published</button>
                        <button class="bg-five search-btn" data-search="isbn">Search by ISBN</button>
                        <button class="bg-five search-btn" data-search="clear">Clear</button>
                    </div>
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

            <!-- <div class="grid-container archive-book-form">
                <div class="content">  
                    <h2 class="action">Archive Books</h2>
                    <p class="action-description">Select a book from below to view its details. Pressing the button will archive the book.</p>

                    <div class="select-archive-container">
                        <select name="book" id="book" required>
                            <option value="book-1">Book Title 1</option>
                            <option value="book-2">Book Title 2</option>
                            <option value="book-3">Book Title 3</option>
                            <option value="book-4">Book Title 4</option>
                        </select>
                        <button type="submit" class="bg-two">View Book</button>
                        <button type="submit" class="bg-two">Archive Book</button>
                    </div>

                </div>
                <div class="content card">
                    <h3 class="bg-two">Archive Books</h3>
                    <form action="archive.php" method="post">
                        <div class="form-input-container">
                            <label for="title-preview">Title:</label>
                            <input type="text" name="title-preview" id="title-preview" placeholder="Enter Book Title" disabled />
                        </div>

                        <div class="form-input-container">
                            <label for="author-preview">Author:</label>
                            <input type="text" name="author-preview" id="author-preview" placeholder="Enter Author/s' Name" disabled />
                        </div>

                        <div class="form-input-container">
                            <label for="publisher-preview">Publisher:</label>
                            <input type="text" name="publisher-preview" id="publisher-preview" placeholder="Enter Publisher's Name" disabled />
                        </div>

                        <div class="form-input-container">
                            <label for="description-preview">Description:</label>
                            <textarea name="description-preview" id="description-preview" placeholder="Enter Book Description" rows="5" disabled></textarea>
                        </div>

                        <div class="form-input-container">
                            <label for="category-preview">Category:</label>
                            <select name="category-preview" id="category-preview" disabled>
                                <option value="fiction">Fiction</option>
                                <option value="non-fiction">Non-Fiction</option>
                                <option value="biography">Biography</option>
                                <option value="autobiography">Autobiography</option>
                            </select> 
                        </div>

                        <div class="form-input-container">
                            <label for="date-published-preview">Date Published:</label>
                            <input type="date" name="date-published-preview" id="date-published-preview" disabled /> 
                        </div>

                        <div class="form-input-container">
                            <label for="isbn-preview">ISBN:</label>
                            <input type="text" name="isbn-preview" id="isbn-preview" disabled />
                        </div>

                        <div class="form-input-container">
                            <label for="image-preview">Image:</label>
                            <input type="file" name="image-preview" id="image-preview" disabled />
                        </div>

                        <button type="submit" class="bg-two">Archive Book</button>
                    </form>
                </div>
            </div> -->

            <div class="grid-container update-book-form">
                <div class="content">  
                    <h2 class="action">Update Book</h2>
                    <p class="action-description">Select a book from below to view its details.</p>

                    <div class="select-update-container">
                        <select name="book" id="book" required>
                            <option value="book-1">Book Title 1</option>
                            <option value="book-2">Book Title 2</option>
                            <option value="book-3">Book Title 3</option>
                            <option value="book-4">Book Title 4</option>
                        </select>
                        <button class="bg-two view-book-btn">View Book</button>
                    </div>

                </div>
                <div class="content card">
                    <h3 class="bg-two">Update Book</h3>
                    <form action="update.php" method="post" name="update" enctype="multipart/form-data" class="update-form">
                        <div class="form-input-container">
                            <label for="title-update">Title:</label>
                            <input type="text" name="title-update" id="title-update" placeholder="Enter Book Title" required />
                        </div>

                        <div class="form-input-container">
                            <label for="author-update">Author:</label>
                            <input type="text" name="author-update" id="author-update" placeholder="Enter Author/s' Name" required />
                        </div>

                        <div class="form-input-container">
                            <label for="publisher-update">Publisher:</label>
                            <input type="text" name="publisher-update" id="publisher-update" placeholder="Enter Publisher's Name" required />
                        </div>

                        <div class="form-input-container">
                            <label for="description-update">Description:</label>
                            <textarea name="description-update" id="description-update" placeholder="Enter Book Description" rows="5" required></textarea>
                        </div>

                        <div class="form-input-container">
                            <label for="category-update">Category:</label>
                            <select name="category-update" id="category-update" required>
                                <option value="fiction">Fiction</option>
                                <option value="non-fiction">Non-Fiction</option>
                                <option value="biography">Biography</option>
                                <option value="autobiography">Autobiography</option>
                            </select> 
                        </div>

                        <div class="form-input-container">
                            <label for="date-published-update">Date Published:</label>
                            <input type="date" name="date-published-update" id="date-published-update" required /> 
                        </div>

                        <div class="form-input-container">
                            <label for="isbn-update">ISBN:</label>
                            <input type="text" name="isbn-update" id="isbn-update" required />
                        </div>

                        <div class="form-input-container">
                            <label for="image-update">Image:</label>
                            <span>Note: Uploading a new picture will replace the preview!</span>
                            <input type="file" name="image-update" id="image-update" accept="image/*" />
                        </div>

                        <div class="form-input-container">
                            <label for="image-preview-update">Preview:</label>
                            <img src="" alt="No Book Image Available" class="update-preview-image" />
                        </div>

                        <input type="hidden" name="id-update" id="id-update" value="" />
                        <!-- <button type="button" onsubmit="return false" class="bg-two preview-btn" onclick="showPreview('update')" data-preview-status="view">Preview Image</button> -->
                        <button type="button" onsubmit="return false" class="bg-five archive-btn">Archive Book</button>
                        <button type="submit" class="bg-two">Update Book</button>
                    </form>
                </div>
            </div>

            <div class="footer bg-one">
                <p>&copy; 2024 Book Keeping System</p>
            </div>
        </div>

        <div class="book-info-popup">
            <div class="book-info-popup-content">
                <button class="close-popup-btn bg-five">Close Book Preview</button>
                <div class="grid-content">
                    <img src="res/a.jpg" alt="No Book Image Available" />
                    <div class="text-info">
                        <h2>Book Title</h2>
                        <p>Author: Author Name</p>
                        <p>Publisher: Publisher Name</p>
                        <p>Description: Book Description</p>
                        <p>Category: Book Category</p>
                        <p>Date Published: Book Date Published</p>
                        <p>ISBN: Book ISBN</p>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/script.js"></script>
    </body>
</html>