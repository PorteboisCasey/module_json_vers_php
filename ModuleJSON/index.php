<!DOCTYPE html>
<html>
<head>
    <title>Module JSON</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px 0px rgba(0,0,0,0.15);
            width: 30%;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 5px;
            margin-top: 15px;
            color: #333;
        }
        input[type=text] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        input[type=submit] {
            display: block;
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #007BFF;
            color: #fff;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<form action="json_module.php" method="POST">
    <h1>Module JSON</h1>
    <label for="url">URL du site :</label>
    <input type="text" id="url" name="url" required><br>
    <label for="tag">Tag :</label>
    <input type="text" id="tag" name="tag"><br>
    <input type="submit" value="Afficher les données JSON">
</form>
</body>
</html>
