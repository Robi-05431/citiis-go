{{-- Auth Modal --}}
<div id="modal-auth" class="hidden fixed inset-0 bg-black/50 z-[9999] flex items-center justify-center p-4"
    onclick="if(event.target===this)this.classList.add('hidden')">
    <div class="bg-white rounded-3xl p-8 w-full max-w-md shadow-2xl relative">

        <button onclick="document.getElementById('modal-auth').classList.add('hidden')"
            class="absolute top-4 right-4 w-9 h-9 rounded-full bg-gray-100 hover:bg-gray-200
                   flex items-center justify-center text-gray-500 transition-colors">
            <i class="ti ti-x text-lg"></i>
        </button>

        <h2 class="font-display text-2xl font-bold mb-1">Masuk ke Akun</h2>
        <p class="text-sm text-gray-500 mb-6">Selamat datang kembali!</p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label class="block text-xs font-medium text-gray-500 mb-1.5">Email</label>
            <input type="email" name="email" placeholder="email@kamu.com"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                    focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20
                    transition mb-4">

            <label class="block text-xs font-medium text-gray-500 mb-1.5">Password</label>
            <input type="password" name="password" placeholder="Password"
                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm
                    focus:outline-none focus:border-brand focus:ring-2 focus:ring-brand/20
                    transition mb-5">

            <button type="submit"
                class="w-full py-3 bg-brand hover:bg-brand-dark text-white font-semibold
                     rounded-xl transition-colors duration-200">
                Masuk
            </button>
        </form>

        <p class="text-center text-sm text-gray-500 mt-4">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-brand font-semibold hover:underline">
                Daftar sekarang
            </a>
        </p>
    </div>
</div>
