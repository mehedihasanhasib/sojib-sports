<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Listing</title>
</head>

<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $target_file = "uploads/" . basename($_FILES["image"]["name"]);
        $uploadOk = true;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        if (empty($_POST["title"])) {
            echo "<p style='color:red;'> * Give a title of your product</p>";
            $uploadOk = false;
        } else if ($_FILES["image"]["size"] == 0) {
            echo "<p style='color:red;'> * Select a product image</p>";
            $uploadOk = false;
        } else if (file_exists($target_file)) {
            echo "<p style='color:red;'>Sorry, file already exists </p>";
            $uploadOk = false;
        } else {

            if ($uploadOk) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                    include "connectDB.php";
                    $statment = $connection->prepare("INSERT INTO products (title, product_desc, product_image) VALUES(?, ?, ?)");
                    $tilte = $_POST["title"];
                    $product_desc = $_POST["description"];
                    $product_image = $target_file;

                    $statment->bind_param("sss", $tilte, $product_desc, $product_image);

                    if ($statment->execute()) {
                        echo "<p style='color:blue;'>Product upload is successfull</p>";
                    } else {
                        echo $connection->error;
                    }
                } else {
                    echo "<p style='color:red;'>ohh sorry! there is an problem</p>";
                }


                // elseif ($_FILES["image"]["size"] > 500000) {
                //             echo "image is too large. Image file should not exceed 500kb";
                //             $uploadOk = false;
                //         }
                // echo $product_image;
            }
        }
    }
    ?>

    <form action="admin.php" method="POST" enctype="multipart/form-data">
        <input type=" text" name="title" placeholder="Title">
        <input type="textarea" name="description" placeholder="Description">
        <input type="file" name="image">
        <button type="submit">Upload</button>
    </form>

</body>

</html>