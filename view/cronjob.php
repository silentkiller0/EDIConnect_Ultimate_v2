<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crontab Generator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #132A2D;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1420px;
            width: 100%;
            height: 96%;
            margin: 20px auto;
            padding: 20px;
            background-color: #F6F7FB;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"] {
        padding: 10px;
        margin-right: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        flex-grow: 1; /* Permet à l'input de s'étirer pour remplir l'espace disponible */
    }


        h1 {
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        .input-group {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        label {
            margin-right: 10px;
            width: 150px;
        }

        select {
    padding: 10px;
    margin-right: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    flex-grow: 1; /* Permet au select de s'étirer pour remplir l'espace disponible */
}


        .button-container {
            display: flex;
            align-items: center;
            justify-content: center; /* Center the button horizontally */
            margin-top: 15px; /* Added margin to separate from input groups */
        }

        button {
            padding: 10px 20px; /* Adjusted padding for better button appearance */
            background-color: #4CAF4F;
            width: auto; /* Let the button size based on content */
            cursor: pointer; /* Added cursor style for better UX */
        }

        button:hover {
            background-color: #45a049; /* Darken the background color on hover */
        }

        .icon-copyy {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 20px; /* Added margin for separation */
        }

        .copy-icon {
            height: 1.5rem;
            width: 1.5rem;
            margin-left: 10px; /* Adjusted margin for spacing */
            color: #000;
            cursor: pointer; /* Added cursor style for better UX */
        }

        #result {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 4px;
            position: relative;
        }

        #crontabOutput {
            font-family: monospace;
            white-space: pre-wrap;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Crontab Generator</h1>
        <br>
        <form id="crontabForm">
            <div class="input-group">
                <label for="minute">Minute:</label>
                <select id="minute" name="minute" required>
                <option value="*">*</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
                <option value="32">32</option>
                <option value="33">33</option>
                <option value="34">34</option>
                <option value="35">35</option>
                <option value="36">36</option>
                <option value="37">37</option>
                <option value="38">38</option>
                <option value="39">39</option>
                <option value="40">40</option>
                <option value="41">41</option>
                <option value="42">42</option>
                <option value="43">43</option>
                <option value="44">44</option>
                <option value="45">45</option>
                <option value="46">46</option>
                <option value="47">47</option>
                <option value="48">48</option>
                <option value="49">49</option>
                <option value="50">50</option>
                <option value="51">51</option>
                <option value="52">52</option>
                <option value="53">53</option>
                <option value="54">54</option>
                <option value="55">55</option>
                <option value="56">56</option>
                <option value="57">57</option>
                <option value="58">58</option>
                <option value="59">59</option>
                <option value="60">60</option>
                </select>
                <input type="checkbox" id="minuteRepeat" name="minuteRepeat"> Répéter
            </div>

            <div class="input-group">
                <label for="hour">Hour:</label>
                <select id="hour" name="hour" required>
                <option value="*">*</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                </select>
                <input type="checkbox" id="hourRepeat" name="hourRepeat"> Répéter
            </div>

            <div class="input-group">
                <label for="dayOfMonth">Day of Month:</label>
                <select id="dayOfMonth" name="dayOfMonth" required>
                <option value="*">*</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
                <option value="13">13</option>
                <option value="14">14</option>
                <option value="15">15</option>
                <option value="16">16</option>
                <option value="17">17</option>
                <option value="18">18</option>
                <option value="19">19</option>
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
                <option value="31">31</option>
                </select>
                <input type="checkbox" id="dayOfMonthRepeat" name="dayOfMonthRepeat"> Répéter
            </div>

            <div class="input-group">
                <label for="month">Month:</label>
                <select id="month" name="month" required>
                <option value="*">*</option>
                <option value="1">1 (Jan)</option>
                <option value="2">2 (Feb)</option>
                <option value="3">3 (Mar)</option>
                <option value="4">4 (Apr)</option>
                <option value="5">5 (May)</option>
                <option value="6">6 (Jun)</option>
                <option value="7">7 (Jul)</option>
                <option value="8">8 (Aug)</option>
                <option value="9">9 (Sep)</option>
                <option value="10">10 (Oct)</option>
                <option value="11">11 (Nov)</option>
                <option value="12">12 (Dec)</option>
                </select>
                <input type="checkbox" id="monthRepeat" name="monthRepeat"> Répéter
            </div>

            <div class="input-group">
                <label for="dayOfWeek">Day of Week:</label>
                <select id="dayOfWeek" name="dayOfWeek" required>
                <option value="*">*</option>
                <option value="0">0 (Sun)</option>
                <option value="1">1 (Mon)</option>
                <option value="2">2 (Tue)</option>
                <option value="3">3 (Wed)</option>
                <option value="4">4 (Thu)</option>
                <option value="5">5 (Fri)</option>
                <option value="6">6 (Sat)</option>
                </select>
                <input type="checkbox" id="dayOfWeekRepeat" name="dayOfWeekRepeat"> Répéter
            </div>

            <div class="input-group">
                <label for="commandPath">Command Path:</label>
                <input type="text" id="commandPath" name="commandPath" placeholder="/path/to/script.sh" required>
            </div>

            <div class="button-container">
                <button type="button" onclick="generateCrontab()">Generate Crontab Entry</button>
            </div>
        </form>
        <div id="result">
            <div class="icon-copyy">
                <h2>Crontab Entry:</h2>
                <p id="crontabOutput">* * * * *</p>
                <i class="fas fa-copy copy-icon" onclick="copyToClipboard()"></i>
            </div>
        </div>
    </div>

    <script>
        function generateCrontab() {
            const minute = document.getElementById('minute').value;
            const hour = document.getElementById('hour').value;
            const dayOfMonth = document.getElementById('dayOfMonth').value;
            const month = document.getElementById('month').value;
            const dayOfWeek = document.getElementById('dayOfWeek').value;
            const commandPath = document.getElementById('commandPath').value;

            const minuteRepeat = document.getElementById('minuteRepeat').checked ? `*/${minute}` : minute;
            const hourRepeat = document.getElementById('hourRepeat').checked ? `*/${hour}` : hour;
            const dayOfMonthRepeat = document.getElementById('dayOfMonthRepeat').checked ? `*/${dayOfMonth}` : dayOfMonth;
            const monthRepeat = document.getElementById('monthRepeat').checked ? `*/${month}` : month;
            const dayOfWeekRepeat = document.getElementById('dayOfWeekRepeat').checked ? `*/${dayOfWeek}` : dayOfWeek;

            let crontabEntry = `${minuteRepeat} ${hourRepeat} ${dayOfMonthRepeat} ${monthRepeat} ${dayOfWeekRepeat}`;

            if (commandPath.trim() !== '') {
                crontabEntry += ` ${commandPath} `;
            }
            crontabEntry += `>/dev/null 2>&1`;

            document.getElementById('crontabOutput').innerText = crontabEntry;
        }

        function copyToClipboard() {
            const crontabText = document.getElementById('crontabOutput').innerText;
            const textarea = document.createElement('textarea');
            textarea.value = crontabText;
            document.body.appendChild(textarea);
            textarea.select();
            document.execCommand('copy');
            textarea.remove();
            alert('Crontab entry copied to clipboard!');
        }
    </script>
</body>
</html>
