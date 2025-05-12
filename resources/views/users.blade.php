<!DOCTYPE html>
<html>
<head>
    <title>User Management</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <style>
        body {
            background-color: #f5f7fa;
            font-family: Arial, sans-serif;
        }
        .main-container {
            max-width: 1200px;
            margin: 20px auto;
        }
        .content-container {
            background-color: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        .table-header {
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-title {
            font-size: 1.4rem;
            font-weight: 600;
            margin: 0;
        }
        .add-btn {
            background-color: #0088ff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 500;
        }
        .add-btn:hover {
            background-color:rgb(230, 230, 230);
        }
        .exp-btn {
            background-color:rgb(99, 192, 102);
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-weight: 500;
        }
        .exp-btn:hover {
            background-color:rgb(230, 230, 230);
        }
        .table-responsive {
            padding: 0 20px 20px 20px;
        }
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 5px;
        }
        th {
            background-color: #f0f0f0;
            padding: 15px;
            text-align: left;
        }
        td {
            padding: 15px;
        }
        .action-btn {
            color: white;
            border: none;
            width: 35px;
            height: 35px;
            border-radius: 5px;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            margin-right: 5px;
        }
        .edit-btn {
            background-color: #0088ff;
        }
        .delete-btn {
            background-color: #ff3366;
        }
        .no-records {
            text-align: center;
            padding: 30px;
            color: #666;
            font-style: italic;
        }
        .form-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background-color: white;
            border-radius: 10px;
            width: 500px;
            max-width: 90%;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        .form-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .form-close {
            position: absolute;
            top: 20px;
            right: 35px;
            font-size: 2rem;
            cursor: pointer;
        }
        .modern-header {
            background:rgb(16, 119, 214);
            padding: 15px 30px;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .header-brand {
            font-size: 1.4rem;
            font-weight: 600;
        }
        .header-nav {
            display: flex;
            align-items: center;
        }
        .header-nav-item {
            color: white;
            margin-left: 20px;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .header-nav-item i {
            margin-right: 5px;
        }
        .header-title{
            margin-left: 15px;
        }
        .fa-user-circle{
            font-size: 35px;
            background-color: #ccc;
            color: #ffffff;
            cursor: pointer;
            border-radius: 50%;
        }
        .sidebar {
            transition: width 0.3s ease-in-out;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            background-color: #1f2937;
            color: #e2e8f0;
            border-right: 1px solid #374151;
            overflow-x: hidden;
            z-index: 1000;
        }

        .sidebar.collapsed {
            width: 0;
        }

        .sidebar.appear {
            width: 0;
        }

        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px;
            border-bottom: 1px solid #374151;
        }

        .sidebar-header h1 {
            font-size: 1.25rem;
            font-weight: 600;
            margin: 0;
        }

        .sidebar-menu {
            padding-top: 1rem;
            padding-bottom: 1rem;
        }

        .sidebar-item {
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: #e2e8f0;
            transition: background-color 0.3s ease;
            border-left: 3px solid transparent;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .sidebar-item:hover,
        .sidebar-item.active {
            background-color: #374151;
            border-left-color: #6b7280;
            color: white;
        }

        .sidebar-item i {
            width: 20px;
            height: 20px;
        }

        .main-content {
            margin-left: 250px;
            transition: margin-left 0.3s ease-in-out;
            padding: 20px;
        }

        .main-content.collapsed {
            margin-left: 0;
        }

        .main-content.appear {
            margin-left: 250px;
        }

        #toggle-sidebar {
            background-color: transparent;
            border: none;
            color: #e2e8f0;
            cursor: pointer;
            padding: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        #toggle-sidebar:hover {
            color: white;
        }

        .nav-icon {
            margin-right: 8px;
            width: 20px;
            height: 20px;
        }
        .fa-bars{
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header class="modern-header">
        <div class="header-brand">
            <i class="fa-solid fa-bars" id="mobile-toggle-sidebar"></i>
            <span class="header-title">Finance App</span>
        </div>
        
        <nav id="sidebar" class="sidebar">
            <div class="sidebar-header">
                <h1>Finance App</h1>
                <button id="toggle-sidebar" class="focus:outline-none">
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </div>
            <div class="sidebar-menu">
                <a href="#" class="sidebar-item">
                    <i class="fas fa-users nav-icon" action="/users"></i> Users
                </a>
                <a href="/version" class="sidebar-item">
                    <i class="fas fa-cog nav-icon" action="/version"></i> Version
                </a>
            </div>
        </nav>
        
        <div class="header-nav">

        <div class="dropdown">
                <i class="shadow-sm fas fa-user-circle" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false"></i>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    <li>
                        <form action="/logout" method="GET" class="m-0">
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <div class="main-container">
        <div class="content-container">
            <div class="table-header">
                <h2 class="table-title">User Management</h2>
                <button class="add-btn" onclick="showAddForm()">Add user</button>
            </div>
            
            <div class="table-responsive">
                <table class="table" id="table">
                    <thead>
                        <tr>
                            <th><input type="checkbox"></th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email Address</th>
                            <th>Username</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    
                    </tbody>
                </table>

                
                <button class="exp-btn" id="export-button">Export to Excel</button>
            </div>
        </div>
    </div>

    <div id="json-output" class="mb-4" hidden></div>
    
    <div class="form-overlay" id="addEmployeeForm">
        <div class="form-container position-relative">
            <span class="form-close" onclick="hideAddForm()">&times;</span>
            <h3 class="form-title">Add New User</h3>
            <form action="/register" method="POST">
                <div class="form-group">
                    <label class="form-label" hidden>ID</label>
                    <input type="text" class="form-control" hidden disabled>
                </div>
                <div class="form-group">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Position</label>
                    <select class="form-select" name="position" required>
                        <option value="">Select Position</option>
                        <option value="Admin">Admin</option>
                        <option value="IT">IT</option>
                        <option value="Staff">Staff</option>
                        <option value="Accountant">Accountant</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Username</label>
                    <input type="text" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="hideAddForm()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>

    <div class="form-overlay" id="editUserForm" style="display: none;">
        <div class="form-container position-relative">
            <span class="form-close" onclick="hideEditForm()">&times;</span>
            <h3 class="form-title">Edit User</h3>
            <form id="editUserFormElement" method="POST">
            <div class="form-group">
                <label class="form-label" hidden>ID</label>
                <input type="text" class="form-control" name="id" id="editUserId" hidden disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="editUserName" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="editUserEmail" required>
            </div>
            <div class="form-group">
                <label class="form-label">Position</label>
                <select class="form-select" name="position" id="editUserPosition" required>
                <option value="">Select Position</option>
                <option value="Admin">Admin</option>
                <option value="IT">IT</option>
                <option value="Staff">Staff</option>
                <option value="Accountant">Accountant</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="editUserUsername" required>
            </div>
            <div class="form-group">
                <label class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="editUserPassword" placeholder="Update password here..">
            </div>
            <div class="form-actions">
                <button type="button" class="btn btn-secondary" onclick="hideEditForm()">Cancel</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>

    <div class="form-overlay" id="viewUserForm" style="display: none;">
        <div class="form-container position-relative">
            <span class="form-close" onclick="hideViewForm()">&times;</span>
            <h3 class="form-title">View User</h3>
            <form>
            <div class="form-group">
                <label class="form-label" hidden>ID</label>
                <input type="text" class="form-control" name="id" id="viewUserId" hidden disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="viewUserName" disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="viewUserEmail" disabled>
            </div>
            <div class="form-group">
            <label class="form-label">Position</label>
                <input class="form-select" name="position" id="viewUserPosition" disabled>
            </div>
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" class="form-control" name="username" id="viewUserUsername" disabled>
            </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('export-button').addEventListener('click', function() {

            const table = document.getElementById('table');

            const numCols = table.rows[0].cells.length - 0;
            const worksheetData = [];
            for (let i = 0; i < table.rows.length; i++) {
                const rowData = [];
                for (let j = 0; j < numCols; j++) {
                    rowData.push(table.rows[i].cells[j].textContent);
                }
                worksheetData.push(rowData);
            }
            const worksheet = XLSX.utils.aoa_to_sheet(worksheetData, { origin: "A1" });
            const workbook = XLSX.utils.book_new();

            XLSX.utils.book_append_sheet(workbook, worksheet, "Sheet1");

            const excelBuffer = XLSX.write(workbook, { bookType: 'xlsx', type: 'array' });

            const blob = new Blob([excelBuffer], { type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet;charset=UTF-8' });
            const url = URL.createObjectURL(blob);
            const link = document.createElement("a");
            link.href = url;
            link.download = "exported_table_data_" + new Date().toISOString().replace(/[-:T.]/g, '') + ".xlsx";
            link.style.display = "none";

            document.body.appendChild(link);

            link.click();

            document.body.removeChild(link);
            URL.revokeObjectURL(url);
        });
    </script>

    <script>
    function editUser(id) {
        fetch('/table-data')
            .then(response => response.json())
            .then(data => {
                const user = data.find(u => u.id == id);

                if (!user) {
                    alert('User not found.');
                    return;
                }

                document.getElementById('editUserId').value = user.id;
                document.getElementById('editUserName').value = user.name;
                document.getElementById('editUserEmail').value = user.email;
                document.getElementById('editUserPosition').value = user.position;
                document.getElementById('editUserUsername').value = user.username;
                document.getElementById('editUserPassword').value = '';

                document.getElementById('editUserForm').style.display = 'flex';
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
                alert("Could not load user data.");
            });
    }

    function hideEditForm() {
        document.getElementById('editUserForm').style.display = 'none';
    }

    document.getElementById('editUserFormElement').addEventListener('submit', function(event) {
        event.preventDefault();

        const id = document.getElementById('editUserId').value;
        const name = document.getElementById('editUserName').value;
        const email = document.getElementById('editUserEmail').value;
        const position = document.getElementById('editUserPosition').value;
        const username = document.getElementById('editUserUsername').value;
        const password = document.getElementById('editUserPassword').value;

        fetch('/table-data')
            .then(response => response.json())
            .then(data => {
                const user = data.find(u => u.id == id);
                if (!user) {
                    alert('User not found.');
                    return;
                }

                const updateData = {
                    name: name || user.name,
                    email: email || user.email,
                    position: position || user.position,
                    username: username || user.username
                };

                if (password) {
                    updateData.password = password;
                }

                fetch('/update-user/' + id, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(updateData)
                })
                .then(response => {
                    if (response.ok) {
                        alert('User updated successfully.');
                        hideEditForm();
                        location.reload();
                    } else {
                        alert('Failed to update user.');
                    }
                })
                .catch(error => {
                    console.error('Error updating user:', error);
                    alert('An error occurred while updating the user.');
                });
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
                alert("Could not fetch user data.");
            });
        });
    </script>

    <script>
    function viewUser(id) {
        fetch('/table-data')
            .then(response => response.json())
            .then(data => {
                const user = data.find(u => u.id == id);

                if (!user) {
                    alert('User not found.');
                    return;
                }

                document.getElementById('viewUserId').value = user.id;
                document.getElementById('viewUserName').value = user.name;
                document.getElementById('viewUserEmail').value = user.email;
                document.getElementById('viewUserPosition').value = user.position;
                document.getElementById('viewUserUsername').value = user.username;

                document.getElementById('viewUserForm').style.display = 'flex';
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
                alert("Could not load user data.");
            });
    }
    function hideViewForm() {
        document.getElementById('viewUserForm').style.display = 'none';
    }
    </script>

        
    <script>
        function deleteUser(id) {
            if (confirm("Are you sure you want to delete this user?")) {
                fetch('/users/' + id, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => {
                    if (response.ok) {
                        alert("User deleted successfully.");
                        location.reload();
                    } else {
                        alert("Failed to delete user.");
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        }
    </script>

    <script>
        fetch('/table-data')
            .then(response => response.json())
            .then(data => {
                const jsonOutputElement = document.getElementById('json-output');
                jsonOutputElement.textContent = JSON.stringify(data, null, 2); // Pretty print the JSON

                const tableBody = document.getElementById('table-body');

                data.forEach(user => {
                    const row = tableBody.insertRow();

                    const checkboxCell = row.insertCell();
                    checkboxCell.innerHTML = '<input type="checkbox">';

                    const IdCell = row.insertCell();
                    IdCell.textContent = user.id;

                    const nameCell = row.insertCell();
                    nameCell.textContent = user.name;

                    const emailCell = row.insertCell();
                    emailCell.textContent = user.email;

                    const usernameCell = row.insertCell();
                    usernameCell.textContent = user.username;

                    const positionCell = row.insertCell();
                    positionCell.textContent = user.position;

                    const actionCell = row.insertCell();
                    actionCell.innerHTML = 
                    '<button class="btn btn-sm btn-warning" onclick="viewUser(' + user.id + ')">View</button> ' +
                    '<button class="btn btn-sm btn-primary" onclick="editUser(' + user.id + ')">Edit</button> ' +
                    '<button class="btn btn-sm btn-danger" onclick="deleteUser(' + user.id + ')">Delete</button>';
                });
            })
            .catch(error => {
                console.error('Error fetching JSON:', error);
        });
    </script>

    <script>
        function showAddForm() {
            document.getElementById("addEmployeeForm").style.display = "flex";
        }
        
        function hideAddForm() {
            document.getElementById("addEmployeeForm").style.display = "none";
        }

        const sidebar = document.getElementById('sidebar');
        const mainContent = document.querySelector('.main-content') || document.querySelector('.main-container');
        const toggleSidebarButtons = [
            document.getElementById('toggle-sidebar'), 
            document.getElementById('mobile-toggle-sidebar')
        ];

        toggleSidebarButtons.forEach(button => {
            if (button) {
                button.addEventListener('click', () => {
                    sidebar.classList.toggle('collapsed');
                    
                    if (mainContent) {
                        mainContent.classList.toggle('collapsed');
                    }
                    
                    const chevronIcon = document.querySelector('#toggle-sidebar i');
                    const mobileBarsIcon = document.querySelector('#mobile-toggle-sidebar');
                    
                    if (sidebar.classList.contains('collapsed')) {
                        if (chevronIcon) {
                            chevronIcon.classList.remove('fa-chevron-left');
                            chevronIcon.classList.add('fa-bars');
                        }
                        if (mobileBarsIcon) {
                            mobileBarsIcon.classList.add('fa-bars');
                        }
                    } else {
                        if (chevronIcon) {
                            chevronIcon.classList.remove('fa-bars');
                            chevronIcon.classList.add('fa-chevron-left');
                        }
                        if (mobileBarsIcon) {
                            mobileBarsIcon.classList.remove('fa-bars');
                        }
                    }
                });
            }
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
