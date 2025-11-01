@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">

        {{-- UPLOAD CSV --}}
        <div class="bg-white shadow-lg rounded-xl p-6 border mb-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">📂 Upload CSV</h2>

            <form action="{{ route('csv.upload') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf

                <label
                    class="flex flex-col justify-center items-center w-full h-32 border-2 border-dashed border-green-400 bg-green-50 rounded-xl cursor-pointer hover:border-green-600 hover:bg-green-100 transition text-gray-600 text-sm text-center font-medium">
                    <span id="fileText">Click or drag file here</span>
                    <input type="file" name="csv_file" class="hidden"
                        onchange="document.getElementById('fileText').innerText = this.files[0].name">
                </label>

                <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md text-sm font-medium shadow-md transition">
                    Upload CSV
                </button>
            </form>
        </div>

        {{-- RECORDS --}}
        <div class="bg-white shadow-lg rounded-xl p-6 border">

            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800">📋 Records</h2>

                {{-- Toggle view --}}
                <div class="flex gap-2">
                    <button id="viewTableBtn" class="viewBtn px-4 py-2 text-sm font-semibold rounded-lg border transition"
                        data-mode="table">
                        Table
                    </button>

                    <button id="viewCardBtn" class="viewBtn px-4 py-2 text-sm font-semibold rounded-lg border transition"
                        data-mode="cards">
                        Cards
                    </button>
                </div>

                <div class="flex gap-2">
                    <a href="{{ route('csv.download') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium shadow">
                        ⬇️ Download CSV
                    </a>

                    <button onclick="openCreateModal()" type="button"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-sm rounded-md shadow">
                        ➕ New
                    </button>
                </div>
            </div>

            {{-- TABLE --}}
            <div id="tableView" class="{{ ($viewMode ?? 'table') === 'cards' ? 'hidden' : '' }}">
                <table class="min-w-full bg-white text-sm rounded-lg">
                    <thead>
                        <tr class="bg-gray-100 text-gray-700 font-semibold">
                            <th class="border-b px-3 py-2 text-center font-semibold bg-gray-50 text-gray-700">ID</th>
                            <th class="border-b px-3 py-2 text-center font-semibold bg-gray-50 text-gray-700">Email</th>
                            <th class="border-b px-3 py-2 text-center font-semibold bg-gray-50 text-gray-700">Password</th>
                            <th class="border-b px-3 py-2 text-center font-semibold bg-gray-50 text-gray-700">Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($data as $row)
                            <tr class="hover:bg-gray-50 border-b last:border-b">
                                <td class="border-b border-gray-200 px-3 py-2 text-center">{{ $row->id }}</td>
                                <td class="border-b border-gray-200 px-3 py-2 text-center">{{ $row->email }}</td>
                                <td class="border-b border-gray-200 px-3 py-2 text-center">{{ $row->password }}</td>
                                <td class="border-b border-gray-200 px-3 py-2 text-center flex justify-center gap-3">
                                    <button type="button" class="text-blue-600 editBtn" data-id="{{ $row->id }}"
                                        data-email="{{ $row->email }}" data-password="{{ $row->password }}">
                                        ✏️
                                    </button>

                                    <form action="{{ route('csv.delete', $row->id) }}" method="POST"
                                        onsubmit="return confirm('Delete?')">
                                        @csrf @method('DELETE')
                                        <button class="text-red-600">🗑️</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            {{-- CARDS --}}
            <div id="cardView"
                class="{{ ($viewMode ?? 'table') === 'cards' ? '' : 'hidden' }} grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 p-2">
                @foreach($data as $row)
                    <div
                        class="bg-white p-5 border shadow-sm rounded-xl hover:shadow-lg transition h-40 flex flex-col justify-between">
                        <div>
                            <p class="text-gray-400 text-xs font-medium">ID: {{ $row->id }}</p>
                            <p class="font-semibold text-gray-800 truncate">{{ $row->email }}</p>
                            <p class="text-gray-500 text-sm truncate">🔐 {{ $row->password }}</p>
                        </div>
                        <div class="flex gap-2 justify-end">
                            <button type="button"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-2 py-2 rounded-lg text-sm editBtn"
                                data-id="{{ $row->id }}" data-email="{{ $row->email }}" data-password="{{ $row->password }}">
                                ✏️
                            </button>
                            <form action="{{ route('csv.delete', $row->id) }}" method="POST"
                                onsubmit="return confirm('Delete?')">
                                @csrf @method('DELETE')
                                <button class="bg-red-600 hover:bg-red-700 text-white px-2 py-2 rounded-lg text-sm">🗑️</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

    {{-- MODAL --}}
    <div id="editModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden flex items-center justify-center z-50">
        <div class="bg-white p-8 rounded-2xl shadow-2xl w-[550px] max-w-[90%] relative animate-fadeIn">
            <button onclick="closeModal()"
                class="absolute top-4 right-4 text-gray-500 hover:text-red-500 text-2xl font-bold">✕</button>
            <h2 class="text-2xl font-bold mb-6 text-gray-800 text-center">Record</h2>

            <form id="editForm" class="space-y-4">
                @csrf
                <input type="hidden" id="id" name="id">
                <input class="border p-3 w-full rounded-lg" id="email" name="email" placeholder="Email">
                <input class="border p-3 w-full rounded-lg" id="password" name="password" placeholder="Password">

                <button id="submitBtn"
                    class="bg-green-600 hover:bg-green-700 w-full text-white py-3 rounded-lg text-base font-semibold shadow-md transition">
                    ✅ Save
                </button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let isEditing = false;

        const activeClasses = ["bg-gray-800", "text-white", "border-gray-800"];
        const inactiveClasses = ["bg-white", "text-gray-800", "border-gray-300", "hover:bg-gray-200"];


        // abrir modal en modo crear
        function openCreateModal() {
            isEditing = false;

            document.getElementById('id').value = "";
            document.getElementById('email').value = "";
            document.getElementById('password').value = "";
            document.getElementById('submitBtn').innerText = "➕ Create";

            document.getElementById('editModal').classList.remove('hidden');
        }

        // cerrar modal
        function closeModal() {
            document.getElementById('editModal').classList.add('hidden');
        }

        document.addEventListener("DOMContentLoaded", () => {

            let isEditing = false;
            const viewButtons = document.querySelectorAll(".viewBtn");
            const tableView = document.getElementById('tableView');
            const cardView = document.getElementById('cardView');

            const activeClasses = ["bg-gray-800", "text-white", "border-gray-800"];
            const inactiveClasses = ["bg-white", "text-gray-800", "border-gray-300", "hover:bg-gray-200"];

            // Estado inicial desde Laravel
            const currentMode = "{{ $viewMode ?? 'table' }}";

            function setViewMode(mode) {
                // Alternar vista en DOM
                if (mode === "table") {
                    tableView.classList.remove("hidden");
                    cardView.classList.add("hidden");
                } else {
                    cardView.classList.remove("hidden");
                    tableView.classList.add("hidden");
                }

                // Estilos botones
                viewButtons.forEach(btn => {
                    if (btn.dataset.mode === mode) {
                        btn.classList.add(...activeClasses);
                        btn.classList.remove(...inactiveClasses);
                    } else {
                        btn.classList.remove(...activeClasses);
                        btn.classList.add(...inactiveClasses);
                    }
                });

                // Guardar en DB
                fetch("{{ route('ui.viewmode') }}", {
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}", "Content-Type": "application/json" },
                    body: JSON.stringify({ view_mode: mode })
                });
            }

            // Activar estado inicial
            setViewMode(currentMode);

            // Clicks
            viewButtons.forEach(btn => {
                btn.addEventListener("click", () => setViewMode(btn.dataset.mode));
            });
        });

        // preparar botones de editar
        document.querySelectorAll('.editBtn').forEach(btn => {
            btn.onclick = () => {
                isEditing = true;

                document.getElementById('id').value = btn.dataset.id;
                document.getElementById('email').value = btn.dataset.email;
                document.getElementById('password').value = btn.dataset.password;

                document.getElementById('submitBtn').innerText = "✅ Update";
                document.getElementById('editModal').classList.remove('hidden');
            };
        });

        // enviar cambios create/update
        document.getElementById('editForm').onsubmit = async (e) => {
            e.preventDefault();

            const url = isEditing
                ? "{{ route('csv.update') }}"
                : "{{ route('csv.store') }}";

            await fetch(url, {
                method: "POST",
                headers: { "X-CSRF-TOKEN": "{{ csrf_token() }}" },
                body: new FormData(e.target)
            });

            location.reload();
        };
    </script>

@endsection