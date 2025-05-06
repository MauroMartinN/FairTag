<?php

class Post {
    private int $id;
    private string $title;
    private string $content;
    private string $image;
    private string $created_at;
    private string $google_link;
    private string $latitude;
    private string $longitude;
    private int $user_id;
    private string $country="Pendiente de implementar";

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getCreatedAt() {
        return $this->created_at;
    }

    public function setCreatedAt($created_at) {
        $this->created_at = $created_at;
    }

    public function getGoogleLink() {
        return $this->google_link;
    }

    public function setGoogleLink($google_link) {
        $this->google_link = $google_link;
        $this->extractCoordinatesFromGoogleLink();
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function getUserId() {
        return $this->user_id;
    }

    public function setUserId($user_id) {
        $this->user_id = $user_id;
    }

    private function extractCoordinatesFromGoogleLink() {
        $partes = explode('!3d', $this->google_link);
        if (isset($partes[1])) {
            $coords1 = explode('!4d', $partes[1]);
            $coords2 = explode('!', $coords1[1]);

            $this->latitude = $coords1[0];
            $this->longitude = $coords2[0];
            //fetchCountryFromCoordinates(); PENDIENTE DE IMPLEMENTAR
            return true;
        }
        return false;
    }

    public function getCoordinates() {
        return [
            'latitude' => $this->latitude,
            'longitude' => $this->longitude
        ];
    }

    public function setCountry($country) {
        $this->country = $country;
    }

    public function getCountry() {
        return $this->country;
    }

    private function fetchCountryFromCoordinates() { //API de OpenStreetMap gratuita, devuelve el país a partir de las coordenadas
        $url = "https://nominatim.openstreetmap.org/reverse?format=json&lat={$this->latitude}&lon={$this->longitude}&zoom=5&addressdetails=1";
    
        $opts = [
            "http" => [
                "method" => "GET",
                "header" => "User-Agent: MyApp/1.0"
            ]
        ];

        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);
    
        if ($response) {
            $data = json_decode($response, true);
            if (isset($data['address']['country'])) {
                $this->setCountry($data['address']['country']);
                return true;
            }
        }
    
        return false;
    }
}
