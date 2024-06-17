# Automatyzacja testów API z wykorzystaniem curl

Ten kod w PHP testuje trzy publiczne API, które nie wymagają żadnych kodów, uwierzytelnień itp.: Narodowy Bank Polski (kurs dolara), Open-Meteo (biezaca pogoda w Legnicy) i The Cat API (Obrazek kota o id 0XYvRd7oD). Skrypt wysyła żądania GET za pomocą `curl`, sprawdza status odpowiedzi HTTP, parsuje odpowiedzi JSON i sprawdza obecność kluczowych elementów JSON - wypisane w odpoweiednim miejscu tablicy $tests.

## Wymagania

- PHP z zainstalowaną biblioteką `curl`.
- Działający Web Serwer

## Uruchomienie kodu php

1. Skopiuj kod do odpowiedniej lokalizacji i uruchom serwer www (np. używając XAMPP)

 Jeżeli wszystkie testy zostaną przeprowadzone poprawnie ujrzymy stronę:
 
![Passed](https://github.com/zebrowskimichal/API-curl-Makefile/assets/117666366/d2115d63-684b-4491-affb-56aaeaa1ce53)

W innym przypadku ujrzymy błąd:

![Error](https://github.com/zebrowskimichal/API-curl-Makefile/assets/117666366/5cdd17fb-a83e-4a80-bf73-a881669e8572)



