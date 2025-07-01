<?php
include 'conn.php';
include 'session.php';

if (isset($_GET['action']) && $_GET['action'] == 'read' && isset($_GET['id'])) {
    $que_id = $_GET['id'];
    $sql1 = "UPDATE contact_query SET query_status = 1 WHERE query_id = {$que_id}";
    mysqli_query($conn, $sql1);
    header("Location: query.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Query List</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<?php include 'header.php'; ?>
<div class="container mt-5">
    <h2>All Queries</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sr No.</th>
                <th>Name</th>
                <th>Number</th>
                <th>Email</th>
                <th>Message</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM contact_query ORDER BY query_id DESC";
            $result = mysqli_query($conn, $sql);
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $row['query_name']; ?></td>
                <td><?php echo $row['query_number']; ?></td>
                <td><?php echo $row['query_mail']; ?></td>
                <td><?php echo $row['query_message']; ?></td>
                <td>
                    <?php if ($row['query_status'] == 0): ?>
                        <a href="query.php?action=read&id=<?php echo $row['query_id']; ?>"><b style="color:red;">Pending</b></a>
                    <?php else: ?>
                        <b style="color:green;">Read</b>
                    <?php endif; ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php include '../footer.php'; ?>
</body>
</html>