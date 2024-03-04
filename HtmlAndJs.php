<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Fetching Form</title>
</head>
<body>

  <h2>Data Fetching Form</h2>

  <form id="myForm" >
    <label for="username">Enter your name:</label>
    <input type="text" id="username" name="username" required>
    <button type="button" onclick="fetchData()">Fetch Data</button>
  </form>


  <div id="result"></div>

  <script>
    function fetchData() {
      // Get the value entered in the input field
      const userName = document.getElementById('username').value;

      // Perform an action with the data (for demonstration, just display it)
    //   document.getElementById('result').innerHTML = `Hello, ${userName}!`;
        // Create a new XMLHttpRequest object
      const xhttp = new XMLHttpRequest();

// Set up the request
xhttp.open("POST", "HtmlAndJs.php", true);
xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

// Set up the event handler for when the request is complete
xhttp.onreadystatechange = function() {
  if (this.readyState === 4 && this.status === 200) {
    // Display the response from the PHP page
    document.getElementById('result').innerHTML = this.responseText;
  }
};

// Send the request with the data
xhttp.send("username=" + userName);

      // You can also use this data to make AJAX requests, fetch data from a server, etc.
      // For example, you could use the fetch API to make an asynchronous request to a server.
    }
  </script>


<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
    $name =  inputTrim($_POST["username"] );
    echo $name;
  }
  function inputTrim($data)
  {
      $data = trim($data);
      $data = stripslashes($data);
      $data =  htmlspecialchars($data);
      return $data;
  }

?>
</body>
</html>
