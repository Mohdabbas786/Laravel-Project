<?php
// Your existing database or API setup can go here
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Live Data Stream</title>
    <style>
        body { font-family: system-ui, sans-serif; margin: 50px; background: #f4f6f8; }
        .box { background: white; max-width: 500px; padding: 24px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.08); }
        pre { background: #1e1e1e; color: #d4d4d4; padding: 12px; border-radius: 6px; overflow-x: auto; }
        .status { font-size: 0.85rem; color: #28a745; margin-bottom: 10px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="box">
        <h2>Live Data Feed</h2>
        <div class="status" id="connection-status">Connecting to live feed...</div>
        <pre id="live-data">Loading...</pre>
    </div>

    <script>
        async function fetchLiveData() {
            try {
                // Fetch fresh data from your api.php file
                const response = await fetch('api.php');
                const data = await response.json();
                
                // Update the DOM with the formatted JSON
                document.getElementById('live-data').textContent = JSON.stringify(data, null, 2);
                document.getElementById('connection-status').textContent = '● Live (Updating every 3s)';
            } catch (error) {
                document.getElementById('connection-status').textContent = '○ Connection error, retrying...';
                document.getElementById('connection-status').style.color = '#dc3545';
            }
        }

        // Fetch immediately when page loads
        fetchLiveData();

        // Automatically re-fetch every 3 seconds (3000 milliseconds)
        setInterval(fetchLiveData, 3000);
    </script>
</body>
</html                       