<html>
<head>
    <?php include "Layout/head.php";?>
</head>
<?php $filesdir = scandir("files"); ?>
<?php $files = array_diff($filesdir, ['..', '.']); ?>
<body>

<div class="container">
    <h1 class="jumbotron text-center">CSV Comma Separated Values File</h1>
    <a href="class/add.php" class="btn btn-primary">Create File(csv)</a>
    <a href="class/import.php" class="btn btn-success">Import CSV File into MySQL</a>
    <a href="class/export.php" class="btn btn-success">Export Mysqli table into CSV file</a>
<table class="table">
    <thead>
    <th>File Name</th>
    <th>Actions</th>
    </thead>
    <tbody>
    <?php foreach ($files as $file): ?>
        <tr>
            <td><?php echo $file; ?></td>
            <td>
                <a href="class/show.php?fileName=<?php echo $file?>" class="btn btn-primary">show</a>
                <a href="class/edit.php?fileName=<?php echo $file?>" class="btn btn-info">edit</a>
                <a href="class/delete.php?fileName=<?php echo $file?>" class="btn btn-danger">Delete</a>
                <a href="files/<?php echo $file?>" class="btn btn-success">Download</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</div>
</body>

</html>