<?php

namespace App\Repositories;

use Carbon\Carbon;
use App\Models\Contact;
use App\Models\Errorlog;
use App\Models\Successlog;
use App\Interface\LandingInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Http\FormRequest;

class LandingRepositories extends FormRequest implements LandingInterface
{
    public function rules(): array //set validation rules
    {
        if (request()->is('contact')) {
            return [
                'email' => 'required|email',
                'message' => 'required|string'
            ];
        } else {
            return [];
        }
    }

    public function messages(): array // message custom of validation rules
    {
        return [
            'required' => ':attribute wajib di isi',
            'email' => ':attribute penulisan salah',
            'string' => ':attribute harus string'
        ];
    }

    public function indexRepositories($data): View
    {
        $landing_image = $data;
        return view('sisarpas.landing.index', compact('landing_image'));
    }

    public function contactRepositories(): void
    {
        try {
            $contact = Contact::create(['email' => request()->input('email'), 'message' => request()->input('message')]);
            $mapSuccessLog = array('message' => "email: {$contact->email} telah mengirim contact ke admin", 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Successlog::create($mapSuccessLog);
        } catch (\Exception $errors) {
            $mapErrorLogs = array('message' => $errors->getMessage(), 'route' => request()->route()->getName(), 'created_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')), 'updated_at' =>  Carbon::now()->timezone(env('APP_TIMEZONE', 'Asia/Makassar')));
            Errorlog::create($mapErrorLogs);
        }
    }
}
