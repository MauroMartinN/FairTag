<?php

class pais {
    private int $id;
    private string $name;
    private string $coin;
    private string $convertRate;
    private string $lastUpdate;



    public function getId() {
        return $this->id;
    }

    public function setId(int $id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName(string $name) {
        $this->name = $name;
    }

    public function getCoin() {
        return $this->coin;
    }

    public function setCoin(string $coin) {
        $this->coin = $coin;
    }

    public function getConvertRate() {
        return $this->convertRate;
    }

    public function setConvertRate(string $convertRate) {
        $this->convertRate = $convertRate;
    }

    public function getLastUpdate() {
        return $this->lastUpdate;
    }

    public function setLastUpdate(string $lastUpdate) {
        $this->lastUpdate = $lastUpdate;
    }
}