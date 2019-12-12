<html>
<head>
    <?php include "../Layout/head.php"; ?>
</head>

<body>
<?php $filesdir = scandir("../files"); ?>
<?php $files = array_diff($filesdir, ['..', '.']); ?>
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
    <?php if (!isset($_POST['file'])): ?>
        <?php $error = true; ?>
        <div class="alert alert-danger">Please Select File or Upload File</div>
    <?php endif; ?>
    <form method="post" action="">
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
            <label>Select File</label>
            <select name="file">
                <?php foreach ($files as $file): ?>
                    <option><?php echo $file ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-success">Export</button>
        </div>
    </form>
    <?php if (!$error): ?>
        <?php if (!$conn = mysqli_connect($_POST['server'], $_POST['user'], $_POST['pass'], $_POST['db'])): ?>
            <div class="alert alert-danger">Your Connection Information's Not Correct</div>
            <?php die(); ?>
        <?php endif; ?>
        <?php $file = fopen('../files/' . $_POST['file'], 'r'); ?>
        <?php $data0=fgetcsv($file, '10000', ',');?>
        <?php while ($data = fgetcsv($file, '10000', ',')): ?>
        <?php $errorInsert=false;?>
            <?php if (!$query = mysqli_query($conn, 'insert into ' . $_POST['table'] . " (".implode(',',$data0).") values('" . implode('\',\'',$data)."')")): ?>
                <div class="alert alert-danger">Error format file with table</div>
            <?php $errorInsert=true;?>
                <?php die(); ?>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php if(!$errorInsert):?>
            <div class="alert alert-success">Export Data Success</div>
    <?php endif;?>
    <?php endif; ?>
    <a href="../home.php" class="btn btn-info">Back</a>
</div>
</body>
</html>