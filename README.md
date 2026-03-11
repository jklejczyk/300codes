# Zadanie rekrutacyjne

## Przbieg realizacji zadania

1. Przygotowania
- zapoznanie się z zadaniem
- wygenerowanie poglądowego planu realizacji zadania przy pomocy AI 
- weryfikacja zgodności planu ze specyfikacją zadania

2. Setup projektu
- instalacja czystego projektu Laravel
- w celu ułatwienia uruchomienia projektu docelowo wykorzystana będzie baza sqlite

3. Przygotowanie struktury bazy
- napisanie modeli wraz z relacjami
- na podstawie modeli wygenerowanie z claude code migracji oraz factory
- poprawa migracji: ograniczenie długości kolumn ze stringiem oraz weryfikacja poprawności relacji, w szczególności kaskadowego usuwania
- dodanie factory do seedera
- wykonanie migracji i zaseedowanie bazy

4. Obsługa API
- utworzenie pustych kontrolerow (korzystając z artisan cli)
- utworzenie pustych requestow (korzystając z artisan cli)
- uzupełenie requestow przez claude code na podstawie danych z migracji i weryfikacji poprawności
- wykonanie php artisan install:api w celu obsługi routow z api.php
- uzupelnienie metod w AuthorController
- wydzilenie logiki biznesowe do serwisu
- utworzenie AuthorResource i AuthorCollection
- przetestowanie routow w postmanie
- na podstawie opracowanego schematu wygenerowanie z claude code obsługi api dla modelu Book
- przetestowanie routow w postmanie

5. Obsługa Jobsów
- utworzenie klasy joba
- rozszerzenie logiki w 

6. Testy
- zezwolenie na RefreshDatabase w Pest.php
- wygenerowanie testow z claude code
- sprawdzenie czy testy pokrywają wszystkie przypadki

7. Sanctum
- dodanie grupy z middlewarem auth:sanctum w api.php
- uzupełnienie trait HasApiTokens w modelu User
- skorygowaniu testów o konieczność uwierzytelniania i dodanie testu na brak tokenu i niepoprawny token
- dodanie usera do seeda
- dodanie komendy do wygenerowania testowego tokenu

8. Obsługa search
- dodanie paremtru Request w AuthorController
- dodanie filtra poprzez relację books
- test parametru serach w postmanie

9. Komenda dodająca autora
- utworzenie komendy z artisan make:command
- wygenerowanie treść commendy podająć prompt do claude code

## Zrealizowane funkcjonalności

Zrealizowano wszystkie wymagane oraz dodatkowe funkcjonalności.

## Instrukcja uruchomienia

1. pobranie repozytorium lub sklonowanie repozytorium poprzez git clone https://github.com/jklejczyk/300codes.git
2. instalacja zależności - composer install
3. utworzenie pliku bazy danych - touch database/database.sqlite
4. utworzenie pliku .env - cp .env.example .env
5. wygenerowanie klucza aplikacji - php artisan key:generate
6. uruchomienie migracji - php artisan migrate
7. uzupełnienie bazy danymi testowymi - php artisan db:seed
8. uruchomienie kolejki - php artisan queue:work
9. można sprawdzać :)

do uruchomienia testów: php artisan test
do wygenerowania tokenu bearer do testu GET /api/authors: php artisan token:generate
do wygenerowania nowego autora: php artisan author:create

## Dodatkowe uwagi

Na potrzeby zadania założyłem, że możemy dodawać do systemu autorów, którzy nie posiadają jeszcze przypisanych książek, ale do każdej książki należy dołączyć autora.

## Wersja demo

Zadanie dostępne jest również pod adresem https://300codes.rozwiazaniawebowe.pl/


