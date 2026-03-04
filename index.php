


<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="theme-color" content="#FDFBF7">
    <title>توبه - المصحف الشريف</title>
    
    <!-- توليد ملف Manifest ديناميكياً لتفعيل ميزة التثبيت PWA -->
    <link rel="manifest" id="manifest-link">
    <script>
        const manifestData = {
            "name": "توبه - المصحف الشريف",
            "short_name": "توبه",
            "start_url": window.location.href,
            "display": "standalone",
            "background_color": "#FDFBF7",
            "theme_color": "#B89947",
            "description": "تطبيق إسلامي شامل للقرآن الكريم والأذكار والإذاعة",
            "icons":[
                {
                    "src": "https://cdn-icons-png.flaticon.com/512/4273/4273032.png",
                    "sizes": "192x192",
                    "type": "image/png"
                },
                {
                    "src": "https://cdn-icons-png.flaticon.com/512/4273/4273032.png",
                    "sizes": "512x512",
                    "type": "image/png"
                }
            ]
        };
        const manifestBlob = new Blob([JSON.stringify(manifestData)], { type: 'application/json' });
        document.getElementById('manifest-link').href = URL.createObjectURL(manifestBlob);
    </script>

    <link href="https://fonts.googleapis.com/css2?family=Amiri:wght@400;700&family=Tajawal:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://js.puter.com/v2/"></script>
    <style>
        :root {
            --bg: #FDFBF7;
            --text-main: #2A2A2A;
            --text-muted: #888;
            --accent: #B89947;
            --accent-light: rgba(184, 153, 71, 0.2);
            --transition: cubic-bezier(0.4, 0, 0.2, 1);
            --mushaf-size: 1.8rem;
            --glass-bg: rgba(253, 251, 247, 0.95);
        }
        * { box-sizing: border-box; margin: 0; padding: 0; border: none; outline: none; }
        body { font-family: 'Tajawal', sans-serif; background: var(--bg); color: var(--text-main); min-height: 100vh; overflow-x: hidden; -webkit-tap-highlight-color: transparent; }
        ::-webkit-scrollbar { width: 3px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: var(--accent); }
        
        #loader { position: fixed; inset: 0; background: var(--bg); z-index: 9999; display: flex; justify-content: center; align-items: center; transition: opacity 0.8s ease; }
        .logo-text { font-family: 'Amiri', serif; font-size: 4.5rem; color: var(--accent); animation: pulse 2s infinite alternate; }
        @keyframes pulse { from { opacity: 0.5; } to { opacity: 1; } }
        
        nav { position: fixed; top: 0; left: 0; right: 0; display: flex; justify-content: center; align-items: center; padding: 20px 10px; background: var(--glass-bg); backdrop-filter: blur(15px); z-index: 100; }
        .nav-links { display: flex; gap: 15px; flex-wrap: wrap; justify-content: center; width: 100%; max-width: 850px; }
        .nav-links button { background: transparent; color: var(--text-muted); font-family: 'Tajawal'; font-size: 1.1rem; font-weight: 700; cursor: pointer; transition: 0.3s; padding: 5px 10px; }
        .nav-links button:hover, .nav-links button.active { color: var(--accent); transform: translateY(-2px); }
        
        main { padding: 110px 20px 250px; max-width: 850px; margin: 0 auto; }
        .section { display: none; animation: fadeIn 0.4s var(--transition) forwards; opacity: 0; }
        .section.active { display: block; }
        @keyframes fadeIn { to { opacity: 1; transform: translateY(0); } }
        
        .search-area { text-align: center; margin-bottom: 50px; display: flex; flex-direction: column; align-items: center; gap: 20px; }
        .search-area input { background: transparent; width: 100%; max-width: 400px; font-family: 'Tajawal'; font-size: 1.8rem; color: var(--text-main); text-align: center; padding: 10px; border-bottom: 2px solid transparent; transition: 0.3s; }
        .search-area input:focus { border-bottom-color: var(--accent-light); }
        .search-area input::placeholder { color: var(--text-muted); opacity: 0.5; }
        
        .bookmark-flat { display: none; justify-content: space-between; align-items: center; padding: 20px 0; cursor: pointer; transition: 0.3s; position: relative; color: var(--accent); }
        .bookmark-flat::after { content: ''; position: absolute; bottom: 0; left: 5%; right: 5%; height: 1px; background: linear-gradient(90deg, transparent, var(--accent), transparent); }
        .bookmark-flat:hover { transform: scale(1.02); padding: 20px 10px; }
        
        .surah-list-flat { display: flex; flex-direction: column; gap: 10px; }
        .surah-item-flat { display: flex; justify-content: space-between; align-items: center; padding: 20px 0; cursor: pointer; transition: 0.3s; position: relative; }
        .surah-item-flat::after { content: ''; position: absolute; bottom: 0; left: 5%; right: 5%; height: 1px; background: linear-gradient(90deg, transparent, var(--accent-light), transparent); }
        .surah-item-flat:hover { color: var(--accent); transform: scale(1.02); padding: 20px 10px; }
        .surah-item-name { font-family: 'Amiri', serif; font-size: 1.8rem; }
        .surah-item-meta { font-size: 1.1rem; color: var(--text-muted); }
        
        .mushaf-tools { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px; }
        .mushaf-tools button { background: transparent; color: var(--text-muted); font-size: 1.3rem; cursor: pointer; transition: 0.3s; padding: 5px; }
        .mushaf-tools button:hover { color: var(--accent); transform: scale(1.1); }
        .mushaf-reciter-select { background: transparent; color: var(--accent); font-family: 'Tajawal'; font-size: 1.2rem; font-weight: bold; border-bottom: 1px solid var(--accent-light); padding: 5px; cursor: pointer; appearance: none; text-align: center; }
        
        .mushaf-header { text-align: center; margin-bottom: 40px; }
        .mushaf-title { font-family: 'Amiri', serif; font-size: 4rem; color: var(--accent); margin-bottom: 5px; }
        .bismillah { font-family: 'Amiri', serif; font-size: 2.2rem; color: var(--text-main); margin-bottom: 30px; display: none; }
        .mushaf-text { font-family: 'Amiri', serif; font-size: var(--mushaf-size); line-height: 2.4; text-align: justify; text-justify: inter-word; direction: rtl; transition: font-size 0.3s; }
        .ayah-container { display: inline; position: relative; }
        .ayah-span { cursor: pointer; transition: color 0.3s; }
        .ayah-span:hover { color: var(--accent); }
        .ayah-span.playing { color: var(--accent); font-weight: bold; }
        .ayah-end { display: inline-flex; align-items: center; justify-content: center; font-size: 1.3rem; color: var(--accent); margin: 0 6px; }
        
        .inline-tafsir { display: none; background: transparent; border-right: 2px solid var(--accent); color: var(--text-main); font-family: 'Tajawal'; font-size: 1.2rem; padding: 15px; margin: 15px 0; text-align: right; line-height: 1.8; animation: fadeIn 0.4s; }
        
        .reciters-hero { text-align: center; margin-bottom: 40px; padding: 20px 0; }
        .reciters-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(140px, 1fr)); gap: 25px; padding: 20px 0; }
        .reciter-card { display: flex; flex-direction: column; align-items: center; justify-content: center; cursor: pointer; transition: 0.4s; padding: 20px 10px; text-align: center; position: relative; }
        .reciter-card::after { content: ''; position: absolute; bottom: 0; left: 20%; right: 20%; height: 1px; background: transparent; transition: 0.4s; }
        .reciter-card:hover::after { background: var(--accent-light); left: 10%; right: 10%; }
        .reciter-card:hover { transform: translateY(-8px); }
        .reciter-avatar { width: 90px; height: 90px; border-radius: 50%; background: transparent; color: var(--accent); border: 2px solid var(--accent-light); display: flex; align-items: center; justify-content: center; font-size: 2.8rem; margin-bottom: 15px; transition: 0.4s; }
        .reciter-card:hover .reciter-avatar { background: var(--accent); color: var(--bg); border-color: var(--accent); }
        .reciter-name { font-family: 'Tajawal'; font-size: 1.2rem; font-weight: 700; color: var(--text-main); transition: 0.4s; }
        .reciter-card:hover .reciter-name { color: var(--accent); }
        
        #ayah-sheet { position: fixed; bottom: 0; left: 0; right: 0; background: var(--glass-bg); backdrop-filter: blur(20px); border-radius: 30px 30px 0 0; padding: 30px 20px 40px; z-index: 400; transform: translateY(100%); transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); display: flex; flex-direction: column; gap: 20px; max-width: 600px; margin: 0 auto; }
        #ayah-sheet.active { transform: translateY(0); }
        .sheet-handle { width: 50px; height: 5px; background: var(--text-muted); opacity: 0.3; border-radius: 5px; margin: -10px auto 10px; }
        .sheet-actions { display: grid; grid-template-columns: repeat(5, 1fr); gap: 10px; }
        .sheet-btn { display: flex; flex-direction: column; align-items: center; gap: 8px; background: transparent; color: var(--text-muted); font-family: 'Tajawal'; font-size: 1rem; cursor: pointer; transition: 0.3s; }
        .sheet-btn i { font-size: 1.5rem; color: var(--text-main); transition: 0.3s; }
        .sheet-btn:hover { color: var(--accent); }
        .sheet-btn:hover i { color: var(--accent); transform: translateY(-5px) scale(1.1); }
        #overlay { position: fixed; inset: 0; background: rgba(0,0,0,0.4); z-index: 350; display: none; opacity: 0; transition: 0.3s; }
        #overlay.active { display: block; opacity: 1; }
        
        .adhkar-flat-list { display: flex; flex-direction: column; align-items: center; gap: 25px; }
        .adhkar-cat-title { font-family: 'Amiri', serif; font-size: 2.2rem; cursor: pointer; transition: 0.3s; color: var(--text-main); text-align: center; }
        .adhkar-cat-title:hover { color: var(--accent); transform: scale(1.1); }
        .dhikr-flat-item { text-align: center; margin-bottom: 60px; user-select: none; }
        .dhikr-content { font-family: 'Amiri', serif; font-size: 2rem; line-height: 2.2; margin-bottom: 25px; }
        .dhikr-counter { font-size: 2.5rem; color: var(--accent); cursor: pointer; transition: 0.1s; font-weight: 900; }
        .dhikr-counter:active { transform: scale(0.9); opacity: 0.7; }
        
        .radio-wrapper { display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 40vh; position: relative; }
        .radio-title { font-family: 'Amiri', serif; font-size: 3rem; color: var(--accent); margin-top: 30px; text-align: center; }
        .radio-subtitle { font-family: 'Tajawal', sans-serif; font-size: 1.2rem; color: var(--text-muted); text-align: center; margin-bottom: 40px; }
        .visualizer-container { position: relative; width: 250px; height: 250px; display: flex; justify-content: center; align-items: center; }
        #radio-canvas { position: absolute; top: 0; left: 0; width: 100%; height: 100%; border-radius: 50%; z-index: 1; }
        .radio-play-btn { position: relative; z-index: 2; width: 80px; height: 80px; border-radius: 50%; background: transparent; color: var(--accent); font-size: 3rem; display: flex; justify-content: center; align-items: center; cursor: pointer; transition: 0.3s; border: 2px solid var(--accent); }
        .radio-play-btn:hover { transform: scale(1.1); }
        .radio-play-btn.playing { background: var(--accent); color: var(--bg); animation: pulseRadio 2s infinite; }
        @keyframes pulseRadio { 0% { box-shadow: 0 0 0 0 var(--accent-light); } 70% { box-shadow: 0 0 0 30px rgba(0,0,0,0); } 100% { box-shadow: 0 0 0 0 rgba(0,0,0,0); } }
        .station-list-flat { display: flex; flex-direction: column; gap: 10px; width: 100%; max-width: 500px; margin: 0 auto; }
        .station-item-flat { display: flex; justify-content: space-between; align-items: center; padding: 20px 0; cursor: pointer; transition: 0.3s; position: relative; font-family: 'Tajawal'; font-size: 1.4rem; color: var(--text-main); }
        .station-item-flat::after { content: ''; position: absolute; bottom: 0; left: 5%; right: 5%; height: 1px; background: linear-gradient(90deg, transparent, var(--accent-light), transparent); }
        .station-item-flat:hover, .station-item-flat.active { color: var(--accent); transform: scale(1.02); padding: 20px 10px; }
        
        #ai-modal { position: fixed; inset: 0; background: var(--bg); z-index: 500; display: none; flex-direction: column; }
        #ai-modal.active { display: flex; animation: fadeIn 0.3s; }
        .ai-tools { position: absolute; top: 20px; left: 20px; right: 20px; display: flex; justify-content: space-between; z-index: 501; }
        .ai-title { font-family: 'Amiri', serif; font-size: 2rem; color: var(--accent); }
        .ai-close { background: transparent; color: var(--text-main); font-size: 1.8rem; cursor: pointer; transition: 0.3s; }
        .ai-close:hover { color: red; transform: scale(1.1); }
        .ai-chat { flex: 1; overflow-y: auto; padding: 80px 20px 100px; max-width: 800px; margin: 0 auto; width: 100%; display: flex; flex-direction: column; gap: 25px; }
        .msg-flat { font-family: 'Tajawal'; font-size: 1.4rem; line-height: 1.8; max-width: 95%; }
        .msg-flat.user { align-self: flex-start; color: var(--accent); font-weight: 700; }
        .msg-flat.ai { align-self: flex-end; color: var(--text-main); text-align: right; }
        .ai-input-wrapper { position: fixed; bottom: 0; left: 0; right: 0; background: linear-gradient(to top, var(--bg) 80%, transparent); padding: 30px 20px; display: flex; justify-content: center; }
        .ai-input-inner { display: flex; align-items: center; width: 100%; max-width: 800px; gap: 15px; }
        .ai-input-inner input { flex: 1; font-size: 1.4rem; background: transparent; padding: 10px 0; font-family: 'Tajawal'; color: var(--text-main); border-bottom: 2px solid var(--accent-light); transition: 0.3s; }
        .ai-input-inner input:focus { border-bottom-color: var(--accent); }
        .ai-input-inner input::placeholder { color: var(--text-muted); opacity: 0.5; }
        .ai-input-inner button { background: transparent; color: var(--accent); font-size: 1.8rem; cursor: pointer; transition: 0.3s; }
        .ai-input-inner button:hover { transform: translateX(-5px); }
        
        #compact-player { position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%); width: 70px; height: 70px; background: var(--text-main); border-radius: 35px; box-shadow: 0 10px 40px rgba(0,0,0,0.2); display: none; align-items: center; justify-content: center; cursor: pointer; z-index: 450; transition: 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); overflow: hidden; flex-direction: column; color: var(--bg); }
        #compact-player.visible { display: flex; }
        #compact-player.expanded { width: 95%; max-width: 450px; height: 180px; border-radius: 25px; padding: 0; background: var(--text-main); cursor: default; }
        
        .player-minimized { display: flex; align-items: center; justify-content: center; width: 100%; height: 100%; pointer-events: none; }
        .wave-icon { display: flex; align-items: center; gap: 4px; height: 25px; }
        .wave-bar { width: 4px; background: var(--bg); border-radius: 2px; height: 100%; animation: wave 1s infinite ease-in-out; transform-origin: bottom; }
        .wave-bar:nth-child(2) { animation-delay: 0.2s; }
        .wave-bar:nth-child(3) { animation-delay: 0.4s; }
        @keyframes wave { 0%, 100% { transform: scaleY(0.3); } 50% { transform: scaleY(1); } }
        .paused .wave-bar { animation: none; transform: scaleY(0.3); }
        
        .player-expanded-ui { display: none; flex-direction: column; width: 100%; height: 100%; padding: 20px; justify-content: space-between; }
        #compact-player.expanded .player-minimized { display: none; }
        #compact-player.expanded .player-expanded-ui { display: flex; }
        
        .player-text-scroll { flex: 1; overflow: hidden; white-space: nowrap; font-family: 'Amiri', serif; font-size: 1.4rem; color: #FFF; position: relative; }
        .scrolling-text { display: inline-block; padding-left: 100%; animation: scrollText 15s linear infinite; }
        @keyframes scrollText { 0% { transform: translate(0, 0); } 100% { transform: translate(100%, 0); } }
        
        .player-progress-container { width: 100%; height: 4px; background: rgba(255,255,255,0.2); border-radius: 2px; position: relative; overflow: hidden; cursor: pointer; }
        .player-progress-bar { height: 100%; background: var(--accent); width: 0%; border-radius: 2px; transition: width 0.1s linear; }
        
        .volume-slider { width: 70px; appearance: none; background: rgba(255,255,255,0.2); height: 2px; outline: none; transition: 0.3s; cursor: pointer; }
        .volume-slider::-webkit-slider-thumb { appearance: none; width: 10px; height: 10px; border-radius: 50%; background: var(--accent); cursor: pointer; }

        .install-banner { position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%) translateY(200%); width: 90%; max-width: 500px; background: var(--glass-bg); backdrop-filter: blur(15px); padding: 20px; border-radius: 20px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 10px 40px rgba(0,0,0,0.15); transition: transform 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275); z-index: 1000; border: 1px solid var(--accent-light); }
        .install-banner.active { transform: translateX(-50%) translateY(0); }
        .install-banner-content { display: flex; align-items: center; gap: 15px; }
        .install-btn { background: var(--accent); color: var(--bg); padding: 8px 20px; border-radius: 20px; font-family: 'Tajawal'; font-weight: bold; cursor: pointer; transition: 0.3s; font-size: 1rem; }
        .install-btn:hover { transform: scale(1.05); }
        .install-close { background: transparent; color: var(--text-muted); font-size: 1.5rem; cursor: pointer; }

        @media (max-width: 768px) {
            .logo-text { font-size: 3.5rem; } .mushaf-title { font-size: 3rem; }
            .nav-links button { font-size: 1rem; padding: 5px; } .sheet-actions { grid-template-columns: repeat(3, 1fr); gap: 15px; }
            .visualizer-container { width: 200px; height: 200px; }
            .reciters-grid { grid-template-columns: repeat(auto-fill, minmax(120px, 1fr)); }
            .reciter-avatar { width: 70px; height: 70px; font-size: 2rem; }
        }
    </style>
