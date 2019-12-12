<html>
<head>
    <?php include "../Layout/head.php"; ?>
</head>

<body>

<div class="container">
    <div class="row">
        <h1 class="jumbotron text-center">CSV Comma Separated Values File</h1>
    </div>
    <?php $error = false; ?>
    <?php if (!isset($_POST['server'])): ?>
        <?php $error = true; ?>
        <div class="alert alert-danger">Please Insert Server Url</div>
    <?php endif; ?>
    <?php if (!isset($_POST['user'])): ?>
        <?php $error = true; ?>
        <div class="alert alert-danger">Please Insert User Name</div>
    <?php endif; ?>
    <?php if (!isset($_POST['pass'])): ?>
        <?php $error = true; ?>
        <div class="alert alert-danger">Please Insert Password</div>
    <?php endif; ?>
    <?php if (!isset($_POST['db'])): ?>
        <?php $error = true; ?>
        <div class="alert alert-danger">Please Insert Database Name</div>
    <?php endif; ?>
    <?php if (!isset($_POST['table'])): ?>
        <?php $error = true; ?>
        <div class="alert alert-danger">Please Insert Table Name</div>
    <?php endif; ?>
    <form method="post" action="" class="form">
        <div class="form-group">
            <label>Data Base Server Url</label>
            <input type="text" name="server">
        </div>
        <div class="form-group">
            <label>User Name</label>
            <input type="text" name="user">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="pass">
        </div>
        <div class="form-group">
            <label>Data Base Name</label>
            <input type="text" name="db">
        </div>
        <div class="form-group">
            <label>Table Name</label>
            <input type="text" name="table">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Import</button>
        </div>
    </form>
    <?php if (!$error): ?>
        <?php if (!$conn = mysqli_connect($_POST['server'], $_POST['user'], $_POST['pass'], $_POST['db'])): ?>
            <div class="alert alert-danger">Your Connection Information's Not Correct</div>
            <?php die(); ?>
        <?php endif; ?>
        <?php if (!$query = mysqli_query($conn, 'select * from ' . $_POST['table'])): ?>
            <div class="alert alert-danger">Your Table Name Not Correct</div>
            <?php die(); ?>
        <?php endif; ?>
        <?php $result = mysqli_fetch_all($query, MYSQLI_ASSOC); ?>

        <?php $file = fopen('../files/' . $_POST['server'] . $_POST['db'] . '.csv', 'w'); ?>
        <?php if ($file == false): ?>
            <div class="alert alert-danger">Error file create</div>
            <?php die(); ?>
        <?php endif; ?>

        <?php fputcsv($file,array_keys($result[0])); ?>
        <?php foreach ($result as $res): ?>
            <?php fputcsv($file, $res); ?>
        <?php endforeach; ?>
        <a href="../files/<?php echo '../files/' . $_POST['server'] . $_POST['db'] . '.csv'; ?>"
           class="btn btn-success">Download</a>
    <?php endif; ?>
    <a href="../home.php" class="btn btn-info">Back</a>
</div>
</body>
</html>