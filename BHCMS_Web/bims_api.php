<?php

class BimsApi
{
    private $baseUrl = "https://localhost:44315/api";
    private $apiKey  = "bims-secret-key-2024";

    private function get($endpoint)
    {
        $url = $this->baseUrl . $endpoint;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // localhost SSL
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // localhost SSL
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "X-API-KEY: " . $this->apiKey,
            "Accept: application/json"
        ]);

        $response = curl_exec($ch);
        $error    = curl_error($ch);
        curl_close($ch);

        if ($error) {
            return ["error" => $error];
        }

        return json_decode($response, true);
    }

    // Get all residents
    public function getAllResidents()
    {
        return $this->get("/Residents");
    }

    // Get single resident by ID
    public function getResident($id)
    {
        return $this->get("/Residents/" . $id);
    }

    // Search residents by name
    public function searchResidents($query)
    {
        return $this->get("/Residents/search?q=" . urlencode($query));
    }
}