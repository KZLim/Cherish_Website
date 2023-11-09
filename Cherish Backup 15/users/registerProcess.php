<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clickable Container</title>
  <!-- Link to Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/css/bootstrap.min.css">
  <!-- Custom CSS for the clickable container -->
  <style>
    .clickable-container {
      background-color: #007bff; /* Set the background color */
      color: #fff; /* Set the text color */
      padding: 20px; /* Add padding to create space inside the container */
      cursor: pointer; /* Change the cursor to a pointer on hover to indicate clickability */
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-md-4">
        <!-- Clickable container -->
        <div class="clickable-container" onclick="handleClick()">
          Clickable Container
        </div>
      </div>
    </div>
  </div>

  <!-- JavaScript function to handle the click -->
  <script>
    function handleClick() {
      // Add your click handling logic here
      alert('Container clicked!');
    }
  </script>
</body>
</html>
