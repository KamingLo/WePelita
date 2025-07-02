<div>
    <div class="md:ml-64 px-4 md:px-8 py-8 flex flex-wrap gap-8">
        <h1 class="w-full text-[#343a40] mb-2 text-2xl font-bold relative pb-2 md:mt-0">
            Jadwal Ajar Anda
        </h1>

        <div class="w-full bg-white p-4 md:p-6 rounded-lg shadow-md flex flex-col">
            <div class="flex flex-col md:flex-row md:items-center mb-5 gap-4 md:gap-0">
                <h2 class="text-[#343a40] text-lg md:text-xl font-semibold mr-auto">Jadwal Pelajaran</h2>
                <div class="flex items-center gap-4 ml-auto">
                    <div class="flex items-center gap-2">
                        <label for="hari" class="text-[#333] text-sm w-50">Pilih Hari:</label>
                        <select wire:model.live="hari" id="hari" class="block w-full px-3 py-2 border border-[#dee2e6] rounded-md shadow-sm focus:outline-none focus:ring-[#4a6cf7] focus:border-[#4a6cf7] sm:text-sm">
                            <option value="">Semuanya</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full leading-normal border-collapse">
                    <thead>
                        <tr>
                            <th class="px-3 py-3 border-b-2 border-[#dee2e6] bg-[#f8f9fa] text-left text-xs font-semibold text-[#6c757d] uppercase tracking-wider">
                                Pelajaran
                            </th>
                            <th class="px-3 py-3 border-b-2 border-[#dee2e6] bg-[#f8f9fa] text-left text-xs font-semibold text-[#6c757d] uppercase tracking-wider">
                                Kelas
                            </th>
                            <th class="px-3 py-3 border-b-2 border-[#dee2e6] bg-[#f8f9fa] text-left text-xs font-semibold text-[#6c757d] uppercase tracking-wider">
                                Waktu
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($jadwals as $index => $jadwal)
                            <tr class="{{ $index % 2 == 0 ? 'bg-white' : 'bg-[#f8f9fa]' }} hover:bg-gray-50">
                                <td class="px-3 py-5 border-b border-[#dee2e6] text-sm text-[#333]">
                                    {{ $jadwal->pelajaran->namaPelajaran }}
                                </td>
                                <td class="px-3 py-5 border-b border-[#dee2e6] text-sm text-[#333]">
                                    {{ $jadwal->kelasTahun->kelas->nama_kelas }}
                                </td>
                                <td class="px-3 py-5 border-b border-[#dee2e6] text-sm text-[#333]">
                                    <span class="inline-block px-2 py-1 leading-none text-[#08546b] bg-[#e0f2f7] rounded-full font-semibold uppercase text-xs">
                                        {{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-3 py-5 border-b border-[#dee2e6] bg-white text-sm text-center">
                                    <div class="flex flex-col items-center justify-center p-4 text-[#6c757d]">
                                        <i class="fas fa-calendar-times text-4xl mb-3"></i>
                                        <p>Tidak ada jadwal untuk hari {{ $hari }}.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>