{{-- Auth Modal (Login & Register) --}}
<div id="auth-modal" class="modal-overlay">
    <div class="modal-box" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h2 id="modal-title" style="font-size:18px; font-weight:500;"></h2>
            <button class="modal-close" onclick="closeModal()">✕</button>
        </div>

        {{-- Register Only --}}
        <div id="field-name" style="display:none; margin-bottom:10px;">
            <input type="text" placeholder="Nama lengkap">
        </div>

        <div style="margin-bottom:10px;">
            <input type="email" placeholder="Email">
        </div>
        <div style="margin-bottom:16px;">
            <input type="password" placeholder="Password">
        </div>

        <button class="btn-primary" style="width:100%; padding:10px 0; font-size:15px;" id="modal-submit-btn"></button>

        <p style="text-align:center; font-size:13px; color:#6b7280; margin-top:12px;">
            <span id="modal-switch-text"></span>
            <a href="#" id="modal-switch-link" style="color:var(--green-main);"></a>
        </p>
    </div>
</div>

<script>
    let currentMode = 'login';

    function openModal(mode) {
        currentMode = mode;
        document.getElementById('auth-modal').classList.add('active');
        renderModal();
    }

    function closeModal() {
        document.getElementById('auth-modal').classList.remove('active');
    }

    function switchModal() {
        currentMode = currentMode === 'login' ? 'register' : 'login';
        renderModal();
        return false;
    }

    function renderModal() {
        const isLogin = currentMode === 'login';
        document.getElementById('modal-title').textContent = isLogin ? 'Masuk ke Akun' : 'Buat Akun Baru';
        document.getElementById('modal-submit-btn').textContent = isLogin ? 'Masuk' : 'Daftar Sekarang';
        document.getElementById('field-name').style.display = isLogin ? 'none' : 'block';
        document.getElementById('modal-switch-text').textContent = isLogin ? 'Belum punya akun? ' :
        'Sudah punya akun? ';
        document.getElementById('modal-switch-link').textContent = isLogin ? 'Daftar' : 'Masuk';
        document.getElementById('modal-switch-link').onclick = switchModal;
    }

    // Close on overlay click
    document.getElementById('auth-modal').addEventListener('click', closeModal);
</script>
