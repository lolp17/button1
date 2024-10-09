<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrator Page</title>
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
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin: 0 auto;
            max-width: 600px;
        }
        input, select {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            width: 100%;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        button {
            padding: 10px;
            width: 100%;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            background-color: #007BFF;
            color: white;
        }
        button:hover {
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
        .employee-name {
            color: #007BFF;
            cursor: pointer;
            text-decoration: underline;
        }
        .remove-button {
            background-color: #dc3545;
        }
        .remove-button:hover {
            background-color: #c82333;
        }
        .attendance-inputs {
            display: none;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<h1>Information</h1>

<!-- Employee Form -->
<form id="employeeForm">
    <input type="text" id="name" placeholder="Name" required>
    <input type="text" id="id" placeholder="Employee ID" required>
    <input type="email" id="email" placeholder="Email" required>
    <input type="text" id="address" placeholder="Address" required>
    <select id="gender" required>
        <option value="" disabled selected>Gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select>
    <input type="number" id="age" placeholder="Age" required>
    <input type="number" id="salary" placeholder="Salary" required>
    
    <input type="number" id="attendance" placeholder="Attendance (1-100%)" required min="1" max="100" readonly>
    
    <button type="button" onclick="showAttendanceInputs()">Enter Attendance Days</button>
    
    <div class="attendance-inputs" id="attendanceInputs">
        <select id="attendanceMonth" required onchange="updateTotalDays()">
            <option value="" disabled selected>Month</option>
            <option value="0">January</option>
            <option value="1">February</option>
            <option value="2">March</option>
            <option value="3">April</option>
            <option value="4">May</option>
            <option value="5">June</option>
            <option value="6">July</option>
            <option value="7">August</option>
            <option value="8">September</option>
            <option value="9">October</option>
            <option value="10">November</option>
            <option value="11">December</option>
        </select>
        <select id="attendanceYear" required onchange="updateTotalDays()">
            <option value="" disabled selected>Year</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <option value="2025">2025</option>
            
        </select>
        <input type="number" id="daysPresent" placeholder="Days Present" required oninput="validateDays('present')">
        <input type="number" id="daysAbsent" placeholder="Days Absent" required oninput="validateDays('absent')">
    </div>
    
    <input type="number" id="performance" placeholder="Performance Rating (1-10)" required>
    <input type="number" id="overtimeHours" placeholder="Overtime Hours" required>
    <input type="number" id="overtimeRate" placeholder="Overtime Rate" required>
    <input type="number" id="deduction" placeholder="Deduction" required>
    <input type="number" id="taxPercentage" placeholder="Tax Percentage (%)" required>
    
    <button type="submit">Add Employee</button>
</form>


<div class="employee-list">
    <h3>User List</h3>
    <button class="remove-button" onclick="removeSelected()">Remove Selected</button>
    <table>
        <thead>
            <tr>
                <th>Select</th>
                <th>Name</th>
                <th>ID</th>
                <th>Email</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Salary</th>
                <th>Attendance</th>
                <th>Performance</th>
                <th>Overtime Hours</th>
                <th>Overtime Rate</th>
                <th>Gross Salary</th>
                <th>Deduction</th>
                <th>Tax (%)</th>
                <th>Net Salary</th>
                <th>Date & Time</th>
            </tr>
        </thead>
        <tbody id="employeeTableBody"></tbody>
    </table>
</div>

<script>
    const employeeForm = document.getElementById('employeeForm');
    const employeeTableBody = document.getElementById('employeeTableBody');
    const attendanceInputs = document.getElementById('attendanceInputs');

    employeeForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const name = document.getElementById('name').value;
        const id = document.getElementById('id').value;
        const email = document.getElementById('email').value;
        const address = document.getElementById('address').value;
        const gender = document.getElementById('gender').value;
        const age = parseInt(document.getElementById('age').value, 10);
        const salary = parseFloat(document.getElementById('salary').value);
        const performance = parseFloat(document.getElementById('performance').value);
        const overtimeHours = parseFloat(document.getElementById('overtimeHours').value);
        const overtimeRate = parseFloat(document.getElementById('overtimeRate').value);
        const deduction = parseFloat(document.getElementById('deduction').value);
        const taxPercentage = parseFloat(document.getElementById('taxPercentage').value);
        
        const attendance = parseFloat(document.getElementById('attendance').value);
        const daysPresent = parseInt(document.getElementById('daysPresent').value, 10);
        const daysAbsent = parseInt(document.getElementById('daysAbsent').value, 10);
        
        
        const dateTime = new Date().toLocaleString();

       
        const grossSalary = salary + (overtimeHours * overtimeRate);

        
        const tax = grossSalary * (taxPercentage / 100);

       
        const netSalary = grossSalary - (deduction + tax);

        
        const employee = {
            name, id, email, address, gender, age, salary, attendance, 
            performance, overtimeHours, overtimeRate, grossSalary, deduction, 
            taxPercentage, netSalary, dateTime
        };

        
        let employees = JSON.parse(localStorage.getItem('employees')) || [];
        employees.push(employee);
        localStorage.setItem('employees', JSON.stringify(employees));

        
        addEmployeeToTable(employee);
        employeeForm.reset();
        attendanceInputs.style.display = 'none'; 
        updateAttendance();
    });

    function addEmployeeToTable(employee) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="checkbox" class="employee-checkbox"></td>
            <td class="employee-name">${employee.name}</td>
            <td>${employee.id}</td>
            <td>${employee.email}</td>
            <td>${employee.address}</td>
            <td>${employee.gender}</td>
            <td>${employee.age}</td>
            <td>${employee.salary.toFixed(2)}</td>
            <td>${employee.attendance.toFixed(2)}</td>
            <td>${employee.performance.toFixed(2)}</td>
            <td>${employee.overtimeHours.toFixed(2)}</td>
            <td>${employee.overtimeRate.toFixed(2)}</td>
            <td>${employee.grossSalary.toFixed(2)}</td>
            <td>${employee.deduction.toFixed(2)}</td>
            <td>${employee.taxPercentage.toFixed(2)}</td>
            <td>${employee.netSalary.toFixed(2)}</td>
            <td>${employee.dateTime}</td>
        `;
        employeeTableBody.appendChild(row);
    }

    function showAttendanceInputs() {
        attendanceInputs.style.display = 'block';
    }

    function updateTotalDays() {
        const month = parseInt(document.getElementById('attendanceMonth').value);
        const year = parseInt(document.getElementById('attendanceYear').value);
        const daysPresentInput = document.getElementById('daysPresent');
        const daysAbsentInput = document.getElementById('daysAbsent');

        if (!isNaN(month) && !isNaN(year)) {
            const totalDays = new Date(year, month + 1, 0).getDate();
            
           
            daysPresentInput.max = totalDays;
            daysAbsentInput.max = totalDays;
        }
    }

    function validateDays(type) {
        const month = parseInt(document.getElementById('attendanceMonth').value);
        const year = parseInt(document.getElementById('attendanceYear').value);
        const totalDays = new Date(year, month + 1, 0).getDate();
        
        const daysPresentInput = document.getElementById('daysPresent');
        const daysAbsentInput = document.getElementById('daysAbsent');

        let daysPresent = parseInt(daysPresentInput.value) || 0;
        let daysAbsent = parseInt(daysAbsentInput.value) || 0;

        if (type === 'present') {
            if (daysPresent > totalDays) {
                daysPresentInput.value = totalDays; 
                daysPresent = totalDays; 
            }
            
            if (daysPresent + daysAbsent > totalDays) {
                daysAbsentInput.value = totalDays - daysPresent; 
            }
        } else {
            if (daysAbsent > totalDays) {
                daysAbsentInput.value = totalDays; 
                daysAbsent = totalDays; 
            }
            
            if (daysPresent + daysAbsent > totalDays) {
                daysPresentInput.value = totalDays - daysAbsent; 
            }
        }

        
        updateAttendance();
    }

    function updateAttendance() {
        const daysPresent = parseInt(document.getElementById('daysPresent').value) || 0;
        const daysAbsent = parseInt(document.getElementById('daysAbsent').value) || 0;

        
        const totalDays = daysPresent + daysAbsent;
        const attendance = totalDays ? (daysPresent / totalDays) * 100 : 0;
        document.getElementById('attendance').value = attendance.toFixed(2);
    }

    function removeSelected() {
        const checkboxes = document.querySelectorAll('.employee-checkbox:checked');
        const employees = JSON.parse(localStorage.getItem('employees')) || [];

        checkboxes.forEach(checkbox => {
            const row = checkbox.closest('tr');
            const name = row.cells[1].textContent; 
            const id = row.cells[2].textContent; 

            
            const index = employees.findIndex(emp => emp.name === name && emp.id === id);
            if (index !== -1) {
                employees.splice(index, 1); 
            }
            row.remove(); 
        });

        
        localStorage.setItem('employees', JSON.stringify(employees));
    }

    
    function refreshEmployeeTable() {
        const employees = JSON.parse(localStorage.getItem('employees')) || [];
        employees.forEach(employee => addEmployeeToTable(employee));
    }
    
    window.onload = refreshEmployeeTable;
</script>

</body>
</html>
