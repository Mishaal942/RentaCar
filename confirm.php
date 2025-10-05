<?php
include 'db.php';
$car_id=$_POST['car_id'];
$name=$_POST['customer_name'];
$email=$_POST['customer_email'];
$location=$_POST['pickup_location'];
$start=$_POST['start_date'];
$end=$_POST['end_date'];
$sql="INSERT INTO bookings (car_id,customer_name,customer_email,pickup_location,start_date,end_date)
VALUES ('$car_id','$name','$email','$location','$start','$end')";
$success=$conn->query($sql)===TRUE;
$car=$conn->query("SELECT * FROM cars WHERE id=$car_id")->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
<title>Booking Confirmation</title>
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
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 20px;
}

.confirmation-container {
  background: white;
  border-radius: 25px;
  box-shadow: 0 20px 60px rgba(0,0,0,0.3);
  overflow: hidden;
  max-width: 600px;
  width: 100%;
  animation: scaleIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  position: relative;
}

@keyframes scaleIn {
  from {
    opacity: 0;
    transform: scale(0.8) translateY(50px);
  }
  to {
    opacity: 1;
    transform: scale(1) translateY(0);
  }
}

.confirmation-container::before {
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

.success-header {
  background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
  padding: 40px;
  text-align: center;
  color: white;
  position: relative;
  overflow: hidden;
}

.error-header {
  background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
  padding: 40px;
  text-align: center;
  color: white;
  position: relative;
  overflow: hidden;
}

.success-header::before, .error-header::before {
  content: '';
  position: absolute;
  width: 300px;
  height: 300px;
  background: rgba(255,255,255,0.1);
  border-radius: 50%;
  top: -150px;
  right: -150px;
  animation: float 6s ease-in-out infinite;
}

@keyframes float {
  0%, 100% { transform: translateY(0) rotate(0deg); }
  50% { transform: translateY(20px) rotate(180deg); }
}

.success-icon {
  width: 120px;
  height: 120px;
  background: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  font-size: 60px;
  animation: checkmarkBounce 0.6s ease 0.5s backwards;
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

.error-icon {
  width: 120px;
  height: 120px;
  background: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  font-size: 60px;
  animation: shake 0.6s ease 0.5s backwards;
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

@keyframes checkmarkBounce {
  0% {
    transform: scale(0) rotate(-180deg);
    opacity: 0;
  }
  50% {
    transform: scale(1.2) rotate(10deg);
  }
  100% {
    transform: scale(1) rotate(0deg);
    opacity: 1;
  }
}

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-10px); }
  75% { transform: translateX(10px); }
}

.success-header h1, .error-header h1 {
  font-size: 2.2em;
  margin-bottom: 10px;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
  animation: fadeInUp 0.8s ease 0.3s backwards;
}

