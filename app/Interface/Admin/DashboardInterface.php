<?php

namespace App\Interface\Admin;

interface DashboardInterface
{
    public function createLandingRepositories($request): void;
    //landing
    public function deleteLandingRepositories($model): void;
    public function updateLandingRepositories($model, $request): void;
    public function createFooterRepositories($request): void;
    public function updateFooterRepositories($request): void;
    public function deleteFooterRepositories($id): void;
    public function createInformasiPentingRepositories($request): void;
    public function updateInformasiPentingRepositories($request): void;
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
    //user inventori
    public function createAdminRepositories($request): void;
    public function updateAdminRepositories($request): void;
    public function deleteAdminRepositories($id): void;
    //penjadwalan inventori
    public function updatePenjadwalanRepositories($request): void;
    public function createPenjadwalanRepositories($request): void;
    public function deletePenjadwalanRepositories($id): void;
}
