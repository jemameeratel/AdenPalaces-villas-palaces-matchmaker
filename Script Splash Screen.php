<style>
  .splash-screen {
    position: fixed;
    top: 0; 
    left: 0; 
    width: 100vw; 
    height: 100vh;
    background: #043c78; /* Primary Blue */
    z-index: 999999; 
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    transition: opacity 0.8s ease, visibility 0.8s ease;
    font-family: "Tajawal", "Segoe UI", Tahoma, sans-serif;
  }
  
  .splash-content {
    text-align: center;
    color: white;
    animation: popIn 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    padding: 20px;
  }

  /* Logo styling */
  .splash-logo {
    max-width: 250px; 
    height: auto;
    margin-bottom: 25px;
    display: block;
    margin-left: auto;
    margin-right: auto;
  }
  
  .splash-content h2 { font-size: 2.5rem; margin-bottom: 10px; color: white; }
  .splash-content p { font-size: 1.2rem; color: #e0e0e0; margin-bottom: 30px; }
  
  .splash-spinner {
    margin: 0 auto;
    width: 50px;
    height: 50px;
    border: 5px solid rgba(255,255,255,0.2);
    border-top: 5px solid #c29b0c; /* Secondary Gold */
    border-radius: 50%;
    animation: spin 1s linear infinite;
  }
  
  @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
  @keyframes popIn { 0% { transform: scale(0.8); opacity: 0; } 100% { transform: scale(1); opacity: 1; } }

  .splash-hidden {
    opacity: 0;
    visibility: hidden;
    pointer-events: none; /* Allows user to click things behind the splash screen once it fades */
  }

  /* Mobile scaling for the logo and text */
  @media (max-width: 768px) {
    .splash-logo { max-width: 180px; margin-bottom: 20px; }
    .splash-content h2 { font-size: 1.8rem; }
    .splash-content p { font-size: 1rem; margin-bottom: 25px;}
    .splash-spinner { width: 40px; height: 40px; }
  }
</style>

<div id="welcome-splash" class="splash-screen" dir="rtl">
  <div class="splash-content">
    <img class="splash-logo" src="https://www.adenpalaces.com/wp-content/uploads/2024/07/aden-palaces-gold-logo-2026-v2.webp" alt="Aden Palaces">
    
    <h2>مرحباً بك في برنامج اختيار الفيلا</h2>
    <p>دعنا نساعدك في تصميم والعثور على قصر أحلامك...</p>
    
    <div class="splash-spinner"></div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
     // Fades out after 3.5 seconds (3500ms)
     setTimeout(function() {
         const splash = document.getElementById("welcome-splash");
         if(splash) {
             splash.classList.add("splash-hidden");
         }
     }, 3500); 
  });
</script>