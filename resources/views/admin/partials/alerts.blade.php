@if ($errors->any())
    <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 shadow-sm rounded-r-lg">
        <p class="font-bold">Terjadi Kesalahan:</p>
        <ul class="list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="mb-6 p-4 bg-emerald-100 border-l-4 border-emerald-500 text-emerald-700 shadow-sm rounded-r-lg flex justify-between items-center">
        <div>
            <p class="font-bold">Berhasil!</p>
            <p class="text-sm">{{ session('success') }}</p>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-500 hover:text-emerald-800">✕</button>
    </div>
@endif
