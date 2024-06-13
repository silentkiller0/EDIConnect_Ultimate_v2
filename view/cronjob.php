<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crontab Generator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #132A2D;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #F6F7FB;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
        }

        select, input[type="text"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        #result {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 4px;
        }

        #crontabOutput {
            font-family: monospace;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Crontab Generator</h1>
        <form id="crontabForm">
            <label for="minute">Minute:</label>
            <select id="minute" name="minute" required>
                <option value="*">*</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <!-- Add other options as needed -->
                <option value="59">59</option>
            </select>

            <label for="hour">Hour:</label>
            <select id="hour" name="hour" required>
                <option value="*">*</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <!-- Add other options as needed -->
                <option value="23">23</option>
            </select>

            <label for="dayOfMonth">Day of Month:</label>
            <select id="dayOfMonth" name="dayOfMonth" required>
                <option value="*">*</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <!-- Add other options as needed -->
                <option value="31">31</option>
            </select>

            <label for="month">Month:</label>
            <select id="month" name="month" required>
                <option value="*">*</option>
                <option value="1">1 (Jan)</option>
                <option value="2">2 (Feb)</option>
                <!-- Add other options as needed -->
                <option value="12">12 (Dec)</option>
            </select>

            <label for="dayOfWeek">Day of Week:</label>
            <select id="dayOfWeek" name="dayOfWeek" required>
                <option value="*">*</option>
                <option value="0">0 (Sun)</option>
                <option value="1">1 (Mon)</option>
                <!-- Add other options as needed -->
                <option value="6">6 (Sat)</option>
            </select>

            <label for="command">Command:</label>
            <input type="text" id="command" name="command" required>

            <button type="button" onclick="generateCrontab()">Generate Crontab Entry</button>
        </form>
        <div id="result">
            <h2>Crontab Entry:</h2>
            <p id="crontabOutput"></p>
        </div>
    </div>
    <script>
        function generateCrontab() {
            const minute = document.getElementById('minute').value;
            const hour = document.getElementById('hour').value;
            const dayOfMonth = document.getElementById('dayOfMonth').value;
            const month = document.getElementById('month').value;
            const dayOfWeek = document.getElementById('dayOfWeek').value;
            const command = document.getElementById('command').value;

            const crontabEntry = `${minute} ${hour} ${dayOfMonth} ${month} ${dayOfWeek} ${command}`;
            
            document.getElementById('crontabOutput').innerText = crontabEntry;
        }
    </script>
</body>
</html>
