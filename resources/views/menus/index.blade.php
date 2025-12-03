@extends('layouts.app')

@section('content')

{{-- NAVBAR KUNING --}}
<nav class="py-3" style="background-color:#F2C94C;">
    <div class="container d-flex flex-column flex-md-row align-items-center justify-content-between gap-3">

        {{-- SEARCH --}}
        <form class="flex-grow-1">
            <div class="input-group shadow-sm bg-white rounded">
                <input type="text" class="form-control border-0" placeholder="Cari makanan mu...">
                <span class="input-group-text bg-white border-0">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-4.35-4.35m1.2-5.4a6.6 6.6 0 11-13.2 0 6.6 6.6 0 0113.2 0z" />
                    </svg>
                </span>
            </div>
        </form>

        {{-- DROPDOWN BUDGET --}}
        <select class="form-select w-auto me-3 mb-3 mb-lg-0"
                onchange="window.location.href='/menus/show/' + this.value;">
            <option value="">Budget ▼</option>
            <option value="10000">10.000</option>
            <option value="20000">20.000</option>
            <option value="30000">30.000</option>
        </select>

    </div>
</nav>

{{-- HEADER MERAH --}}
<div class="w-100 text-center py-5" style="background-color:#8B0000;">
    <h1 class="text-white fw-bold fs-2">Selamat Datang di</h1>
    <h1 class="text-white fw-bold fs-2">Silapar SWK Telkom</h1>
</div>

{{-- SECTION MAKANAN TERPOPULER --}}
<div class="py-5" style="background-color:#F7D794;">
    <div class="container">

        <h4 class="fw-bold mb-4">Makanan Terpopuler</h4>

        <div class="row g-4">

            {{-- CARD 1 --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0">
                    <img src="/images/menus/mie_ayam.jpg" class="card-img-top" style="height:160px;object-fit:cover;">
                    <div class="card-body text-center">
                        <h6 class="fw-semibold">Mie Ayam - Bu Siti</h6>
                    </div>
                </div>
            </div>

            {{-- CARD 2 --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0">
                    <img src="/images/menus/bakso.jpg" class="card-img-top" style="height:160px;object-fit:cover;">
                    <div class="card-body text-center">
                        <h6 class="fw-semibold">Bakso - Cak Ipin</h6>
                    </div>
                </div>
            </div>

            {{-- CARD 3 --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0">
                    <img src="/images/menus/nasi_goreng.jpg" class="card-img-top" style="height:160px;object-fit:cover;">
                    <div class="card-body text-center">
                        <h6 class="fw-semibold">Nasi Goreng- Kaira</h6>
                    </div>
                </div>
            </div>

            {{-- CARD 4 --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="card shadow-sm border-0">
                    <img src="/images/menus/siomay.jpg" class="card-img-top" style="height:160px;object-fit:cover;">
                    <div class="card-body text-center">
                        <h6 class="fw-semibold">Siomay - Bang Ocit</h6>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
