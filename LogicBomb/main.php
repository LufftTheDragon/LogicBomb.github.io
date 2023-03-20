<?php
    $countdownDuration = 30; // Set the countdown duration (in seconds) using PHP
    $targetURL = "https://www.pornhub.com/view_video.php?viewkey=ph611c586c867fa"; // Set the target URL for redirection using PHP
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Timer</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        #timer {
            font-size: 48px;
        }

        button {
            font-size: 24px;
            padding: 10px;
            cursor: pointer;
            margin: 5px;
        }
    </style>
</head>
<body>

<div id="timer"><?php echo sprintf("%02d", $countdownDuration); ?>:000</div>
<button onclick="stopTimer()">Stop Timer</button>
<button onclick="resumeTimer()">Resume Timer</button>

<script>
    let timer;
    let remainingTime = <?php echo $countdownDuration * 1000; ?>;
    const targetURL = "<?php echo $targetURL; ?>";

    function startTimer() {
        const startTime = Date.now() - (<?php echo $countdownDuration * 1000; ?> - remainingTime);
        
        timer = setInterval(() => {
            remainingTime = <?php echo $countdownDuration * 1000; ?> - (Date.now() - startTime);
            document.getElementById('timer').textContent = formatTime(remainingTime);

            if (remainingTime <= 0) {
                clearInterval(timer);
                timer = null;
                window.location.href = targetURL; // Redirect to the target URL
            }
        }, 10);
    }

    function stopTimer() {
        clearInterval(timer);
        timer = null;
    }

    function resumeTimer() {
        if (!timer) {
            startTimer();
        }
    }

    function formatTime(milliseconds) {
        const seconds = Math.floor(milliseconds / 1000);
        const remainingMilliseconds = milliseconds % 1000;

        return `${pad(seconds)}:${pad(remainingMilliseconds, 3)}`;
    }

    function pad(number, length = 2) {
        return String(number).padStart(length, '0');
    }

    // Start the timer when the page loads
    startTimer();
</script>

</body>
</html>