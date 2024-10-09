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
        .approve-button, .remove-button {
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
        .approved {
            background-color: #d4edda;
        }
    </style>
</head>
<body>

<h1>Manager Dashboard</h1>

<div class="leave-list">
    <h3>Leave Requests</h3>
    <table>
        <thead>
            <tr>
                <th>Action</th>
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
    function logout() {
        window.location.href = "button1.php"; 
    }

    function showDetails() {
        window.location.href = "details.php"; 
    }

    const leaveRequests = JSON.parse(localStorage.getItem('leaveRequests')) || [];
    const leaveTableBody = document.getElementById('leaveTableBody');

    function renderLeaveRequests() {
        leaveTableBody.innerHTML = ''; 
        leaveRequests.forEach((request, index) => {
            const row = document.createElement('tr');
            if (request.isApproved) {
                row.classList.add('approved');
            }
            row.innerHTML = `
                <td>
                    ${request.isApproved ? '' : `<button class="approve-button" onclick="approveLeave(${index})">Approve</button>`}
                    <button class="remove-button" onclick="removeLeave(${index})">Remove</button>
                </td>
                <td>${request.username}</td>
                <td>${request.id}</td>
                <td>${request.leaveType}</td>
                <td>${request.leaveDate}</td>
                <td>${request.reason}</td>
            `;
            leaveTableBody.appendChild(row);
        });
    }

    function approveLeave(index) {
        leaveRequests[index].isApproved = true; 
        localStorage.setItem('leaveRequests', JSON.stringify(leaveRequests));
        renderLeaveRequests(); 
    }

    function removeLeave(index) {
        leaveRequests.splice(index, 1); 
        localStorage.setItem('leaveRequests', JSON.stringify(leaveRequests));
        renderLeaveRequests(); 
    }

    
    renderLeaveRequests();
</script>

</body>
</html>
