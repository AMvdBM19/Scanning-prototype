<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Random Pick</title>
</head>
<body>

<h2>Random Item Picker</h2>

<form action="display_order.php" method="post">
    <label for="numberOfItems">Number of Items:</label>
    <input type="number" id="numberOfItems" name="numberOfItems" min="1" max="25" required>
    <button type="submit">Generate Form</button>
</form>

<div>
    <p>This function generates a picking order, choosing random items from a simulated database (database.csv).<br>
    Please input the amount of items you wish to have in the order. (Don't exceed 25).</p>
    
</div>

</body>
</html>
