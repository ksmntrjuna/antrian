<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard Antrian</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 font-sans min-h-screen p-6">

    <div class="max-w-4xl mx-auto bg-white shadow-lg rounded-xl p-6">

        {{-- Notifikasi sukses --}}
        @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            {{ session('success') }}
        </div>
        @endif

        {{-- Header --}}
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-gray-700">Dashboard Admin Antrian</h1>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</button>
            </form>
        </div>

        {{-- Antrian Saat Ini --}}
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6">
            <h2 class="text-xl font-semibold text-blue-600 mb-2">Antrian Saat Ini</h2>
            @if ($current)
            <p class="text-5xl font-bold text-gray-800">{{ $current->number }}</p>
            @else
            <p class="text-gray-600">Belum ada antrian yang dipanggil.</p>
            @endif
        </div>

        {{-- Navigasi Antrian --}}
        <div class="flex gap-4 mb-6">
            <form method="POST" action="{{ route('admin.queue.prev') }}">
                @csrf
                <button class="bg-yellow-400 text-white px-6 py-2 rounded hover:bg-yellow-500">
                    Previous
                </button>
            </form>

            <form method="POST" action="{{ route('admin.queue.next') }}">
                @csrf
                <button class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                    Next
                </button>
            </form>
        </div>

        {{-- Daftar Semua Antrian --}}
        <h3 class="text-xl font-semibold text-gray-700 mb-2">Daftar Semua Antrian</h3>
        <div class="overflow-x-auto">
            <table class="w-full bg-white border border-gray-200 text-sm text-left">
                <thead class="bg-gray-100 text-gray-600 uppercase">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Status</th>
                        <th class="px-4 py-2 border">Dipanggil</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($queues as $q)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-2 border">{{ $q->number }}</td>
                        <td class="px-4 py-2 border capitalize">{{ $q->status }}</td>
                        <td class="px-4 py-2 border">{{ $q->called_at ?? '-' }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-4 py-2 border text-center text-gray-500">Belum ada data antrian</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-6 flex justify-center">
            {{ $queues->links() }}
        </div>
    </div>

</body>

</html>