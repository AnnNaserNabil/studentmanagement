<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Contact Us</title>

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      margin: 0;
      padding: 0;
      background: #f4f4f4;
    }

    .location iframe {
      width: 100%;
      height: 450px;
      border: none;
    }

    .contact-us {
      background: #fff;
      padding: 40px 20px;
      display: flex;
      flex-direction: column;
      align-items: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.05);
      max-width: 900px;
      margin: 0 auto;
    }

    .contact-info {
      display: flex;
      flex-direction: column;
      gap: 30px;
      width: 100%;
    }

    .contact-item {
      display: flex;
      align-items: center;
      gap: 20px;
    }

    .contact-item i {
      font-size: 32px;
      color: #e74c3c;
      min-width: 40px;
    }

    .contact-item h5 {
      margin: 0;
      font-size: 18px;
      color: #333;
    }

    .contact-item p {
      margin: 2px 0 0;
      font-size: 14px;
      color: #555;
    }

    .icon-demo {
      text-align: center;
      margin-top: 40px;
    }

    .icon-demo button {
      font-size: 20px;
      padding: 10px 20px;
      background: #3498db;
      color: #fff;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .icon-demo i {
      margin-left: 10px;
    }

    @media (min-width: 600px) {
      .contact-info {
        flex-direction: row;
        justify-content: space-around;
      }

      .contact-item {
        flex-direction: column;
        align-items: flex-start;
        max-width: 300px;
      }
    }
  </style>
</head>
<body>

  <!-- Google Map Section -->
  <section class="location">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d117768.06465023453!2d90.39955005000002!3d22.71887230000001!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x375533dd386a623b%3A0xd993f961bb50c143!2sBarisal%20Sadar%20Upazila!5e0!3m2!1sen!2sbd!4v1742048247649!5m2!1sen!2sbd" allowfullscreen loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </section>

  <!-- Contact Info Section -->
  <section class="contact-us">
    <h2 style="margin-bottom: 30px; color: #333;">Contact Information</h2>
    <div class="contact-info">
      <div class="contact-item">
        <i class="fa fa-home"></i>
        <div>
          <h5>DinbondhuShen Road, 775 Building</h5>
          <p>Barishal, Bangladesh</p>
        </div>
      </div>

      <div class="contact-item">
        <i class="fa fa-envelope"></i>
        <div>
          <h5>registar@global.edu</h5>
          <p>Email us your query</p>
        </div>
      </div>

      <div class="contact-item">
        <i class="fa fa-phone"></i>
        <div>
          <h5>+8801793107002</h5>
          <p>Sunday to Thursday, 9am to 5pm</p>
        </div>
      </div>
    </div>
  </section>

 

</body>
</html>
