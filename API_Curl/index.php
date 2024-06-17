<?php

// Wyslanie zadania - curl
function sendRequest($url) {
    $ch = curl_init();

    // Ustawienie URL
    curl_setopt($ch, CURLOPT_URL, $url);
    // Wynik zwracany jako string
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    // Funkcja ma zwracac naglowki odpowiedzi
    curl_setopt($ch, CURLOPT_HEADER, 1);
    // Wykonanie zadania
    $response = curl_exec($ch);

    // Pobranie statusu HTTP odpowiedzi - wazne do testow
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    // Pobranie rozmiaru naglowka
    $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    // Wyodrebnienie ciala odpowiedzi
    $body = substr($response, $header_size);
    // Zamkniecie cURL
    curl_close($ch);

    return [$http_code, $body];
}

// sprawdzanie odpowiedzi
function checkResponse($http_code, $body, $required_keys) {
    // Sprawdzanie statusu HTTP
    if ($http_code != 200) {
        return [false, "Status zadania HTTP: $http_code"];
    }

    // Parsowanie odpowiedzi JSON
    $data = json_decode($body, true);
    if ($data === null) {
        return [false, "Nie udalo sie przeanalizowac JSON'a"];
    }

    // Sprawdzanie obecnosci wymaganych kluczy
    foreach ($required_keys as $key) {
        if (!array_key_exists($key, $data)) {
            return [false, "Brakuje klucza: $key"];
        }
    }

    return [true, null];
}

// Funkcja do uruchamiania testow
function runTests() {
    $tests = [
        ["http://api.nbp.pl/api/exchangerates/rates/A/USD?format=json", "Test API Narodowego Banku Polskiego", ["rates", "code", "currency"]],
        ["https://api.open-meteo.com/v1/forecast?latitude=51.204491&longitude=16.159241&current_weather=true", "Test Weather API", ["current_weather"]],
        ["https://api.thecatapi.com/v1/images/0XYvRd7oD", "Test Cat API", ["id", "url"], true]
    ];

    // Iteracja przez testy
    foreach ($tests as $test) {
        list($url, $test_name, $required_keys) = $test;

        // Wysylanie zadania
        list($http_code, $body) = sendRequest($url);

        // Sprawdzanie odpowiedzi
        list($passed, $error) = checkResponse($http_code, $body, $required_keys);
        
        // Wyswietlanie wyniku testu
        if ($passed) {
            echo "$test_name: <h5 style='color:green'>PASSED</h5>\n";
        } else {
            echo "$test_name: <h5 style='color:red'>FAILED ($error)</h5>\n";
        }
    }
}

runTests();

?>
