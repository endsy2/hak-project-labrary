<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Information - Library Management System</title>
    <link rel="stylesheet" href="{{ asset('css/bookinginformation.css') }}">
    <!-- Add CSRF Token for AJAX requests -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <a href="{{ route('dashboard') }}" class="btn btn-dark">Back to Dashboard</a>
            <h1>Book Information</h1>
            <form action="{{ route('logout') }}" method="POST" class="logout-form">
                @csrf
                <button type="submit" class="btn btn-dark">Log Out</button>
            </form>
        </div>

        <!-- Form Section -->
        <div class="form-container">
            <div class="form-grid form-grid-4">
                <div class="form-group">
                    <label for="bookId">Book ID</label>
                    <input type="text" id="bookId" class="form-control" placeholder="Enter Book ID">
                </div>
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" class="form-control" placeholder="Enter Book Title">
                </div>
                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" id="author" class="form-control" placeholder="Enter Author Name">
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <input type="number" id="year" class="form-control" placeholder="Enter Year">
                </div>
                <div class="form-grid form-grid-2">
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" class="form-control" placeholder="Enter Price" step="0.01">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" class="form-control">
                            <option value="">Select Status</option>
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-actions">
                <button type="button" id="addBtn" class="btn btn-success">Add</button>
                <button type="button" id="updateBtn" class="btn btn-warning">Update</button>
                <button type="button" id="deleteBtn" class="btn btn-danger">Delete</button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="table-container">
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Book ID</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Year</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody id="booksTableBody">
                        <!-- Books will be loaded here dynamically -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Add jQuery for AJAX requests -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Set up CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Load books when page loads
            loadBooks();

            // Add book functionality
            $('#addBtn').click(function() {
                if (validateForm()) {
                    addBook();
                }
            });

            // Update book functionality
            $('#updateBtn').click(function() {
                if ($('#bookId').val()) {
                    updateBook();
                } else {
                    alert('Please select a book to update!');
                }
            });

            // Delete book functionality
            $('#deleteBtn').click(function() {
                if ($('#bookId').val()) {
                    if (confirm('Are you sure you want to delete this book?')) {
                        deleteBook();
                    }
                } else {
                    alert('Please select a book to delete!');
                }
            });

            // Populate form when clicking a table row
            $('#booksTableBody').on('click', 'tr', function() {
                const bookId = $(this).find('td:eq(0)').text();
                const title = $(this).find('td:eq(1)').text();
                const author = $(this).find('td:eq(2)').text();
                const year = $(this).find('td:eq(3)').text();
                const price = $(this).find('td:eq(4)').text().replace('$', '');
                const status = $(this).find('.status-badge').hasClass('status-available') ? 'available' : 'unavailable';

                $('#bookId').val(bookId);
                $('#title').val(title);
                $('#author').val(author);
                $('#year').val(year);
                $('#price').val(price);
                $('#status').val(status);
            });

            // Function to load books from server
            function loadBooks() {
                $.ajax({
                    url: '/books',
                    type: 'GET',
                    success: function(response) {
                        $('#booksTableBody').empty();
                        response.forEach(function(book) {
                            addBookToTable(book);
                        });
                    },
                    error: function(xhr) {
                        alert('Error loading books: ' + xhr.responseText);
                    }
                });
            }

            // Function to add a new book
            function addBook() {
                const bookData = {
                    book_id: $('#bookId').val(),
                    title: $('#title').val(),
                    author: $('#author').val(),
                    year: $('#year').val(),
                    price: $('#price').val(),
                    status: $('#status').val()
                };

                $.ajax({
                    url: '/books',
                    type: 'POST',
                    data: bookData,
                    success: function(response) {
                        addBookToTable(response);
                        clearForm();
                        alert('Book added successfully!');
                    },
                    error: function(xhr) {
                        alert('Error adding book: ' + xhr.responseJSON.message);
                    }
                });
            }

            // Function to update a book
            function updateBook() {
                const bookData = {
                    title: $('#title').val(),
                    author: $('#author').val(),
                    year: $('#year').val(),
                    price: $('#price').val(),
                    status: $('#status').val()
                };

                $.ajax({
                    url: '/books/' + $('#bookId').val(),
                    type: 'PUT',
                    data: bookData,
                    success: function(response) {
                        loadBooks(); // Refresh the table
                        clearForm();
                        alert('Book updated successfully!');
                    },
                    error: function(xhr) {
                        alert('Error updating book: ' + xhr.responseJSON.message);
                    }
                });
            }

            // Function to delete a book
            function deleteBook() {
                $.ajax({
                    url: '/books/' + $('#bookId').val(),
                    type: 'DELETE',
                    success: function() {
                        loadBooks(); // Refresh the table
                        clearForm();
                        alert('Book deleted successfully!');
                    },
                    error: function(xhr) {
                        alert('Error deleting book: ' + xhr.responseJSON.message);
                    }
                });
            }

            // Helper function to add a book to the table
            function addBookToTable(book) {
                const statusClass = book.status === 'available' ? 'status-available' : 'status-unavailable';
                const statusText = book.status === 'available' ? 'Available' : 'Unavailable';

                $('#booksTableBody').append(
                    `<tr>
                        <td>${book.book_id}</td>
                        <td>${book.title}</td>
                        <td>${book.author}</td>
                        <td>${book.year}</td>
                        <td>$${book.price}</td>
                        <td><span class="status-badge ${statusClass}">${statusText}</span></td>
                    </tr>`
                );
            }

            // Form validation
            function validateForm() {
                if (!$('#bookId').val() || !$('#title').val() || !$('#author').val() ||
                    !$('#year').val() || !$('#price').val() || !$('#status').val()) {
                    alert('Please fill in all fields!');
                    return false;
                }
                return true;
            }

            // Clear form fields
            function clearForm() {
                $('#bookId').val('');
                $('#title').val('');
                $('#author').val('');
                $('#year').val('');
                $('#price').val('');
                $('#status').val('');
            }
        });
    </script>
</body>

</html>