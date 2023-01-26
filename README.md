# Read Me

## Introduction

Dies ist für das Modul 151, das von Gabriel Varga & Arman-Din Selimovic bearbeitet wird. In diesem Modul besteht unsere Aufgabe darin, eine WebAPI mit php zu erstellen, allerdings ohne ein Frontend. Die Architektur ist der einzige wichtige Teil.

# API

Bei unserer API geht es um ein Fussball Transferfenster. Der Spieler Name, sein zurzeitiges Heimclub und der Transferclub wird angezeigt. Dazu noch die Datume & Ablösessume angezeigt. Dazu kann man auch selber einen neuen Transfer erfassen, einen vorhandenen bearbeiten oder auch einen vorhandenen Entfernen. Das gleiche ist auch möglich mit den Spielern und Teams. Diese kann man ebenfalls anschauen, bearbeiten, neu erstellen oder auch löschen.

# Vorgehensweise

Zusammen haben wir uns die Aufgaben unterteilt, jedoch haben wir bei den meisten "Extreme Programming" angewendet. Bei diesem "Extreme Programming" handelt es sich um "Pair Programming".

# Architektur

- PHP
  <br>
    Das Projekt wird, aufgrund der Aufgabenstellung, mit PHP programmiert. Es dürfen auch keine Frameworks verwendet werden, ausser die Aufgabenstellung verlangt dies explizit.
- Aufbau
  <br>
    Der Aufbau von unserem Projekt sieht folgendes aus:

    Das Projekt wird in verschiedene Themen unterteilt. Die erste Datei kümmert sich um die Datenbank verbindung. Danach folgt je ein Controller und ein Model für jede Funktion der API. Das auslesen, bearbeiten, erstellen und löschen der Daten werden auf 4 verschiedene PHP Dateien unterteilt. Dies wird gemacht für die Transfers, Spieler und Teams. Insgesamt werden es dann 12 Controller und 12 Models sein. Die Models rufen eine Methode von Controller auf, welche mit der Datenbank kommuniziert und dann auch die Datenbankabfragen ausführt. Je nach dem was ausgeführt wird, bekommt man dann auch ein Resultat oder nur eine Meldung ob ein Fehler aufgetreten ist oder nicht. Die Queries werden in der Datei definiert, für die jeweilige Funktion (get, delete, put, post) Hier ist noch eine kleine Darstellung wie unsere Architektur aussieht:
    
![M151_Architecture](https://user-images.githubusercontent.com/91592508/214017628-a6be0515-f318-4604-9720-25a11f16b6e4.png)

## Thema 1 Native SQL Statements
Bei diesem Thema müssen wir ein WebAPI erstellen mit der Architektur die in der Dokumentation definiert wurden ist.
- Use Case's
  <br>
  Hier ist die Liste von unseren Use Case's für die API:
  - Transfers:
    - [x] Ein Transfer sollte per TransferId aus der Datenbank geholt werden
    - [x] Wenn man mehrere TransferIds angibt, dann sollten auch mehrere Resultate angezeigt werden.
    - [x] Wenn "all" angegeben wird, dann sollen alle Resultate angezeigt werden.
    - [x] Man sollte Transfers aus der Datenbank ändern können.
    - [x] Man sollte neue Transfers erfassen können.
    - [x] Man sollte Transfers in der Datenbank löschen können.
  - Spieler:
    - [x] Ein Spieler sollte per SpielerId aus der Datenbank geholt werden
    - [x] Wenn man mehrere SpielerIds angibt, dann sollten auch mehrere Resultate angezeigt werden.
    - [x] Wenn "all" angegeben wird, dann sollen alle Resultate angezeigt werden.
    - [x] Man sollte Spieler aus der Datenbank ändern können.
    - [x] Man sollte neue Spieler erfassen können.
    - [x] Man sollte Spieler in der Datenbank löschen können.
  - Team:
    - [x] Ein Team sollte per TeamId aus der Datenbank geholt werden
    - [x] Wenn man mehrere TeamIds angibt, dann sollten auch mehrere Resultate angezeigt werden.
    - [x] Wenn "all" angegeben wird, dann sollen alle Resultate angezeigt werden.
    - [x] Man sollte Teams aus der Datenbank ändern können.
    - [x] Man sollte neue Teams erfassen können.
    - [x] Man sollte Teams in der Datenbank löschen können.
  - [x] Beim Aufrufen von einer Funktion sollte im Fehler fall eine Fehlermeldung angezeigt werden.
## ERM

![M151_ERD](https://user-images.githubusercontent.com/91592508/213154819-a1454509-eded-47bf-9393-479924badfc6.png)

## Fazit

Im Allgemeinen gab es nie grosse Probleme beim Bearbeiten dieses Projektes. Wir kamen immer schnell voran und musste nie wirklich Hilfe suchen. Am Anfang hatten wir jedoch Schwierigkeiten, da keiner von uns viel PHP Erfahrung hatte und noch nie eine API selbst erstellt hat. Doch wir konnten diese Hürden schnell überwinden. In Zukunft wissen wir nun von Anfang an, wie man ein PHP API Projekt starten sollte. Dazu können wir später uns auf wichtigere Punkte fokussieren, anstatt Nebensachen, die wir bei diesem Projekt angetroffen haben.