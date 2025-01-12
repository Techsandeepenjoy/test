<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Logo Maker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        h1 {
            margin-top: 20px;
        }

        form {
            margin: 20px;
        }

        input[type="text"] {
            padding: 5px;
            width: 200px;
        }

        button {
            padding: 5px 10px;
        }

        .logo-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>AI Logo Maker</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $apiKey = "quickstart-QUdJIGlzIGNvbWluZy4uLi4K";
        $logoText = $_POST["logoText"];

        // Make API request
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.deepai.org/api/text2img");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "text=$logoText");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("api-key: $apiKey"));
        $response = curl_exec($ch);
        curl_close($ch);

        // Process API response
        $responseData = json_decode($response, true);
        if (isset($responseData["output_url"])) {
            echo '<div class="logo-container">';
            echo '<img src="' . $responseData["output_url"] . '" alt="Generated Logo">';
            echo '</div>';
        } else {
            echo "Error generating logo.";
        }
    }
    ?>
    <form action="" method="post">
        <label for="logoText">Enter Logo Text:</label>
        <input type="text" id="logoText" name="logoText" required>
        <button type="submit">Generate Logo</button>
    </form>
</body>
</html>
