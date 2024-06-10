<?php
include 'connect.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM procedures WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $procedure = $result->fetch_assoc();

    if (!$procedure) {
        echo "Procedure not found";
        exit();
    }
} else {
    echo "Invalid request.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Procedure</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-4">
        <h1 class="text-center">Edit Procedure</h1>
        <form action="update_procedure.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $procedure['id']; ?>">
            <div class="form-group">
                <label for="procedureName">Procedure Name</label>
                <input type="text" class="form-control" id="procedureName" name="procedureName" value="<?php echo $procedure['name']; ?>" required>
            </div>
            <div class="form-group">
                <label for="procedurePrice">Procedure Price</label>
                <input type="number" step="0.01" min="0" class="form-control" id="procedurePrice" name="procedurePrice" value="<?php echo $procedure['price']; ?>" required>
            </div>
            <div class="form-group">
                <label for="procedureImage">Procedure Image</label>
                <input type="file" class="form-control-file" id="procedureImage" name="procedureImage">
                <small>Leave this empty if you don't want to change the image.</small>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>
</body>
</html>
