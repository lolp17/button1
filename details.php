<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale: 1.0">
    <title>Collected Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        h1 {
            text-align: center;
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
        .exit-button, .remove-button {
            position: absolute;
            top: 20px;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
        }
        .exit-button {
            left: 20px;
            background-color: #dc3545;
        }
        .exit-button:hover {
            background-color: #c82333;
        }
        .remove-button {
            right: 20px;
            background-color: #dc3545;
        }
        .remove-button:hover {
            background-color: #c82333; 
        }
    </style>
</head>
<body>

<h1>Collected Data</h1>


<button class="exit-button" onclick="goToManager()">Exit</button>
<button class="remove-button" onclick="removeSelected()">Remove Selected</button>

<div class="collected-list">
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
                <th>Earnings</th>
                <th>Date and Time</th>
            </tr>
        </thead>
        <tbody id="collectedTableBody"></tbody>
    </table>
</div>

<script>
    
    const collectedData = JSON.parse(localStorage.getItem('collectedData')) || [];
    const collectedTableBody = document.getElementById('collectedTableBody');

    
    collectedData.forEach((emp, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>
                <input type="checkbox" class="remove-checkbox" data-index="${index}">
            </td>
            <td>${emp.name}</td>
            <td>${emp.id}</td>
            <td>${emp.email}</td>
            <td>${emp.address}</td>
            <td>${emp.gender}</td>
            <td>${emp.age}</td>
            <td>${emp.salary.toFixed(2)}</td>
            <td>${(emp.attendance * 100).toFixed(2)}%</td>
            <td>${emp.performance}</td>
            <td>${emp.netSalary.toFixed(2)}</td>
            <td>${emp.dateTime}</td>
        `;
        collectedTableBody.appendChild(row);
    });

    function goToManager() {
        
        window.location.href = "manager.php"; 
    }

    function removeSelected() {
        const checkboxes = document.querySelectorAll('.remove-checkbox:checked');
        const indicesToRemove = Array.from(checkboxes).map(checkbox => parseInt(checkbox.getAttribute('data-index')));
        
        if (indicesToRemove.length === 0) {
            alert("Please select at least one entry to remove.");
            return;
        }

        if (confirm("Are you sure you want to remove the selected entries?")) {
            const updatedData = collectedData.filter((_, index) => !indicesToRemove.includes(index));
            localStorage.setItem('collectedData', JSON.stringify(updatedData)); 
            window.location.reload(); 
        }
    }
</script>

</body>
</html>