</head>
<body>

<div id="loader"><div class="logo-text">توبه</div></div>

<nav>
    <div class="nav-links">
        <button onclick="switchTab('quran')" id="nav-quran" class="active">المصحف</button>
        <button onclick="switchTab('reciters')" id="nav-reciters">القراء</button>
        <button onclick="switchTab('adhkar')" id="nav-adhkar">الأذكار</button>
        <button onclick="switchTab('radio')" id="nav-radio">الإذاعة</button>
        <button onclick="switchTab('ai')" id="nav-ai">AI</button>
    </div>
</nav>

<main>
    <div id="quran" class="section active">
        <div id="surah-list-container">
            <div class="search-area">
                <input type="text" id="surah-search" placeholder="ابحث في سور القرآن الكريم..." oninput="filterSurahs('quran')">
            </div>
            <div id="bookmark-flat" class="bookmark-flat" onclick="goToBookmark()">
                <div style="display:flex; flex-direction:column; gap:5px;">
                    <span style="font-size:1rem; color:var(--text-muted);">متابعة القراءة</span>
                    <span id="bookmark-text" style="font-family:'Amiri'; font-size:1.5rem; font-weight:bold;"></span>
                </div>
                <i class="fas fa-bookmark" style="font-size:1.8rem;"></i>
            </div>
            <div id="surah-list" class="surah-list-flat"></div>
        </div>
        
        <div id="mushaf-container" style="display:none;">
            <div class="mushaf-tools">
                <button onclick="closeMushaf()" title="عودة للقائمة"><i class="fas fa-arrow-right"></i></button>
                <select id="mushaf-reciter" class="mushaf-reciter-select" onchange="changeMushafReciter()"></select>
                <div style="display: flex; gap: 10px;">
                    <button onclick="changeFontSize(-0.2)" title="تصغير الخط"><i class="fas fa-minus"></i></button>
                    <button onclick="changeFontSize(0.2)" title="تكبير الخط"><i class="fas fa-plus"></i></button>
                </div>
            </div>
            <div class="mushaf-header">
                <h2 id="mushaf-title" class="mushaf-title"></h2>
                <div id="mushaf-bismillah" class="bismillah">بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ</div>
            </div>
            <div id="mushaf-content" class="mushaf-text"></div>
        </div>
    </div>

    <div id="reciters" class="section">
        <div id="reciters-main-view">
            <div class="reciters-hero">
                <h2 style="font-family: 'Amiri', serif; font-size: 3rem; color: var(--accent); margin-bottom: 10px;">استمع للقرآن الكريم</h2>
                <p style="color: var(--text-muted); font-size: 1.2rem;">بأصوات نخبة من أفضل القراء</p>
            </div>
            <div class="search-area">
                <input type="text" id="reciter-search" placeholder="ابحث عن قارئ..." oninput="filterReciters()">
                <p id="reciters-count" style="color: var(--text-muted); font-size: 1rem;">جاري تجهيز قائمة القراء...</p>
            </div>
            <div id="reciters-grid" class="reciters-grid"></div>
        </div>
        
        <div id="reciter-surahs-view" style="display:none;">
            <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:40px;">
                <button onclick="backToReciters()" style="background:transparent; color:var(--text-muted); font-size:1.5rem; cursor:pointer; transition:0.3s;"><i class="fas fa-arrow-right"></i></button>
                <div id="active-reciter-title" style="font-family:'Amiri'; font-size:2.5rem; color:var(--accent);"></div>
                <div style="width:24px;"></div>
            </div>
            <div class="search-area">
                <input type="text" id="reciter-surah-search" placeholder="ابحث عن سورة للاستماع..." oninput="filterSurahs('reciters')">
            </div>
            <div id="reciter-surah-list" class="surah-list-flat"></div>
        </div>
    </div>

    <div id="adhkar" class="section">
        <div id="adhkar-cats" class="adhkar-flat-list"></div>
        <div id="adhkar-view" style="display:none;">
            <button onclick="closeAdhkar()" style="background:transparent; font-size:2rem; cursor:pointer; margin-bottom:40px; text-align:center; display:block; width:100%; color:var(--text-muted);"><i class="fas fa-chevron-up"></i></button>
            <div id="adhkar-items"></div>
        </div>
    </div>

    <div id="radio" class="section">
        <div class="radio-wrapper">
            <div class="visualizer-container">
                <canvas id="radio-canvas" width="300" height="300"></canvas>
                <button id="radio-btn" class="radio-play-btn" onclick="toggleRadio()"><i class="fas fa-play"></i></button>
            </div>
            <h2 class="radio-title" id="current-station-title">إذاعة القرآن الكريم - القاهرة</h2>
            <p class="radio-subtitle" id="radio-status-text">متوقف</p>
            <button onclick="playRandomStation()" style="background: transparent; color: var(--accent); border: 1px solid var(--accent-light); border-radius: 999px; padding: 7px 16px; cursor: pointer; font-family: 'Tajawal';"><i class="fas fa-shuffle"></i> محطة عشوائية</button>
        </div>
        <div class="station-list-flat" id="radio-stations-container"></div>
    </div>
