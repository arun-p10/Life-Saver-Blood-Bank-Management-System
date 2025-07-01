<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
<?php $active ='contact'; include 'head.php'; ?>

<?php
if(isset($_POST["send"])){
  $name = $_POST['fullname'];
  $number = $_POST['contactno'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $conn = mysqli_connect("localhost", "root", "rahul@16", "blood_donation") or die("Connection error");

  $sql = "INSERT INTO contact_query (query_name, query_number, query_mail, query_message)
          VALUES ('{$name}', '{$number}', '{$email}', '{$message}')";
  $result = mysqli_query($conn, $sql) or die("Query unsuccessful.");
  echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Query Sent!</strong> We will contact you shortly.</div>';
}
?>

<div id="page-container" style="margin-top:50px; position: relative;min-height: 84vh;">
  <div class="container">
    <div id="content-wrap" style="padding-bottom:50px;">
      <h1 class="mt-4 mb-3">Contact</h1>
      <div class="row">
        <div class="col-lg-8 mb-4">
          <h3>Send us a Message</h3>
          <form name="sentMessage" method="post">
            <div class="control-group form-group">
              <div class="controls">
                <label>Full Name:</label>
                <input type="text" class="form-control" name="fullname" required>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Phone Number:</label>
                <input type="tel" class="form-control" name="contactno" maxlength="10" required>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Email Address:</label>
                <input type="email" class="form-control" name="email" required>
              </div>
            </div>
            <div class="control-group form-group">
              <div class="controls">
                <label>Message:</label>
                <textarea rows="10" class="form-control" name="message" required maxlength="999" style="resize:none"></textarea>
              </div>
            </div>
            <button type="submit" name="send" class="btn btn-primary">Send Message</button>
          </form>
        </div>
        <div class="col-lg-4 mb-4">
          <h2>Contact Details</h2>
          <?php
            include 'conn.php';
            $sql = "SELECT * FROM contact_info";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
          ?>
          <br>
          <p><strong>Address:</strong><br><?php echo $row['contact_address']; ?></p>
          <p><strong>Contact Number:</strong><br><?php echo $row['contact_phone']; ?></p>
          <p><strong>Email:</strong><br><a href="#"><?php echo $row['contact_mail']; ?></a></p>
          <?php } } ?>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php'; ?>
</div>
</body>
</html>