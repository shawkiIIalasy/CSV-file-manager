<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <?php include "../Layout/head.php"; ?>
</head>

<body>
<div class="container">
    <div class="row">
        <h1 class="jumbotron text-center">CSV Comma Separated Values File</h1>
    </div>
    <?php $error = false; ?>
    <?php if (isset($_POST['fileName'])): ?>
        <?php if (!preg_match("/^[A-Za-z][A-Za-z]{2,10}$/", $_POST['fileName'])): ?>
            <?php $error = true; ?>
            <div class="alert alert-danger">File Name Must be only alpha characters and length between 2 and 10</div>
        <?php endif; ?>
    <?php else: ?>
        <?php $error = true; ?>
    <?php endif; ?>
    <?php if (isset($_POST['rows'])): ?>
        <?php if ($_POST['rows'] < 0 || $_POST['rows'] > 101): ?>
            <?php $error = true; ?>
            <div class="alert alert-danger">Rows Must be between 0 and 100</div>
        <?php endif; ?>
    <?php else: ?>
        <?php $error = true; ?>
    <?php endif; ?>
    <?php if (isset($_POST['columns'])): ?>
        <?php if ($_POST['columns'] < 0 || $_POST['columns'] > 101): ?>
            <?php $error = true; ?>
            <div class="alert alert-danger">Column Must be between 0 and 100</div>
        <?php endif; ?>
    <?php else: ?>
        <?php $error = true; ?>
    <?php endif; ?>


    <div class="row">
        <div class="col-xm-12">
            <form action="" method="post" class="form">
                <div class="form-group">
                    <lable>File Name</lable>
                    <input type="text" name="fileName">
                </div>
                <div class="form-group">
                    <lable>File Rows</lable>
                    <input type="number" name="rows" min="1" max="100">
                    <lable>File Column</lable>
                    <input type="number" name="columns" min="1" max="100">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="Create" class="btn btn-primary">
                </div>
            </form>
        </div>
        <hr>
        <?php if (!$error): ?>
        <h4 class="jumbotron"><?php echo $_POST['fileName'];?></h4>
        <form action="createFile.php" method="post">
            <table class="form">
                <thead>
                <?php for ($j = 0; $j < $_POST['columns']; $j++): ?>
                    <th><input class="form-group" type="text" name="title[]" placeholder="Column Title"></th>
                <?php endfor; ?>
                </thead>
                <tbody>
                <?php for ($i = 0; $i < $_POST['rows']; $i++): ?>
                    <tr>
                        <?php for ($j = 0; $j < $_POST['columns']; $j++): ?>
                            <td><input type="text" class="form-group" name="row<?php echo $i;?>[]"></td>
                        <?php endfor; ?>
                    </tr>
                <?php endfor; ?>
                </tbody>
            </table>
            <input type="hidden" name="fileName" value="<?php echo $_POST['fileName']?>">
            <input type="hidden" name="rows" value="<?php echo $_POST['rows']?>">
            <input type="hidden" name="columns" value="<?php echo $_POST['columns']?>">
            <button type="submit" class="btn btn-primary">Save</button>
        </form>
        <?php endif; ?>
        <a href="../home.php" class="btn btn-info">Back</a>
    </div>
</div>
</body>
</html>