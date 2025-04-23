@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-10">
        <div class="card shadow-lg border-0 bg-gradient-primary text-white">
            <div class="card-body p-5">
                <div class="d-flex align-items-center mb-3">
                    <div class="me-3">
                        <i class="fas fa-futbol fa-3x text-white animate__animated animate__bounceIn"></i>
                    </div>
                    <div>
                        <h2 class="fw-bold">Selamat Datang di Akademi Sepak Bola!</h2>
                        <p class="mb-0 fs-5">Kelola data pendaftar, atur jadwal seleksi, dan pantau perkembangan peserta dengan mudah.</p>
                    </div>
                </div>
                <hr class="border-light">
                <p class="mb-0 text-white-50">Gunakan menu di sidebar untuk navigasi.</p>
            </div>
        </div>
    </div>
</div>
@endsection
