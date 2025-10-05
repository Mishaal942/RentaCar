<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>RentACar - Home</title>
<style>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin: 0;
  padding: 0;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  min-height: 100vh;
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
  font-size: 2.8em;
  font-weight: 700;
  letter-spacing: 2px;
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
  width: 85%;
  max-width: 1200px;
  margin: 30px auto;
  padding-bottom: 50px;
}

.search-bar {
  background: white;
  padding: 35px;
  border-radius: 20px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.2);
  margin-bottom: 40px;
  animation: fadeInUp 1s ease;
  position: relative;
  overflow: hidden;
}

.search-bar::before {
  content: '';
  position: absolute;
  top: 0;
  left: -100%;
  width: 100%;
  height: 100%;
  background: linear-gradient(90deg, transparent, rgba(102,126,234,0.1), transparent);
  transition: left 0.5s;
}

.search-bar:hover::before {
  left: 100%;
}

@keyframes fadeInUp {
  from {
    opacity: 0;
    transform: translateY(30px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.search-bar input, .search-bar button {
  padding: 15px 20px;
  margin: 8px;
  border: 2px solid #e0e0e0;
  border-radius: 10px;
  font-size: 16px;
  transition: all 0.3s ease;
  outline: none;
}

.search-bar input {
  width: calc(25% - 16px);
  background: #f8f9fa;
}

.search-bar input:focus {
  border-color: #667eea;
  background: white;
  box-shadow: 0 0 15px rgba(102,126,234,0.3);
  transform: translateY(-2px);
}

.search-bar button {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border: none;
  cursor: pointer;
  font-weight: 600;
  padding: 15px 35px;
  letter-spacing: 1px;
  box-shadow: 0 4px 15px rgba(102,126,234,0.4);
}

.search-bar button:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 25px rgba(102,126,234,0.6);
}

.search-bar button:active {
  transform: translateY(-1px);
}

h2 {
  color: white;
  font-size: 2em;
  margin-bottom: 25px;
  text-align: center;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
  animation: fadeIn 1.5s ease;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.cars {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 30px;
  margin-top: 20px;
}

.car {
  background: white;
  border-radius: 20px;
  overflow: hidden;
  box-shadow: 0 8px 30px rgba(0,0,0,0.15);
  transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  animation: scaleIn 0.6s ease backwards;
  position: relative;
}

.car:nth-child(1) { animation-delay: 0.1s; }
.car:nth-child(2) { animation-delay: 0.2s; }
.car:nth-child(3) { animation-delay: 0.3s; }

@keyframes scaleIn {
  from {
    opacity: 0;
    transform: scale(0.8);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.car:hover {
  transform: translateY(-15px) scale(1.02);
  box-shadow: 0 15px 50px rgba(0,0,0,0.3);
}

.car::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 5px;
  background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
  transform: scaleX(0);
  transition: transform 0.4s ease;
}

.car:hover::before {
  transform: scaleX(1);
}

.car img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  transition: transform 0.5s ease;
}

.car:hover img {
  transform: scale(1.1);
}

.car-content {
  padding: 20px;
  background: linear-gradient(to bottom, white 0%, #f8f9fa 100%);
}

.car-content h3 {
  margin: 0 0 10px 0;
  color: #2c3e50;
  font-size: 1.5em;
  font-weight: 700;
}

.car-content p {
  color: #666;
  line-height: 1.6;
  margin-bottom: 15px;
  font-size: 0.95em;
}

.price {
  color: #27ae60;
  font-weight: bold;
  font-size: 1.4em;
  margin: 15px 0;
  display: block;
  text-shadow: 1px 1px 2px rgba(39,174,96,0.2);
}

button.book-btn {
  background: linear-gradient(135deg, #27ae60 0%, #229954 100%);
  color: white;
  border: none;
  padding: 12px 25px;
  border-radius: 10px;
  cursor: pointer;
  font-weight: 600;
  font-size: 16px;
  width: 100%;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(39,174,96,0.3);
  letter-spacing: 0.5px;
}

button.book-btn:hover {
  background: linear-gradient(135deg, #229954 0%, #1e8449 100%);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(39,174,96,0.5);
}

button.book-btn:active {
  transform: translateY(0);
}

@media (max-width: 768px) {
  .container {
    width: 95%;
  }
  
  .search-bar input {
    width: 100%;
    margin: 5px 0;
  }
  
  .search-bar button {
    width: 100%;
  }
  
  header h1 {
    font-size: 2em;
  }
  
  .cars {
    grid-template-columns: 1fr;
    gap: 20px;
  }
}
</style>
<script>
function redirectCars(){
  let loc=document.getElementById('pickup').value;
  let start=document.getElementById('start').value;
  let end=document.getElementById('end').value;
  window.location.href='cars.php?pickup='+loc+'&start='+start+'&end='+end;
}
</script>
</head>
<body>
<header><h1>🚗 RentACar.com Clone</h1></header>
<div class="container">
  <div class="search-bar">
    <input type="text" id="pickup" placeholder="📍 Pickup Location">
    <input type="date" id="start" placeholder="Start Date">
    <input type="date" id="end" placeholder="End Date">
    <button onclick="redirectCars()">🔍 Search Cars</button>
  </div>
  <h2>✨ Featured Cars</h2>
  <div class="cars">
  <?php
  $result=$conn->query("SELECT * FROM cars LIMIT 3");
  while($row=$result->fetch_assoc()){
    echo '<div class="car">
      <img src="'.$row['image_url'].'" alt="'.$row['car_name'].'">
      <div class="car-content">
        <h3>'.$row['car_name'].'</h3>
        <p>'.$row['description'].'</p>
        <p class="price">PKR '.$row['price_per_day'].'/day</p>
        <button class="book-btn" onclick="window.location.href=\'book.php?id='.$row['id'].'\'">Book Now</button>
      </div>
    </div>';
  }
  ?>
  </div>
</div>
</body>
</html>
