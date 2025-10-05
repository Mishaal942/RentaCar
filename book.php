<?php include 'db.php'; 
$id=$_GET['id'];
$car=$conn->query("SELECT * FROM cars WHERE id=$id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<title>Book Car</title>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  margin: 0;
  min-height: 100vh;
  padding-bottom: 50px;
}

header {
  background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
  color: white;
  padding: 30px 20px;
  text-align: center;
  box-shadow: 0 4px 20px rgba(0,0,0,0.3);
  position: relative;
  overflow: hidden;
}

header::before {
  content: '';
  position: absolute;
  top: -50%;
  right: -50%;
  width: 200%;
  height: 200%;
  background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
  animation: headerPulse 15s infinite;
}

@keyframes headerPulse {
  0%, 100% { transform: translate(0, 0); }
  50% { transform: translate(-20px, -20px); }
}

header h1 {
  font-size: 2.3em;
  font-weight: 700;
  letter-spacing: 1px;
  text-shadow: 3px 3px 6px rgba(0,0,0,0.3);
  position: relative;
  z-index: 1;
  animation: fadeInDown 1s ease;
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.container {
  width: 90%;
  max-width: 900px;
  margin: 40px auto;
  background: white;
  padding: 0;
  border-radius: 25px;
  box-shadow: 0 15px 50px rgba(0,0,0,0.3);
  overflow: hidden;
  animation: scaleIn 0.8s ease;
  position: relative;
}

@keyframes scaleIn {
  from {
    opacity: 0;
    transform: scale(0.9);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.container::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 6px;
  background: linear-gradient(90deg, #667eea, #764ba2, #f093fb, #667eea);
  background-size: 200% 100%;
  animation: gradientMove 3s linear infinite;
}

@keyframes gradientMove {
  0% { background-position: 0% 0%; }
  100% { background-position: 200% 0%; }
}

.car-preview {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  padding: 40px;
  text-align: center;
  color: white;
  position: relative;
  overflow: hidden;
}

.car-preview::before {
  content: '🚗';
  position: absolute;
  font-size: 200px;
  opacity: 0.1;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.car-preview img {
  width: 100%;
  max-width: 400px;
  height: 250px;
  object-fit: cover;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.3);
  margin-bottom: 20px;
  border: 4px solid rgba(255,255,255,0.3);
  transition: transform 0.3s ease;
}

.car-preview img:hover {
  transform: scale(1.05);
}

.car-preview h2 {
  font-size: 2em;
  margin-bottom: 10px;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.car-preview .price-tag {
  display: inline-block;
  background: rgba(255,255,255,0.2);
  padding: 10px 20px;
  border-radius: 30px;
  font-size: 1.3em;
  font-weight: 700;
  backdrop-filter: blur(10px);
  border: 2px solid rgba(255,255,255,0.3);
}

.form-section {
  padding: 40px;
}

.form-section h3 {
  color: #2c3e50;
  font-size: 1.8em;
  margin-bottom: 25px;
  text-align: center;
  position: relative;
  padding-bottom: 15px;
}

.form-section h3::after {
  content: '';
  position: absolute;
  bottom: 0;
  left: 50%;
  transform: translateX(-50%);
  width: 80px;
  height: 4px;
  background: linear-gradient(90deg, #667eea, #764ba2);
  border-radius: 2px;
}

.form-group {
  margin-bottom: 25px;
  animation: slideIn 0.6s ease backwards;
}

.form-group:nth-child(1) { animation-delay: 0.1s; }
.form-group:nth-child(2) { animation-delay: 0.2s; }
.form-group:nth-child(3) { animation-delay: 0.3s; }
.form-group:nth-child(4) { animation-delay: 0.4s; }
.form-group:nth-child(5) { animation-delay: 0.5s; }

@keyframes slideIn {
  from {
    opacity: 0;
    transform: translateX(-30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

label {
  display: block;
  color: #555;
  font-weight: 600;
  margin-bottom: 8px;
  font-size: 0.95em;
  letter-spacing: 0.3px;
}

label::before {
  content: '●';
  color: #667eea;
  margin-right: 8px;
  font-size: 0.8em;
}

input {
  width: 100%;
  padding: 15px 20px;
  border: 2px solid #e0e0e0;
  border-radius: 12px;
  font-size: 16px;
  transition: all 0.3s ease;
  background: #f8f9fa;
  outline: none;
}

input:focus {
  border-color: #667eea;
  background: white;
  box-shadow: 0 0 0 4px rgba(102,126,234,0.1);
  transform: translateY(-2px);
}

input::placeholder {
  color: #aaa;
}

.date-inputs {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

button {
  width: 100%;
  padding: 18px;
  background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
  color: white;
  border: none;
  border-radius: 12px;
  font-size: 18px;
  font-weight: 700;
  cursor: pointer;
  transition: all 0.3s ease;
  box-shadow: 0 6px 20px rgba(39,174,96,0.4);
  letter-spacing: 1px;
  margin-top: 15px;
  position: relative;
  overflow: hidden;
}

button::before {
  content: '';
  position: absolute;
  top: 50%;
  left: 50%;
  width: 0;
  height: 0;
  border-radius: 50%;
  background: rgba(255,255,255,0.3);
  transform: translate(-50%, -50%);
  transition: width 0.6s, height 0.6s;
}

button:hover::before {
  width: 300px;
  height: 300px;
}

button:hover {
  background: linear-gradient(135deg, #229954 0%, #1e8449 100%);
  transform: translateY(-3px);
  box-shadow: 0 8px 25px rgba(39,174,96,0.6);
}

button:active {
  transform: translateY(-1px);
}

button span {
  position: relative;
  z-index: 1;
}

.back-link {
  display: inline-block;
  margin: 20px 40px;
  color: #667eea;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
  padding: 10px 20px;
  border-radius: 8px;
  background: rgba(102,126,234,0.1);
}

.back-link:hover {
  background: rgba(102,126,234,0.2);
  transform: translateX(-5px);
}

.booking-info {
  background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
  color: white;
  padding: 20px;
  margin: 20px 40px;
  border-radius: 15px;
  text-align: center;
  box-shadow: 0 4px 15px rgba(245,87,108,0.3);
}

.booking-info p {
  margin: 5px 0;
  font-size: 0.95em;
}

@media (max-width: 768px) {
  .container {
    width: 95%;
    margin: 20px auto;
  }
  
  .form-section {
    padding: 25px;
  }
  
  .car-preview {
    padding: 25px;
  }
  
  header h1 {
    font-size: 1.6em;
  }
  
  .date-inputs {
    grid-template-columns: 1fr;
    gap: 15px;
  }
  
  .car-preview img {
    max-width: 100%;
    height: 200px;
  }
}
</style>
</head>
<body>
<header><h1>🎯 Book Your Dream Car</h1></header>

<div class="container">
  <div class="car-preview">
    <img src="<?php echo $car['image_url']; ?>" alt="<?php echo $car['car_name']; ?>">
    <h2><?php echo $car['car_name']; ?></h2>
    <div class="price-tag">💰 PKR <?php echo $car['price_per_day']; ?>/day</div>
  </div>
  
  <div class="booking-info">
    <p>✨ <strong>Special Offer:</strong> Book for 7+ days and get 10% discount!</p>
    <p>🛡️ Free insurance included | 📞 24/7 support available</p>
  </div>
  
  <div class="form-section">
    <h3>📋 Booking Details</h3>
    <form method="post" action="confirm.php">
      <input type="hidden" name="car_id" value="<?php echo $car['id']; ?>">
      
      <div class="form-group">
        <label>👤 Full Name</label>
        <input type="text" name="customer_name" placeholder="Enter your full name" required>
      </div>
      
      <div class="form-group">
        <label>📧 Email Address</label>
        <input type="email" name="customer_email" placeholder="your.email@example.com" required>
      </div>
      
      <div class="form-group">
        <label>📍 Pickup Location</label>
        <input type="text" name="pickup_location" placeholder="Enter pickup address" required>
      </div>
      
      <div class="date-inputs">
        <div class="form-group">
          <label>📅 Start Date</label>
          <input type="date" name="start_date" required>
        </div>
        
        <div class="form-group">
          <label>📅 End Date</label>
          <input type="date" name="end_date" required>
        </div>
      </div>
      
      <button type="submit"><span>✅ Confirm Booking</span></button>
    </form>
  </div>
  
  <a href="cars.php" class="back-link">← Back to Cars</a>
</div>
</body>
</html>
