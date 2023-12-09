<?php
// Inisialisasi variabel
$name = $email = $website = $comment = $gender = "";
$nameErr = $emailErr = $websiteErr = $genderErr = "";

// Fungsi untuk membersihkan input
function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Memproses formulir ketika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi nama
    if (empty($_POST["name"])) {
        $nameErr = "Nama harus diisi";
    } else {
        $name = cleanInput($_POST["name"]);
        // Periksa apakah nama hanya berisi huruf dan spasi
        if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
            $nameErr = "Hanya huruf dan spasi yang diperbolehkan";
        }
    }

    // Validasi email
    if (empty($_POST["email"])) {
        $emailErr = "Email harus diisi";
    } else {
        $email = cleanInput($_POST["email"]);
        // Periksa apakah format email valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Format email tidak valid";
        }
    }

    // Validasi website
    if (!empty($_POST["website"])) {
        $website = cleanInput($_POST["website"]);
        // Periksa apakah format URL valid
        if (!filter_var($website, FILTER_VALIDATE_URL)) {
            $websiteErr = "Format URL tidak valid";
        }
    }

    // Validasi jenis kelamin
    if (empty($_POST["gender"])) {
        $genderErr = "Jenis kelamin harus dipilih";
    } else {
        $gender = cleanInput($_POST["gender"]);
    }

    // Tanggapan/Komentar
    $comment = cleanInput($_POST["comment"]);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <style>
    body {
        font-family: 'Arial', sans-serif;
        background-color: #1a1a1a;
        color: #fff;
        margin: 0;
        padding: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    form {
        background-color: #333;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
        width: 400px;
        max-width: 100%;
    }

    input,
    textarea,
    select {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        box-sizing: border-box;
        border: 1px solid #555;
        border-radius: 6px;
        background-color: #444;
        color: #fff;
        transition: border-color 0.3s;
        font-size: 16px;
    }

    input[type="submit"] {
        background-color: #4caf50;
        color: #fff;
        cursor: pointer;
        border: none;
        border-radius: 6px;
        padding: 12px;
        font-size: 18px;
        transition: background-color 0.3s;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .error {
        color: #e74c3c;
        font-size: 14px;
        margin-top: 5px;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-size: 16px;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    input,
    textarea,
    select {
        animation: fadeIn 1s ease-in-out;
    }

    input[type="radio"],
    input[type="checkbox"] {
        margin-top: 5px;
    }

    .required-text {
        font-size: 12px;
        color: #e74c3c;
        margin-top: 5px;
    }
</style>




</head>
<body>

    <div class="container">
        <h2>Form Validation</h2>
        <p><span class="error">* required field</span></p>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <span class="error">* <?php echo $nameErr; ?></span>
            <br>
            <label for="name">Nama:</label>
            <input type="text" name="name" id="name" value="<?php echo $name; ?>">
            
            <span class="error">* <?php echo $emailErr; ?></span>
            <br>
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" value="<?php echo $email; ?>">
            
            <span class="error">* <?php echo $websiteErr; ?></span>
            <br>
            <label for="website">Website:</label>
            <input type="text" name="website" id="website" value="<?php echo $website; ?>">
            
            <label for="comment">Komentar:</label>
            <textarea name="comment" id="comment" rows="5" cols="40"><?php echo $comment; ?></textarea>
            <br>
            
            <span class="error">*<?php echo $genderErr; ?></span>
            <br>
            <div class="gender-group">
            <label for="gender">Jenis Kelamin:</label>
            <input type="radio" name="gender" id="male" value="Laki-laki" <?php if ($gender == "Laki-laki") echo "checked"; ?>> Laki-laki
            <input type="radio" name="gender" id="female" value="Perempuan" <?php if ($gender == "Perempuan") echo "checked"; ?>> Perempuan
            
            <br><br>
            <input type="submit" name="submit" class="btn" value="Submit">
        </form>
    </div>

</body>
</html>
