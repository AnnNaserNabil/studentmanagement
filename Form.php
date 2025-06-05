<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admission Form</title>
   <link rel="stylesheet" href="form.css">
</head>
<body>

  <div class="form-container">
    <h2>Admission Form</h2>
    <form action="data_check.php" method="POST">
      <div class="form-group">
        
        <label for="name">Full Name</label>
        <input type="text" name="name" id="name" required />
      </div>

      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" name="email" id="email" required />
      </div>

      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" name="phone" id="phone" pattern="[0-9]{11}" placeholder="e.g. 01XXXXXXXXX" required />
      </div>

      <div class="form-group">
        <label for="message">Your Message</label>
        <textarea name="message" id="message" required></textarea>
      </div>

      <button type="submit" class="submit-btn" name="apply">Apply</button>
    </form>
  </div>

</body>
</html>