</main>

<div id="overlay" onclick="hideAyahSheet()"></div>
<div id="ayah-sheet">
    <div class="sheet-handle"></div>
    <div style="font-family:'Amiri'; font-size:1.6rem; text-align:center; color:var(--text-main); margin-bottom:15px; line-height: 1.8;" id="sheet-ayah-text"></div>
    <div class="sheet-actions">
        <button class="sheet-btn" id="btn-play-ayah"><i class="fas fa-play"></i> استماع</button>
        <button class="sheet-btn" id="btn-inline-tafsir"><i class="fas fa-book-open"></i> تفسير</button>
        <button class="sheet-btn" id="btn-ask-ai"><i class="fas fa-robot"></i> الذكاء</button>
        <button class="sheet-btn" id="btn-copy-ayah"><i class="fas fa-copy"></i> نسخ</button>
        <button class="sheet-btn" id="btn-bookmark-ayah"><i class="fas fa-bookmark"></i> حفظ</button>
    </div>
</div>

<div id="ai-modal">
    <div class="ai-tools">
        <div class="ai-title">توبه AI</div>
        <button class="ai-close" onclick="closeAI()"><i class="fas fa-times"></i></button>
    </div>
    <div class="ai-chat" id="ai-chatbox">
        <div class="msg-flat ai">السلام عليكم ورحمة الله وبركاته. أنا هنا لمساعدتك في التفسير والأسئلة الدينية. كيف يمكنني إفادتك؟</div>
    </div>
    <form class="ai-input-wrapper" onsubmit="sendAiMsg(event)">
        <div class="ai-input-inner">
            <input type="text" id="ai-input" placeholder="اكتب سؤالك هنا..." autocomplete="off">
            <button type="submit"><i class="fas fa-paper-plane"></i></button>
        </div>
    </form>
