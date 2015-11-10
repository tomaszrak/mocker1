Mocker
======yyxx

###1. Opis aplikacji 
Celem aplikacji jest umo¿liwienie u¿ytkownikom na wygenerowanie linków do wczeœniej przygotowanych danych np. json czy xml. Dziêki aplikacji mo¿liwe bêdzie przygotowanie ró¿nych odpowiedzi serwera i przetestowanie ich zarówno przez klientów mobilnych jak i inne serwery.


###2. Interfejs u¿ytkownika
![alt text](https://github.com/kgurgul/mocker/blob/master/info/UI_Interface.png "UI")


###3. U¿yte technologie
* Jêzyk programowania: PHP
* Framework: Symphony2
* Baza danych: MySQL
* ORM do obs³ugi bazy danych: Doctrine 
* System kontroli wersji: GIT (repozytorium na github.com)
* Interfejs: Bootstrap 


###4. ERD bazy danych 
![alt text](https://github.com/kgurgul/mocker/blob/master/info/ERD.png "ERD")

####mock – pojedyncza odpowiedŸ serwera zadeklarowana przez u¿ytkownika
* mockId – id 
* url – link ¿¹dania 
* userId – id u¿ytkownika
* responsStatus – kod odpowiedzi 
* createdAt – data utworzenia 
* body – treœæ odpowiedzi 
* blocked – ¿¹danie aktywne lub zablokowane
* deleted – wartoœæ 1 dla usuniêtego ¿¹dania  
* method - metoda ¿¹dania 

####header – nag³ówki dla odpowiedzi z serwera 
* headerId – id
* key – klucz nag³ówka 
* value – wartoœæ nag³ówka 
* mockId – id mock`a

####user – tabela u¿ytkowników (nie u¿ywana w tej wersji)
* userId – id
* username – nazwa u¿ytkownika 
* password – has³o u¿ytkownika 
* email – email u¿ytkownika
* createdAt – data utworzenia u¿ytkownika 

####code – tabela pomocnicza dla auto propozycji zawieraj¹ca listê dostêpnych kodów odpowiedzi serwera (nie u¿ywana w tej wersji)
* codeId – id
* code – kod
* description – opis kodu 


###5. Diagram sekwencji
![alt text](https://github.com/kgurgul/mocker/blob/master/info/Diagram_sekwencji.png "Diagram sekwencji")


###6. Diagram przypadków u¿ycia
Modu³ u¿ytkownika jest niezaimplementowany w tej wersji 

![alt text](https://github.com/kgurgul/mocker/blob/master/info/Przypadki_u¿ycia.png "Przypadki u¿ycia")


###7. Dodatkowe opcje mockowania
Specjalne tagi nale¿y opakowywaæ wed³ug szablonu: {{nazwa_tagu?opcjonalne_parametry}}

####Dostêpne tagi:
#####Date - wyœwietla aktualn¹ datê. 
Dostêpne parametry:
* format - string formatuj¹cy aktualn¹ datê ([dokumentacja](http://php.net/manual/pl/function.date.php))

Przyk³ady u¿ycia:
* {{Date?}} - zwraca datê z formatowaniem domyœlnym "Y-m-d H:i:s" np. 2015-11-08 22:50:16
* {{Date?format=Y-m-d}} - zwraca datê z podanym formatowaniem np. "Y-m-d" zwraca 2015-11-08

#####Timestamp - wyœwietla aktualny timestamp. 
Przyk³ady u¿ycia:
* {{Timestamp?}} - zwraca np. 1447086090

#####Uuid - wyœwietla unikalny identyfikator. 
Przyk³ady u¿ycia:
* {{Uuid?}} - zwraca np. 5640c845b63b6

###8. Live server
[Mocker](http://kgurgul-mockertool.rhcloud.com/)

###9. Konfiguracja projektu (uruchamiaæ w katalogu z projektem)
* composer install - dogranie potrzebnych zale¿noœci
* php app/console server:run - uruchomienie serwera
* php app/console doctrine:schema:update --force - utworzenie tabel w bazie danych 
* php app/console assets:install - instalowanie plików z katalogu Resource (zmiana nazw)
* php app/console assetc:dump - zrzut plików z Resource do katalogu web