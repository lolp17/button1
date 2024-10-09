<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        h1 {
            text-align: center;
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
        /* Modal styles */
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(0, 0, 0, 0.4); 
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            max-width: 500px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h1>User Dashboard</h1>

<div class="employee-list">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Attendance (%)</th>
                <th>Total Salary</th>
                <th>Performance</th>
                <th>Date and Time</th>
            </tr>
        </thead>
        <tbody id="employeeTableBody"></tbody>
    </table>
</div>


<div id="salarySlipModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2>Salary Slip Details</h2>
        <p id="salarySlipDetails"></p>
    </div>
</div>

<script>
    function closeModal() {
        document.getElementById('salarySlipModal').style.display = "none";
    }

    
    const employees = JSON.parse(localStorage.getItem('employees')) || [];
    const employeeTableBody = document.getElementById('employeeTableBody');

    
    employees.forEach(emp => {
        if (emp.isApproved) {
            const attendancePercentage = emp.attendance ? (emp.attendance * 100).toFixed(2) : '0.00';
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${emp.id}</td>
                <td>${attendancePercentage}%</td>
                <td>${emp.salary.toFixed(2)}</td>
                <td>${emp.performance}</td>
                <td>${emp.dateTime}</td>
            `;
            employeeTableBody.appendChild(row);
        }
    });
</script>

</body>
</html>
