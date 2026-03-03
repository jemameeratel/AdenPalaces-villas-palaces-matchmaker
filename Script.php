<div id="aden-quiz-app" dir="rtl">

  <style>
    #aden-quiz-app {
      --q-primary: #043c78;
      --q-secondary: #c29b0c;
      --q-bg: #f8f9fa;
      --q-white: #ffffff;
      --q-text: #2c3e50;
      
      font-family: "Tajawal", "Segoe UI", Tahoma, sans-serif;
      max-width: 900px; 
      margin: 0 auto;
      background: var(--q-bg);
      color: var(--q-text);
      padding: 20px;
    }

    #aden-quiz-app * { box-sizing: border-box; transition: all 0.3s ease; }

    
    #header-title{
        color:#ffffff;
    }
    .quiz-layout {
      display: flex;
      flex-direction: column;
      gap: 30px;
    }

  
    .wizard-container {
      background: white;
      border-radius: 20px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
      overflow: hidden;
      border: 1px solid #eee;
    }

 
    .wizard-header {
      background: var(--q-primary);
      padding: 20px 30px;
      color: white;
    }
    .wizard-header h2 { margin: 0; font-size: 1.4rem; }
    
    .progress-track {
      background: rgba(255,255,255,0.2);
      height: 6px;
      border-radius: 10px;
      margin-top: 15px;
      overflow: hidden;
    }
    .progress-fill {
      height: 100%;
      background: var(--q-secondary);
      width: 25%;
      border-radius: 10px;
    }

  
    .wizard-body {
      padding: 25px;
      min-height: 380px; 
      position: relative;
    }

    .quiz-step { display: none; animation: fadeIn 0.4s; }
    .quiz-step.active { display: block; }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .step-title { color: var(--q-primary); margin-bottom: 5px; font-size: 1.3rem; }
    .step-desc { color: #777; margin-bottom: 20px; font-size: 0.95rem; }

    
    .input-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #fdfdfd;
      padding: 10px 15px;
      border-radius: 10px;
      border: 1px solid #eee;
      margin-bottom: 12px;
    }
    .input-row.active { border-color: var(--q-secondary); background: #fffcf0; }

    .check-label {
      display: flex;
      align-items: center;
      gap: 10px;
      cursor: pointer;
      width: 65%;
      font-weight: 600;
      color: #555;
    }
    .input-row.active .check-label { color: var(--q-primary); }

    .custom-checkbox {
      width: 20px;
      height: 20px;
      border: 2px solid #ccc;
      border-radius: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
      position: relative;
    }
    input[type="checkbox"]:checked + .custom-checkbox {
      background: var(--q-secondary);
      border-color: var(--q-secondary);
    }
    /* Pure CSS Checkmark to replace emoji */
    input[type="checkbox"]:checked + .custom-checkbox::after {
      content: '';
      position: absolute;
      left: 6px;
      top: 2px;
      width: 6px;
      height: 10px;
      border: solid white;
      border-width: 0 2px 2px 0;
      transform: rotate(45deg);
    }
    input[type="checkbox"] { display: none; }

    .custom-select {
      width: 30%;
      padding: 6px;
      border-radius: 6px;
      border: 1px solid #ddd;
      cursor: pointer;
    }
    .custom-select:disabled { background: #f0f0f0; cursor: not-allowed; }

  
    .wizard-footer {
      padding: 20px 30px;
      border-top: 1px solid #eee;
      display: flex;
      justify-content: space-between;
      background: #fcfcfc;
    }
    .nav-btn {
      padding: 10px 25px;
      border-radius: 30px;
      border: none;
      font-size: 0.95rem;
      cursor: pointer;
      font-weight: bold;
    }
    .btn-prev { background: #eee; color: #666; }
    .btn-prev:disabled { opacity: 0.5; cursor: not-allowed; }
    .btn-next { background: var(--q-secondary); color: white; }
    
    /* Error Message Style */
    .error-message {
      display: none;
      background: #fde8e8;
      color: #c53030;
      border: 1px solid #feb2b2;
      padding: 12px;
      border-radius: 8px;
      text-align: center;
      font-weight: bold;
      margin-top: 20px;
      animation: fadeIn 0.3s;
    }
  
    .winner-card {
      background: white;
      border-radius: 20px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
      border: 3px solid var(--q-secondary);
      display: flex; 
      flex-direction: row;
      align-items: stretch;
      margin-bottom: 20px;
    }
    
    .winner-img-container {
      width: 40%;
      position: relative;
      line-height: 0;
      font-size: 0;
      display: flex;
    }
    
    .winner-img { 
      width: 100%; 
      height: 100%; 
      object-fit: cover; 
      display: block;
      margin: 0;
      padding: 0;
      background: #eee;
      min-height: 250px;
    }
    
    .winner-details { 
      width: 60%;
      padding: 30px; 
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    
    .match-badge {
      background: var(--q-secondary);
      color: white;
      padding: 5px 15px;
      border-radius: 20px;
      font-weight: bold;
      align-self: flex-start;
      margin-bottom: 15px;
      font-size: 0.9rem;
      line-height: 1.5;
    }
    
    .winner-details h2 { margin: 0 0 10px 0; color: var(--q-primary); font-size: 1.8rem; }
    .winner-details p { color: #666; font-size: 1rem; margin-bottom: 20px; line-height: 1.6; }

    .stats-grid { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 15px; }
    .stat-tag { background: #eef2f5; padding: 6px 12px; border-radius: 8px; font-size: 0.85rem; color: #333; display: flex; align-items: center; gap: 5px; line-height: 1.5;}

  
    .suggestions-wrapper {
      display: none; 
    }
    .suggestions-title {
      text-align: center;
      margin-bottom: 20px;
      color: var(--q-primary);
      font-size: 1.4rem;
      position: relative;
    }
    .suggestions-title::after {
        content: ''; display: block; width: 50px; height: 3px; background: var(--q-secondary); margin: 10px auto 0; border-radius: 2px;
    }

    .suggestions-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 20px;
    }

    .suggestion-card {
      background: white;
      border-radius: 15px;
      overflow: hidden;
      box-shadow: 0 5px 15px rgba(0,0,0,0.05);
      border: 1px solid #eee;
      display: flex;
      flex-direction: column;
      position: relative;
      text-decoration: none;
      color: inherit;
    }
    
    .suggestion-img {
      width: 100%;
      height: 180px;
      object-fit: cover;
    }
    
    .suggestion-info {
      padding: 15px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
    }
    
    .suggestion-match {
      font-size: 0.85rem;
      color: var(--q-secondary);
      font-weight: bold;
      margin-bottom: 5px;
    }
    
    .suggestion-info h3 {
      font-size: 1.1rem;
      margin: 0 0 10px;
      color: var(--q-primary);
    }
    
    .view-btn {
        background: var(--q-primary);
        color: white;
        text-align: center;
        padding: 10px;
        border-radius: 5px;
        text-decoration: none;
        margin-top: auto;
        display: inline-block;
        font-weight: bold;
    }
    
    .winner-link-btn {
        background: var(--q-primary);
        color: #ffffff!important;
        padding: 12px 25px;
        text-decoration: none;
        border-radius: 30px;
        display: inline-block;
        margin-top: 10px;
        align-self: flex-start;
        font-weight: bold;
    }


    @media (max-width: 768px) {
      .winner-card { flex-direction: column; }
      .winner-img-container, .winner-details { width: 100%; }
      .winner-img-container { height: 250px; }
      .suggestions-grid { grid-template-columns: 1fr; }
    }

 
    .final-msg { text-align: center; padding: 40px; }
    .final-msg h3 { color: var(--q-secondary); font-size: 2rem; margin-bottom: 10px; }

  </style>

  <div class="quiz-layout">
    
    <div class="wizard-container">
      
      <div class="wizard-header">
        <h2 id="header-title">صمم قصر أحلامك</h2>
        <div class="progress-track">
          <div class="progress-fill" id="progress-fill"></div>
        </div>
      </div>

      <div class="wizard-body">
        
        <div class="quiz-step active" id="step-1">
          <h3 class="step-title">1. غرف النوم</h3>
          <p class="step-desc">فعل الخيار لتحديد العدد</p>
          
          <div class="input-row" id="row_w_master_dress">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_master_dress')">
              <span class="custom-checkbox"></span>
              نوم ماستر (ملابس)
            </label>
            <select id="w_master_dress" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
            </select>
          </div>

          <div class="input-row" id="row_w_master">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_master')">
              <span class="custom-checkbox"></span>
              نوم ماستر
            </label>
            <select id="w_master" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
            </select>
          </div>

          <div class="input-row" id="row_w_suite">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_suite')">
              <span class="custom-checkbox"></span>
              جناح خاص
            </label>
            <select id="w_suite" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option><option value="3">3</option>
            </select>
          </div>

          <div class="input-row" id="row_w_studio">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_studio')">
              <span class="custom-checkbox"></span>
              استوديو
            </label>
            <select id="w_studio" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option><option value="3">3</option>
            </select>
          </div>

          <div class="input-row" id="row_w_standard">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_standard')">
              <span class="custom-checkbox"></span>
              غرفة نوم
            </label>
            <select id="w_standard" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option>
            </select>
          </div>
        </div>

        <div class="quiz-step" id="step-2">
          <h3 class="step-title">2. أستقبال الضيوف</h3>
          <p class="step-desc">حدد المجالس المطلوبة</p>
          
          <div class="input-row" id="row_w_rec_suite">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_rec_suite')">
              <span class="custom-checkbox"></span>
              جناح استقبال
            </label>
            <select id="w_rec_suite" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          <div class="input-row" id="row_w_fam_suite">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_fam_suite')">
              <span class="custom-checkbox"></span>
              جناح عائلي
            </label>
            <select id="w_fam_suite" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          <div class="input-row" id="row_w_diwan">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_diwan')">
              <span class="custom-checkbox"></span>
              ديوان رجال
            </label>
            <select id="w_diwan" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          <div class="input-row" id="row_w_majlis">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_majlis')">
              <span class="custom-checkbox"></span>
              مجلس نساء
            </label>
            <select id="w_majlis" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
        </div>

        <div class="quiz-step" id="step-3">
          <h3 class="step-title">3. الصالات والمعيشة</h3>
          <p class="step-desc">حدد مساحات المعيشة المطلوبة</p>
          
          <div class="input-row" id="row_w_pool">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_pool')">
              <span class="custom-checkbox"></span>
              صالة بمسبح
            </label>
            <select id="w_pool" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option>
            </select>
          </div>
          <div class="input-row" id="row_w_living_low">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_living_low')">
              <span class="custom-checkbox"></span>
              معيشة سفلية
            </label>
            <select id="w_living_low" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          <div class="input-row" id="row_w_living_up">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_living_up')">
              <span class="custom-checkbox"></span>
              معيشة علوية
            </label>
            <select id="w_living_up" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          <div class="input-row" id="row_w_dining">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_dining')">
              <span class="custom-checkbox"></span>
              صالة طعام
            </label>
            <select id="w_dining" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          <div class="input-row" id="row_w_terrace">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_terrace')">
              <span class="custom-checkbox"></span>
              شرفة علوية
            </label>
            <select id="w_terrace" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
        </div>

        <div class="quiz-step" id="step-4">
          <h3 class="step-title">4. المطبخ</h3>
          <p class="step-desc">حدد نوع المطبخ</p>
          
          <div class="input-row" id="row_w_kit_ind">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_kit_ind')">
              <span class="custom-checkbox"></span>
              مطبخ مستقل (مغلق)
            </label>
            <select id="w_kit_ind" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          <div class="input-row" id="row_w_kit_open">
            <label class="check-label">
              <input type="checkbox" onchange="toggleSelect(this, 'w_kit_open')">
              <span class="custom-checkbox"></span>
              مطبخ مفتوح
            </label>
            <select id="w_kit_open" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
        </div>

        <div class="quiz-step" id="step-5">
           <div class="final-msg">
             <h3>شكراً لك!</h3>
             <p>النتيجة النهائية معروضة بالأسفل.</p>
             <div style="display:flex; gap:10px; justify-content:center; margin-top:20px;">
               <button class="nav-btn btn-prev" type="button" onclick="changeStep(-1)">تعديل الاختيارات</button>
               <button class="nav-btn btn-next" type="button" onclick="location.reload()">ابدأ من جديد</button>
             </div>
           </div>
        </div>
        
        <div id="step-error" class="error-message">
          يرجى تحديد خيار واحد على الأقل للمتابعة.
        </div>

      </div>

      <div class="wizard-footer" id="wizard-footer">
        <button class="nav-btn btn-prev" id="btn-back" type="button" onclick="changeStep(-1)" disabled>السابق</button>
        <button class="nav-btn btn-next" id="btn-next" type="button" onclick="changeStep(1)">التالي</button>
      </div>

    </div>

    <div class="winner-card" id="winner-card">
      <div class="winner-img-container">
        <img class="winner-img" id="res-img" src="https://www.adenpalaces.com/wp-content/uploads/2026/01/aden-palaces-img-slider-01-v2.webp" alt="Select Options">
      </div>
      <div class="winner-details">
        <div class="match-badge" id="res-percent">نسبة التطابق: 0%</div>
        <h2 id="res-name">ابدأ الاختيار</h2>
        <p id="res-desc">قم بتحديد خياراتك في الأعلى لرؤية النموذج المناسب هنا تلقائياً.</p>
        <div class="stats-grid" id="res-stats"></div>
        <div id="res-action"></div>
      </div>
    </div>
    
    <div class="suggestions-wrapper" id="sugg-wrapper">
        <h3 class="suggestions-title">نماذج أخرى قد تناسبك</h3>
        <div class="suggestions-grid" id="sugg-grid">
            </div>
    </div>

  </div>

  <script>

    function toggleSelect(checkbox, id) {
      const el = document.getElementById(id);
      const row = document.getElementById('row_' + id);
      
      if (checkbox.checked) {
        el.disabled = false;
        el.value = "1"; 
        row.classList.add('active');
      } else {
        el.disabled = true;
        row.classList.remove('active');
      }
      
      // Hide error message as soon as user checks a box
      document.getElementById('step-error').style.display = 'none';
      
      calculateRealTime();
    }


    let currentStep = 1;
    const totalSteps = 4; 

    function changeStep(direction) {
      const errorMsg = document.getElementById('step-error');

      // --- VALIDATION LOGIC ---
      // If moving forward (direction === 1) and we are on an input step
      if (direction === 1 && currentStep <= totalSteps) {
          const currentStepDiv = document.getElementById(`step-${currentStep}`);
          const checkedBoxes = currentStepDiv.querySelectorAll('input[type="checkbox"]:checked');
          
          if (checkedBoxes.length === 0) {
              // Show error message and stop
              errorMsg.style.display = 'block';
              return; 
          }
      }
      
      // Clear error message when successfully navigating
      errorMsg.style.display = 'none';
      // --- END VALIDATION LOGIC ---

      if (currentStep + direction > totalSteps) {
         document.getElementById(`step-${currentStep}`).classList.remove('active');
         currentStep = 5; 
         document.getElementById('step-5').classList.add('active');
         document.getElementById('wizard-footer').style.display = 'none';
         document.getElementById('winner-card').scrollIntoView({behavior: 'smooth'});
         return;
      }
      if (currentStep === 5 && direction === -1) {
         document.getElementById('step-5').classList.remove('active');
         currentStep = 4;
         document.getElementById('step-4').classList.add('active');
         document.getElementById('wizard-footer').style.display = 'flex';
         updateNav();
         return;
      }
      if (currentStep + direction < 1) return;

      document.getElementById(`step-${currentStep}`).classList.remove('active');
      currentStep += direction;
      document.getElementById(`step-${currentStep}`).classList.add('active');
      
      updateNav();
    }

    function updateNav() {
      let percent = (currentStep / totalSteps) * 100;
      document.getElementById('progress-fill').style.width = `${percent}%`;

      document.getElementById('btn-back').disabled = (currentStep === 1);
      
      if (currentStep === totalSteps) {
        document.getElementById('btn-next').innerText = "عرض النتيجة";
      } else {
        document.getElementById('btn-next').innerText = "التالي";
      }
    }

 
    const q_models = [
        
        {
            name: "فيلا اللؤلؤ - نموذج A",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Lulu.webp",
            link: "https://www.adenpalaces.com/property/pearl-villa/",
            stats: { master:3, standard:2, diwan:1, majlis:1, kit_ind:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "فيلا عائلية عملية بتصميم كلاسيكي."
        },
        {
            name: "فيلا اللؤلؤ - نموذج B",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Lulu.webp",
            link: "https://www.adenpalaces.com/property/pearl-villa/",
            stats: { master_dress:1, master:1, standard:3, diwan:1, majlis:1, kit_open:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "نسخة معدلة من فيلا اللؤلؤ مع مطبخ مفتوح."
        },
        
        
        {
            name: "فيلا الكوارتز - نموذج A",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Quartz.webp",
            link: "https://www.adenpalaces.com/property/quartz-villa/",
            stats: { master:4, diwan:1, majlis:1, kit_ind:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "تصميم عصري بـ 4 أجنحة ماستر."
        },
        {
            name: "فيلا الكوارتز - نموذج B",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Quartz.webp",
            link: "https://www.adenpalaces.com/property/quartz-villa/",
            stats: { master:3, studio:1, diwan:1, majlis:1, kit_open:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "فيلا الكوارتز مع استوديو ومطبخ مفتوح."
        },

        
        {
            name: "فيلا الفيروز - نموذج A",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Fairuz.webp",
            link: "https://www.adenpalaces.com/property/turquoise-villa/",
            stats: { master_dress:2, master:3, rec_suite:1, fam_suite:1, pool:1, kit_open:1, dining:1 },
            desc: "الفيلا المميزة بالمسبح الداخلي."
        },
        {
            name: "فيلا الفيروز - نموذج B",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Fairuz.webp",
            link: "https://www.adenpalaces.com/property/turquoise-villa/",
            stats: { master_dress:1, master:1, rec_suite:1, majlis:1, kit_open:1, living_low:1, dining:1 },
            desc: "نسخة الفيروز الأصغر."
        },
        {
            name: "فيلا الفيروز - نموذج C",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Fairuz.webp",
            link: "https://www.adenpalaces.com/property/turquoise-villa/",
            stats: { standard:5, rec_suite:1, fam_suite:1, diwan:1, pool:1, kit_open:1, dining:1 }, 
            desc: "فيلا الفيروز بـ 5 غرف نوم."
        },
        {
            name: "فيلا الفيروز - نموذج D",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Fairuz.webp",
            link: "https://www.adenpalaces.com/property/turquoise-villa/",
            stats: { master_dress:1, master:4, diwan:1, majlis:1, pool:1, kit_open:1, dining:1 },
            desc: "فيلا الفيروز بـ 5 أجنحة ماستر."
        },
        {
            name: "فيلا الفيروز - نموذج E",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Fairuz.webp",
            link: "https://www.adenpalaces.com/property/turquoise-villa/",
            stats: { master:2, suite:1, rec_suite:1, fam_suite:1, pool:1, kit_open:1, dining:1 },
            desc: "فيلا الفيروز مع جناح خاص."
        },

        
        {
            name: "فيلا العقيق - نموذج A",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Aqiq.webp",
            link: "https://www.adenpalaces.com/property/agate-villa/",
            stats: { master_dress:1, master:3, studio:1, rec_suite:1, fam_suite:1, diwan:1, kit_ind:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "مساحات ضخمة للعائلات الكبيرة."
        },
        {
            name: "فيلا العقيق - نموذج B",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Aqiq.webp",
            link: "https://www.adenpalaces.com/property/agate-villa/",
            stats: { master:3, studio:2, rec_suite:1, fam_suite:1, diwan:1, majlis:1, kit_open:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "فيلا العقيق مع استوديوهات إضافية."
        },
        {
            name: "فيلا العقيق - نموذج C",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Aqiq.webp",
            link: "https://www.adenpalaces.com/property/agate-villa/",
            stats: { master:3, standard:4, rec_suite:1, fam_suite:1, diwan:1, kit_ind:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "فيلا العقيق بأكبر عدد غرف."
        },
        {
            name: "فيلا العقيق - نموذج D",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Aqiq.webp",
            link: "https://www.adenpalaces.com/property/agate-villa/",
            stats: { master_dress:1, master:3, standard:2, rec_suite:1, fam_suite:1, diwan:1, majlis:1, kit_ind:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "فيلا العقيق المتوازنة."
        },
        {
            name: "فيلا العقيق - نموذج E",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Aqiq.webp",
            link: "https://www.adenpalaces.com/property/agate-villa/",
            stats: { master:3, studio:1, standard:2, rec_suite:1, fam_suite:1, diwan:1, majlis:1, kit_ind:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "فيلا العقيق بتوزيع اقتصادي."
        },

        
        {
            name: "قصر الكريستال - نموذج A",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Crystal.webp",
            link: "https://www.adenpalaces.com/property/crystal-palace/",
            stats: { master:2, suite:1, studio:1, standard:2, rec_suite:1, fam_suite:1, kit_ind:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "فخامة القصور مع أجنحة خاصة."
        },
        {
            name: "قصر الكريستال - نموذج B",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Crystal.webp",
            link: "https://www.adenpalaces.com/property/crystal-palace/",
            stats: { master:3, studio:1, standard:3, rec_suite:1, fam_suite:1, diwan:1, kit_ind:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "قصر الكريستال بتوزيع غرف نوم أكبر."
        },
        {
            name: "قصر الكريستال - نموذج C",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Crystal.webp",
            link: "https://www.adenpalaces.com/property/crystal-palace/",
            stats: { master:3, studio:2, rec_suite:1, fam_suite:1, diwan:1, majlis:1, kit_ind:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "قصر الكريستال مع استوديوهات مزدوجة."
        },

        
        {
            name: "فيلا الجاد - نموذج A",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Jaad.webp",
            link: "https://www.adenpalaces.com/property/villa-jaad/",
            stats: { master_dress:1, master:1, suite:1, studio:1, standard:1, diwan:1, majlis:1, kit_ind:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "توزيع شامل مع أجنحة واستوديوهات."
        },
        {
            name: "فيلا الجاد - نموذج B",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Jaad.webp", 
            link: "https://www.adenpalaces.com/property/villa-jaad/",
            stats: { master_dress:1, master:1, studio:1, standard:3, diwan:1, majlis:1, kit_open:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "نموذج الجاد بمطبخ مفتوح."
        },
        {
            name: "فيلا الجاد - نموذج C",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Jaad.webp",
            link: "https://www.adenpalaces.com/property/villa-jaad/",
            stats: { master_dress:1, master:4, standard:1, diwan:1, majlis:1, kit_ind:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "الجاد بتركيز على غرف الماستر."
        },
        {
            name: "فيلا الجاد - نموذج D",
            image: "https://www.adenpalaces.com/wp-content/uploads/2026/02/AL-Jaad.webp",
            link: "https://www.adenpalaces.com/property/villa-jaad/",
            stats: { master_dress:1, master:2, standard:3, diwan:1, majlis:1, kit_open:1, living_low:1, living_up:1, dining:1, terrace:1 },
            desc: "الجاد العائلية المتوازنة."
        }
    ];

    function calculateRealTime() {
      const getVal = (id) => {
        let el = document.getElementById(id);
        if(el.disabled) return 0;
        return parseInt(el.value) || 0;
      };

      const needs = {
          master_dress: getVal('w_master_dress'),
          master: getVal('w_master'),
          suite: getVal('w_suite'),
          studio: getVal('w_studio'),
          standard: getVal('w_standard'),
          rec_suite: getVal('w_rec_suite'),
          fam_suite: getVal('w_fam_suite'),
          diwan: getVal('w_diwan'),
          majlis: getVal('w_majlis'),
          pool: getVal('w_pool'),
          living_low: getVal('w_living_low'),
          living_up: getVal('w_living_up'),
          dining: getVal('w_dining'),
          terrace: getVal('w_terrace'),
          kit_ind: getVal('w_kit_ind'),
          kit_open: getVal('w_kit_open')
      };

      const totalInputs = Object.values(needs).reduce((a, b) => a + b, 0);
      const suggWrapper = document.getElementById('sugg-wrapper');
      const actionDiv = document.getElementById('res-action');
      
      if (totalInputs === 0) {
        document.getElementById('res-percent').innerText = "نسبة التطابق: 0%";
        document.getElementById('res-name').innerText = "ابدأ الاختيار";
        document.getElementById('res-desc').innerText = "قم بتحديد خياراتك لرؤية النموذج المناسب.";
        document.getElementById('res-img').src = "https://www.adenpalaces.com/wp-content/uploads/2024/11/chinese-company-opple-visit.jpg";
        document.getElementById('res-stats').innerHTML = "";
        actionDiv.innerHTML = "";
        suggWrapper.style.display = 'none';
        return;
      }
      
      const userTotalRooms = needs.master + needs.master_dress + needs.suite + needs.studio + needs.standard;

      const results = q_models.map(model => {
          let score = 0;
          let maxPossible = 0;
          
          for (const [key, userValue] of Object.entries(needs)) {
              if (userValue > 0) {
                  let weight = 5;
                  if(['master','master_dress','suite','studio','standard'].includes(key)) weight = 15;
                  if(['kit_ind','diwan','majlis'].includes(key)) weight = 10;
                  
                  maxPossible += (userValue * weight);
                  const modelValue = model.stats[key] || 0;
                  
                  if (modelValue >= userValue) {
                      score += (userValue * weight); 
                  } else {
                      score += (modelValue * weight); 
                  }
              }
          }
          
          let percentage = maxPossible === 0 ? 0 : Math.round((score / maxPossible) * 100);
          
          const modelTotalRooms = (model.stats.master||0) + (model.stats.master_dress||0) + (model.stats.suite||0) + (model.stats.studio||0) + (model.stats.standard||0);
          
          return { 
              ...model, 
              matchScore: percentage,
              roomDiff: Math.abs(modelTotalRooms - userTotalRooms) 
          };
      });

      results.sort((a, b) => {
          if (b.matchScore !== a.matchScore) {
              return b.matchScore - a.matchScore;
          }
          return a.roomDiff - b.roomDiff; 
      });
      
      const winner = results[0];
      const totalRooms = (winner.stats.master || 0) + (winner.stats.standard || 0) + (winner.stats.master_dress || 0) + (winner.stats.suite || 0);

      document.getElementById('res-percent').innerText = `نسبة التطابق: ${winner.matchScore}%`;
      document.getElementById('res-name').innerText = winner.name;
      document.getElementById('res-desc').innerText = winner.desc;
      document.getElementById('res-img').src = winner.image;
      
      let tagsHtml = `<span class="stat-tag">${totalRooms} غرف نوم</span>`;
      if(winner.stats.pool) tagsHtml += `<span class="stat-tag">مسبح</span>`;
      if(winner.stats.kit_open) tagsHtml += `<span class="stat-tag">مطبخ مفتوح</span>`;
      
      document.getElementById('res-stats').innerHTML = tagsHtml;
      
      actionDiv.innerHTML = `<a href="${winner.link}" class="winner-link-btn" target="_blank">عرض التفاصيل</a>`;
      
      const runnersUp = results.filter(model => model.name !== winner.name).slice(0, 2);
      
      if(runnersUp.length > 0) {
          suggWrapper.style.display = 'block';
          const suggGrid = document.getElementById('sugg-grid');
          
          suggGrid.innerHTML = runnersUp.map(model => {
              const r = (model.stats.master||0) + (model.stats.standard||0) + (model.stats.master_dress||0) + (model.stats.suite||0);
              return `
                <a class="suggestion-card" href="${model.link}" target="_blank">
                  <img class="suggestion-img" src="${model.image}" alt="${model.name}">
                  <div class="suggestion-info">
                    <span class="suggestion-match">تطابق: ${model.matchScore}%</span>
                    <h3>${model.name}</h3>
                    <div class="stats-grid">
                      <span class="stat-tag" style="font-size:0.75rem">${r} غرف</span>
                      ${model.stats.pool ? '<span class="stat-tag" style="font-size:0.75rem">مسبح</span>' : ''}
                    </div>
                  </div>
                </a>
              `;
          }).join('');
      } else {
          suggWrapper.style.display = 'none';
      }
    }
    
    updateNav();
  </script>
</div>