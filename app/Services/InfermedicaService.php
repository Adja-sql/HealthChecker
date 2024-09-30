<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class InfermedicaService
{
    protected $apiUrl;
    protected $appId;
    protected $appKey;

    public function __construct()
    {
        // Ces valeurs sont récupérées du fichier .env
        $this->apiUrl = config('services.infermedica.url');
        $this->appId = config('services.infermedica.app_id');
        $this->appKey = config('services.infermedica.app_key');
    }

    public function getConditions($age, $sex)
    {
        return Http::withHeaders([
            'App-Id' => $this->appId,
            'App-Key' => $this->appKey,
        ])->get($this->apiUrl . '/conditions', [
            'age' => $age,
            'sex' => $sex,
        ]);
    }

    // Fonction pour envoyer un diagnostic basé sur des symptômes
    public function getDiagnosis(array $symptoms, $age, $sex)
    {
        $data = [
            'age' => ['value' => $age],
            'sex' => $sex,
            'evidence' => $symptoms,
        ];

        $response = Http::withHeaders([
            'App-Id' => $this->appId,
            'App-Key' => $this->appKey,
            'Accept-Language' => 'fr'
        ])->post($this->apiUrl . '/diagnosis', $data);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    public function getInitialQuestion()
    {
        return Http::withHeaders([
            'App-Id' => $this->appId,
            'App-Key' => $this->appKey,
        ])->get($this->apiUrl . '/diagnosis', [
            // Paramètres nécessaires pour l'appel API, comme âge, sexe, etc.
        ])->json();
    }
}
