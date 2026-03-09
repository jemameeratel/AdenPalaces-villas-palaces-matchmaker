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

    #header-title { color: #ffffff; }
    
    .quiz-layout {
      display: flex;
      flex-direction: column;
      gap: 30px;
    }

    .wizard-container {
      background: white;
      border-radius: 20px;
      box-shadow: 0 5px 20px rgba(0,0,0,0.05);
      border: 1px solid #eee;
    }

    .wizard-header {
      background: var(--q-primary);
      padding: 20px 30px;
      color: white;
      border-radius: 20px 20px 0 0; 
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
      position: relative; /* Important for popup placement */
    }
    .input-row.active { border-color: var(--q-secondary); background: #fffcf0; }

    /* Groups the Checkbox Label and the Image Container */
    .label-group {
      display: flex;
      align-items: center;
      gap: 12px;
      width: 65%;
    }

    .check-label {
      display: flex;
      align-items: center;
      gap: 10px; 
      cursor: pointer;
      font-weight: 600;
      color: #555;
      margin: 0;
    }
    .input-row.active .check-label { color: var(--q-primary); }
    
    .label-text { margin-left: 2px; }

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
      flex-shrink: 0;
    }
    input[type="checkbox"]:checked + .custom-checkbox {
      background: var(--q-secondary);
      border-color: var(--q-secondary);
    }
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

    /* ========================================= */
    /* HOVER ENLARGE IMAGE CSS                   */
    /* ========================================= */
    .img-tooltip-container {
      position: relative;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* The small landscape thumbnail */
    .tiny-thumb {
      width: 65px;  /* Landscape width */
      height: 40px; /* Landscape height */
      border-radius: 5px;
      object-fit: cover;
      border: 1px solid #ccc;
      cursor: zoom-in;
      background-color: white;
      transition: all 0.2s ease;
    }
    .input-row.active .tiny-thumb { border-color: var(--q-secondary); }

    /* The large popup image */
	.large-preview {
      position: absolute;
      bottom: 130%; 
      right: 0; 
      
      /* Add !important to force Elementor to listen */
      width: 300px !important;  
      height: 200px !important; 
      
      /* THIS IS THE MAGIC FIX */
      max-width: none !important; 
      
      object-fit: cover;
      border-radius: 12px;
      border: 4px solid white;
      box-shadow: 0 15px 40px rgba(0,0,0,0.3);
      opacity: 0;
      visibility: hidden;
      transform: translateY(15px);
      transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      z-index: 9999;
      pointer-events: none; 
    }

    /* Triggers the popup when mouse enters the container */
    .img-tooltip-container:hover .large-preview {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }
    /* ========================================= */

    .custom-select {
      width: 30%;
      padding: 6px;
      border-radius: 6px;
      border: 1px solid #ddd;
      cursor: pointer;
    }
    .custom-select:disabled { background: #f0f0f0; cursor: not-allowed; }

    /* Validation Error Message */
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

    .wizard-footer {
      padding: 20px 30px;
      border-top: 1px solid #eee;
      display: flex;
      justify-content: space-between;
      background: #fcfcfc;
      border-radius: 0 0 20px 20px;
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
    .winner-img-container { width: 40%; position: relative; line-height: 0; font-size: 0; display: flex; }
    .winner-img { width: 100%; height: 100%; object-fit: cover; display: block; margin: 0; padding: 0; background: #eee; min-height: 250px; }
    .winner-details { width: 60%; padding: 30px; display: flex; flex-direction: column; justify-content: center; }
    
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

    .suggestions-wrapper { display: none; }
    .suggestions-title { text-align: center; margin-bottom: 20px; color: var(--q-primary); font-size: 1.4rem; position: relative; }
    .suggestions-title::after { content: ''; display: block; width: 50px; height: 3px; background: var(--q-secondary); margin: 10px auto 0; border-radius: 2px; }
    .suggestions-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }

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
    .suggestion-img { width: 100%; height: 180px; object-fit: cover; }
    .suggestion-info { padding: 15px; flex-grow: 1; display: flex; flex-direction: column; }
    .suggestion-match { font-size: 0.85rem; color: var(--q-secondary); font-weight: bold; margin-bottom: 5px; }
    .suggestion-info h3 { font-size: 1.1rem; margin: 0 0 10px; color: var(--q-primary); }
    
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

    /* MOBILE RESPONSIVE CSS */
    @media (max-width: 768px) {
      .winner-card { flex-direction: column; }
      .winner-img-container, .winner-details { width: 100%; }
      .winner-img-container { height: 250px; }
      .suggestions-grid { grid-template-columns: 1fr; }
      .label-group { width: auto; flex-wrap: wrap; gap: 8px; }
      .check-label { width: auto; font-size: 0.9rem; }
      
      /* Keep mobile tooltip slightly smaller to fit screen */
      .large-preview { width: 220px; height: 160px; }
    }
	@media (max-width: 768px) {
      .large-preview { 
        width: 250px !important; 
        height: 180px !important; 
        max-width: 85vw !important; /* Prevents horizontal scroll on tiny phones */
      }
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
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_master_dress')">
                <span class="custom-checkbox"></span>
                <span class="label-text">نوم ماستر (ملابس)</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://www.adenpalaces.com/wp-content/uploads/2026/03/01-Master-Bedroom-with-Dressing-Room-نوم-ماستر-ملابس.webp" class="tiny-thumb" alt="نوم ماستر (ملابس)">
                <img src="https://www.adenpalaces.com/wp-content/uploads/2026/03/01-Master-Bedroom-with-Dressing-Room-نوم-ماستر-ملابس.webp" class="large-preview" alt="نوم ماستر (ملابس)">
              </div>
            </div>
            <select id="w_master_dress" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option>
            </select>
          </div>

          <div class="input-row" id="row_w_master">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_master')">
                <span class="custom-checkbox"></span>
                <span class="label-text">نوم ماستر</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://www.adenpalaces.com/wp-content/uploads/2026/03/02-Master-Bedroom-نوم-ماستر.webp" class="tiny-thumb" alt="نوم ماستر">
                <img src="https://www.adenpalaces.com/wp-content/uploads/2026/03/02-Master-Bedroom-نوم-ماستر.webp" class="large-preview" alt="نوم ماستر">
              </div>
            </div>
            <select id="w_master" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option>
            </select>
          </div>

          <div class="input-row" id="row_w_suite">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_suite')">
                <span class="custom-checkbox"></span>
                <span class="label-text">جناح خاص</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://www.adenpalaces.com/wp-content/uploads/2026/03/03-Private-Suite-جناح-خاص.webp" class="tiny-thumb" alt="جناح خاص">
                <img src="https://www.adenpalaces.com/wp-content/uploads/2026/03/03-Private-Suite-جناح-خاص.webp" class="large-preview" alt="جناح خاص">
              </div>
            </div>
            <select id="w_suite" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option><option value="3">3</option>
            </select>
          </div>

          <div class="input-row" id="row_w_studio">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_studio')">
                <span class="custom-checkbox"></span>
                <span class="label-text">استوديو</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://www.adenpalaces.com/wp-content/uploads/2026/03/04-Studio-استوديو.webp" class="tiny-thumb" alt="استوديو">
                <img src="https://www.adenpalaces.com/wp-content/uploads/2026/03/04-Studio-استوديو.webp" class="large-preview" alt="استوديو">
              </div>
            </div>
            <select id="w_studio" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option><option value="3">3</option>
            </select>
          </div>

          <div class="input-row" id="row_w_standard">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_standard')">
                <span class="custom-checkbox"></span>
                <span class="label-text">غرفة نوم</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://www.adenpalaces.com/wp-content/uploads/2026/03/05-Standard-Bedroom-غرفة-نوم.webp" class="tiny-thumb" alt="غرفة نوم">
                <img src="https://www.adenpalaces.com/wp-content/uploads/2026/03/05-Standard-Bedroom-غرفة-نوم.webp" class="large-preview" alt="غرفة نوم">
              </div>
            </div>
            <select id="w_standard" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option>
            </select>
          </div>
        </div>

        <div class="quiz-step" id="step-2">
          <h3 class="step-title">2. أستقبال الضيوف</h3>
          <p class="step-desc">حدد المجالس المطلوبة</p>
          
          <div class="input-row" id="row_w_rec_suite">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_rec_suite')">
                <span class="custom-checkbox"></span>
                <span class="label-text">جناح استقبال</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=600&q=80" class="tiny-thumb" alt="جناح استقبال">
                <img src="https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=600&q=80" class="large-preview" alt="جناح استقبال">
              </div>
            </div>
            <select id="w_rec_suite" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          
          <div class="input-row" id="row_w_fam_suite">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_fam_suite')">
                <span class="custom-checkbox"></span>
                <span class="label-text">جناح عائلي</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=600&q=80" class="tiny-thumb" alt="جناح عائلي">
                <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?auto=format&fit=crop&w=600&q=80" class="large-preview" alt="جناح عائلي">
              </div>
            </div>
            <select id="w_fam_suite" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          
          <div class="input-row" id="row_w_diwan">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_diwan')">
                <span class="custom-checkbox"></span>
                <span class="label-text">ديوان رجال</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://images.unsplash.com/photo-1618219908412-a29a1bb7b86e?auto=format&fit=crop&w=600&q=80" class="tiny-thumb" alt="ديوان رجال">
                <img src="https://images.unsplash.com/photo-1618219908412-a29a1bb7b86e?auto=format&fit=crop&w=600&q=80" class="large-preview" alt="ديوان رجال">
              </div>
            </div>
            <select id="w_diwan" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          
          <div class="input-row" id="row_w_majlis">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_majlis')">
                <span class="custom-checkbox"></span>
                <span class="label-text">مجلس نساء</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=600&q=80" class="tiny-thumb" alt="مجلس نساء">
                <img src="https://images.unsplash.com/photo-1512918728675-ed5a9ecdebfd?auto=format&fit=crop&w=600&q=80" class="large-preview" alt="مجلس نساء">
              </div>
            </div>
            <select id="w_majlis" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
        </div>

        <div class="quiz-step" id="step-3">
          <h3 class="step-title">3. الصالات والمعيشة</h3>
          <p class="step-desc">حدد مساحات المعيشة المطلوبة</p>
          
          <div class="input-row" id="row_w_pool">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_pool')">
                <span class="custom-checkbox"></span>
                <span class="label-text">صالة بمسبح</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://images.unsplash.com/photo-1576013551627-11dc5f22bce6?auto=format&fit=crop&w=600&q=80" class="tiny-thumb" alt="صالة بمسبح">
                <img src="https://images.unsplash.com/photo-1576013551627-11dc5f22bce6?auto=format&fit=crop&w=600&q=80" class="large-preview" alt="صالة بمسبح">
              </div>
            </div>
            <select id="w_pool" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option>
            </select>
          </div>
          
          <div class="input-row" id="row_w_living_low">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_living_low')">
                <span class="custom-checkbox"></span>
                <span class="label-text">معيشة سفلية</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=600&q=80" class="tiny-thumb" alt="معيشة سفلية">
                <img src="https://images.unsplash.com/photo-1600121848594-d8644e57abab?auto=format&fit=crop&w=600&q=80" class="large-preview" alt="معيشة سفلية">
              </div>
            </div>
            <select id="w_living_low" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          
          <div class="input-row" id="row_w_living_up">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_living_up')">
                <span class="custom-checkbox"></span>
                <span class="label-text">معيشة علوية</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://images.unsplash.com/photo-1600566753086-00f18efc22c7?auto=format&fit=crop&w=600&q=80" class="tiny-thumb" alt="معيشة علوية">
                <img src="https://images.unsplash.com/photo-1600566753086-00f18efc22c7?auto=format&fit=crop&w=600&q=80" class="large-preview" alt="معيشة علوية">
              </div>
            </div>
            <select id="w_living_up" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          
          <div class="input-row" id="row_w_dining">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_dining')">
                <span class="custom-checkbox"></span>
                <span class="label-text">صالة طعام</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://images.unsplash.com/photo-1617806118233-18e1c0945594?auto=format&fit=crop&w=600&q=80" class="tiny-thumb" alt="صالة طعام">
                <img src="https://images.unsplash.com/photo-1617806118233-18e1c0945594?auto=format&fit=crop&w=600&q=80" class="large-preview" alt="صالة طعام">
              </div>
            </div>
            <select id="w_dining" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          
          <div class="input-row" id="row_w_terrace">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_terrace')">
                <span class="custom-checkbox"></span>
                <span class="label-text">شرفة علوية</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://images.unsplash.com/photo-1600607686527-6fb886090705?auto=format&fit=crop&w=600&q=80" class="tiny-thumb" alt="شرفة علوية">
                <img src="https://images.unsplash.com/photo-1600607686527-6fb886090705?auto=format&fit=crop&w=600&q=80" class="large-preview" alt="شرفة علوية">
              </div>
            </div>
            <select id="w_terrace" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
        </div>

        <div class="quiz-step" id="step-4">
          <h3 class="step-title">4. المطبخ</h3>
          <p class="step-desc">حدد نوع المطبخ</p>
          
          <div class="input-row" id="row_w_kit_ind">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_kit_ind')">
                <span class="custom-checkbox"></span>
                <span class="label-text">مطبخ مستقل (مغلق)</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=600&q=80" class="tiny-thumb" alt="مطبخ مستقل (مغلق)">
                <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?auto=format&fit=crop&w=600&q=80" class="large-preview" alt="مطبخ مستقل (مغلق)">
              </div>
            </div>
            <select id="w_kit_ind" class="custom-select" disabled onchange="calculateRealTime()">
              <option value="1">1</option><option value="2">2</option>
            </select>
          </div>
          
          <div class="input-row" id="row_w_kit_open">
            <div class="label-group">
              <label class="check-label">
                <input type="checkbox" onchange="toggleSelect(this, 'w_kit_open')">
                <span class="custom-checkbox"></span>
                <span class="label-text">مطبخ مفتوح</span>
              </label>
              <div class="img-tooltip-container">
                <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&fit=crop&w=600&q=80" class="tiny-thumb" alt="مطبخ مفتوح">
                <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?auto=format&fit=crop&w=600&q=80" class="large-preview" alt="مطبخ مفتوح">
              </div>
            </div>
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
        <div class="suggestions-grid" id="sugg-grid"></div>
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
      
      // Hide error message when user checks a box
      document.getElementById('step-error').style.display = 'none';
      calculateRealTime();
    }

    let currentStep = 1;
    const totalSteps = 4; 

    function changeStep(direction) {
      const errorMsg = document.getElementById('step-error');

      // Validation logic: Prevent going to next step if nothing is checked
      if (direction === 1 && currentStep <= totalSteps) {
          const currentStepDiv = document.getElementById('step-' + currentStep);
          const checkedBoxes = currentStepDiv.querySelectorAll('input[type="checkbox"]:checked');
          
          if (checkedBoxes.length === 0) {
              errorMsg.style.display = 'block';
              return; 
          }
      }
      
      // Hide error message if validation passes
      errorMsg.style.display = 'none';

      if (currentStep + direction > totalSteps) {
         document.getElementById('step-' + currentStep).classList.remove('active');
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

      document.getElementById('step-' + currentStep).classList.remove('active');
      currentStep += direction;
      document.getElementById('step-' + currentStep).classList.add('active');
      
      updateNav();
    }

    function updateNav() {
      let percent = (currentStep / totalSteps) * 100;
      document.getElementById('progress-fill').style.width = percent + '%';
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
        document.getElementById('res-img').src = "https://www.adenpalaces.com/wp-content/uploads/2026/01/aden-palaces-img-slider-01-v2.webp";
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