</div>

<div id="compact-player" onclick="togglePlayerExpand(event)">
    <div class="player-minimized">
        <div class="wave-icon paused" id="wave-anim">
            <div class="wave-bar"></div><div class="wave-bar"></div><div class="wave-bar"></div>
        </div>
    </div>
    <div class="player-expanded-ui">
        <div style="display:flex; align-items:center; gap:15px; width:100%; margin-bottom:15px;">
            <i id="player-reciter-icon" class="fas fa-user" style="font-size:2rem; color:var(--accent);"></i>
            <div class="player-text-scroll">
                <span class="scrolling-text" id="player-scroll-text"></span>
            </div>
        </div>
        <div class="player-progress-container" onclick="seekAudio(event)">
            <div class="player-progress-bar" id="player-progress"></div>
        </div>
        <div style="display:flex; justify-content:center; align-items:center; gap:30px; margin:15px 0;">
            <button id="btn-speed" onclick="toggleSpeed(event)" style="background:transparent; color:var(--bg); font-size:1.2rem; cursor:pointer; font-weight:bold;">1x</button>
            <button onclick="playPrev(event)" style="background:transparent; color:var(--bg); font-size:1.5rem; cursor:pointer;"><i class="fas fa-backward-step"></i></button>
            <button onclick="toggleAudio(event)" id="expand-play-btn" style="background:transparent; color:var(--accent); font-size:2.5rem; cursor:pointer;"><i class="fas fa-play"></i></button>
            <button onclick="playNext(event)" style="background:transparent; color:var(--bg); font-size:1.5rem; cursor:pointer;"><i class="fas fa-forward-step"></i></button>
            <button id="btn-loop" onclick="toggleLoop(event)" style="background:transparent; color:var(--bg); font-size:1.2rem; cursor:pointer;"><i class="fas fa-repeat"></i></button>
        </div>
        <div style="display:flex; justify-content:space-between; align-items:center;">
            <div style="display:flex; align-items:center; gap:10px;">
                <i class="fas fa-volume-up" id="vol-icon" onclick="toggleMute(event)" style="color:var(--bg); cursor:pointer;"></i>
                <input type="range" id="vol-slider" class="volume-slider" min="0" max="1" step="0.05" value="1" oninput="changeVolume(event)">
            </div>
            <div style="display:flex; gap:20px;">
                <button onclick="toggleSleepTimer(event)" style="background:transparent; color:var(--bg); font-size:1.2rem; cursor:pointer; position:relative;">
                    <i class="fas fa-moon"></i>
                    <div id="timer-badge" style="position:absolute; top:-8px; right:-8px; background:var(--accent); color:var(--text-main); font-size:0.7rem; border-radius:50%; width:16px; height:16px; display:none; align-items:center; justify-content:center; font-weight:bold;"></div>
                </button>
                <button onclick="downloadCurrentAudio(event, this)" style="background:transparent; color:var(--bg); font-size:1.2rem; cursor:pointer;"><i class="fas fa-download"></i></button>
                <button onclick="closePlayer(event)" style="background:transparent; color:var(--bg); font-size:1.2rem; cursor:pointer;"><i class="fas fa-times"></i></button>
            </div>
        </div>
    </div>
</div>

<div id="install-banner" class="install-banner">
    <div class="install-banner-content">
        <i class="fas fa-kaaba" style="font-size: 2.5rem; color: var(--accent);"></i>
        <div>
            <div style="font-family: 'Amiri', serif; font-size: 1.5rem; color: var(--accent); font-weight: bold;">تطبيق توبه</div>
            <div style="font-size: 0.9rem; color: var(--text-muted); font-family: 'Tajawal', sans-serif;">قم بتثبيت التطبيق للوصول السريع</div>
        </div>
    </div>
    <div style="display: flex; gap: 10px; align-items: center;">
        <button id="btn-install" class="install-btn">تثبيت</button>
        <button onclick="dismissInstall()" class="install-close"><i class="fas fa-times"></i></button>
    </div>
</div>

<audio id="main-audio"></audio>
<audio id="radio-audio" crossorigin="anonymous"></audio>

