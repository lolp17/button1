<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .logout-button, .detail-button {
            position: absolute;
            top: 20px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        .logout-button {
            right: 20px;
            background-color: #dc3545;
        }
        .logout-button:hover {
            background-color: #c82333;
        }
        .detail-button {
            left: 20px;
            background-color: #007BFF;
        }
        .detail-button:hover {
            background-color: #0056b3;
        }
        .employee-list {
            margin-top: 20px;
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
        .approve-button, .remove-button, .collect-button {
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            padding: 5px 10px;
            margin-right: 5px;
        }
        .approve-button {
            background-color: #28a745;
        }
        .approve-button:hover {
            background-color: #218838;
        }
        .remove-button {
            background-color: #dc3545;
        }
        .remove-button:hover {
            background-color: #c82333;
        }
        .collect-button {
            background-color: #007BFF;
        }
        .collect-button:hover {
            background-color: #0056b3;
        }
        .disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<h1>Manager Dashboard</h1>

<button class="detail-button" onclick="showDetails()">Details</button>
<button class="logout-button" onclick="logout()">Logout</button>

<div class="employee-list">
    <h3>User List</h3>
    <table>
        <thead>
            <tr>
                <th>Action</th>
                <th>Name</th>
                <th>ID</th>
                <th>Email</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Salary</th>
                <th>Attendance</th>
                <th>Performance</th>
                <th>Earnings</th>
                <th>Date and Time</th>
            </tr>
        </thead>
        <tbody id="employeeTableBody"></tbody>
    </table>
</div>

<script>
    function logout() {
        window.location.href = "salary.php"; 
    }

    function showDetails() {
        window.location.href = "details.php"; 
    }

    const employees = JSON.parse(localStorage.getItem('employees')) || [];
    const collectedData = JSON.parse(localStorage.getItem('collectedData')) || [];
    const employeeTableBody = document.getElementById('employeeTableBody');

    function isCollected(emp) {
        return collectedData.some(collectedEmp => collectedEmp.id === emp.id);
    }

    function isDuplicateId(empId) {
        return employees.some(emp => emp.id === empId);
    }

    employees.forEach((emp, index) => {
        if (emp.isActive !== false) {
            const row = document.createElement('tr');
            const actionButtons = emp.isApproved 
                ? `<td>
                    <button class="collect-button ${isCollected(emp) ? 'disabled' : ''}" ${isCollected(emp) ? 'disabled' : ''} onclick="collectData(${index}, this)">Collect</button>
                    <button class="remove-button" onclick="removeEmployee(${index})">Remove</button>
                   </td>` 
                : `<td>
                    <button class="approve-button" onclick="approveEmployee(${index})">Approve</button>
                    <button class="remove-button" onclick="removeEmployee(${index})">Remove</button>
                   </td>`;

            row.innerHTML = `
                ${actionButtons}
                <td>${emp.name}</td>
                <td>${emp.id}</td>
                <td>${emp.email}</td>
                <td>${emp.address}</td>
                <td>${emp.gender}</td>
                <td>${emp.age}</td>
                <td>${emp.salary.toFixed(2)}</td>
                <td>${(emp.attendance * 100).toFixed(2)}%</td> <!-- Displaying attendance percentage -->
                <td>${emp.performance}</td>
                <td>${emp.netSalary.toFixed(2)}</td>
                <td>${emp.dateTime}</td>
            `;
            employeeTableBody.appendChild(row);
        }
    });

    function collectData(index, button) {
        const emp = employees[index];

        if (isCollected(emp)) {
            alert(`Data for ${emp.name} has already been collected.`);
            return;
        }

        collectedData.push(emp);
        localStorage.setItem('collectedData', JSON.stringify(collectedData));

        alert(`Collecting data for: ${emp.name}`);
        button.parentElement.removeChild(button);
    }

    function approveEmployee(index) {
        employees[index].isApproved = true;
        localStorage.setItem('employees', JSON.stringify(employees));
        window.location.reload();
    }

    function removeEmployee(index) {
        employees[index].isActive = false;
        localStorage.setItem('employees', JSON.stringify(employees));
        window.location.reload();
    }

    
    function addEmployee(name, id, email, address, gender, age, salary, attendance, performance, netSalary) {
        if (isDuplicateId(id)) {
            alert(`Employee ID ${id} already exists! Please use a unique ID.`);
            return;
        }

        const newEmployee = {
            name, id, email, address, gender, age, salary,
            attendance, performance, netSalary,
            dateTime: new Date().toLocaleString(),
            isActive: true,
            isApproved: false
        };

        employees.push(newEmployee);
        localStorage.setItem('employees', JSON.stringify(employees));
        window.location.reload(); 
    }
</script>

</body>
</html>
