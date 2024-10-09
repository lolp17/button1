<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendar</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; 
        }

        header {
            background: #0078D4; 
            color: white;
            padding: 15px 20px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            text-align: center;
        }

        main {
            text-align: center;
            margin: 20px;
        }

        .calendar {
            display: flex;
            flex-direction: column;
            align-items: center;
            background: white; 
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1); 
            padding: 20px; 
        }

        .controls {
            margin-bottom: 20px;
        }

        .calendar-header {
            margin-bottom: 10px;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr); 
            grid-template-rows: repeat(5, 1fr); 
            gap: 10px; 
            width: 100%; 
        }

        .day {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: center;
            background-color: #f0f0f0;
            border-radius: 8px; 
            transition: background-color 0.3s;
            min-height: 60px; 
            display: flex; 
            align-items: center;
            justify-content: center;
        }

        .day:hover {
            background-color: #e0f7fa; 
        }

        .empty {
            border: none;
            background: transparent;
            min-height: 60px; 
        }

        .day-header {
            font-weight: bold;
            background-color: #0078D4; 
            color: white;
            border-radius: 8px; 
            padding: 10px 0; 
            min-height: 60px; 
            text-align: center; 
        }

        footer {
            text-align: center;
            padding: 10px 0;
            margin-top: 20px;
        }

        @media (max-width: 600px) {
            .calendar-grid {
                grid-template-columns: repeat(3, 1fr); 
            }

            .day {
                padding: 10px; 
            }
        }
    </style>
</head>
<body>

<header>
    <h1>Calendar</h1>
</header>

<main>
    <div class="controls">
        <label for="month">Month:</label>
        <select id="month" onchange="updateCalendar()" aria-label="Select month"></select>
        <label for="year">Year:</label>
        <select id="year" onchange="updateCalendar()" aria-label="Select year"></select>
    </div>
    <div class="calendar">
        <div class="calendar-header">
            <h2 id="calendar-title">October 2024</h2>
        </div>
        <div class="calendar-grid" id="calendar-grid">
            <div class="day day-header">Sun</div>
            <div class="day day-header">Mon</div>
            <div class="day day-header">Tue</div>
            <div class="day day-header">Wed</div>
            <div class="day day-header">Thu</div>
            <div class="day day-header">Fri</div>
            <div class="day day-header">Sat</div>
           
        </div>
    </div>
</main>

<script>
    const calendarGrid = document.getElementById('calendar-grid');
    const calendarTitle = document.getElementById('calendar-title');
    const yearSelect = document.getElementById('year');
    const monthSelect = document.getElementById('month');
    const currentYear = new Date().getFullYear();
    const currentMonth = new Date().getMonth();

    
    for (let i = 0; i < 12; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = new Date(0, i).toLocaleString('default', { month: 'long' });
        monthSelect.appendChild(option);
    }

    
    for (let i = currentYear - 50; i <= currentYear + 50; i++) {
        const option = document.createElement('option');
        option.value = i;
        option.textContent = i;
        yearSelect.appendChild(option);
    }

    
    monthSelect.value = currentMonth;
    yearSelect.value = currentYear;

    function updateCalendar() {
        const month = parseInt(monthSelect.value);
        const year = parseInt(yearSelect.value);
        calendarTitle.textContent = `${monthSelect.options[month].text} ${year}`;
        renderCalendar(year, month);
    }

    function renderCalendar(year, month) {
        
        calendarGrid.querySelectorAll('.day:not(.day-header)').forEach(day => {
            day.remove(); 
        });

        const firstDayOfMonth = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        const today = new Date();
        const currentDay = today.getDate();
        const currentMonth = today.getMonth();
        const currentYear = today.getFullYear();

        
        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.className = 'empty';
            calendarGrid.appendChild(emptyDiv);
        }

        
        for (let day = 1; day <= daysInMonth; day++) {
            const dayDiv = document.createElement('div');
            dayDiv.className = 'day';
            dayDiv.textContent = day;

            
            if (day === currentDay && month === currentMonth && year === currentYear) {
                dayDiv.style.backgroundColor = '#ffeb3b'; 
                dayDiv.style.fontWeight = 'bold'; 
            }

            
            dayDiv.onclick = () => alert(`You clicked on ${day} ${monthSelect.options[month].text} ${year}`);

            calendarGrid.appendChild(dayDiv);
        }

       
        const totalCells = 35; 
        const emptyCells = totalCells - (firstDayOfMonth + daysInMonth);
        for (let i = 0; i < emptyCells; i++) {
            const emptyDiv = document.createElement('div');
            emptyDiv.className = 'empty';
            calendarGrid.appendChild(emptyDiv);
        }
    }

    
    renderCalendar(currentYear, currentMonth);
</script>
</body>
</html>
