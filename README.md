Mocker
======yyxx

###1. Opis aplikacji 
Celem aplikacji jest umo�liwienie u�ytkownikom na wygenerowanie link�w do wcze�niej przygotowanych danych np. json czy xml. Dzi�ki aplikacji mo�liwe b�dzie przygotowanie r�nych odpowiedzi serwera i przetestowanie ich zar�wno przez klient�w mobilnych jak i inne serwery.


###2. Interfejs u�ytkownika
![alt text](https://github.com/kgurgul/mocker/blob/master/info/UI_Interface.png "UI")


###3. U�yte technologie
* J�zyk programowania: PHP
* Framework: Symphony2
* Baza danych: MySQL
* ORM do obs�ugi bazy danych: Doctrine 
* System kontroli wersji: GIT (repozytorium na github.com)
* Interfejs: Bootstrap 


###4. ERD bazy danych 
![alt text](https://github.com/kgurgul/mocker/blob/master/info/ERD.png "ERD")

####mock � pojedyncza odpowied� serwera zadeklarowana przez u�ytkownika
* mockId � id 
* url � link ��dania 
* userId � id u�ytkownika
* responsStatus � kod odpowiedzi 
* createdAt � data utworzenia 
* body � tre�� odpowiedzi 
* blocked � ��danie aktywne lub zablokowane
* deleted � warto�� 1 dla usuni�tego ��dania  
* method - metoda ��dania 

####header � nag��wki dla odpowiedzi z serwera 
* headerId � id
* key � klucz nag��wka 
* value � warto�� nag��wka 
* mockId � id mock`a

####user � tabela u�ytkownik�w (nie u�ywana w tej wersji)
* userId � id
* username � nazwa u�ytkownika 
* password � has�o u�ytkownika 
* email � email u�ytkownika
* createdAt � data utworzenia u�ytkownika 

####code � tabela pomocnicza dla auto propozycji zawieraj�ca list� dost�pnych kod�w odpowiedzi serwera (nie u�ywana w tej wersji)
* codeId � id
* code � kod
* description � opis kodu 


###5. Diagram sekwencji
![alt text](https://github.com/kgurgul/mocker/blob/master/info/Diagram_sekwencji.png "Diagram sekwencji")


###6. Diagram przypadk�w u�ycia
Modu� u�ytkownika jest niezaimplementowany w tej wersji 

![alt text](https://github.com/kgurgul/mocker/blob/master/info/Przypadki_u�ycia.png "Przypadki u�ycia")


###7. Dodatkowe opcje mockowania
Specjalne tagi nale�y opakowywa� wed�ug szablonu: {{nazwa_tagu?opcjonalne_parametry}}

####Dost�pne tagi:
#####Date - wy�wietla aktualn� dat�. 
Dost�pne parametry:
* format - string formatuj�cy aktualn� dat� ([dokumentacja](http://php.net/manual/pl/function.date.php))

Przyk�ady u�ycia:
* {{Date?}} - zwraca dat� z formatowaniem domy�lnym "Y-m-d H:i:s" np. 2015-11-08 22:50:16
* {{Date?format=Y-m-d}} - zwraca dat� z podanym formatowaniem np. "Y-m-d" zwraca 2015-11-08

#####Timestamp - wy�wietla aktualny timestamp. 
Przyk�ady u�ycia:
* {{Timestamp?}} - zwraca np. 1447086090

#####Uuid - wy�wietla unikalny identyfikator. 
Przyk�ady u�ycia:
* {{Uuid?}} - zwraca np. 5640c845b63b6

###8. Live server
[Mocker](http://kgurgul-mockertool.rhcloud.com/)

###9. Konfiguracja projektu (uruchamia� w katalogu z projektem)
* composer install - dogranie potrzebnych zale�no�ci
* php app/console server:run - uruchomienie serwera
* php app/console doctrine:schema:update --force - utworzenie tabel w bazie danych 
* php app/console assets:install - instalowanie plik�w z katalogu Resource (zmiana nazw)
* php app/console assetc:dump - zrzut plik�w z Resource do katalogu web