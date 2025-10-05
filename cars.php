<?php include 'db.php'; ?>
<!DOCTYPE html>
<html>
<head>
<title>Available Cars - RentACar</title>
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
  padding: 40px 20px;
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
  font-size: 3em;
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

.header-subtitle {
  font-size: 1.2em;
  margin-top: 10px;
  opacity: 0.9;
  position: relative;
  z-index: 1;
  animation: fadeIn 1.5s ease;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.container {
  width: 90%;
  max-width: 1400px;
  margin: 30px auto;
}

.top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 25px;
  flex-wrap: wrap;
  gap: 15px;
}

.back-btn {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  background: white;
  color: #2c3e50;
  padding: 12px 25px;
  border-radius: 12px;
  text-decoration: none;
  font-weight: 600;
  box-shadow: 0 4px 15px rgba(0,0,0,0.15);
  transition: all 0.3s ease;
  animation: slideInLeft 0.6s ease;
}

@keyframes slideInLeft {
  from {
    opacity: 0;
    transform: translateX(-30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.back-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.25);
  background: #f8f9fa;
}

.results-count {
  background: white;
  padding: 12px 25px;
  border-radius: 12px;
  color: #2c3e50;
  font-weight: 600;
  box-shadow: 0 4px 15px rgba(0,0,0,0.15);
  animation: slideInRight 0.6s ease;
}

@keyframes slideInRight {
  from {
    opacity: 0;
    transform: translateX(30px);
  }
  to {
    opacity: 1;
    transform: translateX(0);
  }
}

.filters {
  background: white;
  padding: 30px;
  border-radius: 20px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.2);
  margin-bottom: 30px;
  animation: fadeInUp 0.8s ease;
  position: relative;
  overflow: hidden;
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

.filters::before {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  height: 4px;
  background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
}

.filters h3 {
  color: #2c3e50;
  margin-bottom: 20px;
  font-size: 1.5em;
  display: flex;
  align-items: center;
  gap: 10px;
}

.filter-section {
  margin-bottom: 20px;
}

.filter-section:last-child {
  margin-bottom: 0;
}

.filter-section h4 {
  color: #555;
  font-size: 1em;
  margin-bottom: 12px;
  font-weight: 600;
}

.filter-group {
  display: flex;
  gap: 12px;
  flex-wrap: wrap;
}

.filter-tag {
  display: inline-flex;
  align-items: center;
  gap: 8px;
  cursor: pointer;
  padding: 10px 18px;
  background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  border: 2px solid transparent;
  border-radius: 10px;
  transition: all 0.3s ease;
  font-weight: 500;
  font-size: 0.95em;
}

.filter-tag:hover {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(102,126,234,0.4);
}

.filter-tag input[type="checkbox"] {
  cursor: pointer;
  width: 18px;
  height: 18px;
}

.search-box {
  width: 100%;
  padding: 15px 20px;
  border: 2px solid #e0e0e0;
  border-radius: 12px;
  font-size: 16px;
  transition: all 0.3s ease;
  background: #f8f9fa;
  outline: none;
}

.search-box:focus {
  border-color: #667eea;
  background: white;
  box-shadow: 0 0 15px rgba(102,126,234,0.2);
}

.cars {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
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
  cursor: pointer;
}

.car:nth-child(1) { animation-delay: 0.05s; }
.car:nth-child(2) { animation-delay: 0.1s; }
.car:nth-child(3) { animation-delay: 0.15s; }
.car:nth-child(4) { animation-delay: 0.2s; }
.car:nth-child(5) { animation-delay: 0.25s; }
.car:nth-child(6) { animation-delay: 0.3s; }
.car:nth-child(7) { animation-delay: 0.35s; }
.car:nth-child(8) { animation-delay: 0.4s; }
.car:nth-child(9) { animation-delay: 0.45s; }

@keyframes scaleIn {
  from {
    opacity: 0;
    transform: scale(0.85);
  }
  to {
    opacity: 1;
    transform: scale(1);
  }
}

.car:hover {
  transform: translateY(-15px) scale(1.02);
  box-shadow: 0 20px 60px rgba(0,0,0,0.3);
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
  z-index: 1;
}

.car:hover::before {
  transform: scaleX(1);
}

.car-badge {
  position: absolute;
  top: 15px;
  right: 15px;
  background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
  color: white;
  padding: 8px 15px;
  border-radius: 25px;
  font-size: 0.85em;
  font-weight: 700;
  z-index: 2;
  box-shadow: 0 4px 15px rgba(245,87,108,0.5);
  letter-spacing: 0.5px;
}

.car-image-wrapper {
  position: relative;
  overflow: hidden;
  height: 240px;
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.car img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.6s ease;
}

.car:hover img {
  transform: scale(1.15) rotate(2deg);
}

.quick-view {
  position: absolute;
  bottom: 15px;
  left: 50%;
  transform: translateX(-50%) translateY(100px);
  background: rgba(255,255,255,0.95);
  padding: 8px 20px;
  border-radius: 20px;
  font-weight: 600;
  color: #2c3e50;
  opacity: 0;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
}

.car:hover .quick-view {
  transform: translateX(-50%) translateY(0);
  opacity: 1;
}

.car-content {
  padding: 25px;
  background: linear-gradient(to bottom, white 0%, #f8f9fa 100%);
}

.car-content h3 {
  margin: 0 0 12px 0;
  color: #2c3e50;
  font-size: 1.6em;
  font-weight: 700;
  display: flex;
  align-items: center;
  gap: 10px;
}

.car-rating {
  display: flex;
  align-items: center;
  gap: 5px;
  font-size: 0.9em;
  color: #f39c12;
  margin-bottom: 12px;
}

.car-specs {
  display: flex;
  gap: 12px;
  margin: 15px 0;
  flex-wrap: wrap;
}

.spec-item {
  display: flex;
  align-items: center;
  gap: 6px;
  color: #666;
  font-size: 0.9em;
  background: #f0f0f0;
  padding: 6px 12px;
  border-radius: 8px;
  font-weight: 500;
}

.car-content p {
  color: #666;
  line-height: 1.6;
  margin-bottom: 15px;
  font-size: 0.95em;
}

.car-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-top: 20px;
  padding-top: 15px;
  border-top: 2px solid #f0f0f0;
}

.price {
  color: #27ae60;
  font-weight: bold;
  font-size: 1.6em;
  display: flex;
  flex-direction: column;
  text-shadow: 1px 1px 2px rgba(39,174,96,0.2);
}

.price-label {
  font-size: 0.5em;
  color: #999;
  font-weight: 500;
}

.car-content button {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  color: white;
  border: none;
  padding: 12px 25px;
  border-radius: 10px;
  cursor: pointer;
  font-weight: 600;
  font-size: 15px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(102,126,234,0.4);
  letter-spacing: 0.5px;
}

.car-content button:hover {
  background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
  transform: translateY(-2px);
  box-shadow: 0 6px 20px rgba(102,126,234,0.6);
}

.car-content button:active {
  transform: translateY(0);
}

.no-cars {
  text-align: center;
  padding: 60px 20px;
  background: white;
  border-radius: 20px;
  box-shadow: 0 10px 40px rgba(0,0,0,0.15);
}

.no-cars h2 {
  color: #2c3e50;
  font-size: 2em;
  margin-bottom: 15px;
}

.no-cars p {
  color: #666;
  font-size: 1.1em;
}

@media (max-width: 768px) {
  .container {
    width: 95%;
  }
  
  header h1 {
    font-size: 2em;
  }
  
  .cars {
    grid-template-columns: 1fr;
    gap: 20px;
  }
  
  .filters {
    padding: 20px;
  }
  
  .filter-group {
    flex-direction: column;
  }
  
  .top-bar {
    flex-direction: column;
    align-items: stretch;
  }
  
  .car-footer {
    flex-direction: column;
    gap: 15px;
  }
  
  .car-content button {
    width: 100%;
  }
}
</style>
</head>
<body>
<header>
  <h1>🚗 Available Cars for Rent</h1>
  <p class="header-subtitle">Find your perfect ride from our premium collection</p>
</header>

<div class="container">
  <div class="top-bar">
    <a href="index.php" class="back-btn">← Back to Home</a>
    <div class="results-count">
      <?php 
      $count_result = $conn->query("SELECT COUNT(*) as total FROM cars");
      $count = $count_result->fetch_assoc()['total'];
      echo "📊 " . $count . " Cars Available";
      ?>
    </div>
  </div>
  
  <div class="filters">
    <h3>🔍 Filter & Search</h3>
    
    <div class="filter-section">
      <input type="text" class="search-box" placeholder="🔎 Search by car name, brand, or model...">
    </div>
    
    <div class="filter-section">
      <h4>Transmission</h4>
      <div class="filter-group">
        <label class="filter-tag">
          <input type="checkbox" value="automatic">
          <span>⚙️ Automatic</span>
        </label>
        <label class="filter-tag">
          <input type="checkbox" value="manual">
          <span>🔧 Manual</span>
        </label>
      </div>
    </div>
    
    <div class="filter-section">
      <h4>Capacity</h4>
      <div class="filter-group">
        <label class="filter-tag">
          <input type="checkbox" value="2-4">
          <span>👥 2-4 Seats</span>
        </label>
        <label class="filter-tag">
          <input type="checkbox" value="5-7">
          <span>👨‍👩‍👧‍👦 5-7 Seats</span>
        </label>
        <label class="filter-tag">
          <input type="checkbox" value="8+">
          <span>🚐 8+ Seats</span>
        </label>
      </div>
    </div>
    
    <div class="filter-section">
      <h4>Category</h4>
      <div class="filter-group">
        <label class="filter-tag">
          <input type="checkbox" value="economy">
          <span>💰 Economy</span>
        </label>
        <label class="filter-tag">
          <input type="checkbox" value="luxury">
          <span>💎 Luxury</span>
        </label>
        <label class="filter-tag">
          <input type="checkbox" value="suv">
          <span>🚙 SUV</span>
        </label>
        <label class="filter-tag">
          <input type="checkbox" value="sports">
          <span>🏎️ Sports</span>
        </label>
      </div>
    </div>
  </div>
  
  <div class="cars">
  <?php
  $sql="SELECT * FROM cars";
  $result=$conn->query($sql);
  
  if($result->num_rows > 0) {
    $badges = ['🔥 Popular', '⭐ Best Value', '💎 Luxury', '🆕 New Arrival', '👑 Premium', '✨ Recommended', '🎯 Top Rated', '💯 Best Seller', '🌟 Featured'];
    $count = 0;
    
    while($row=$result->fetch_assoc()){
      $badge = $badges[$count % count($badges)];
      $rating = number_format(4 + (rand(0, 10) / 10), 1);
      $count++;
      
      echo '<div class="car">
        <div class="car-badge">'.$badge.'</div>
        <div class="car-image-wrapper">
          <img src="'.$row['image_url'].'" alt="'.$row['car_name'].'">
          <div class="quick-view">👁️ Quick View</div>
        </div>
        <div class="car-content">
          <h3>🚗 '.$row['car_name'].'</h3>
          <div class="car-rating">
            ⭐⭐⭐⭐⭐ <span style="color:#666;">('.$rating.')</span>
          </div>
          <div class="car-specs">
            <span class="spec-item">⚙️ Automatic</span>
            <span class="spec-item">👥 5 Seats</span>
            <span class="spec-item">⛽ Petrol</span>
          </div>
          <p>'.$row['description'].'</p>
          <div class="car-footer">
            <div class="price">
              <span class="price-label">Starting from</span>
              PKR '.$row['price_per_day'].'/day
            </div>
            <button onclick="window.location.href=\'book.php?id='.$row['id'].'\'">Book Now →</button>
          </div>
        </div>
      </div>';
    }
  } else {
    echo '<div class="no-cars">
      <h2>🚗 No Cars Available</h2>
      <p>Please check back later or contact support</p>
    </div>';
  }
  ?>
  </div>
</div>
</body>
</html>
