<?php
session_start();
include_once('header.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Recipe Corner</title>
  <!-- Google Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <style>
    /* Global & Animations */
    body {
      background-color:rgb(92, 84, 84);
      font-family: 'Montserrat', sans-serif;
      overflow-x: hidden;
      margin: 0;
      padding: 0;
    }
    .fade-in {
      animation: fadeIn 1.3s ease-in forwards;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(20px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    /* Animated Gradient Background for Introduction Section */
    @keyframes gradientShift {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }
    
    /* Introduction Section Enhancements */
    .intro-section {
      position: relative;
      background: 
        linear-gradient(135deg, rgba(0,0,0,0.65), rgba(0,0,0,0.35)),
        url('../images/aboutUs.jpg') no-repeat center center/cover;
      /* Add animated overlay */
      background-size: 300% 300%;
      animation: gradientShift 15s ease infinite, fadeIn 1.3s ease-in forwards;
      padding: 120px 0;
      color: #fff;
      text-align: center;
      overflow: hidden;
    }
    .intro-section:after {
      content: "";
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      width: 40px;
      height: 40px;
      border: 2px solid #fff;
      border-radius: 50%;
      animation: bounce 2s infinite;
    }
    @keyframes bounce {
      0%, 20%, 50%, 80%, 100% { transform: translateX(-50%) translateY(0); }
      40% { transform: translateX(-50%) translateY(-10px); }
      60% { transform: translateX(-50%) translateY(-5px); }
    }
    .intro-section h2 {
      font-size: 3.5rem;
      font-weight: bold;
      margin-bottom: 30px;
      text-shadow: 2px 2px 6px rgba(0,0,0,0.8);
    }
    .intro-section p {
      font-size: 1.3rem;
      margin-bottom: 20px;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
      line-height: 1.6;
    }
    .intro-section .btn {
      background-color: #ff6347;
      color: #fff;
      border: none;
      padding: 15px 30px;
      font-size: 1.2rem;
      border-radius: 50px;
      transition: background-color 0.3s, transform 0.3s;
    }
    .intro-section .btn:hover {
      background-color: #e5533d;
      transform: scale(1.05);
    }
    
    /* Why Recipe Corner Section */
    section.my-5 h2.display-6.fw-bold {
      font-size: 2.8rem;
      color: #333;
      margin-bottom: 40px;
      text-align: center;
      position: relative;
    }
    section.my-5 h2.display-6.fw-bold:after {
      content: "";
      width: 60px;
      height: 4px;
      background: #ff6347;
      position: absolute;
      bottom: -10px;
      left: 50%;
      transform: translateX(-50%);
      border-radius: 2px;
    }
    
    /* Enhanced Card Styles with Cooking Animation */
    @keyframes steamAnimation {
      0% { transform: translateY(0) scale(1); opacity: 0; }
      50% { transform: translateY(-20px) scale(1.2); opacity: 0.7; }
      100% { transform: translateY(-40px) scale(1.5); opacity: 0; }
    }

    @keyframes wobble {
      0%, 100% { transform: rotate(0); }
      25% { transform: rotate(-3deg); }
      75% { transform: rotate(3deg); }
    }

    .card-custom {
      border: none;
      border-radius: 10px;
      overflow: hidden;
      background: #fff;
      transition: transform 0.3s, box-shadow 0.3s;
      position: relative;
    }

    .card-custom:hover {
      transform: translateY(-10px);
      box-shadow: 0 10px 25px rgba(0,0,0,0.2);
      animation: wobble 0.5s ease-in-out;
    }

    .card-custom:hover::before {
      content: "👨‍🍳";
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 24px;
      animation: steamAnimation 1.5s infinite;
    }

    .card-custom .card-img-top {
      transition: transform 0.3s;
    }

    .card-custom:hover .card-img-top {
      transform: scale(1.05);
    }

    .card-custom .stretched-link::after {
      content: "🍽️";
      position: absolute;
      right: 10px;
      bottom: 10px;
      opacity: 0;
      transition: opacity 0.3s;
    }

    .card-custom:hover .stretched-link::after {
      opacity: 1;
    }
    
    /* Floating Action Button Enhancements */
    .fab {
      width: 70px;
      height: 70px;
      background-color:rgb(230, 91, 67);
      color: #fff;
      font-size: 2rem;
      border: none;
      border-radius: 50%;
      position: fixed;
      bottom: 2270px;
      right: 20px;
      box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
      transition: transform 0.3s, background-color 0.3s;
      z-index: -200;
    }
    .fab:hover {
      transform: scale(1.15);
      background-color: #e5533d;
    }
    
    /* Chatbot Modal Enhancements */
    .modal-header.bg-primary {
      background: linear-gradient(90deg, #ff7f50, #ff6347);
      border: none;
    }
    .chat-area {
      background: #fafafa;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 15px;
    }
    .user-message, .bot-message {
      border-radius: 20px;
      padding: 10px 15px;
      margin: 8px 0;
      font-size: 0.95rem;
      max-width: 80%;
      animation: messageFade 0.5s ease-in;
    }
    @keyframes messageFade {
      from { opacity: 0; transform: translateY(5px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .user-message {
      background: #007bff;
      color: #fff;
      margin-left: auto;
    }
    .bot-message {
      background: #e9ecef;
      color: #212529;
      margin-right: auto;
    }
    .message-time {
      font-size: 0.75rem;
      color: #555;
      text-align: right;
      margin-top: 4px;
    }
    .typing-indicator .dot {
      width: 8px;
      height: 8px;
      background-color: #007bff;
      border-radius: 50%;
      margin: 0 2px;
      animation: typing 1s infinite;
    }
    @keyframes typing {
      0%, 60%, 100% { transform: translateY(0); }
      30% { transform: translateY(-5px); }
    }
    
    /* Section Spacing */
    section.my-5 {
      padding-top: 80px;
      padding-bottom: 80px;
    }
  </style>
</head>
<body class="bg-light fade-in">

<!-- Introduction Section -->
<section class="intro-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6 text-center text-lg-start">
        <h2 class="mb-4 display-5">Don't know how to cook?</h2>
        <p class="lead">Discover the world of flavors and master culinary art effortlessly!</p>
        <p>Whether you're a newbie or a seasoned chef, explore recipes curated just for you.</p>
        <a href="#recipes" class="btn btn-lg mt-3">
          Get Started <i class="fa fa-chevron-right ms-2"></i>
        </a>
      </div>
      <div class="col-lg-6 text-center mt-4 mt-lg-0">
        <img src="../images/aboutUs.jpg" class="img-fluid rounded shadow" alt="About Us">
      </div>
    </div>
  </div>
</section>

<!-- Why Recipe Corner Section -->
<section class="my-5">
  <div class="container">
    <h2 class="text-center mb-5 display-6 fw-bold">Why Recipe Corner?</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <div class="col">
        <div class="card card-custom h-100">
          <img src="../images/about1.gif" class="card-img-top p-3" alt="Easy">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">Easy</h5>
            <p class="card-text text-secondary">Simple and clear recipes that anyone can follow.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card card-custom h-100">
          <img src="../images/about2.gif" class="card-img-top p-3" alt="Quick">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">Quick</h5>
            <p class="card-text text-secondary">Whip up delicious meals in no time.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card card-custom h-100">
          <img src="../images/about3.gif" class="card-img-top p-3" alt="Tasty">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">Tasty</h5>
            <p class="card-text text-secondary">Exquisite flavors that tantalize your taste buds.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Best Chefs Section -->
<section class="my-5">
  <div class="container">
    <h2 class="text-center mb-5 display-6 fw-bold">Best Chefs</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <div class="col">
        <div class="card card-custom h-100">
          <img src="Gordon_Ramsay.jpg" class="card-img-top p-3" alt="Chef Gordon Ramsay">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">Chef Gordon Ramsay</h5>
            <p class="card-text text-secondary">Iconic chef known for his remarkable culinary expertise.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card card-custom h-100">
          <img src="../images/chef2.jpg" class="card-img-top p-3" alt="Chef Ranveer Brar">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">Chef Ranveer Brar</h5>
            <p class="card-text text-secondary">Bringing traditional flavors with a modern twist.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card card-custom h-100">
          <img src="sanjeev.jpg" class="card-img-top p-3" alt="Chef Sanjeev Kapoor">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">Chef Sanjeev Kapoor</h5>
            <p class="card-text text-secondary">A household name in Indian culinary arts.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Best Recipes Section -->
<section class="my-5" id="recipes">
  <div class="container">
    <h2 class="text-center mb-5 display-6 fw-bold">Best Recipes Just for You!</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
      <div class="col">
        <div class="card card-custom h-100">
          <img src="../images/pizza.jpg" class="card-img-top p-3" alt="Pizza">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">
              <a href="pizza.php" class="stretched-link text-decoration-none text-primary">Pizza</a>
            </h5>
            <p class="card-text text-secondary">Experience the delight of a classic pizza recipe.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card card-custom h-100">
          <img src="../images/mango-smoothie.jpg" class="card-img-top p-3" alt="Mango Smoothie">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">
              <a href="mango_smoothie.php" class="stretched-link text-decoration-none text-primary">Mango Smoothie</a>
            </h5>
            <p class="card-text text-secondary">Refresh yourself with our invigorating mango smoothie recipe.</p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card card-custom h-100">
          <img src="../images/cheese-sandwich.jpg" class="card-img-top p-3" alt="Cheese Sandwich">
          <div class="card-body text-center">
            <h5 class="card-title fw-bold">
              <a href="cheese_sandwich.php" class="stretched-link text-decoration-none text-primary">Cheese Sandwich</a>
            </h5>
            <p class="card-text text-secondary">Indulge in the perfect blend of cheese and crunch.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Floating Action Button -->
<div class="position-fixed" style="bottom: 20px; right: 20px; z-index: 1100;">
  <button class="btn btn-primary fab" id="chatbot-fab">
    <i class="material-icons">chat</i>
  </button>
</div>

<!-- Chatbot Modal -->
<div class="modal fade" id="chatbotModal" tabindex="-1" aria-labelledby="chatbotModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title" id="chatbotModalLabel">
          <i class="material-icons me-2">chat</i> ChatBot
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" 
          aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div id="chatArea" class="chat-area" style="max-height: 400px; overflow-y: auto;">
          <!-- Chat messages will appear here -->
        </div>
        <div class="input-group mt-3">
          <input type="text" id="userQuery" class="form-control" placeholder="Ask about recipes...">
          <button id="submitQuery" class="btn btn-primary">
            <i class="material-icons">send</i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Custom JavaScript for Chatbot Interaction -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Ensure Bootstrap 5 JS is loaded before using this code
var chatbotModalEl = document.getElementById('chatbotModal');
var chatbotModal = new bootstrap.Modal(chatbotModalEl, {});

document.getElementById('chatbot-fab').addEventListener('click', function() {
    document.getElementById('userQuery').value = '';
    chatbotModal.show();
    if (!document.getElementById('chatArea').dataset.welcomeMessageShown) {
        setTimeout(() => {
            document.getElementById('chatArea').innerHTML += `
                <div class="bot-message">
                    Hello! I'm your recipe assistant. How can I help you today?
                    <div class="message-time">${new Date().toLocaleTimeString()}</div>
                </div>`;
            document.getElementById('chatArea').scrollTop = document.getElementById('chatArea').scrollHeight;
            document.getElementById('chatArea').dataset.welcomeMessageShown = true;
        }, 500);
    }
});

// ... rest of your chatbot JS code remains the same ...
document.getElementById('submitQuery').addEventListener('click', async function() {
    // Your existing chatbot query code...
});

document.getElementById('userQuery').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        document.getElementById('submitQuery').click();
    }
});
</script>
<?php include_once('footer.php'); ?>
</body>
</html>