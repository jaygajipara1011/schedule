<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Ajax CRUD with Local Storage</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .form-container {
            width: 300px;
            margin: 20px auto;
        }
        .form-container input, .form-container button {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        .user-list {
            width: 400px;
            margin: 20px auto;
        }
        .user-list table {
            width: 100%;
            border-collapse: collapse;
        }
        .user-list th, .user-list td {
            border: 1px solid #ddd;
            padding: 8px;
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Add User</h2>
        <input type="text" id="name" placeholder="Enter Name">
        <input type="email" id="email" placeholder="Enter Email">
        <button id="addUserBtn">Add User</button>
    </div>

    <div class="user-list">
        <h2>Users List</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="usersData">
                <!-- Users will be populated here -->
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(function() {
            // Load form data from local storage on page load
            if (localStorage.getItem('name')) {
                $('#name').val(localStorage.getItem('name'));
            }
            if (localStorage.getItem('email')) {
                $('#email').val(localStorage.getItem('email'));
            }

            // Save form data to local storage on input change
            $('#name').on('input', function() {
                localStorage.setItem('name', $(this).val());
            });
            $('#email').on('input', function() {
                localStorage.setItem('email', $(this).val());
            });

            // Fetch and display users
            function fetchUsers() {
                $.ajax({
                    url: "fetch_users.php",
                    type: "GET",
                    success: function(data) {
                        $('#usersData').html(data);
                    }
                });
            }

            // Load users when page loads
            fetchUsers();

            // Add a new user
            $('#addUserBtn').click(function() {
                var name = $('#name').val();
                var email = $('#email').val();

                if (name !== '' && email !== '') {
                    $.ajax({
                        url: "add_user.php",
                        type: "POST",
                        data: { name: name, email: email },
                        success: function(response) {
                            alert(response);
                            $('#name').val('');
                            $('#email').val('');
                            fetchUsers();
                            
                            // Clear local storage when form is submitted
                            localStorage.removeItem('name');
                            localStorage.removeItem('email');
                        }
                    });
                } else {
                    alert('Please enter all fields.');
                }
            });

            // Delete a user
            $(document).on('click', '.delete-btn', function() {
                var userId = $(this).data('id');

                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: "delete_user.php",
                        type: "POST",
                        data: { id: userId },
                        success: function(response) {
                            alert(response);
                            fetchUsers();
                        }
                    });
                }
            });
        });
    </script>

</body>
</html>
        