.success-header p, .error-header p {
  font-size: 1.1em;
  opacity: 0.95;
  animation: fadeInUp 0.8s ease 0.5s backwards;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(20px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.booking-details {
  padding: 40px;
}

.detail-card {
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  padding: 25px;
  border-radius: 15px;
  margin-bottom: 20px;
  border-left: 5px solid #667eea;
  animation: slideInRight 0.6s ease backwards;
}

.detail-card:nth-child(1) { animation-delay: 0.6s; }
.detail-card:nth-child(2) { animation-delay: 0.7s; }
.detail-card:nth-child(3) { animation-delay: 0.8s; }

@keyframes slideInRight {
  from {
    opacity: 0;
    transform: translateX(-30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.detail-card h3 {
  color: #2c3e50;
  font-size: 1.1em;
  margin-bottom: 15px;
  display: flex;
  align-items: center;
  gap: 10px;
}

.detail-card h3::before {
  content: '';
  width: 8px;
  height: 8px;
  background: #667eea;
  border-radius: 50%;
  display: inline-block;
}

.detail-row {
  display: flex;
  justify-content: space-between;
  padding: 10px 0;
  border-bottom: 1px solid rgba(0,0,0,0.1);
}

.detail-row:last-child {
  border-bottom: none;
}

.detail-label {
  color: #666;
  font-weight: 500;
}

.detail-value {
  color: #2c3e50;
  font-weight: 600;
}

.booking-id {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  padding: 15px;
  border-radius: 12px;
  text-align: center;
  font-size: 1.2em;
  font-weight: 700;
  letter-spacing: 1px;
  margin-bottom: 25px;
  box-shadow: 0 4px 15px rgba(102,126,234,0.4);
  animation: slideInRight 0.6s ease 0.9s backwards;
}

.action-buttons {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 15px;
  margin-top: 30px;
  animation: fadeIn 1s ease 1s backwards;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.btn {
  padding: 15px 25px;
  border: none;
  border-radius: 12px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.3s ease;
  text-decoration: none;
  display: inline-block;
  text-align: center;
}

.btn-primary {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  box-shadow: 0 4px 15px rgba(102,126,234,0.4);
}

.btn-primary:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(102,126,234,0.6);
}

.btn-secondary {
  background: white;
  color: #667eea;
  border: 2px solid #667eea;
}

.btn-secondary:hover {
  background: #667eea;
  color: white;
  transform: translateY(-3px);
  box-shadow: 0 4px 15px rgba(102,126,234,0.3);
}

.info-box {
  background: linear-gradient(135deg, #ffeaa7 0%, #fdcb6e 100%);
  padding: 20px;
  border-radius: 12px;
  margin-top: 20px;
  border-left: 5px solid #f39c12;
  animation: slideInRight 0.6s ease 1.1s backwards;
}

.info-box p {
  color: #2c3e50;
  margin: 8px 0;
  font-size: 0.95em;
  display: flex;
  align-items: center;
  gap: 10px;
}

.confetti {
  position: fixed;
  width: 10px;
  height: 10px;
  background: #f39c12;
  position: absolute;
  animation: confettiFall 3s linear infinite;
}

@keyframes confettiFall {
  to {
    transform: translateY(100vh) rotate(360deg);
    opacity: 0;
  }
}

@media (max-width: 768px) {
  .confirmation-container {
    margin: 20px;
  }
  
  .booking-details {
    padding: 25px;
  }
  
  .success-header h1, .error-header h1 {
    font-size: 1.6em;
  }
  
  .action-buttons {
    grid-template-columns: 1fr;
  }
  
  .detail-row {
    flex-direction: column;
    gap: 5px;
  }
}
</style>
</head>
<body>
<div class="confirmation-container">
  <?php if($success): ?>
    <div class="success-header">
      <div class="success-icon">✓</div>
      <h1>🎉 Booking Confirmed!</h1>
      <p>Your reservation has been successfully processed</p>
    </div>
    
    <div class="booking-details">
      <div class="booking-id">
        📋 Booking ID: #<?php echo str_pad($conn->insert_id, 6, '0', STR_PAD_LEFT); ?>
      </div>
      
      <div class="detail-card">
        <h3>🚗 Vehicle Details</h3>
        <div class="detail-row">
          <span class="detail-label">Car Name</span>
          <span class="detail-value"><?php echo $car['car_name']; ?></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Daily Rate</span>
          <span class="detail-value">PKR <?php echo $car['price_per_day']; ?></span>
        </div>
      </div>
      
      <div class="detail-card">
        <h3>👤 Customer Information</h3>
        <div class="detail-row">
          <span class="detail-label">Name</span>
          <span class="detail-value"><?php echo $name; ?></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Email</span>
          <span class="detail-value"><?php echo $email; ?></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Pickup Location</span>
          <span class="detail-value"><?php echo $location; ?></span>
        </div>
      </div>
      
      <div class="detail-card">
        <h3>📅 Rental Period</h3>
        <div class="detail-row">
          <span class="detail-label">Start Date</span>
          <span class="detail-value"><?php echo date('d M Y', strtotime($start)); ?></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">End Date</span>
          <span class="detail-value"><?php echo date('d M Y', strtotime($end)); ?></span>
        </div>
        <div class="detail-row">
          <span class="detail-label">Duration</span>
          <span class="detail-value">
            <?php 
            $days = (strtotime($end) - strtotime($start)) / (60*60*24);
            echo $days . ' day' . ($days > 1 ? 's' : '');
            ?>
          </span>
        </div>
      </div>
      
      <div class="info-box">
        <p>📧 Confirmation email sent to <strong><?php echo $email; ?></strong></p>
        <p>📞 Our team will contact you within 24 hours</p>
        <p>🛡️ Free cancellation available up to 48 hours before pickup</p>
      </div>
      
      <div class="action-buttons">
        <a href="index.php" class="btn btn-primary">🏠 Back to Home</a>
        <a href="cars.php" class="btn btn-secondary">🚗 Browse More Cars</a>
      </div>
    </div>
  <?php else: ?>
    <div class="error-header">
      <div class="error-icon">✕</div>
      <h1>❌ Booking Failed</h1>
      <p>We encountered an error processing your request</p>
    </div>
    
    <div class="booking-details">
      <div class="detail-card" style="border-left-color: #e74c3c;">
        <h3>⚠️ Error Details</h3>
        <p style="color: #e74c3c; padding: 15px 0;">
          <?php echo $conn->error; ?>
        </p>
      </div>
      
      <div class="info-box" style="background: linear-gradient(135deg, #ffcccc 0%, #ff9999 100%); border-left-color: #e74c3c;">
        <p>🔄 Please try again or contact our support team</p>
        <p>📞 Support: +92-XXX-XXXXXXX</p>
      </div>
      
      <div class="action-buttons">
        <a href="javascript:history.back()" class="btn btn-primary">← Go Back</a>
        <a href="index.php" class="btn btn-secondary">🏠 Home Page</a>
      </div>
    </div>
  <?php endif; ?>
</div>
</body>
</html>
