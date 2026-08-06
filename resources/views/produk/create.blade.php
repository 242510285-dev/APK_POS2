@extends('layouts.app')

@section('title', 'Tambah Produk Baru')

@section('content')

    @include('layouts.navbar')

    <style>
        :root {
            --bg-main: #090d16;
            --card-bg: #1e293b;
            --card-border: rgba(255, 255, 255, 0.08);
            --accent-indigo: #6366f1;
            --accent-emerald: #10b981;
        }

        body {
            background-color: var(--bg-main) !important;
            color: #f8fafc !important;
            font-family: 'Plus Jakarta Sans', 'Instrument Sans', system-ui, -apple-system, sans-serif;
        }

        /* CARD */
        .card-pro {
            background: var(--card-bg) !important;
            border: 1px solid var(--card-border);
            border-radius: 1.25rem;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.4);
            overflow: hidden;
        }

        /* INPUT */
        .form-control-dark,
        .form-select-dark {
            background-color: #0f172a !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #f8fafc !important;
            border-radius: 0.75rem !important;
            padding: 0.7rem 1rem;
        }

        .form-control-dark:focus,
        .form-select-dark:focus {
            border-color: #6366f1 !important;
            box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25) !important;
        }

        /* SELECT OPTION */
        .form-select-dark option {
            background-color: #0f172a;
            color: #f8fafc;
        }

        /* LABEL */
        .form-label-dark {
            color: #cbd5e1 !important;
        }

        /* PLACEHOLDER */
        .form-control-dark::placeholder {
            color: #64748b !important;
            opacity: 1 !important;
        }

        /* RP */
        .input-group-text-dark {
            color: #94a3b8 !important;
            background: #0f172a !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
        }

        /* FILE INPUT */
        .form-control-dark::file-selector-button {
            background: #334155;
            color: #f8fafc;
            border: none;
            padding: 0.4rem 0.8rem;
            border-radius: 0.5rem;
            margin-right: 0.75rem;
            transition: all 0.2s;
        }

        .form-control-dark::file-selector-button:hover {
            background: #475569;
            cursor: pointer;
        }

        /* IMAGE PREVIEW */
        .image-preview-container {
            width: 100%;
            height: 220px;
            background-color: #0f172a;
            border: 2px dashed rgba(255, 255, 255, 0.15);
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        .image-preview-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* JENIS PRODUK */
        .jenis-wrapper {
            position: relative;
        }

        .jenis-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
            font-size: 1.1rem;
            pointer-events: none;
        }

        .jenis-select {
            padding-left: 2.8rem !important;
        }

        /* BUTTON SAVE */
        .btn-save-pro {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            font-weight: 700;
            border-radius: 0.75rem;
            padding: 0.75rem 1.75rem;
            border: none;
            box-shadow: 0 4px 14px rgba(16, 185, 129, 0.4);
            transition: all 0.25s ease;
        }

        .btn-save-pro:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.6);
            color: #ffffff;
        }

        /* BUTTON BACK */
        .btn-back-pro {
            background: rgba(148, 163, 184, 0.15);
            color: #cbd5e1;
            border: 1px solid rgba(255, 255, 255, 0.1);
            font-weight: 600;
            border-radius: 0.75rem;
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-back-pro:hover {
            background: rgba(148, 163, 184, 0.25);
            color: #ffffff;
        }

        /* ERROR */
        .text-error {
            color: #f87171;
            font-size: 0.8rem;
            margin-top: 0.4rem;
        }

        /* REQUIRED */
        .required {
            color: #ef4444;
        }
    </style>


    <div class="container py-5">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h1 class="fw-black text-white mb-1"
                    style="font-size: 2rem; letter-spacing: -0.02em;">
                    Tambah Produk Baru
                </h1>

                <p class="mb-0 small" style="color: #94a3b8;">
                    Isi formulir berikut untuk menambahkan stok
                    barang ke dalam sistem.
                </p>
            </div>

            <div>
                <a href="{{ route('produk.index') }}"
                    class="btn btn-back-pro d-inline-flex align-items-center gap-2">

                    <i class="bi bi-arrow-left"></i>
                    Kembali

                </a>
            </div>

        </div>


        {{-- FORM CARD --}}
        <div class="card card-pro p-4 p-md-5">

            <form action="{{ route('produk.store') }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf

                <div class="row g-4">

                    {{-- ========================================= --}}
                    {{-- BAGIAN KIRI --}}
                    {{-- ========================================= --}}
                    <div class="col-12 col-lg-7">


                        {{-- NAMA PRODUK --}}
                        <div class="mb-3">

                            <label class="form-label fw-bold small form-label-dark">

                                Nama Produk
                                <span class="required">*</span>

                            </label>

                            <input type="text"
                                name="nama"
                                class="form-control form-control-dark @error('nama') is-invalid @enderror"
                                placeholder="Contoh: Kopi Susu Aren"
                                value="{{ old('nama') }}"
                                required>

                            @error('nama')
                                <div class="text-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- ========================================= --}}
                        {{-- JENIS PRODUK --}}
                        {{-- ========================================= --}}
                        <div class="mb-3">

                            <label class="form-label fw-bold small form-label-dark">

                                Jenis Produk
                                <span class="required">*</span>

                            </label>

                            <div class="jenis-wrapper">

                                <span class="jenis-icon" id="jenisIcon">
                                    📦
                                </span>

                                <select name="jenis_produk"
                                    id="jenisProduk"
                                    class="form-select form-select-dark jenis-select @error('jenis_produk') is-invalid @enderror"
                                    required>

                                    <option value="" disabled
                                        {{ old('jenis_produk') ? '' : 'selected' }}>
                                        Pilih jenis produk
                                    </option>

                                    <option value="Makanan"
                                        data-icon="🍔"
                                        {{ old('jenis_produk') == 'Makanan' ? 'selected' : '' }}>
                                        🍔 Makanan
                                    </option>

                                    <option value="Minuman"
                                        data-icon="🥤"
                                        {{ old('jenis_produk') == 'Minuman' ? 'selected' : '' }}>
                                        🥤 Minuman
                                    </option>

                                    <option value="Snack"
                                        data-icon="🍪"
                                        {{ old('jenis_produk') == 'Snack' ? 'selected' : '' }}>
                                        🍪 Snack
                                    </option>

                                    <option value="Kopi"
                                        data-icon="☕"
                                        {{ old('jenis_produk') == 'Kopi' ? 'selected' : '' }}>
                                        ☕ Kopi
                                    </option>

                                    <option value="Sembako"
                                        data-icon="🛒"
                                        {{ old('jenis_produk') == 'Sembako' ? 'selected' : '' }}>
                                        🛒 Sembako
                                    </option>

                                    <option value="Lainnya"
                                        data-icon="📦"
                                        {{ old('jenis_produk') == 'Lainnya' ? 'selected' : '' }}>
                                        📦 Lainnya
                                    </option>

                                </select>

                            </div>

                            @error('jenis_produk')
                                <div class="text-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- HARGA BELI & HARGA JUAL --}}
                        <div class="row mb-3">

                            {{-- HARGA BELI --}}
                            <div class="col-12 col-md-6 mb-3 mb-md-0">

                                <label class="form-label fw-bold small form-label-dark">

                                    Harga Beli (Rp)

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text input-group-text-dark"
                                        style="border-radius: 0.75rem 0 0 0.75rem !important;">

                                        Rp

                                    </span>

                                    <input type="number"
                                        name="harga_beli"
                                        class="form-control form-control-dark border-start-0 @error('harga_beli') is-invalid @enderror"
                                        placeholder="0"
                                        value="{{ old('harga_beli') }}"
                                        min="0"
                                        style="border-radius: 0 0.75rem 0.75rem 0 !important;">

                                </div>

                                @error('harga_beli')
                                    <div class="text-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- HARGA JUAL --}}
                            <div class="col-12 col-md-6">

                                <label class="form-label fw-bold small form-label-dark">

                                    Harga Jual (Rp)
                                    <span class="required">*</span>

                                </label>

                                <div class="input-group">

                                    <span class="input-group-text input-group-text-dark"
                                        style="border-radius: 0.75rem 0 0 0.75rem !important;">

                                        Rp

                                    </span>

                                    <input type="number"
                                        name="harga_jual"
                                        class="form-control form-control-dark border-start-0 @error('harga_jual') is-invalid @enderror"
                                        placeholder="0"
                                        value="{{ old('harga_jual') }}"
                                        min="0"
                                        required
                                        style="border-radius: 0 0.75rem 0.75rem 0 !important;">

                                </div>

                                @error('harga_jual')
                                    <div class="text-error">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                        </div>


                        {{-- STOK --}}
                        <div class="mb-4">

                            <label class="form-label fw-bold small form-label-dark">

                                Jumlah Stok
                                <span class="required">*</span>

                            </label>

                            <input type="number"
                                name="stok"
                                class="form-control form-control-dark @error('stok') is-invalid @enderror"
                                placeholder="0"
                                value="{{ old('stok', 0) }}"
                                min="0"
                                required>

                            @error('stok')
                                <div class="text-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- ========================================= --}}
                    {{-- BAGIAN KANAN --}}
                    {{-- ========================================= --}}
                    <div class="col-12 col-lg-5 d-flex flex-column justify-content-between">

                        <div>

                            {{-- FOTO --}}
                            <label class="form-label fw-bold small form-label-dark">

                                Foto Produk

                            </label>

                            <div class="image-preview-container mb-3"
                                id="previewBox">

                                <div class="text-center p-3"
                                    id="previewPlaceholder"
                                    style="color: #64748b;">

                                    <i class="bi bi-cloud-arrow-up fs-1 d-block mb-1"></i>

                                    <span class="small fw-semibold">
                                        Preview Foto Produk
                                    </span>

                                </div>

                                <img id="imgPreview"
                                    class="d-none"
                                    alt="Preview Gambar">

                            </div>


                            {{-- FILE --}}
                            <input type="file"
                                name="foto"
                                id="fotoInput"
                                class="form-control form-control-dark @error('foto') is-invalid @enderror"
                                accept="image/*"
                                onchange="previewImage(this)">

                            @error('foto')
                                <div class="text-error">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- BUTTON --}}
                        <div class="d-flex gap-2 justify-content-end mt-4 pt-3"
                            style="border-top: 1px solid rgba(255,255,255,0.08);">

                            <a href="{{ route('produk.index') }}"
                                class="btn btn-back-pro">

                                Batal

                            </a>

                            <button type="submit"
                                class="btn btn-save-pro d-inline-flex align-items-center gap-2">

                                <i class="bi bi-floppy-fill"></i>

                                Simpan Produk

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>


    {{-- ========================================= --}}
    {{-- JAVASCRIPT --}}
    {{-- ========================================= --}}
    <script>

        // =========================================
        // PREVIEW GAMBAR
        // =========================================

        function previewImage(input) {

            const preview = document.getElementById('imgPreview');
            const placeholder = document.getElementById('previewPlaceholder');

            if (input.files && input.files[0]) {

                const reader = new FileReader();

                reader.onload = function(e) {

                    preview.src = e.target.result;

                    preview.classList.remove('d-none');

                    placeholder.classList.add('d-none');

                };

                reader.readAsDataURL(input.files[0]);

            } else {

                preview.src = '#';

                preview.classList.add('d-none');

                placeholder.classList.remove('d-none');

            }

        }


        // =========================================
        // ICON JENIS PRODUK
        // =========================================

        document.addEventListener('DOMContentLoaded', function() {

            const select = document.getElementById('jenisProduk');
            const icon = document.getElementById('jenisIcon');

            function updateJenisIcon() {

                const selectedOption =
                    select.options[select.selectedIndex];

                if (selectedOption && selectedOption.dataset.icon) {

                    icon.textContent =
                        selectedOption.dataset.icon;

                } else {

                    icon.textContent = '📦';

                }

            }

            select.addEventListener('change', updateJenisIcon);

            updateJenisIcon();

        });

    </script>

@endsection