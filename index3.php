<!-- user -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            position: relative;
        }
        form {
            background: white;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }
        input {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            width: calc(100% - 22px); 
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
        .link {
            text-align: center;
            margin-top: 10px;
        }
        .password-container {
            display: flex; 
            align-items: center; 
        }
        .toggle-password {
            margin-left: -40px; 
            cursor: pointer;
            border: none;
            background: none;
            color: #007BFF;
        }
    </style>
</head>
<body>

<form id="loginForm">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required>
    
    <label for="password">Password:</label>
    <div class="password-container">
        <input type="password" id="password" name="password" required>
        <button type="button" id="togglePassword" class="toggle-password">Show</button>
    </div>
    
    <button type="submit">Login</button>
    
    <div class="link">
        <button id="resetButton">Exit</button>
    </div>
</form>

<script>
    const credentials = {
        administrator: "admin123",
        manager: "manager123",
        employee: "user123"
    };

    document.getElementById("loginForm").addEventListener("submit", function(event) {
        event.preventDefault();
        const username = document.getElementById("username").value;
        const password = document.getElementById("password").value;

        if (username === "user" && password === credentials.employee) {
            alert("Login successful! Redirecting to employee page.");
            window.location.href = "userpage.php"; 
       
        } else {
            alert("Invalid username or password.");
        }
    });

    document.getElementById("resetButton").addEventListener("click", function() {
        resetForm(); 
    });

    function resetForm() {
        document.getElementById("loginForm").reset(); 
        window.location.href = "button1.php"; 
    }

    document.getElementById("togglePassword").addEventListener("click", function() {
        const passwordInput = document.getElementById("password");
        const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
        passwordInput.setAttribute("type", type);
        this.textContent = type === "password" ? "Show" : "Hide";
    });
</script>
</body>
</html>
