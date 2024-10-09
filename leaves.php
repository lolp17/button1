<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Management Page</title>
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
        .leave-list {
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
        .remove-button {
            background-color: #dc3545;
        }
        .remove-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>

<h1>Leave Management</h1>


<form id="leaveForm">
    <input type="text" id="username" placeholder="Username" required>
    <input type="text" id="id" placeholder="Employee ID" required>
    <select id="leaveType" required>
        <option value="" disabled selected>Leave Type</option>
        <option value="Casual Leave">Casual Leave</option>
        <option value="Privileged Leave">Privileged Leave</option>
        <option value="Medical/Sick Leave">Medical/Sick Leave</option>
    </select>
    <input type="date" id="leaveDate" required>
    <input type="text" id="reason" placeholder="Reason for Leave" required>
    
    <button type="submit">Add Leave Request</button>
</form>


<div class="leave-list">
    <h3>Leave Requests</h3>
    <button class="remove-button" onclick="removeSelected()">Remove Selected</button>
    <table>
        <thead>
            <tr>
                <th>Select</th>
                <th>Username</th>
                <th>ID</th>
                <th>Leave Type</th>
                <th>Date</th>
                <th>Reason</th>
            </tr>
        </thead>
        <tbody id="leaveTableBody"></tbody>
    </table>
</div>

<script>
    const leaveForm = document.getElementById('leaveForm');
    const leaveTableBody = document.getElementById('leaveTableBody');

    leaveForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const username = document.getElementById('username').value;
        const id = document.getElementById('id').value;
        const leaveType = document.getElementById('leaveType').value;
        const leaveDate = document.getElementById('leaveDate').value;
        const reason = document.getElementById('reason').value;

       
        const leaveRequest = {
            username, id, leaveType, leaveDate, reason
        };

        
        let leaveRequests = JSON.parse(localStorage.getItem('leaveRequests')) || [];
        leaveRequests.push(leaveRequest);
        localStorage.setItem('leaveRequests', JSON.stringify(leaveRequests));

       
        addLeaveToTable(leaveRequest);
        leaveForm.reset();
    });

    function addLeaveToTable(leaveRequest) {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td><input type="checkbox" class="leave-checkbox"></td>
            <td>${leaveRequest.username}</td>
            <td>${leaveRequest.id}</td>
            <td>${leaveRequest.leaveType}</td>
            <td>${leaveRequest.leaveDate}</td>
            <td>${leaveRequest.reason}</td>
        `;
        leaveTableBody.appendChild(row);
    }

    function removeSelected() {
        const checkboxes = document.querySelectorAll('.leave-checkbox:checked');
        const leaveRequests = JSON.parse(localStorage.getItem('leaveRequests')) || [];

        checkboxes.forEach(checkbox => {
            const row = checkbox.closest('tr');
            const username = row.cells[1].textContent; 
            const id = row.cells[2].textContent; 

           
            const index = leaveRequests.findIndex(req => req.username === username && req.id === id);
            if (index !== -1) {
                leaveRequests.splice(index, 1); 
            }
            row.remove(); 
        });

       
        localStorage.setItem('leaveRequests', JSON.stringify(leaveRequests));
    }

    
    function refreshLeaveTable() {
        const leaveRequests = JSON.parse(localStorage.getItem('leaveRequests')) || [];
        leaveRequests.forEach(leaveRequest => addLeaveToTable(leaveRequest));
    }
    
    window.onload = refreshLeaveTable;
</script>

</body>
</html>