<script>
    // --- إعداد عامل الخدمة (Service Worker) ديناميكياً لتشغيل PWA ---
    const swCode = `
        self.addEventListener('install', (e) => {
            self.skipWaiting();
        });
        self.addEventListener('activate', (e) => {
            self.clients.claim();
        });
        self.addEventListener('fetch', (e) => {
            // السماح بمرور الطلبات بشكل عادي (مطلوب لقبول PWA)
            e.respondWith(fetch(e.request).catch(() => new Response('Offline')));
        });
    `;
    const swBlob = new Blob([swCode], { type: 'application/javascript' });
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register(URL.createObjectURL(swBlob)).catch(err => console.log('SW Error', err));
    }

    // --- منطق عرض إشعار التثبيت (PWA Install Prompt) ---
    let deferredPrompt;
    
    window.addEventListener('beforeinstallprompt', (e) => {
        // منع كروم من إظهار الرسالة التلقائية فجأة
        e.preventDefault();
        // حفظ الحدث لاستخدامه عند الضغط على الزر
        deferredPrompt = e;
        
        // إظهار الإشعار الخاص بنا بعد ثانيتين
        if(!sessionStorage.getItem('installDismissed')) {
            setTimeout(() => {
                document.getElementById('install-banner').classList.add('active');
            }, 2000);
        }
    });

    document.getElementById('btn-install').addEventListener('click', async () => {
        if (deferredPrompt) {
            // إخفاء الإشعار
            document.getElementById('install-banner').classList.remove('active');
            // إظهار رسالة المتصفح الرسمية
            deferredPrompt.prompt();
            // انتظار رد المستخدم
            const { outcome } = await deferredPrompt.userChoice;
            if (outcome === 'accepted') {
                console.log('User accepted the install prompt');
            }
            deferredPrompt = null;
        }
    });

    // إخفاء الزر إذا تم تثبيت التطبيق بنجاح
    window.addEventListener('appinstalled', () => {
        document.getElementById('install-banner').classList.remove('active');
        deferredPrompt = null;
    });

    function dismissInstall() {
        document.getElementById('install-banner').classList.remove('active');
        sessionStorage.setItem('installDismissed', 'true');
    }

    // --- باقي كود التطبيق الأساسي ---
    let viewState = { surahs:[], currentId: -1, ayahs:[], name: '' };
    let playState = { mode: 'none', surahId: -1, ayahs:[], currentIndex: -1, isLooping: false, speed: 1, currentReciterName: '' };
    let adhkarData = {};
    let selectedAyahIndex = -1;
    let selectedAyahText = '';
    const arabicNumbers =['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
    let userBookmark = null;
    let currentFontSize = 1.8;

    let topReciters = [
        {id: 'ar.alafasy', name: 'مشاري العفاسي', icon: 'fas fa-user'},
        {id: 'ar.abdulbasitmurattal', name: 'عبد الباسط عبد الصمد', icon: 'fas fa-user'},
        {id: 'ar.husary', name: 'محمود خليل الحصري', icon: 'fas fa-user'},
        {id: 'ar.minshawi', name: 'محمد صديق المنشاوي', icon: 'fas fa-user'},
        {id: 'ar.mahermuaiqly', name: 'ماهر المعيقلي', icon: 'fas fa-user'},
        {id: 'ar.sudais', name: 'عبد الرحمن السديس', icon: 'fas fa-user'},
        {id: 'ar.shuraym', name: 'سعود الشريم', icon: 'fas fa-user'},
        {id: 'ar.yasserdossari', name: 'ياسر الدوسري', icon: 'fas fa-user'},
        {id: 'ar.hudhaify', name: 'علي الحذيفي', icon: 'fas fa-user'},
        {id: 'ar.muhammadjibreel', name: 'محمد جبريل', icon: 'fas fa-user'},
        {id: 'ar.aymanswaid', name: 'أيمن سويد', icon: 'fas fa-user'},
        {id: 'ar.abdullahbasfar', name: 'عبد الله بصفر', icon: 'fas fa-user'}
    ];
    const MIN_RECITERS_TARGET = 100;
    const favoriteReciterKey = 'toba_favorite_reciter';
    let favoriteReciterId = localStorage.getItem(favoriteReciterKey) || '';
    let activeMushafReciter = 'ar.alafasy';
    let activeListenReciter = null;

    const radioStations =[
        { id: 'cairo', name: "إذاعة القرآن الكريم - القاهرة", url: "https://stream.radiojar.com/8s5u5tpdtwzuv" },
        { id: 'saudi', name: "إذاعة القرآن الكريم - السعودية", url: "https://n0a.radiojar.com/4wqre23fytzuv" },
        { id: 'makkah', name: "إذاعة القرآن الكريم - مكة", url: "https://qurango.net/radio/makkah" },
        { id: 'madinah', name: "إذاعة القرآن الكريم - المدينة", url: "https://qurango.net/radio/madinah" },
        { id: 'alafasy', name: "مشاري العفاسي", url: "https://qurango.net/radio/mishary_alafasi" },
        { id: 'abdulbasit', name: "عبدالباسط عبدالصمد", url: "https://qurango.net/radio/abdulbasit_abdulsamad_mojawwad" },
        { id: 'husary', name: "محمود خليل الحصري", url: "https://qurango.net/radio/mahmoud_khalil_alhussary" },
        { id: 'maher', name: "ماهر المعيقلي", url: "https://qurango.net/radio/maher_al_muaiqly" },
        { id: 'minshawi', name: "محمد صديق المنشاوي", url: "https://qurango.net/radio/mohammed_siddiq_alminshawi" },
        { id: 'yasser', name: "ياسر الدوسري", url: "https://qurango.net/radio/yasser_aldosari" },
        { id: 'sudais', name: "عبدالرحمن السديس", url: "https://qurango.net/radio/abdulrahman_alsudais" },
        { id: 'shuraym', name: "سعود الشريم", url: "https://qurango.net/radio/saud_alshuraim" },
        { id: 'hudhaify', name: "علي الحذيفي", url: "https://qurango.net/radio/ali_alhuthaify" },
        { id: 'ajamy', name: "أحمد العجمي", url: "https://qurango.net/radio/ahmed_alajmy" },
        { id: 'ghamdi', name: "سعد الغامدي", url: "https://qurango.net/radio/saad_alghamdi" },
        { id: 'juhani', name: "عبدالله الجهني", url: "https://qurango.net/radio/abdullah_aljuhani" },
        { id: 'tablawi', name: "محمد محمود الطبلاوي", url: "https://qurango.net/radio/mohamed_mahmoud_altablawi" },
        { id: 'jibreel', name: "محمد جبريل", url: "https://qurango.net/radio/mohammad_jibreel" },
        { id: 'tarawih', name: "إذاعة صلاة التراويح", url: "https://qurango.net/radio/tarawih" },
        { id: 'fatwa', name: "إذاعة الفتاوى", url: "https://qurango.net/radio/fatwa" }
    ];
    let currentRadioId = 'cairo';

    let sleepTimerInterval = null;
    let sleepMinutesLeft = 0;
    const timerBadge = document.getElementById('timer-badge');

    window.onload = () => {
        setTimeout(() => { document.getElementById('loader').style.opacity = '0'; setTimeout(() => document.getElementById('loader').style.display = 'none', 800); }, 1000);
        loadBookmark(); loadSurahs(); loadAdhkar(); renderRadioStations(); populateMushafReciters(); renderRecitersGrid(); loadDynamicReciters();
        document.getElementById('radio-audio').src = radioStations[0].url;
    };

    function toArabicNum(num) { return String(num).split('').map(c => arabicNumbers[c] || c).join(''); }

    function updateRecitersCount(filteredCount = topReciters.length) {
        const label = document.getElementById('reciters-count');
        if(!label) return;
        const total = topReciters.length;
        label.innerText = `عدد القراء: ${toArabicNum(filteredCount)} من ${toArabicNum(total)}`;
    }

    async function loadDynamicReciters() {
        try {
            const res = await fetch('https://api.alquran.cloud/v1/edition?format=audio');
            const data = await res.json();
            const existingIds = new Set(topReciters.map(r => r.id));
            const fetched = (data.data || [])
                .filter(item => item && item.identifier && item.format === 'audio')
                .map(item => ({ id: item.identifier, name: item.name || item.englishName, icon: 'fas fa-user' }))
                .filter(item => item.name && !existingIds.has(item.id));

            topReciters = [...topReciters, ...fetched].slice(0, Math.max(MIN_RECITERS_TARGET, topReciters.length + fetched.length));
            updateRecitersCount();
            renderRecitersGrid(document.getElementById('reciter-search').value.trim());
        } catch(e) {
            updateRecitersCount();
        }
    }

    function toggleFavoriteReciter(e, reciterId) {
        e.stopPropagation();
        favoriteReciterId = favoriteReciterId === reciterId ? '' : reciterId;
        localStorage.setItem(favoriteReciterKey, favoriteReciterId);
        renderRecitersGrid(document.getElementById('reciter-search').value.trim());
    }

    function switchTab(tab) {
        if(tab === 'ai') { openAI(); return; }
        document.querySelectorAll('.section').forEach(el => el.classList.remove('active'));
        document.querySelectorAll('.nav-links button').forEach(el => el.classList.remove('active'));
        document.getElementById(tab).classList.add('active');
        document.getElementById('nav-' + tab).classList.add('active');
        if(tab === 'reciters') { backToReciters(); }
        window.scrollTo(0, 0);
    }

    function changeFontSize(change) {
        currentFontSize += change;
        if(currentFontSize < 1.2) currentFontSize = 1.2;
        if(currentFontSize > 3.5) currentFontSize = 3.5;
        document.documentElement.style.setProperty('--mushaf-size', currentFontSize + 'rem');
    }

    function loadBookmark() {
        const b = localStorage.getItem('toba_bookmark');
        if(b) {
            userBookmark = JSON.parse(b);
            const banner = document.getElementById('bookmark-flat');
            banner.style.display = 'flex';
            document.getElementById('bookmark-text').innerText = `سورة ${userBookmark.sName} - آية ${toArabicNum(userBookmark.aNum)}`;
        }
    }

    function saveBookmarkCurrent() {
        if(viewState.currentId !== -1) {
            userBookmark = { sId: viewState.currentId, sName: viewState.name, aIdx: 0, aNum: 1 };
            if(selectedAyahIndex !== -1) {
                userBookmark.aIdx = selectedAyahIndex;
                userBookmark.aNum = viewState.ayahs[selectedAyahIndex].numberInSurah;
            }
            localStorage.setItem('toba_bookmark', JSON.stringify(userBookmark));
            loadBookmark();
        }
    }

    function goToBookmark() {
        if(userBookmark) {
            openSurah(userBookmark.sId, userBookmark.sName).then(() => {
                const el = document.getElementById('view-ayah-' + userBookmark.aIdx);
                if(el) { setTimeout(() => { el.scrollIntoView({ behavior: 'smooth', block: 'center' }); el.style.color = 'var(--accent)'; setTimeout(()=> el.style.color='', 2000); }, 500); }
            });
        }
    }

    async function loadSurahs() {
        try {
            const res = await fetch('https://api.alquran.cloud/v1/surah');
            const data = await res.json();
            viewState.surahs = data.data;
            renderSurahsList(viewState.surahs, 'quran');
        } catch(e) {}
    }

    function renderSurahsList(list, target) {
        const cont = document.getElementById(target === 'quran' ? 'surah-list' : 'reciter-surah-list');
        cont.innerHTML = '';
        list.forEach(s => {
            const d = document.createElement('div');
            d.className = 'surah-item-flat';
            d.onclick = () => target === 'quran' ? openSurah(s.number, s.name) : playFullSurah(s.number, s.name);
            d.innerHTML = `<div class="surah-item-name">${s.name}</div><div class="surah-item-meta">${s.numberOfAyahs} آية</div>`;
            cont.appendChild(d);
        });
    }

    function filterSurahs(target) {
        const v = document.getElementById(target === 'quran' ? 'surah-search' : 'reciter-surah-search').value.trim();
        renderSurahsList(viewState.surahs.filter(s => s.name.includes(v)), target);
    }

    function populateMushafReciters() {
        const sel = document.getElementById('mushaf-reciter');
        sel.innerHTML = '';
        topReciters.slice(0, 30).forEach(r => {
            const opt = document.createElement('option');
            opt.value = r.id; opt.innerText = r.name;
            sel.appendChild(opt);
        });
        sel.value = activeMushafReciter;
    }

    async function changeMushafReciter() {
        activeMushafReciter = document.getElementById('mushaf-reciter').value;
        if(viewState.currentId !== -1) {
            try {
                const res = await fetch(`https://api.alquran.cloud/v1/surah/${viewState.currentId}/${activeMushafReciter}`);
                const data = await res.json();
                viewState.ayahs = data.data.ayahs;
                if(playState.mode === 'ayah' && playState.surahId === viewState.currentId) {
                    playState.ayahs =[...viewState.ayahs];
                    if(!audio.paused && playState.currentIndex !== -1) {
                        const ct = audio.currentTime;
                        audio.src = playState.ayahs[playState.currentIndex].audio;
                        audio.currentTime = ct; audio.play();
                    }
                }
            } catch(e) {}
        }
    }

    async function openSurah(id, name) {
        document.getElementById('surah-list-container').style.display = 'none';
        document.getElementById('mushaf-container').style.display = 'block';
        document.getElementById('mushaf-title').innerText = name;
        const bismillahEl = document.getElementById('mushaf-bismillah');
        bismillahEl.style.display = (id === 1 || id === 9) ? 'none' : 'block';
        viewState.currentId = id; viewState.name = name;
        const content = document.getElementById('mushaf-content');
        content.innerHTML = '<div style="color:var(--accent); font-size:2rem; padding:40px; text-align:center;">جاري التنزيل...</div>';
        try {
            const res = await fetch(`https://api.alquran.cloud/v1/surah/${id}/${activeMushafReciter}`);
            const data = await res.json();
            viewState.ayahs = data.data.ayahs;
            content.innerHTML = '';
            viewState.ayahs.forEach((a, idx) => {
                let txt = a.text;
                if(id !== 1 && id !== 9 && idx === 0) { 
                    txt = txt.replace(/^بِسْمِ ٱللَّهِ ٱلرَّحْمَـٰنِ ٱلرَّحِيمِ\s*/g, '');
                    txt = txt.replace(/^بِسْمِ اللَّهِ الرَّحْمَٰنِ الرَّحِيمِ\s*/g, '');
                    txt = txt.replace(/^بِسْمِ ٱللَّهِ ٱلرَّحْمَٰنِ ٱلرَّحِيمِ\s*/g, '');
                }
                const container = document.createElement('div'); container.className = 'ayah-container';
                const span = document.createElement('span'); span.className = 'ayah-span'; span.id = 'view-ayah-' + idx; span.innerText = txt; span.onclick = () => showAyahSheet(idx, txt);
                const end = document.createElement('span'); end.className = 'ayah-end'; end.innerText = ` ۝${toArabicNum(a.numberInSurah)} `;
                const tafsirDiv = document.createElement('div'); tafsirDiv.className = 'inline-tafsir'; tafsirDiv.id = 'tafsir-box-' + idx;
                container.appendChild(span); container.appendChild(end); container.appendChild(tafsirDiv); content.appendChild(container);
            });
            window.scrollTo(0, 0); syncHighlight();
        } catch(e) { content.innerHTML = '<div style="text-align:center;">حدث خطأ.</div>'; }
    }

    function closeMushaf() {
        document.getElementById('mushaf-container').style.display = 'none'; document.getElementById('surah-list-container').style.display = 'block';
        viewState.currentId = -1; hideAyahSheet();
    }

    function renderRecitersGrid(filter = '') {
        const cont = document.getElementById('reciters-grid');
        cont.innerHTML = '';
        const normalized = filter.trim();
        const favorites = topReciters.filter(r => r.id === favoriteReciterId && r.name.includes(normalized));
        const rest = topReciters.filter(r => r.id !== favoriteReciterId && r.name.includes(normalized));
        const list = [...favorites, ...rest];
        updateRecitersCount(list.length);
        if(!list.length) {
            cont.innerHTML = '<div style="text-align:center; width:100%; color:var(--text-muted);">لا يوجد قارئ مطابق للبحث.</div>';
            return;
        }
        list.forEach(r => {
            const isFav = r.id === favoriteReciterId;
            const d = document.createElement('div');
            d.className = 'reciter-card';
            d.onclick = () => openReciterView(r);
            d.innerHTML = `<button onclick="toggleFavoriteReciter(event, '${r.id}')" style="background:transparent; color:${isFav ? 'var(--accent)' : 'var(--text-muted)'}; font-size:1rem; position:absolute; top:8px; left:8px; cursor:pointer;"><i class="fas fa-star"></i></button><div class="reciter-avatar"><i class="${r.icon}"></i></div><div class="reciter-name">${r.name}</div>`;
            cont.appendChild(d);
        });
    }

    function filterReciters() { renderRecitersGrid(document.getElementById('reciter-search').value.trim()); }

    function openReciterView(reciter) {
        activeListenReciter = reciter;
        document.getElementById('reciters-main-view').style.display = 'none';
        document.getElementById('reciter-surahs-view').style.display = 'block';
        document.getElementById('active-reciter-title').innerText = reciter.name;
        document.getElementById('reciter-surah-search').value = '';
        renderSurahsList(viewState.surahs, 'reciters');
        window.scrollTo(0, 0);
    }

    function backToReciters() {
        document.getElementById('reciter-surahs-view').style.display = 'none';
        document.getElementById('reciters-main-view').style.display = 'block';
        activeListenReciter = null;
    }

    const sheet = document.getElementById('ayah-sheet');
    const overlay = document.getElementById('overlay');
    
    function showAyahSheet(idx, text) {
        selectedAyahIndex = idx; selectedAyahText = text;
        document.querySelectorAll('.ayah-span').forEach(el => el.classList.remove('playing'));
        document.getElementById('view-ayah-' + idx).classList.add('playing');
        document.getElementById('sheet-ayah-text').innerText = text.length > 80 ? text.substring(0, 80) + '...' : text;
        overlay.classList.add('active'); sheet.classList.add('active');
        document.getElementById('btn-play-ayah').onclick = () => { triggerPlayAyah(idx); hideAyahSheet(); };
        document.getElementById('btn-inline-tafsir').onclick = () => { fetchInlineTafsir(idx, text); hideAyahSheet(); };
        document.getElementById('btn-ask-ai').onclick = () => { openAI(); askAiDirectly(text); hideAyahSheet(); };
        document.getElementById('btn-copy-ayah').onclick = () => { navigator.clipboard.writeText(text); hideAyahSheet(); };
        document.getElementById('btn-bookmark-ayah').onclick = () => { saveBookmarkCurrent(); hideAyahSheet(); };
    }

    function hideAyahSheet() { sheet.classList.remove('active'); overlay.classList.remove('active'); syncHighlight(); }

    async function fetchInlineTafsir(idx, text) {
        const box = document.getElementById('tafsir-box-' + idx);
        box.style.display = 'block'; box.innerHTML = 'جاري جلب التفسير...';
        try {
            const resp = await puter.ai.chat([{role: 'system', content: 'أعطني تفسيراً مختصراً جداً ومبسطاً لهذه الآية.'}, {role: 'user', content: text}]);
            box.innerText = resp.message.content;
        } catch(e) { box.innerText = 'عذراً، فشل جلب التفسير.'; }
    }

    const audio = document.getElementById('main-audio');
    const player = document.getElementById('compact-player');
    const wave = document.getElementById('wave-anim');
    const expandBtn = document.getElementById('expand-play-btn');
    const scrollText = document.getElementById('player-scroll-text');
    const progressBar = document.getElementById('player-progress');
    const volSlider = document.getElementById('vol-slider');
    const volIcon = document.getElementById('vol-icon');
    const playerReciterIcon = document.getElementById('player-reciter-icon');

    function triggerPlayAyah(idx) {
        if(!radioAudio.paused) toggleRadio();
        playState.mode = 'ayah'; playState.surahId = viewState.currentId; playState.ayahs = [...viewState.ayahs]; playState.currentIndex = idx;
        executePlayAyah();
    }

    function executePlayAyah() {
        if(playState.currentIndex < 0 || playState.currentIndex >= playState.ayahs.length) return;
        const ayah = playState.ayahs[playState.currentIndex];
        audio.src = ayah.audio; audio.playbackRate = playState.speed; audio.play();
        const activeReciterData = topReciters.find(r => r.id === activeMushafReciter);
        playerReciterIcon.className = activeReciterData ? activeReciterData.icon : 'fas fa-user';
        setupPlayerUI(`۝ ${ayah.text} ۝`); syncHighlight();
    }

    function playFullSurah(surahId, surahName) {
        if(!radioAudio.paused) toggleRadio();
        if(!activeListenReciter) return;
        playState.mode = 'surah'; playState.surahId = surahId; playState.currentReciterName = activeListenReciter.name;
        audio.src = `https://cdn.islamic.network/quran/audio-surah/128/${activeListenReciter.id}/${surahId}.mp3`;
        audio.playbackRate = playState.speed; audio.play();
        playerReciterIcon.className = activeListenReciter.icon;
        setupPlayerUI(`سورة ${surahName} - ${playState.currentReciterName}`);
    }

    function setupPlayerUI(textMsg) {
        player.classList.add('visible'); wave.classList.remove('paused'); expandBtn.innerHTML = '<i class="fas fa-pause"></i>';
        scrollText.innerText = textMsg; scrollText.style.animation = 'none'; setTimeout(() => scrollText.style.animation = '', 10);
    }

    function syncHighlight() {
        document.querySelectorAll('.ayah-span').forEach(el => el.classList.remove('playing'));
        if(playState.mode === 'ayah' && viewState.currentId === playState.surahId && playState.currentIndex !== -1) {
            const el = document.getElementById('view-ayah-' + playState.currentIndex);
            if(el) {
                el.classList.add('playing');
                const offset = el.getBoundingClientRect().top + window.scrollY - (window.innerHeight / 3);
                window.scrollTo({ top: offset, behavior: 'smooth' });
            }
        }
    }

    audio.ontimeupdate = () => { if(audio.duration) progressBar.style.width = ((audio.currentTime / audio.duration) * 100) + '%'; };

    function seekAudio(e) { const rect = e.currentTarget.getBoundingClientRect(); const pos = (e.clientX - rect.left) / rect.width; if(audio.duration) audio.currentTime = pos * audio.duration; }

    audio.onended = () => {
        if(playState.isLooping) { audio.currentTime = 0; audio.play(); return; }
        if(playState.mode === 'ayah') {
            if(playState.currentIndex < playState.ayahs.length - 1) { playState.currentIndex++; executePlayAyah(); }
            else if(playState.surahId < 114) { fetchNextSurahAyahsAndPlay(playState.surahId + 1); }
            else { wave.classList.add('paused'); expandBtn.innerHTML = '<i class="fas fa-play"></i>'; }
        } else if(playState.mode === 'surah') {
            if(playState.surahId < 114) { const nextSurah = viewState.surahs.find(s => s.number === playState.surahId + 1); if(nextSurah) playFullSurah(nextSurah.number, nextSurah.name); }
            else { wave.classList.add('paused'); expandBtn.innerHTML = '<i class="fas fa-play"></i>'; }
        }
    };

    async function fetchNextSurahAyahsAndPlay(nextId) {
        scrollText.innerText = 'جاري الانتقال للسورة التالية...';
        try {
            const res = await fetch(`https://api.alquran.cloud/v1/surah/${nextId}/${activeMushafReciter}`);
            const data = await res.json();
            playState.surahId = nextId; playState.ayahs = data.data.ayahs; playState.currentIndex = 0;
            if(viewState.currentId !== -1) openSurah(nextId, data.data.name); executePlayAyah();
        } catch(e) { wave.classList.add('paused'); expandBtn.innerHTML = '<i class="fas fa-play"></i>'; }
    }

    function togglePlayerExpand(e) { if(e.target.closest('button') || e.target.closest('.player-progress-container') || e.target.closest('.volume-slider') || e.target.closest('i')) return; player.classList.toggle('expanded'); }

    function toggleAudio(e) {
        e.stopPropagation();
        if(audio.paused) { if(!radioAudio.paused) toggleRadio(); if(!audio.src) return; audio.play(); wave.classList.remove('paused'); expandBtn.innerHTML = '<i class="fas fa-pause"></i>'; }
        else { audio.pause(); wave.classList.add('paused'); expandBtn.innerHTML = '<i class="fas fa-play"></i>'; }
    }

    function playNext(e) { e.stopPropagation(); if(playState.mode === 'ayah') { if(playState.currentIndex < playState.ayahs.length - 1) { playState.currentIndex++; executePlayAyah(); } } else if(playState.mode === 'surah') { if(playState.surahId < 114) { const next = viewState.surahs.find(s=>s.number===playState.surahId+1); if(next) playFullSurah(next.number, next.name); } } }
    function playPrev(e) { e.stopPropagation(); if(playState.mode === 'ayah') { if(playState.currentIndex > 0) { playState.currentIndex--; executePlayAyah(); } } else if(playState.mode === 'surah') { if(playState.surahId > 1) { const prev = viewState.surahs.find(s=>s.number===playState.surahId-1); if(prev) playFullSurah(prev.number, prev.name); } } }

    function toggleLoop(e) { e.stopPropagation(); playState.isLooping = !playState.isLooping; e.currentTarget.style.color = playState.isLooping ? 'var(--accent)' : 'var(--bg)'; }
    
    function toggleSpeed(e) { e.stopPropagation(); playState.speed = playState.speed === 1 ? 1.25 : playState.speed === 1.25 ? 1.5 : 1; audio.playbackRate = playState.speed; e.currentTarget.innerText = playState.speed + 'x'; e.currentTarget.style.color = playState.speed !== 1 ? 'var(--accent)' : 'var(--bg)'; }

    function closePlayer(e) { e.stopPropagation(); audio.pause(); player.classList.remove('visible', 'expanded'); playState.mode = 'none'; document.querySelectorAll('.ayah-span').forEach(el => el.classList.remove('playing')); }

    function buildAudioFileName() {
        if(playState.mode === 'surah') {
            const surahNum = playState.surahId > 0 ? String(playState.surahId).padStart(3, '0') : '000';
            return `surah-${surahNum}.mp3`;
        }
        if(playState.mode === 'ayah' && playState.currentIndex !== -1 && playState.ayahs[playState.currentIndex]) {
            const ayahNo = playState.ayahs[playState.currentIndex].numberInSurah || (playState.currentIndex + 1);
            return `ayah-${playState.surahId}-${ayahNo}.mp3`;
        }
        return 'tilawa.mp3';
    }

    async function downloadCurrentAudio(e, btn) {
        e.stopPropagation();
        if (!audio.src) return;
        const oldIcon = btn ? btn.innerHTML : '';
        if(btn) { btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>'; btn.disabled = true; }
        try {
            const resp = await fetch(audio.src);
            if(!resp.ok) throw new Error('failed to fetch');
            const blob = await resp.blob();
            const blobUrl = URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.href = blobUrl;
            a.download = buildAudioFileName();
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
            URL.revokeObjectURL(blobUrl);
        } catch(err) {
            const a = document.createElement('a');
            a.href = audio.src;
            a.download = buildAudioFileName();
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        } finally {
            if(btn) { btn.innerHTML = oldIcon; btn.disabled = false; }
        }
    }

    function changeVolume(e) { audio.volume = e.target.value; updateVolIcon(); }
    function toggleMute(e) { e.stopPropagation(); if(audio.volume > 0) { audio.dataset.lastVol = audio.volume; audio.volume = 0; volSlider.value = 0; } else { audio.volume = audio.dataset.lastVol || 1; volSlider.value = audio.volume; } updateVolIcon(); }
    function updateVolIcon() { volIcon.className = audio.volume === 0 ? 'fas fa-volume-mute' : audio.volume < 0.5 ? 'fas fa-volume-down' : 'fas fa-volume-up'; }

    function toggleSleepTimer(e) {
        e.stopPropagation();
        const cycles =[0, 15, 30, 60];
        let idx = cycles.indexOf(sleepMinutesLeft);
        if(idx === -1 || idx === cycles.length - 1) sleepMinutesLeft = cycles[0]; else sleepMinutesLeft = cycles[idx+1];
        if(sleepTimerInterval) { clearInterval(sleepTimerInterval); sleepTimerInterval = null; }
        if(sleepMinutesLeft === 0) { timerBadge.style.display = 'none'; }
        else {
            timerBadge.style.display = 'flex'; timerBadge.innerText = sleepMinutesLeft;
            sleepTimerInterval = setInterval(() => {
                sleepMinutesLeft--; timerBadge.innerText = sleepMinutesLeft;
                if(sleepMinutesLeft <= 0) { clearInterval(sleepTimerInterval); audio.pause(); wave.classList.add('paused'); expandBtn.innerHTML = '<i class="fas fa-play"></i>'; timerBadge.style.display = 'none'; }
            }, 60000);
        }
    }

    const radioAudio = document.getElementById('radio-audio');
    const radioBtn = document.getElementById('radio-btn');
    const radioCanvas = document.getElementById('radio-canvas');
    const canvasCtx = radioCanvas.getContext('2d');
    const radioStatusText = document.getElementById('radio-status-text');
    let audioCtx, analyser, source, dataArray;
    let isRadioVisualizing = false;

    function renderRadioStations() { const cont = document.getElementById('radio-stations-container'); cont.innerHTML = ''; radioStations.forEach(st => { const d = document.createElement('div'); d.className = `station-item-flat ${st.id === currentRadioId ? 'active' : ''}`; d.onclick = () => changeRadioStation(st); d.innerHTML = `<div class="station-name">${st.name}</div>`; cont.appendChild(d); }); }

    function changeRadioStation(station) { currentRadioId = station.id; document.getElementById('current-station-title').innerText = station.name; renderRadioStations(); const wasPlaying = !radioAudio.paused; radioAudio.src = station.url; if(wasPlaying) { radioAudio.play(); radioStatusText.innerText = "جاري البث..."; } }

    function playRandomStation() {
        const available = radioStations.filter(st => st.id !== currentRadioId);
        const randomStation = available[Math.floor(Math.random() * available.length)] || radioStations[0];
        changeRadioStation(randomStation);
        if(radioAudio.paused) toggleRadio();
    }

    function initAudioContext() { if(!audioCtx) { audioCtx = new (window.AudioContext || window.webkitAudioContext)(); analyser = audioCtx.createAnalyser(); source = audioCtx.createMediaElementSource(radioAudio); source.connect(analyser); analyser.connect(audioCtx.destination); analyser.fftSize = 128; dataArray = new Uint8Array(analyser.frequencyBinCount); radioCanvas.width = radioCanvas.parentElement.clientWidth; radioCanvas.height = radioCanvas.parentElement.clientHeight; } if(audioCtx.state === 'suspended') audioCtx.resume(); }

    function toggleRadio() {
        if(radioAudio.paused) {
            if(!audio.paused) toggleAudio({stopPropagation:()=>{}});
            initAudioContext(); radioAudio.play(); radioBtn.classList.add('playing'); radioBtn.innerHTML = '<i class="fas fa-pause"></i>'; radioStatusText.innerText = "جاري البث مباشر..."; if(!isRadioVisualizing) { isRadioVisualizing = true; drawVisualizer(); }
        } else {
            radioAudio.pause(); radioBtn.classList.remove('playing'); radioBtn.innerHTML = '<i class="fas fa-play"></i>'; radioStatusText.innerText = "متوقف"; isRadioVisualizing = false; canvasCtx.clearRect(0, 0, radioCanvas.width, radioCanvas.height);
        }
    }

    radioAudio.addEventListener('waiting', () => { if(!radioAudio.paused) radioStatusText.innerText = "جاري التحميل..."; });
    radioAudio.addEventListener('playing', () => { radioStatusText.innerText = "جاري البث مباشر..."; });
    radioAudio.addEventListener('error', () => { radioStatusText.innerText = "خطأ في الاتصال بالبث"; radioBtn.classList.remove('playing'); radioBtn.innerHTML = '<i class="fas fa-play"></i>'; isRadioVisualizing = false; });

    function drawVisualizer() {
        if(!isRadioVisualizing) return; requestAnimationFrame(drawVisualizer); analyser.getByteFrequencyData(dataArray); canvasCtx.clearRect(0, 0, radioCanvas.width, radioCanvas.height); const centerX = radioCanvas.width / 2; const centerY = radioCanvas.height / 2; const radius = 80; let sum = 0; for(let i=0; i<dataArray.length; i++) sum += dataArray[i]; let avg = sum / dataArray.length; canvasCtx.beginPath(); canvasCtx.arc(centerX, centerY, radius + (avg*0.2), 0, 2 * Math.PI); canvasCtx.fillStyle = 'rgba(184, 153, 71, 0.1)'; canvasCtx.fill(); const bars = 40; const step = Math.PI * 2 / bars;
        for(let i = 0; i < bars; i++) { const val = dataArray[i] || 0; const barHeight = (val / 255) * 40; const angle = i * step; const x1 = centerX + Math.cos(angle) * radius; const y1 = centerY + Math.sin(angle) * radius; const x2 = centerX + Math.cos(angle) * (radius + barHeight + 5); const y2 = centerY + Math.sin(angle) * (radius + barHeight + 5); canvasCtx.beginPath(); canvasCtx.moveTo(x1, y1); canvasCtx.lineTo(x2, y2); canvasCtx.lineWidth = 4; canvasCtx.lineCap = 'round'; canvasCtx.strokeStyle = '#B89947'; canvasCtx.stroke(); }
    }

    async function loadAdhkar() {
        try {
            const res = await fetch('https://raw.githubusercontent.com/nawafalqari/azkar-api/56df51279ab6eb86dc2f6202c7de26c8948331c1/azkar.json'); adhkarData = await res.json(); const cont = document.getElementById('adhkar-cats'); const excludedCats =["أدعية قرآنية", "أدعية الأنبياء", "دعاء ختم القرآن الكريم"];
            Object.keys(adhkarData).forEach(cat => { if(!excludedCats.includes(cat)) { const d = document.createElement('div'); d.className = 'adhkar-cat-title'; d.innerText = cat; d.onclick = () => openAdhkarCat(cat); cont.appendChild(d); } });
        } catch(e) {}
    }

    function openAdhkarCat(cat) { document.getElementById('adhkar-cats').style.display = 'none'; document.getElementById('adhkar-view').style.display = 'block'; const cont = document.getElementById('adhkar-items'); cont.innerHTML = `<h2 style="text-align:center; font-family:'Amiri'; font-size:3rem; margin-bottom:40px; color:var(--accent);">${cat}</h2>`; adhkarData[cat].forEach(item => { let max = item.count ? parseInt(String(item.count).replace(/[^0-9]/g, '')) || 1 : 1; const d = document.createElement('div'); d.className = 'dhikr-flat-item'; d.innerHTML = `<div class="dhikr-content">${item.content}</div><div class="dhikr-counter" onclick="incDhikr(this, ${max})">${toArabicNum(max)}</div>`; cont.appendChild(d); }); window.scrollTo(0,0); }

    function closeAdhkar() { document.getElementById('adhkar-view').style.display = 'none'; document.getElementById('adhkar-cats').style.display = 'flex'; }

    function incDhikr(el, max) { if(navigator.vibrate) navigator.vibrate(50); let curr = parseInt(el.getAttribute('data-c') || '0') + 1; if(curr > max) return; el.setAttribute('data-c', curr); if(curr === max) { el.style.color = 'var(--text-muted)'; el.innerText = '✓'; } else { el.innerText = toArabicNum(max - curr); } }

    let aiHistory =[{ role: 'system', content: 'أنت مفسر ومساعد إسلامي. أجب باختصار وأدب، بدون تنسيقات معقدة.' }];
    function openAI() { document.getElementById('ai-modal').classList.add('active'); setTimeout(()=>document.getElementById('ai-input').focus(), 300); }
    function closeAI() { document.getElementById('ai-modal').classList.remove('active'); }

    function askAiDirectly(text) { const inp = document.getElementById('ai-input'); inp.value = `فسر لي: "${text}"`; sendAiMsg(new Event('submit')); }

    async function sendAiMsg(e) { if(e) e.preventDefault(); const inp = document.getElementById('ai-input'); const txt = inp.value.trim(); if(!txt) return; appendAiMsg(txt, 'user'); inp.value = ''; aiHistory.push({role: 'user', content: txt}); const box = document.getElementById('ai-chatbox'); const aiDiv = document.createElement('div'); aiDiv.className = 'msg-flat ai'; aiDiv.innerHTML = 'يفكر...'; box.appendChild(aiDiv); box.scrollTop = box.scrollHeight; try { const resp = await puter.ai.chat(aiHistory, { model: 'deepseek-chat', stream: true }); aiDiv.innerHTML = ''; let full = ''; for await (const part of resp) { full += part?.text || ''; aiDiv.innerText = full; box.scrollTop = box.scrollHeight; } aiHistory.push({role: 'assistant', content: full}); } catch(err) { aiDiv.innerText = 'عذراً، حدث خطأ في الاتصال.'; } }

    function appendAiMsg(txt, cls) { const box = document.getElementById('ai-chatbox'); const d = document.createElement('div'); d.className = 'msg-flat ' + cls; d.innerText = txt; box.appendChild(d); box.scrollTop = box.scrollHeight; }
</script>
</body>
</html>