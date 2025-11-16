@extends('layouts.app')

@section('page-title', 'Edit Tenaga Pendidikan')
@section('page-subtitle', 'Perbarui data guru atau staf')

@section('content')
<div class="max-w-4xl">
    <div class="mb-6">
        <a href="{{ route('admin.tenaga-pendidikan.index') }}" class="inline-flex items-center text-gray-600 hover:text-gray-900 font-semibold">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="p-8">
                    <form action="{{ route('admin.tenaga-pendidikan.update', $tenagaPendidikan) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Nama -->
                            <div class="col-span-2">
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap *</label>
                                <input type="text" name="nama" id="nama" value="{{ old('nama', $tenagaPendidikan->nama) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('nama')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- NIP -->
                            <div>
                                <label for="nip" class="block text-sm font-medium text-gray-700">NIP</label>
                                <input type="text" name="nip" id="nip" value="{{ old('nip', $tenagaPendidikan->nip) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('nip')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jenis -->
                            <div>
                                <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis *</label>
                                <select name="jenis" id="jenis" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Pilih Jenis</option>
                                    <option value="guru" {{ old('jenis', $tenagaPendidikan->jenis) == 'guru' ? 'selected' : '' }}>Guru</option>
                                    <option value="staf" {{ old('jenis', $tenagaPendidikan->jenis) == 'staf' ? 'selected' : '' }}>Staf</option>
                                </select>
                                @error('jenis')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Jabatan -->
                            <div>
                                <label for="jabatan" class="block text-sm font-medium text-gray-700">Jabatan *</label>
                                <input type="text" name="jabatan" id="jabatan" value="{{ old('jabatan', $tenagaPendidikan->jabatan) }}" required placeholder="Contoh: Guru Matematika, Kepala Sekolah" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('jabatan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Pendidikan -->
                            <div>
                                <label for="pendidikan" class="block text-sm font-medium text-gray-700">Pendidikan</label>
                                <input type="text" name="pendidikan" id="pendidikan" value="{{ old('pendidikan', $tenagaPendidikan->pendidikan) }}" placeholder="Contoh: S1, S2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('pendidikan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email" value="{{ old('email', $tenagaPendidikan->email) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Telepon -->
                            <div>
                                <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                                <input type="text" name="telepon" id="telepon" value="{{ old('telepon', $tenagaPendidikan->telepon) }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('telepon')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Bidang Keahlian -->
                            <div class="col-span-2">
                                <label for="bidang_keahlian" class="block text-sm font-medium text-gray-700">Bidang Keahlian (untuk Guru)</label>
                                <textarea name="bidang_keahlian" id="bidang_keahlian" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('bidang_keahlian', $tenagaPendidikan->bidang_keahlian) }}</textarea>
                                @error('bidang_keahlian')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Foto -->
                            <div class="col-span-2">
                                <label for="foto" class="block text-sm font-medium text-gray-700">Foto</label>
                                @if($tenagaPendidikan->foto)
                                    <div class="mt-2 mb-3">
                                        <img src="{{ $tenagaPendidikan->foto }}" alt="{{ $tenagaPendidikan->nama }}" class="h-32 w-32 rounded-lg object-cover">
                                    </div>
                                @endif
                                <input type="file" name="foto" id="foto" accept="image/jpeg,image/jpg,image/png" class="mt-1 block w-full">
                                <p class="mt-1 text-sm text-gray-500">Format: JPG, JPEG, PNG. Maksimal 15MB. Kosongkan jika tidak ingin mengubah foto.</p>
                                @error('foto')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-span-2">
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', $tenagaPendidikan->is_active) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <span class="ml-2 text-sm text-gray-700">Aktif</span>
                                </label>
                            </div>
                        </div>

            <div class="mt-6 flex justify-end gap-3">
                <a href="{{ route('admin.tenaga-pendidikan.index') }}" class="px-6 py-3 bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold rounded-lg transition">
                    Batal
                </a>
                <button type="submit" class="px-6 py-3 rounded-lg font-bold text-white shadow-lg transition transform hover:-translate-y-1" style="background: linear-gradient(135deg, #6155F5 0%, #00C2A8 100%);">
                    Update
                </button>
            </div>
        </form>
        </div>
    </div>
</div>
@endsection
