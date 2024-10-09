    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                display: flex;
                flex-direction: column;
                height: 100vh;
                margin: 0;
                background-color: #f4f4f4;
                padding: 20px;
                position: relative;
            }

            .logout-button {
                position: absolute;
                top: 20px;
                right: 20px;
                padding: 10px 15px;
                border: none;
                border-radius: 5px;
                background-color: #dc3545;
                color: white;
                cursor: pointer;
            }

            .logout-button:hover {
                background-color: #c82333;
            }

            .button-container {
                display: flex;
                flex-direction: column;
                gap: 10px;
                margin-top: 60px;
            }

            button, .link-button {
                padding: 10px 20px;
                font-size: 16px;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                background-color: #007BFF;
                color: white;
                text-align: center;
                text-decoration: none;
            }

            button:hover, .link-button:hover {
                background-color: #0056b3;
            }

            #contentContainer {
                flex-grow: 1;
                margin-top: 20px;
                display: none;
                padding: 20px;
                border: 2px solid #007BFF;
                border-radius: 5px;
                background-color: white;
            }

            #employeeFrame {
                width: 100%;
                height: 100%;
                border: none;
            }
        </style>
    </head>
    <body>

    
    <button class="logout-button" onclick="logout()">Logout</button>

    <div class="button-container">
        <a href="#" id="informationbutton" class="link-button">Information</a>
        <button id="userbutton">Users</button>
        <button id="calendarbutton">Calendar</button>
        <button id="leaves_managementbutton">leaves management</button>
        
    </div>

    <div id="contentContainer">
        <iframe id="employeeFrame" src="" hidden></iframe>
    </div>

    <script>
        function logout() {
            
            window.location.href = "salary.php"; 
        }

        function toggleIframe(source) {
            const contentContainer = document.getElementById('contentContainer');
            const employeeFrame = document.getElementById('employeeFrame');

            
            if (contentContainer.style.display === 'none' || contentContainer.style.display === '') {
                employeeFrame.src = source; 
                contentContainer.style.display = 'block'; 
                employeeFrame.hidden = false; // 
            } else {
                contentContainer.style.display = 'none'; 
                employeeFrame.src = ""; 
                employeeFrame.hidden = true; 
            }
        }

        document.getElementById('informationbutton').addEventListener('click', function(event) {
            event.preventDefault(); 
            toggleIframe("administrator.php"); 
        });

        document.getElementById('userbutton').addEventListener('click', function() {
            toggleIframe("users.php"); 
        });
        document.getElementById('calendarbutton').addEventListener('click', function() {
            toggleIframe("calendar.php"); 
        });

        document.getElementById('leaves_managementbutton').addEventListener('click', function() {
            toggleIframe("leaves_management.php"); 
        });

    </script>

    </body>
    </html>
