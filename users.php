<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .home-link {
            position: absolute;
            top: 20px;
            left: 20px; 
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            display: inline-block;
        }
        .home-link:hover {
            background-color: #0056b3;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #007BFF;
            color: white;
        }
    </style>
</head>
<body>

<h1>User List</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Age</th>
            <th>Email</th>
            <th>Address</th>
            <th>Date & Time</th>
        </tr>
    </thead>
    <tbody id="employeeTableBody"></tbody>
</table>

<script>
    const employeeTableBody = document.getElementById('employeeTableBody');

   
    const employees = JSON.parse(localStorage.getItem('employees')) || [];
    employees.forEach(emp => {
        if (emp.isApproved) { 
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${emp.id}</td>
                <td>${emp.name}</td>
                <td>${emp.age}</td>
                <td>${emp.email}</td>
                <td>${emp.address}</td>
                <td>${emp.dateTime}</td>
            `;
            employeeTableBody.appendChild(row);
        }
    });
</script>

</body>
</html>
