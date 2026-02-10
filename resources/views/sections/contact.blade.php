<section id="contact" class="h-screen min-h-[600px] flex items-center bg-[#0f172a] px-6 relative overflow-hidden py-12">
    {{-- Decorative Background Glow --}}
    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-blue-600/5 blur-[100px] rounded-full -mr-48 -mt-48"></div>
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-cyan-600/5 blur-[100px] rounded-full -ml-48 -mb-48"></div>

    <div class="max-w-6xl mx-auto w-full relative z-10">
        <div class="text-center mb-8" data-aos="fade-up">
            <h2 class="text-3xl font-black bg-gradient-to-r from-cyan-400 to-blue-500 bg-clip-text text-transparent uppercase tracking-tighter">Get In Touch</h2>
            <p class="text-slate-400 mt-2 text-xs font-medium italic">Let's connect for further collaboration.</p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8 items-center">
            {{-- SOSIAL MEDIA: COMPACT 2 COLUMNS --}}
            <div class="space-y-3" data-aos="fade-right">
                <h3 class="text-white font-bold uppercase tracking-widest text-[9px] mb-4 ml-1 text-cyan-500/80">Social Channels</h3>

                @php
                    $socials = [
                        ['name' => 'Email', 'icon' => 'fas fa-envelope', 'color' => 'text-red-400', 'user' => 'abbelkadafi@gmail.com', 'link' => 'mailto:abbelkadafi@gmail.com'],
                        ['name' => 'WhatsApp', 'icon' => 'fab fa-whatsapp', 'color' => 'text-green-400', 'user' => '+62 822-8759-2930', 'link' => 'https://wa.me/6282287592930'],
                        ['name' => 'Instagram', 'icon' => 'fab fa-instagram', 'color' => 'text-pink-500', 'user' => '@_ntbbll', 'link' => 'https://instagram.com/_ntbbll'],
                        ['name' => 'Facebook', 'icon' => 'fab fa-facebook', 'color' => 'text-blue-600', 'user' => '@Bell', 'link' => 'https://facebook.com/zx.marchia'],
                        ['name' => 'Twitter/X', 'icon' => 'fab fa-twitter', 'color' => 'text-slate-200', 'user' => '@zxbell2', 'link' => 'https://twitter.com/zxbell2'],
                        ['name' => 'Telegram', 'icon' => 'fab fa-telegram', 'color' => 'text-blue-400', 'user' => '@bellxss', 'link' => 'https://t.me/bellxss'],
                        ['name' => 'GitHub', 'icon' => 'fab fa-github', 'color' => 'text-white', 'user' => 'notbell1', 'link' => 'https://github.com/notbell1'],
                        ['name' => 'LinkedIn', 'icon' => 'fab fa-linkedin', 'color' => 'text-blue-500', 'user' => 'Abbel', 'link' => 'https://linkedin.com/in/abbel'],
                    ];
                @endphp

                <div class="grid grid-cols-2 gap-2">
                    @foreach($socials as $social)
                    <a href="{{ $social['link'] }}" target="_blank" class="flex flex-col items-center text-center gap-1.5 bg-slate-800/20 p-3 rounded-xl border border-slate-800 hover:border-cyan-500/50 hover:bg-slate-800/40 transition-all group overflow-hidden">
                        <div class="w-8 h-8 shrink-0 rounded-lg bg-slate-900 flex items-center justify-center {{ $social['color'] }} group-hover:scale-105 transition-transform text-sm">
                            <i class="{{ $social['icon'] }}"></i>
                        </div>
                        <div class="w-full">
                            <p class="text-[7px] text-slate-500 uppercase font-black tracking-tighter">{{ $social['name'] }}</p>
                            <p class="text-slate-200 text-[9px] font-bold truncate">{{ $social['user'] }}</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>

            {{-- FORM PESAN: COMPACT DESIGN --}}
            <div class="lg:col-span-2" data-aos="fade-left">
                <div class="bg-slate-800/20 backdrop-blur-xl p-6 lg:p-8 rounded-[2rem] border border-slate-800 shadow-2xl relative">

                    {{-- Alert Notification --}}
                    <div id="contact-alert" class="hidden mb-4 p-3 rounded-xl text-[11px] italic items-center gap-3 animate__animated">
                        <i id="alert-icon" class="fas"></i>
                        <span id="alert-message"></span>
                    </div>

                    <form id="contact-form" action="{{ route('contact.send') }}" method="POST" class="space-y-4">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="space-y-1">
                                <label class="text-[9px] font-black uppercase tracking-widest text-slate-500 ml-3">Full Name</label>
                                <input type="text" name="name" required placeholder="Name" class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-200 focus:border-cyan-500 focus:outline-none transition-all placeholder:text-slate-700">
                            </div>
                            <div class="space-y-1">
                                <label class="text-[9px] font-black uppercase tracking-widest text-slate-500 ml-3">Email Address</label>
                                <input type="email" name="email" required placeholder="mail@example.com" class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-200 focus:border-cyan-500 focus:outline-none transition-all placeholder:text-slate-700">
                            </div>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase tracking-widest text-slate-500 ml-3">Subject</label>
                            <input type="text" name="subject" required placeholder="Subject" class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-200 focus:border-cyan-500 focus:outline-none transition-all placeholder:text-slate-700">
                        </div>
                        <div class="space-y-1">
                            <label class="text-[9px] font-black uppercase tracking-widest text-slate-500 ml-3">Message</label>
                            <textarea name="message" rows="3" required placeholder="Message..." class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 text-sm text-slate-200 focus:border-cyan-500 focus:outline-none transition-all placeholder:text-slate-700"></textarea>
                        </div>

                        <button type="submit" id="submit-btn" class="w-full py-4 bg-gradient-to-r from-blue-600 to-cyan-500 text-white font-black uppercase tracking-widest text-[10px] rounded-xl shadow-lg shadow-cyan-500/10 hover:shadow-cyan-500/30 hover:scale-[1.01] active:scale-[0.98] transition-all flex items-center justify-center gap-2 group">
                            <span id="btn-text">Send Message</span>
                            <i id="btn-icon" class="fas fa-paper-plane text-xs group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.getElementById('contact-form').addEventListener('submit', async function(e) {
    e.preventDefault();
    const form = this, btn = document.getElementById('submit-btn'), btnText = document.getElementById('btn-text');
    const alertBox = document.getElementById('contact-alert'), alertMsg = document.getElementById('alert-message'), alertIcon = document.getElementById('alert-icon');

    btn.disabled = true; btnText.innerText = 'Sending...';
    alertBox.classList.add('hidden');

    try {
        const response = await fetch(form.action, {
            method: 'POST',
            body: new FormData(form),
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        });

        const result = await response.json();
        alertBox.classList.remove('hidden', 'bg-emerald-500/10', 'text-emerald-400', 'bg-red-500/10', 'text-red-400', 'animate__fadeIn', 'animate__shakeX', 'flex');
        alertBox.classList.add('flex');

        if (response.ok) {
            alertBox.classList.add('bg-emerald-500/10', 'text-emerald-400', 'animate__fadeIn');
            alertIcon.className = 'fas fa-check-circle';
            alertMsg.innerText = result.message;
            form.reset();
        } else {
            alertBox.classList.add('bg-red-500/10', 'text-red-400', 'animate__shakeX');
            alertIcon.className = 'fas fa-exclamation-triangle';
            alertMsg.innerText = result.message;
        }
    } catch (error) {
        alertBox.classList.remove('hidden'); alertBox.classList.add('flex', 'bg-red-500/10', 'text-red-400');
        alertMsg.innerText = 'Server Error.';
    } finally {
        btn.disabled = false; btnText.innerText = 'Send Message';
    }
});
</script>
