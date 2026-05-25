<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonus - GYM-IN</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
    <style>
        .bg-image { position: absolute; inset: 0; background-image: url("https://images.pexels.com/photos/4162449/pexels-photo-4162449.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2"); background-size: cover; background-position: center; opacity: 0.25; }
        .reward-card { transition: all 0.3s ease; }
        .reward-card:hover { transform: translateY(-5px); background-color: rgba(255,255,255,0.15); }
        .btn-pilih, .btn-konfirmasi { transition: all 0.3s ease; }
        .btn-pilih:hover { transform: scale(1.05); background-color: rgba(77,145,132,0.8); }
        .modal-content { animation: modalPop 0.3s ease-out; }
        @keyframes modalPop { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
        .toast-notif { position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%) translateY(100px); background: linear-gradient(135deg,#1e293b,#0f172a); color: white; padding: 12px 24px; border-radius: 60px; font-weight: bold; z-index: 200; transition: transform 0.3s; border-left: 5px solid #10b981; backdrop-filter: blur(12px); white-space: nowrap; pointer-events: none; }
        .toast-notif.show { transform: translateX(-50%) translateY(0); }
        .selected-highlight { background: rgba(16,185,129,0.2); border-left: 4px solid #10b981; }
    </style>
</head>
<body class="bg-black md:mx-11">
    <div class="fixed inset-0 pointer-events-none -z-10"><div class="bg-image"></div></div>
    <div class="flex flex-col items-center px-4 py-8 md:px-10">
        <h1 class="mt-6 text-6xl font-bold text-center text-white">GYM-IN</h1>
        <div class="w-full max-w-6xl mt-8"><a href="{{ route('member.dashboard') }}" class="text-white font-semibold hover:underline inline-flex items-center gap-2">← Kembali</a></div>

        <!-- Points Card -->
        <div class="w-full max-w-6xl mt-6">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-gradient-to-r from-emerald-900/40 to-teal-900/40">
                <div class="flex flex-col md:flex-row justify-between items-center gap-4">
                    <div><p class="text-gray-300">Poin <i>streak</i> anda</p><p class="text-3xl font-bold text-white" id="userPoints">{{ $anggota->points ?? 1250 }}</p></div>
                    <div class="text-center md:text-right bg-black/30 px-4 py-2 rounded-xl">
                        <p class="text-gray-200 text-sm">Total poin yang akan dikurangi</p>
                        <p class="text-2xl font-bold text-red-400">-<span id="totalPoints">0</span> <span class="text-sm">Poin</span></p>
                        <p class="text-xs text-gray-300" id="selectedInfo">Belum ada bonus dipilih</p>
                    </div>
                    <button id="confirmBtn" class="bg-emerald-600/90 hover:bg-emerald-500 text-white px-7 py-2.5 rounded-xl text-sm font-bold shadow-lg disabled:opacity-50 disabled:cursor-not-allowed">✅ KONFIRMASI TUKAR</button>
                </div>
            </div>
        </div>

        <!-- Rewards Grid -->
        <div class="w-full max-w-6xl mt-8">
            <div class="p-6 rounded-xl backdrop-blur-sm bg-white/10">
                <h2 class="mb-6 text-xl font-bold text-white">Daftar bonus yang bisa ditukar</h2>
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3" id="rewardsGrid">
                    @foreach($rewards as $reward)
                    <div class="reward-card p-4 rounded-xl backdrop-blur-sm bg-white/5 overflow-hidden" data-id="{{ $reward->id }}" data-points="{{ $reward->points_required }}" data-name="{{ $reward->name }}">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-12 h-12 rounded-full overflow-hidden"><img src="{{ asset('storage/' . $reward->image) }}" class="w-full h-full object-cover"></div>
                                <div><p class="font-semibold text-white">{{ $reward->name }}</p><p class="text-sm text-emerald-400">{{ $reward->points_required }} Poin</p></div>
                            </div>
                            <button class="btn-pilih bg-emerald-600/80 text-white px-4 py-2 rounded-lg text-sm font-semibold">PILIH</button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="w-full max-w-6xl py-8 mt-4 mb-8 text-center"><p class="text-white">Mengalami kendala? Kontak kami di:</p><p class="text-emerald-400 mt-2">+62 767-6767-6767</p></div>
    </div>

    <!-- Modal Success -->
    <div id="successModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center z-50 hidden">
        <div class="bg-gradient-to-br from-gray-900 to-black rounded-2xl max-w-md w-full mx-4 p-6 border border-purple-500/30 modal-content">
            <div class="flex justify-between items-center mb-4"><h3 class="text-2xl font-bold text-white">🎉 Penukaran Berhasil!</h3><button onclick="closeModal()" class="text-gray-400 hover:text-white text-3xl">&times;</button></div>
            <div class="flex justify-center my-4"><div id="qrContainer" class="bg-white p-4 rounded-xl"></div></div>
            <div class="bg-white/5 rounded-xl p-4 space-y-2">
                <p class="text-gray-300 text-sm"><strong class="text-white">Bonus:</strong> <span id="modalBonuses"></span></p>
                <p class="text-gray-300 text-sm"><strong class="text-white">Poin digunakan:</strong> <span id="modalPoints"></span></p>
                <p class="text-gray-300 text-sm break-all"><strong class="text-white">Kode QR:</strong> <code id="modalQrCode" class="text-yellow-400 text-xs"></code></p>
                <div class="border-t border-white/10 pt-2"><p class="text-yellow-400 text-xs">🔐 Tunjukkan QR ini ke admin.</p></div>
            </div>
            <div class="mt-4 space-y-2"><button onclick="closeModal()" class="w-full bg-gradient-to-r from-purple-600 to-indigo-600 hover:opacity-90 text-white font-bold py-2 rounded-lg">Tutup</button><button onclick="downloadQR()" class="w-full bg-white/10 hover:bg-white/20 text-white py-2 rounded-lg text-sm">💾 Download QR</button></div>
        </div>
    </div>

    <div id="toast" class="toast-notif"></div>

    <div class="fixed bottom-0 left-0 right-0 bg-black/90 backdrop-blur-sm border-t border-white/10 max-w-md mx-auto">
        <div class="flex justify-around items-center px-4 py-3">
            <a href="{{ route('member.dashboard') }}" class="flex flex-col items-center text-white/60 hover:text-emerald-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg><span class="text-xs mt-1">Beranda</span></a>
            <a href="{{ route('member.progres') }}" class="flex flex-col items-center text-white/60 hover:text-emerald-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg><span class="text-xs mt-1">Perkembangan</span></a>
            <a href="{{ route('member.rewards') }}" class="flex flex-col items-center text-emerald-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg><span class="text-xs mt-1">Bonus</span></a>
            <a href="{{ route('member.profile') }}" class="flex flex-col items-center text-white/60 hover:text-emerald-400"><svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 0118 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg><span class="text-xs mt-1">Profil</span></a>
        </div>
    </div>

    <script>
        // ---------- STATE ----------
        let selected = []; // { id, name, points, btn, card }
        let userPoints = parseInt(document.getElementById('userPoints')?.innerText || '1250');
        const toastEl = document.getElementById('toast');
        function showToast(msg, isErr=false) { toastEl.textContent = msg; toastEl.style.borderLeftColor = isErr ? '#ef4444' : '#10b981'; toastEl.classList.add('show'); setTimeout(()=>toastEl.classList.remove('show'), 2500); }
        function updateUI() {
            let total = selected.reduce((s,r)=>s+r.points,0);
            document.getElementById('totalPoints').innerText = total;
            document.getElementById('selectedInfo').innerHTML = selected.length ? `${selected.length} bonus dipilih · total ${total} poin` : 'Belum ada bonus dipilih';
            const confirmBtn = document.getElementById('confirmBtn');
            let enough = total <= userPoints;
            confirmBtn.disabled = !(selected.length && enough);
            if(selected.length && !enough) showToast(`❌ Poin kurang! butuh ${total}, tersisa ${userPoints}`, true);
        }
        function removeReward(idx) {
            let r = selected[idx];
            r.btn.innerText = 'PILIH';
            r.btn.classList.remove('bg-red-600/80','hover:bg-red-700');
            r.btn.classList.add('bg-emerald-600/80');
            if(r.card) r.card.classList.remove('selected-highlight');
            selected.splice(idx,1);
            updateUI();
        }
        function selectReward(btn, id, name, points, card) {
            let exist = selected.findIndex(r=>r.id==id);
            if(exist !== -1) { removeReward(exist); showToast(`✖️ ${name} dibatalkan`); return; }
            let newTotal = selected.reduce((s,r)=>s+r.points,0) + points;
            if(newTotal > userPoints) { showToast(`❌ Poin tidak cukup! butuh ${points} poin`, true); return; }
            selected.push({ id, name, points, btn, card });
            btn.innerText = 'BATALKAN';
            btn.classList.remove('bg-emerald-600/80');
            btn.classList.add('bg-red-600/80','hover:bg-red-700');
            if(card) card.classList.add('selected-highlight');
            showToast(`✅ ${name} dipilih (${points} poin)`);
            updateUI();
        }
        function resetAll() { selected.forEach(r=>{ r.btn.innerText='PILIH'; r.btn.classList.remove('bg-red-600/80','hover:bg-red-700'); r.btn.classList.add('bg-emerald-600/80'); if(r.card) r.card.classList.remove('selected-highlight'); }); selected=[]; updateUI(); }
        
        // Konfirmasi + Notifikasi Popup
        function handleConfirm() {
            if(!selected.length) { showToast("⚠️ Belum ada bonus dipilih", true); return; }
            let total = selected.reduce((s,r)=>s+r.points,0);
            if(total > userPoints) { showToast(`❌ Poin tidak mencukupi!`, true); return; }
            // NOTIFICATION POPUP saat konfirmasi
            showToast(`🎉 Berhasil menukar ${selected.length} reward! Total poin: ${total}`);
            // Siapkan modal
            let bonusNames = selected.map(r=>r.name).join(', ');
            let uniqueCode = `GYMIN:${Date.now()}-${Math.floor(Math.random()*10000)}|USER:Member|BONUS:${bonusNames}|POINTS:${total}`;
            document.getElementById('modalBonuses').innerText = bonusNames;
            document.getElementById('modalPoints').innerText = total;
            document.getElementById('modalQrCode').innerText = uniqueCode;
            let qrDiv = document.getElementById('qrContainer');
            qrDiv.innerHTML = '';
            new QRCode(qrDiv, { text: uniqueCode, width: 180, height: 180, colorDark: "#000000", colorLight: "#ffffff", correctLevel: QRCode.CorrectLevel.H });
            document.getElementById('successModal').classList.remove('hidden');
            // Kurangi poin & update tampilan
            userPoints -= total;
            document.getElementById('userPoints').innerText = userPoints;
            resetAll();
        }
        
        // Attach events
        document.addEventListener('DOMContentLoaded',()=>{
            document.querySelectorAll('.reward-card').forEach(card=>{
                let btn = card.querySelector('.btn-pilih');
                let id = card.dataset.id || 'r'+Date.now()+Math.random();
                let points = parseInt(card.dataset.points);
                let name = card.dataset.name;
                if(!card.dataset.id) { card.dataset.id=id; card.dataset.points=points; card.dataset.name=name; }
                if(btn) {
                    let newBtn = btn.cloneNode(true);
                    btn.parentNode.replaceChild(newBtn,btn);
                    newBtn.addEventListener('click',(e)=>{
                        e.stopPropagation();
                        let finalId = card.dataset.id, finalPoints = parseInt(card.dataset.points), finalName = card.dataset.name;
                        selectReward(newBtn, finalId, finalName, finalPoints, card);
                    });
                }
            });
            document.getElementById('confirmBtn').addEventListener('click', handleConfirm);
            updateUI();
        });
        
        window.closeModal = ()=>document.getElementById('successModal').classList.add('hidden');
        window.downloadQR = ()=>{
            let canvas = document.querySelector('#qrContainer canvas');
            if(canvas){ let link=document.createElement('a'); link.download='gymin_qr.png'; link.href=canvas.toDataURL(); link.click(); showToast("QR terunduh");}
            else showToast("Gagal download QR",true);
        };
        document.getElementById('successModal')?.addEventListener('click',(e)=>{if(e.target===document.getElementById('successModal')) closeModal();});
    </script>
</body>
</html>