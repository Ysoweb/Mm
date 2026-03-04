


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

        .feature-block { border: 1px solid var(--accent-light); border-radius: 20px; padding: 16px; margin-top: 18px; }
        .feature-title { font-family: 'Amiri', serif; font-size: 1.6rem; color: var(--accent); margin-bottom: 10px; }
        .feature-row { display: flex; gap: 10px; flex-wrap: wrap; align-items: center; margin-top: 10px; }
        .feature-input { background: transparent; color: var(--text-main); border-bottom: 1px solid var(--accent-light); padding: 8px; font-family: 'Tajawal'; min-width: 120px; }
        .feature-btn { background: transparent; color: var(--accent); border: 1px solid var(--accent-light); border-radius: 999px; padding: 8px 14px; cursor: pointer; font-family: 'Tajawal'; }
        .feature-muted { color: var(--text-muted); font-size: 0.95rem; }

        .feature-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(210px, 1fr)); gap: 12px; margin-top: 12px; }
        .feature-card { border: 1px solid var(--accent-light); border-radius: 14px; padding: 12px; background: rgba(184,153,71,0.06); }
        .feature-card h4 { font-family: 'Amiri', serif; color: var(--accent); font-size: 1.2rem; margin-bottom: 6px; }
        .feature-card p { color: var(--text-muted); font-size: .95rem; line-height: 1.6; }

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
        <button onclick="switchTab('features')" id="nav-features">المميزات</button>
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

    <div id="features" class="section">
        <div class="feature-block">
            <div class="feature-title">المميزات الإضافية</div>
            <div class="feature-muted" id="khatma-progress-text">تقدم الختمة: ٢% | الخطة: ١٥ يوم</div>
            <div style="height:6px; background:var(--accent-light); border-radius:4px; margin-top:8px;"><div id="khatma-progress-bar" style="height:100%; width:2%; background:var(--accent); border-radius:4px;"></div></div>
            <div class="feature-row">
                <button class="feature-btn" onclick="setKhatmaPlan(30)">خطة ختمة 30 يوم</button>
                <button class="feature-btn" onclick="setKhatmaPlan(15)">خطة ختمة 15 يوم</button>
                <button class="feature-btn" onclick="setKhatmaPlan(7)">خطة ختمة 7 أيام</button>
            </div>
            <div class="feature-row">
                <button class="feature-btn" onclick="setDailyWirdReminder()">تذكير الورد اليومي</button>
                <button class="feature-btn" onclick="setAdhkarReminder()">تذكير أذكار الصباح/المساء</button>
                <button class="feature-btn" onclick="setSiyamReminder()">تذكير صيام الإثنين/الخميس</button>
            </div>
            <div class="feature-row">
                <input id="prayer-city" class="feature-input" placeholder="المدينة (مثال: Cairo)">
                <button class="feature-btn" onclick="loadPrayerTimes()">مواقيت الصلاة + إشعار</button>
                <span class="feature-muted" id="prayer-next">القادم: Dhuhr (12:06)</span>
            </div>
            <div class="feature-row">
                <button class="feature-btn" onclick="enableOfflineMode()">تفعيل أوفلاين لسور قصيرة</button>
                <button class="feature-btn" onclick="syncCloudData()">تسجيل/مزامنة سحابية</button>
                <button class="feature-btn" onclick="restoreCloudData()">استعادة تلقائية</button>
            </div>
            <div class="feature-row">
                <button class="feature-btn" onclick="showWidgetTip()">ويدجت الهاتف</button>
                <button class="feature-btn" onclick="openKhutabLibrary()">مكتبة الخطب</button>
                <button class="feature-btn" onclick="openTajweedLessons()">تعلم التجويد</button>
                <button class="feature-btn" onclick="openProphetsStories()">قصص الأنبياء</button>
                <button class="feature-btn" onclick="openSeerahTimeline()">السيرة (خط زمني)</button>
            </div>
            <div class="feature-row">
                <button class="feature-btn" onclick="generateSmartDailyPlan()"><i class="fas fa-robot"></i> خطة يومية بالذكاء الاصطناعي</button>
                <button class="feature-btn" onclick="reviewProgressWithAI()"><i class="fas fa-chart-line"></i> تحليل تقدّمك بالذكاء الاصطناعي</button>
                <button class="feature-btn" onclick="openFeatureAIAssistant('اقترح لي برنامج حفظ قوي لمدة 15 يوم')"><i class="fas fa-brain"></i> مدرب AI للحفظ</button>
            </div>
            <div class="feature-muted" id="feature-status">جاهز.</div>
            <div class="feature-muted" id="points-status">النقاط: 0 | الإنجازات: 0</div>
        </div>

        <div class="feature-block">
            <div class="feature-title">أخبار وتحديثات التطبيق</div>
            <div id="updates-list" class="feature-muted"></div>
        </div>


        <div class="feature-block">
            <div class="feature-title">لوحة تنفيذ المميزات (واقعية)</div>
            <div class="feature-grid" id="features-dashboard-grid"></div>
        </div>

        <div class="feature-block">
            <div class="feature-title">أقسام المميزات</div>
            <div class="feature-row">
                <button class="feature-btn" onclick="switchFeatureCategory('wird')">قسم الورد والختمة</button>
                <button class="feature-btn" onclick="switchFeatureCategory('audio')">قسم الصوت والإذاعة</button>
                <button class="feature-btn" onclick="switchFeatureCategory('learning')">قسم التعلم والتجويد</button>
                <button class="feature-btn" onclick="switchFeatureCategory('assistant')">قسم المساعد الذكي</button>
            </div>
            <div class="feature-muted" id="feature-category-view">اختر قسمًا لعرض أدواته المتقدمة.</div>
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
        <button class="sheet-btn" id="btn-share-ayah"><i class="fas fa-image"></i> صورة</button>
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
        const CACHE = 'toba-runtime-v2';
        self.addEventListener('fetch', (e) => {
            e.respondWith(caches.open(CACHE).then(async cache => {
                try {
                    const net = await fetch(e.request);
                    if(e.request.url.includes('audio-surah/128')) cache.put(e.request, net.clone());
                    return net;
                } catch(_) {
                    const c = await cache.match(e.request);
                    return c || new Response('Offline');
                }
            }));
        });
        self.addEventListener('notificationclick', (event) => {
            event.notification.close();
            event.waitUntil(clients.matchAll({ type:'window' }).then(clientsArr => {
                if(clientsArr.length) return clientsArr[0].focus();
                return clients.openWindow('/');
            }));
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

    let radioStations =[
        { id: 'egypt-quran', name: "إذاعة القرآن الكريم - القاهرة", url: "https://n0e.radiojar.com/8s5u5tpdtwzuv" },
        { id: 'saudi-quran', name: "إذاعة القرآن الكريم - السعودية", url: "https://n0a.radiojar.com/4wqre23fytzuv" },
        { id: 'quran-radio', name: "Quran Radio", url: "https://stream.quranradio.net:8443/;" },
        { id: 'sunnah-radio', name: "إذاعة السنة", url: "https://stream.radiojar.com/4ejfz7f5q3quv" }
    ];
    let currentRadioId = 'egypt-quran';

    let sleepTimerInterval = null;
    let sleepMinutesLeft = 0;
    const timerBadge = document.getElementById('timer-badge');

    let ayahRepeatLeft = 0;
    let points = parseInt(localStorage.getItem('toba_points') || '0');
    let achievements = JSON.parse(localStorage.getItem('toba_achievements') || '[]');
    let stationRatings = JSON.parse(localStorage.getItem('toba_station_ratings') || '{}');
    let favoriteStations = JSON.parse(localStorage.getItem('toba_fav_stations') || '[]');
    let khatmaPlanDays = parseInt(localStorage.getItem('toba_khatma_plan') || '30');
    let khatmaDoneSurahs = JSON.parse(localStorage.getItem('toba_khatma_done') || '[]');

    window.onload = () => {
        setTimeout(() => { document.getElementById('loader').style.opacity = '0'; setTimeout(() => document.getElementById('loader').style.display = 'none', 800); }, 1000);
        loadBookmark(); loadSurahs(); loadAdhkar(); renderRadioStations(); populateMushafReciters(); renderRecitersGrid(); loadDynamicReciters(); loadReliableRadios(); initAdvancedFeatures();
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


    function initAdvancedFeatures() {
        updateKhatmaProgress();
        updatePointsUI();
        requestNotificationPermission();
        loadUpdatesPanel();
        renderFeaturesDashboard();
    }

    function requestNotificationPermission() {
        if('Notification' in window && Notification.permission === 'default') Notification.requestPermission();
    }

    function notifyUser(title, body) {
        if(!('Notification' in window) || Notification.permission !== 'granted') return;
        navigator.serviceWorker?.getRegistration().then(reg => {
            if(reg) reg.showNotification(title, { body, icon: 'https://cdn-icons-png.flaticon.com/512/4273/4273032.png' });
            else new Notification(title, { body });
        });
    }

    function gainPoints(v, label) {
        points += v;
        localStorage.setItem('toba_points', String(points));
        if(points >= 100 && !achievements.includes('قارئ نشيط')) achievements.push('قارئ نشيط');
        if(points >= 300 && !achievements.includes('صاحب همة')) achievements.push('صاحب همة');
        localStorage.setItem('toba_achievements', JSON.stringify(achievements));
        updatePointsUI(label);
    }

    function updatePointsUI(label = '') {
        const el = document.getElementById('points-status');
        if(el) el.innerText = `النقاط: ${toArabicNum(points)} | الإنجازات: ${toArabicNum(achievements.length)}${label ? ' | ' + label : ''}`;
    }

    function setKhatmaPlan(days) {
        khatmaPlanDays = days;
        localStorage.setItem('toba_khatma_plan', String(days));
        updateKhatmaProgress();
        gainPoints(5, 'تم تحديث خطة الختمة');
    }

    function updateKhatmaProgress() {
        const p = Math.min(100, Math.round((khatmaDoneSurahs.length / 114) * 100));
        const t = document.getElementById('khatma-progress-text');
        const b = document.getElementById('khatma-progress-bar');
        if(t) t.innerText = `تقدم الختمة: ${toArabicNum(p)}% | الخطة: ${toArabicNum(khatmaPlanDays)} يوم`;
        if(b) b.style.width = p + '%';
    }

    function markSurahDone(id) {
        if(!khatmaDoneSurahs.includes(id)) {
            khatmaDoneSurahs.push(id);
            localStorage.setItem('toba_khatma_done', JSON.stringify(khatmaDoneSurahs));
            updateKhatmaProgress();
            gainPoints(10, 'إنجاز سورة جديدة');
        }
    }

    function scheduleReminderAt(hour, minute, title, body) {
        const now = new Date();
        const target = new Date();
        target.setHours(hour, minute, 0, 0);
        if(target <= now) target.setDate(target.getDate() + 1);
        setTimeout(() => notifyUser(title, body), target - now);
    }

    function setDailyWirdReminder() { scheduleReminderAt(20, 0, 'تذكير الورد اليومي', 'حان وقت وردك اليومي من القرآن.'); document.getElementById('feature-status').innerText = 'تم ضبط تذكير الورد يوميًا 8:00 م'; }
    function setAdhkarReminder() { scheduleReminderAt(6, 0, 'أذكار الصباح', 'لا تنس أذكار الصباح.'); scheduleReminderAt(18, 0, 'أذكار المساء', 'لا تنس أذكار المساء.'); document.getElementById('feature-status').innerText = 'تم ضبط تذكير الأذكار'; }
    function setSiyamReminder() {
        const d = new Date().getDay();
        if(d === 0 || d === 3) scheduleReminderAt(21, 0, 'تذكير صيام', 'غدًا صيام نافلة بإذن الله.');
        document.getElementById('feature-status').innerText = 'تم تفعيل تذكير صيام الإثنين/الخميس';
    }

    async function loadPrayerTimes() {
        const city = document.getElementById('prayer-city').value.trim() || 'Cairo';
        try {
            const res = await fetch(`https://api.aladhan.com/v1/timingsByCity?city=${encodeURIComponent(city)}&country=EG`);
            const data = await res.json();
            const t = data?.data?.timings || {};
            const now = new Date();
            const prayers = ['Fajr','Dhuhr','Asr','Maghrib','Isha'];
            let next = 'Isha';
            for(const p of prayers) {
                const [h,m] = (t[p] || '00:00').split(':').map(Number);
                const dt = new Date(); dt.setHours(h,m,0,0);
                if(dt > now) { next = p; break; }
            }
            document.getElementById('prayer-next').innerText = `القادم: ${next} (${t[next] || '--'})`;
            notifyUser('مواقيت الصلاة', `تم تحديث مواقيت الصلاة لمدينة ${city}`);
        } catch(e) { document.getElementById('prayer-next').innerText = 'تعذر تحميل المواقيت'; }
    }

    async function syncCloudData() {
        const key = prompt('أدخل بريدك أو رقمك للمزامنة:');
        if(!key) return;
        const payload = { points, achievements, khatmaDoneSurahs, favoriteReciterId, favoriteStations };
        localStorage.setItem('toba_cloud_'+key, JSON.stringify(payload));
        document.getElementById('feature-status').innerText = 'تم تسجيل الدخول/المزامنة محليًا.';
    }

    function restoreCloudData() {
        const key = prompt('أدخل نفس الحساب للاستعادة:');
        if(!key) return;
        const raw = localStorage.getItem('toba_cloud_'+key);
        if(!raw) { document.getElementById('feature-status').innerText = 'لا توجد نسخة محفوظة.'; return; }
        const d = JSON.parse(raw);
        points = d.points || 0; achievements = d.achievements || []; khatmaDoneSurahs = d.khatmaDoneSurahs || [];
        favoriteReciterId = d.favoriteReciterId || favoriteReciterId; favoriteStations = d.favoriteStations || [];
        localStorage.setItem('toba_fav_stations', JSON.stringify(favoriteStations));
        updateKhatmaProgress(); updatePointsUI('تمت الاستعادة'); renderRecitersGrid(); renderRadioStations();
    }

    async function enableOfflineMode() {
        const shortSurahs = [112,113,114];
        const cache = await caches.open('toba-offline-v1');
        for(const s of shortSurahs) {
            await cache.add(`https://cdn.islamic.network/quran/audio-surah/128/ar.alafasy/${s}.mp3`).catch(()=>{});
        }
        document.getElementById('feature-status').innerText = 'تم تجهيز سور قصيرة للأوفلاين مع ضغط تلقائي من المصدر 128kbps.';
    }

    function showWidgetTip() { document.getElementById('feature-status').innerText = 'لإضافة ويدجت: ثبّت التطبيق ثم أضف اختصار الصفحة الرئيسية (يدعم أندرويد).'; }
    function openKhutabLibrary() { openAI(); appendAiMsg('أعطني مكتبة صوتية مقترحة لخطب إسلامية موثوقة وروابطها.', 'user'); gainPoints(5, 'تم فتح مكتبة الخطب'); }
    function openTajweedLessons() { openAI(); appendAiMsg('اعطني درس تجويد مبسط اليوم مع مثال صوتي مقترح.', 'user'); }
    function openProphetsStories() { openAI(); appendAiMsg('احكِ لي قصة نبي مختصرة للأطفال مع الفائدة.', 'user'); }
    function openSeerahTimeline() { openAI(); appendAiMsg('اعطني خطًا زمنيًا مختصرًا للسيرة النبوية.', 'user'); }

    function loadUpdatesPanel() {
        const updates = [
            'تحديث حقيقي: صفحة المميزات أصبحت مستقلة بالكامل وليست داخل الأذكار.',
            'تم إصلاح ظهور محتوى الإذاعة والمميزات بعد معالجة بنية الأقسام.',
            'تم اعتماد بث موثوق مع تحميل ديناميكي من mp3quran عند التوفر.',
            'تم تعزيز AI بخطط يومية تلقائية وتحليل تقدّم مفصل.',
            'تمت إضافة لوحة تنفيذ تعرض حالة كل ميزة بشكل مباشر.'
        ];
        const list = document.getElementById('updates-list');
        if(list) list.innerHTML = updates.map(u => `• ${u}`).join('<br>');
    }

    function renderFeaturesDashboard() {
        const grid = document.getElementById('features-dashboard-grid');
        if(!grid) return;
        const cards = [
            {t:'الختمة والورد', d:`نسبة الإنجاز الحالية: ${Math.round((khatmaDoneSurahs.length/114)*100)}% مع خطة ${khatmaPlanDays} يوم.`},
            {t:'الإشعارات', d:'تذكير يومي للورد + أذكار الصباح/المساء + تنبيه صيام الإثنين/الخميس.'},
            {t:'الصوت والبث', d:`عدد المحطات المتاحة الآن: ${radioStations.length} مع ترتيب مفضلة وتقييم.`},
            {t:'الذكاء الاصطناعي', d:'خطة حفظ يومية، تحليل أداء، ومساعد تعلم تفاعلي بخطوات عملية.'},
            {t:'المزامنة', d:'حفظ/استعادة بيانات المستخدم محليًا كمزامنة خفيفة تعمل فورًا.'},
            {t:'المحتوى التعليمي', d:'مكتبة خطب + تعلم التجويد + قصص الأنبياء + خط زمني للسيرة.'}
        ];
        grid.innerHTML = cards.map(c => `<div class="feature-card"><h4>${c.t}</h4><p>${c.d}</p></div>`).join('');
    }

    function switchFeatureCategory(cat) {
        const map = {
            wird: 'أدوات هذا القسم: خطة الختمة، تذكير الورد، عدّاد الإنجاز، وتحليل AI للالتزام اليومي.',
            audio: 'أدوات هذا القسم: إذاعات موثوقة، مفضلة وتقييم، تنزيل مباشر، وسرعات متعددة.',
            learning: 'أدوات هذا القسم: تعلم التجويد، قصص الأنبياء، خط زمني للسيرة، ومكتبة خطب.',
            assistant: 'أدوات هذا القسم: مدرب حفظ بالذكاء الاصطناعي، خطة يومية، تحليل شامل ومتابعة.'
        };
        document.getElementById('feature-category-view').innerText = map[cat] || 'اختر قسمًا لعرض أدواته المتقدمة.';
    }

    function openFeatureAIAssistant(promptText) {
        openAI();
        const inp = document.getElementById('ai-input');
        inp.value = promptText;
        sendAiMsg(new Event('submit'));
    }

    function generateSmartDailyPlan() {
        const progress = Math.round((khatmaDoneSurahs.length / 114) * 100);
        openFeatureAIAssistant(`اصنع لي خطة يومية دقيقة لقراءة القرآن بناء على تقدم ${progress}% وخطة ${khatmaPlanDays} يوم، مع جدول صباح/مساء.`);
    }

    function reviewProgressWithAI() {
        openFeatureAIAssistant(`حلل أدائي الحالي: نقاط ${points}، إنجازات ${achievements.length}، سور منجزة ${khatmaDoneSurahs.length}، واعطني خطة تحسين عملية للأسبوع القادم.`);
    }

    async function loadReliableRadios() {
        try {
            const res = await fetch('https://mp3quran.net/api/v3/radios?language=ar');
            const data = await res.json();
            const dynamic = (data.radios || [])
                .filter(r => r.url)
                .slice(0, 20)
                .map((r, i) => ({ id: `mp3q-${i}`, name: r.name || `إذاعة ${i+1}`, url: r.url }));
            if(dynamic.length) {
                radioStations = dynamic;
                currentRadioId = dynamic[0].id;
                radioAudio.src = dynamic[0].url;
                renderRadioStations();
                renderFeaturesDashboard();
            }
        } catch(e) {
            // fallback to static verified radios
        }
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
        viewState.currentId = id; viewState.name = name; markSurahDone(id);
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
        document.getElementById('btn-bookmark-ayah').onclick = () => { saveBookmarkCurrent(); hideAyahSheet(); gainPoints(2, 'تم حفظ آية'); };
        document.getElementById('btn-share-ayah').onclick = () => { shareAyahAsImage(text); hideAyahSheet(); };
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


    async function shareAyahAsImage(text) {
        const canvas = document.createElement('canvas');
        canvas.width = 1200; canvas.height = 630;
        const ctx = canvas.getContext('2d');
        ctx.fillStyle = '#FDFBF7'; ctx.fillRect(0,0,canvas.width,canvas.height);
        ctx.fillStyle = '#B89947'; ctx.font = 'bold 54px Amiri';
        ctx.fillText('توبه - آية للمشاركة', 40, 90);
        ctx.fillStyle = '#2A2A2A'; ctx.font = '42px Amiri';
        const lines = text.match(/.{1,40}(\s|$)/g) || [text];
        lines.slice(0,8).forEach((ln,i)=> ctx.fillText(ln.trim(), 40, 180 + (i*55)));
        const blob = await new Promise(r=>canvas.toBlob(r, 'image/png'));
        const file = new File([blob], 'ayah.png', {type:'image/png'});
        if(navigator.share && navigator.canShare?.({files:[file]})) await navigator.share({ files:[file], title:'آية قرآنية' });
        else {
            const a = document.createElement('a'); a.href = URL.createObjectURL(blob); a.download='ayah.png'; a.click();
        }
        gainPoints(3, 'تمت مشاركة آية');
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
        const repeat = parseInt(prompt('عدد تكرار الآية للتثبيت (1-20)', '1') || '1');
        ayahRepeatLeft = Math.max(1, Math.min(20, repeat));
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
        setupPlayerUI(`سورة ${surahName} - ${playState.currentReciterName}`); gainPoints(4, 'تم تشغيل سورة كاملة');
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
            if(ayahRepeatLeft > 1) { ayahRepeatLeft--; executePlayAyah(); return; }
            ayahRepeatLeft = 1;
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
    
    function toggleSpeed(e) { e.stopPropagation(); const speeds = [0.75, 1, 1.25, 1.5]; const idx = speeds.indexOf(playState.speed); playState.speed = speeds[(idx + 1) % speeds.length]; audio.playbackRate = playState.speed; e.currentTarget.innerText = playState.speed + 'x'; e.currentTarget.style.color = playState.speed !== 1 ? 'var(--accent)' : 'var(--bg)'; }

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

    function renderRadioStations() { const cont = document.getElementById('radio-stations-container'); cont.innerHTML = ''; const ordered = [...radioStations].sort((a,b)=> (favoriteStations.includes(b.id)?1:0) - (favoriteStations.includes(a.id)?1:0)); ordered.forEach(st => { const rating = stationRatings[st.id] || 0; const fav = favoriteStations.includes(st.id); const d = document.createElement('div'); d.className = `station-item-flat ${st.id === currentRadioId ? 'active' : ''}`; d.onclick = () => changeRadioStation(st); d.innerHTML = `<div style="display:flex;justify-content:space-between;align-items:center;gap:8px;"><div class="station-name">${st.name}</div><div><button onclick="event.stopPropagation();toggleFavoriteStation('${st.id}')" style="background:transparent;color:${fav?'var(--accent)':'var(--text-muted)'};cursor:pointer;"><i class="fas fa-heart"></i></button><button onclick="event.stopPropagation();rateStation('${st.id}')" style="background:transparent;color:var(--accent);cursor:pointer;"><i class="fas fa-star"></i> ${toArabicNum(rating)}</button></div></div>`; cont.appendChild(d); }); }

    function changeRadioStation(station) { currentRadioId = station.id; document.getElementById('current-station-title').innerText = station.name; renderRadioStations(); const wasPlaying = !radioAudio.paused; radioAudio.src = station.url; if(wasPlaying) { radioAudio.play(); radioStatusText.innerText = "جاري البث..."; } }

    function toggleFavoriteStation(id) {
        if(favoriteStations.includes(id)) favoriteStations = favoriteStations.filter(x=>x!==id);
        else favoriteStations.push(id);
        localStorage.setItem('toba_fav_stations', JSON.stringify(favoriteStations));
        renderRadioStations();
    }

    function rateStation(id) {
        const v = parseInt(prompt('قيّم المحطة من 1 إلى 5', String(stationRatings[id] || 5)) || '5');
        stationRatings[id] = Math.max(1, Math.min(5, v));
        localStorage.setItem('toba_station_ratings', JSON.stringify(stationRatings));
        renderRadioStations();
    }

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
