<?php

namespace App\Interface\Admin;

interface DashboardInterface
{
    public function createLandingRepositories($request): void;
    //landing
    public function deleteLandingRepositories($model): void;
    public function updateLandingRepositories($model, $request): void;
    //contacts
    public function updateContactsRepositories($model, $request): void;
    public function deleteContactsRepositories($model): void;
    //inventori_barang
    public function createBarangRepositories($request): void;
    public function updateBarangRepositories($request): void;
    public function deleteBarangRepositories($id): void;
    //inventori ruangan
    public function createRuanganRepositories($request): void;
    public function updateRuanganRepositories($request): void;
    public function deleteRuanganRepositories($id): void;
    //begin transaction verification peminjaman
    public function submitRequestVerificationBYIDRepositories($id, $request): void;
}
