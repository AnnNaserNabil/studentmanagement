<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admission Form</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: #f5f7fa;
      margin: 0;
      padding: 20px;
    }

    .form-container {
      max-width: 500px;
      margin: 40px auto;
      background: #ffffff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: 600;
      margin-bottom: 8px;
      color: #444;
    }

    input[type="text"],
    input[type="email"],
    textarea {
      width: 100%;
      padding: 12px 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
      transition: border-color 0.3s ease;
    }

    input:focus,
    textarea:focus {
      border-color: #007bff;
      outline: none;
    }

    textarea {
      resize: vertical;
      height: 100px;
    }

    .submit-btn {
      width: 100%;
      background-color: #007bff;
      color: white;
      padding: 12px;
      font-size: 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .submit-btn:hover {
      background-color: #0056b3;
    }

    @media (max-width: 600px) {
      .form-container {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <div class="form-container">
    <h1>Admission Form</h1>
    <form>
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Enter your full name" required>
      </div>

      <div class="form-group">
        <label for="email">Email Address</label>
        <input type="email" id="email" name="email" placeholder="Enter your email" required>
      </div>

      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" placeholder="Enter your phone number" required>
      </div>

      <div class="form-group">
        <label for="message">Your Message</label>
        <textarea id="message" name="message" placeholder="Type your message here..."></textarea>
      </div>

      <button type="submit" class="submit-btn">Apply</button>
    </form>
  </div>

</body>
</html>
