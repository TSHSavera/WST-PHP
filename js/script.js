// Switch views on button clicks

// Get the buttons
const btns = document.querySelectorAll('.nav-btn');

// Get the views
const views = document.querySelectorAll('.grid-container');

// Add event listeners to the buttons
btns.forEach(btn => {
  btn.addEventListener('click', () => {
    // Remove the active class from all buttons
    btns.forEach(btn => {
      btn.classList.remove('active');
    });

    // Add the active class to the clicked button
    btn.classList.add('active');

    // Hide all views
    views.forEach(view => {
      view.style.display = 'none';
    });

    // Show the view that corresponds to the clicked button
    const view = document.querySelector("."+ btn.dataset.view);
    // Do something based on the view
    if (btn.dataset.view == 'view-books-form') {
        // Also, load the books
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'getBooks.php', true);

        xhr.onload = function() {
            if (this.status === 200) {
                const books = JSON.parse(this.responseText);
                const booksTable = document.querySelector('.books-table');
                // Clear the table except the header
                booksTable.innerHTML = '<thead class="bg-three"><tr><th>Title</th><th>Author</th><th>Category</th><th>Date Published</th><th>ISBN</th><th>ID</th><th>Actions</th></tr></thead>';
                books.forEach(book => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${book.title}</td>
                        <td>${book.author}</td>
                        <td>${book.category}</td>
                        <td>${book.datePublished}</td>
                        <td>${book.isbn}</td>
                        <td>${book.id}</td>
                        <td>
                            <a href="index.php?view=update&id=${book.id}" class="btn">More Details</a>
                        </td>
                    `;
                    booksTable.appendChild(tr);
                });
            }
        }
        xhr.send();
        view.style.display = 'grid';
    } else if (btn.dataset.view == 'update-book-form') {
        // Generate the dropdown options
        const xhr = new XMLHttpRequest();
        const xhr2 = new XMLHttpRequest();
        const dropdown = document.querySelector('#book');
        // Clear the dropdown
        dropdown.innerHTML = '';
        xhr2.open('GET', 'getBooks.php', true);

        xhr2.onload = function() {
            if (this.status === 200) {
                const books = JSON.parse(this.responseText);
                books.forEach(book => {
                    const option = document.createElement('option');
                    option.value = book.id;
                    option.textContent = book.title;
                    dropdown.appendChild(option);
                });
            }
        }

        xhr2.send();
        // Load the book details if the id is in the URL
        const bookId = urlParams.get('id');

        xhr.open('GET', 'getBooks.php?id=' + bookId, true);

        xhr.onload = function() {
            if (this.status === 200 && this.responseText != 'Book not found') {
                const book = JSON.parse(this.responseText);
                console.log(book);
                // Also change the dropdown value
                dropdown.value = book.id;
                // Also, fill in the form
                const form = document.querySelector('.update-form');
                form['title-update'].value = book.title;
                form['author-update'].value = book.author;
                form['publisher-update'].value = book.publisher;
                form['description-update'].value = book.descr;
                form['category-update'].value = book.category;
                form['date-published-update'].value = book.datePublished;
                form['isbn-update'].value = book.isbn;
                form['id-update'].value = book.id;
                // Set the image path in the img src
                const imagePreview = document.querySelector('.update-preview-image');
                // Trim the path to get the file name
                const fileName = book.imgPath.split('/').pop();
                imagePreview.src = 'uploads/' + fileName;
            } else {
                const viewElement = document.querySelector("."+ btn.dataset.view);
                viewElement.style.display = 'grid';
            }
        }

        xhr.send();

        view.style.display = 'grid';
    } else {
        view.style.display = 'grid';
    };
  });
});

// Read the parameters from the URL
const urlParams = new URLSearchParams(window.location.search);
const err = urlParams.get('err_id');
const custMsg = urlParams.get('msg');
const res = urlParams.get('res_id');
const view = urlParams.get('view');

if (err) {
    generateErrPopUp(err, custMsg);
}

if (res) {
    generatePopup(res);
}

if (view) {
    // Remove the active class from all buttons
    btns.forEach(btn => {
        btn.classList.remove('active');
    });

    // Add the active class to the clicked button
    const btn = document.querySelector("."+ view);
    btn.classList.add('active');

    // Hide all views
    views.forEach(view => {
        view.style.display = 'none';
    });

    // Show the view that corresponds to the clicked button
    if (view == 'view') {
        const viewElement = document.querySelector("."+ view + '-books-form');
        viewElement.style.display = 'grid';
        // Also, load the books
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'getBooks.php', true);

        xhr.onload = function() {
            if (this.status === 200) {
                const books = JSON.parse(this.responseText);
                const booksTable = document.querySelector('.books-table');
                booksTable.innerHTML = '';
                books.forEach(book => {
                    const tr = document.createElement('tr');
                    tr.innerHTML = `
                        <td>${book.title}</td>
                        <td>${book.author}</td>
                        <td>${book.category}</td>
                        <td>${book.datePublished}</td>
                        <td>${book.isbn}</td>
                        <td>${book.id}</td>
                        <td>
                            <a href="index.php?view=update&id=${book.id}" class="btn">More Details</a>
                        </td>
                    `;
                    booksTable.appendChild(tr);
                });
            }
        }
    } else if (view == 'update') {
        // Load the book details
        const bookId = urlParams.get('id');
        const xhr = new XMLHttpRequest();
        const xhr2 = new XMLHttpRequest();
        const dropdown = document.querySelector('#book');
        // Clear the dropdown
        dropdown.innerHTML = '';
        // Generate the dropdown options
        xhr2.open('GET', 'getBooks.php', true);
        console.log('Getting books');
        xhr2.onload = function() {
            console.log(this.status);
            if (this.status === 200) {
                const books = JSON.parse(this.responseText);
                console.log(books);
                books.forEach(book => {
                    const option = document.createElement('option');
                    option.value = book.id;
                    option.textContent = book.title;
                    dropdown.appendChild(option);
                });
            }
        }
        xhr2.send();
        if (bookId == null) {
            const viewElement = document.querySelector("."+ view + '-book-form');
            viewElement.style.display = 'grid';
        } else {
            xhr.open('GET', 'getBooks.php?id=' + bookId, true);

            xhr.onload = function() {
                if (this.status === 200 && this.responseText != 'Book not found') {
                    const book = JSON.parse(this.responseText);
                    console.log(book);
                    // Also change the dropdown value
                    dropdown.value = book.id;
                    // Also, fill in the form
                    const form = document.querySelector('.update-form');
                    form['title-update'].value = book.title;
                    form['author-update'].value = book.author;
                    form['publisher-update'].value = book.publisher;
                    form['description-update'].value = book.descr;
                    form['category-update'].value = book.category;
                    form['date-published-update'].value = book.datePublished;
                    form['isbn-update'].value = book.isbn;
                    form['id-update'].value = book.id;
                    // Set the image path in the img src
                    const imagePreview = document.querySelector('.update-preview-image');
                    // Trim the path to get the file name
                    const fileName = book.imgPath.split('/').pop();
                    imagePreview.src = 'uploads/' + fileName;
                } else {
                    const viewElement = document.querySelector("."+ view + '-book-form');
                    viewElement.style.display = 'grid';
                    // Show an error message
                    generateErrPopUp('a', 'Book not found');
                }
            }
            xhr.send();

            const viewElement = document.querySelector("."+ view + '-book-form');
            viewElement.style.display = 'grid';

        }
        
    } else {
        const viewElement = document.querySelector("."+ view + "-book-form");
        viewElement.style.display = 'grid';
    }
}

function generateErrPopUp(err, customMessage) {
    // Create elements
    const popup = document.createElement('div');
    const popupTitle = document.createElement('h2');
    const closeBtn = document.createElement('button');
    const p = document.createElement('p');

    // Add classes
    popup.classList.add('popup');

    // Add the close button text
    closeBtn.textContent = 'Close';
  
    // Add event listener to the close button
    closeBtn.addEventListener('click', () => {
        // Animate the popup
        popup.style.opacity = 0;
        popup.style.right = '-50%';
        // Remove the popup from the DOM
        popup.addEventListener('transitionend', () => {
            popup.remove();
        });
    });

    // If the URL contains a err_id parameter, show the popup with the corresponding error message
    if (err) {
        // Set the text content
        popupTitle.textContent = 'Error';
        // Check which error message to display
        switch (err) {
            case '0':
                p.textContent = 'An error occurred. Please try again later.';
                break;
            case '1':
                p.textContent = 'Please fill in all fields.';
                break;
            case '2':
                p.textContent = 'Invalid ISBN Format. Please enter a 13 digit ISBN number.';
                break;
            case '3':
                p.textContent = 'ISBN already in exists.';
                break;
            case '4':
                p.textContent = 'Image file is too large. Please upload an image that is less than 2MB.';
                break;
            case '5':
                p.textContent = 'Invalid file type. Please upload a .jpg, .jpeg, or .png file.';
                break;
            case '6':
                p.textContent = 'Image file already exists.';
                break;
            case '7':
                p.textContent = 'Image file upload failed.';
                break;
            default:
                popupTitle.textContent = 'An Error Occurred';
                p.textContent = customMessage;
                break
            }
        // Set the color of the popup
        popup.style.backgroundColor = "#f44336";
        popup.style.color = "white";

    }
    // Append elements
    popup.appendChild(popupTitle);
    popup.appendChild(p);
    popup.appendChild(closeBtn);
    document.body.appendChild(popup);
};

function generatePopup(res) {
    // Create elements
    const popup = document.createElement('div');
    const popupTitle = document.createElement('h2');
    const closeBtn = document.createElement('button');
    const p = document.createElement('p');

    // Add classes
    popup.classList.add('popup');

    // Add the close button text
    closeBtn.textContent = 'Close';
  
    // Add event listener to the close button
    closeBtn.addEventListener('click', () => {
        // Animate the popup
        popup.style.opacity = 0;
        popup.style.right = '-50%';
        // Remove the popup from the DOM
        popup.addEventListener('transitionend', () => {
            popup.remove();
        });
    });

    // If the URL contains a res_id parameter, show the popup with the corresponding message
    if (res) {
        // Set the text content
        popupTitle.textContent = 'Success';
        // Set the color of the popup
        popup.style.backgroundColor = "#008000";
        popup.style.color = "white";
        // Check which message to display
        switch (res) {
            case '0':
                p.textContent = 'Book added successfully.';
                break;
            case '1':
                p.textContent = 'Book updated successfully.';
                break;
            case '2':
                p.textContent = 'Book archived successfully.';
                break;
            case '3':
                p.textContent = 'Image uploaded successfully.';
                break;
            default:
                popupTitle.textContent = 'Unknown response code';
                p.textContent = 'Wrong response code received. Please try again later.';
                popup.style.backgroundColor = "#f4b400";
                popup.style.color = "black";
                break
            }
        

    }
    // Append elements
    popup.appendChild(popupTitle);
    popup.appendChild(p);
    popup.appendChild(closeBtn);
    document.body.appendChild(popup);
};

// Add event listener to the ISBN input field - replace spaces with dashes + limit to 17 characters
const isbnInput = document.querySelector('#isbn');

isbnInput.addEventListener('keyup', () => {
    // Replace spaces with dashes
    isbnInput.value = isbnInput.value.replace(/ /g, '-');
    // Limit to 17 characters
    if (isbnInput.value.length > 17) {
        isbnInput.value = isbnInput.value.slice(0, 17);
    }
    // Forbid typing anything other than numbers, spaces, and dashes
    isbnInput.value = isbnInput.value.replace(/[^0-9-]/g, '');
});

isbnInput.addEventListener('keydown', () => {
    isbnInput.value = isbnInput.value.replace(/[^0-9-]/g, '');
});


// Add event listener to the #book dropdown - load the book details
const bookDropdown = document.querySelector('#book');
const form = document.querySelector('.update-form');
const viewBookBtn = document.querySelector('.view-book-btn');

viewBookBtn.addEventListener('click', () => {
    const bookId = bookDropdown.value;
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'getBooks.php?id=' + bookId, true);

    xhr.onload = function() {
        if (this.status === 200 && this.responseText != 'Book not found') {
            const book = JSON.parse(this.responseText);
            console.log(book);
            // Also, fill in the form
            form['title-update'].value = book.title;
            form['author-update'].value = book.author;
            form['publisher-update'].value = book.publisher;
            form['description-update'].value = book.descr;
            form['category-update'].value = book.category;
            form['date-published-update'].value = book.datePublished;
            form['isbn-update'].value = book.isbn;
            form['id-update'].value = book.id;
            // Set the image path in the img src
            const imagePreview = document.querySelector('.update-preview-image');
            // Trim the path to get the file name
            const fileName = book.imgPath.split('/').pop();
            imagePreview.src = 'uploads/' + fileName;
        } else {
            // Clear the form
            form['title-update'].value = '';
            form['author-update'].value = '';
            form['publisher-update'].value = '';
            form['description-update'].value = '';
            form['category-update'].value = '';
            form['date-published-update'].value = '';
            form['isbn-update'].value = '';
            form['id-update'].value = '';
            // Set the image path in the img src
            const imagePreview = document.querySelector('.update-preview-image');
            imagePreview.src = '';
            // Show an error message
            generateErrPopUp('a', 'Book not found');
        }
    }
    xhr.send();
});

// Add event listener to the image input field of update form - show the image preview
const imageInput = document.querySelector('#image-update');
const imagePreview = document.querySelector('.update-preview-image');

imageInput.addEventListener('change', () => {
    const file = imageInput.files[0];
    const reader = new FileReader();
    reader.onload = function(e) {
        imagePreview.src = e.target.result;
    }
    reader.readAsDataURL(file);
});

// Add event listener to the image input field of add form - show the image preview
const imageInputAdd = document.querySelector('#image');
const imagePreviewAdd = document.querySelector('.add-preview-image');

imageInputAdd.addEventListener('change', () => {
    const file = imageInputAdd.files[0];
    const reader = new FileReader();
    reader.onload = function(e) {
        imagePreviewAdd.src = e.target.result;
    }
    reader.readAsDataURL(file);
});

// Add event listener to the archive button
const archiveBtn = document.querySelector('.archive-btn');

archiveBtn.addEventListener('click', () => {
    // Ask if the user is sure
    if (confirm('Are you sure you want to archive this book?')) {
        // Get the book id
        const bookId = form['id-update'].value;
        // Send the request
        const xhr = new XMLHttpRequest();
        xhr.open('GET', 'archive.php?id=' + bookId, true);

        xhr.onload = function() {
            if (this.status === 200) {
                const res = this.responseText;
                if (res == 'Book archived successfully') {
                    window.location.href = 'index.php?res_id=2';
                } else {
                    window.location.href = 'index.php?err_id=a&msg=' + res;
                }
            }
        }

        xhr.send();
    }
});


// Search functionality
const searchInput = document.querySelector('#search');

// Search btns
const searchBtns = document.querySelectorAll('.search-btn');

// Add event listeners to the search btns - adjust the table based on the search type and value
searchBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        // Get the search value
        const searchValue = searchInput.value;
        
        // Modify the search value based on the search type - get on data-search attribute
        if (btn.dataset.search == 'date') {
            // Get all the rows
            const rows = document.querySelectorAll('.books-table tr');
            // Loop through the rows
            rows.forEach(row => {
                // Get the date
                const date = row.children[3].textContent;
                // Check if the date contains the search value
                if (date.includes(searchValue)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        } else if (btn.dataset.search == 'category') {
            // Get all the rows
            const rows = document.querySelectorAll('.books-table tr');
            // Loop through the rows
            rows.forEach(row => {
                // Get the category
                const category = row.children[2].textContent;
                // Check if the category contains the search value
                if (category.includes(searchValue)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        } else if (btn.dataset.search == 'isbn') {
            // Get all the rows
            const rows = document.querySelectorAll('.books-table tr');
            // Loop through the rows
            rows.forEach(row => {
                // Get the isbn
                const isbn = row.children[4].textContent;
                // Check if the isbn contains the search value
                if (isbn.includes(searchValue)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        } else if (btn.dataset.search == 'author') {
            // Get all the rows
            const rows = document.querySelectorAll('.books-table tr');
            // Loop through the rows
            rows.forEach(row => {
                // Get the author
                const author = row.children[1].textContent;
                // Check if the author contains the search value
                if (author.includes(searchValue)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        } else if (btn.dataset.search == 'title') {
            // Get all the rows
            const rows = document.querySelectorAll('.books-table tr');
            // Loop through the rows
            rows.forEach(row => {
                // Get the title
                const title = row.children[0].textContent;
                // Check if the title contains the search value
                if (title.includes(searchValue)) {
                    row.style.display = 'table-row';
                } else {
                    row.style.display = 'none';
                }
            });
        } else {
            // Reset the table
            const rows = document.querySelectorAll('.books-table tr');
            rows.forEach(row => {
                row.style.display = 'table-row';
            });
        }

        // Show the header row
        const header = document.querySelector('.books-table thead tr');
        header.style.display = 'table-row';
    });
});