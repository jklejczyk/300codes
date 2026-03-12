# Zadanie rekrutacyjne

## Przbieg realizacji zadania

1. Przygotowania
- Zapoznanie się z zadaniem.
- Wygenerowanie poglądowego planu realizacji zadania przy pomocy AI.
- Weryfikacja zgodności planu ze specyfikacją zadania.

2. Setup projektu
- Instalacja czystego projektu Laravel.
- W celu ułatwienia uruchomienia projektu wykorzystana będzie baza sqlite.

3. Przygotowanie struktury bazy
- Napisanie modeli wraz z relacjami.
- Na podstawie modeli wygenerowanie z Claude Code migracji oraz factory.
- Poprawa migracji: ograniczenie długości kolumn ze stringiem oraz weryfikacja poprawności relacji, w szczególności kaskadowego usuwania.
- Dodanie Factory do Seedera.
- Wykonanie migracji i zaseedowanie bazy.

4. Obsługa API
- Utworzenie pustych Controllers (korzystając z artisan cli).
- Utworzenie pustych Requests (korzystając z artisan cli).
- Uzupełnienie klas Requests przez Claude Code na podstawie danych z migracji i weryfikacji poprawności.
- Wykonanie php artisan install:api w celu dodania routes z api.php.
- Uzupełnienie metod w AuthorController.
- Wydzielenie logiki biznesowe do klas Service.
- Utworzenie AuthorResource i AuthorCollection.
- Przetestowanie routes w postmanie.
- Na podstawie opracowanego schematu wygenerowanie z Claude Code obsługi api dla modelu Book.
- Przetestowanie routes w postmanie.

5. Obsługa Jobs
- Utworzenie klasy UpdateAuthorLastBookTitleJob.
- Rozszerzenie logiki w BookService.

6. Testy
- Zezwolenie na RefreshDatabase w Pest.php w celu ułatwienia pracy nad zadaniem.
- Wygenerowanie testów z Claude Code.
- Sprawdzenie czy testy pokrywają wszystkie przypadki.

7. Sanctum
- Dodanie grupy z middleware "auth:sanctum" w api.php.
- Uzupełnienie trait HasApiTokens w modelu User.
- Skorygowaniu testów o konieczność uwierzytelniania i dodanie testu na brak tokenu i niepoprawny token.
- Dodanie usera do seeda.
- Dodanie komendy do wygenerowania testowego tokenu.

8. Obsługa search
- Dodanie parametru Request w AuthorController@index.
- Dodanie filtra poprzez relację "books".
- Test parametru serach w postmanie.

9. Komenda dodająca autora
- Utworzenie komendy z artisan make:command.
- Wygenerowanie treści komendy podając prompt do Claude Code.

## Zrealizowane funkcjonalności

Zrealizowano wszystkie wymagane oraz dodatkowe funkcjonalności.

## Instrukcja uruchomienia

dodaj info o artisan serve

1. Pobranie repozytorium lub sklonowanie repozytorium poprzez git clone https://github.com/jklejczyk/300codes.git.
2. Przejście do folderu projektu - cd 300codes/.
3. Instalacja zależności - composer install.
4. Utworzenie pliku bazy danych - touch database/database.sqlite.
5. Utworzenie pliku .env - cp .env.example .env.
6. Wygenerowanie klucza aplikacji - php artisan key:generate.
7. Uruchomienie migracji - php artisan migrate (wcześniej należy zainstalować rozszerzenie php do sqlite jeśli brakuje w systemie -  sudo apt install php-sqlite3).
8. Uzupełnienie bazy danymi testowymi - php artisan db:seed.
9. Uruchomienie aplikacji - php artisan serve.
10. Uruchomienie kolejki - php artisan queue:work.
11. można sprawdzać :)

Do uruchomienia testów: php artisan test.

Do wygenerowania tokenu bearer do testu GET /api/authors: php artisan token:generate.

Do wygenerowania nowego autora: php artisan author:create.

## Dodatkowe uwagi

Na potrzeby zadania założyłem, że możemy dodawać do systemu autorów, którzy nie posiadają jeszcze przypisanych książek, ale do każdej książki należy dołączyć autora.

## Wersja demo

Zadanie dostępne jest również pod adresem https://300codes.rozwiazaniawebowe.pl/
token do testów: 1|51HdpGo5QRn6xT6j8o8iIHTWSMy3RyTomIJcrgSU3f69f16f


