# Read Me

## Introduction

Dies ist für das Modul 151, das von Gabriel Varga & Arman-Din Selimovic bearbeitet wird. In diesem Modul besteht unsere Aufgabe darin, eine WebAPI mit php zu erstellen, allerdings ohne ein Frontend. Die Architektur ist der einzige wichtige Teil.

# API

Bei unserer API geht um ein Fussball Transferfenster. Der Spieler Name, sein zurzeitiges Heimclub und der Transferclub wird angezeigt. Dazu noch die Datume & Ablösessume angezeigt. Zusätzlich, gibt es einen Filter für jede Information im Transferfenster.

# Architektur

- PHP
  <br>
    Das Projekt wird, aufgrund der Aufgabenstellung, mit PHP programmiert. Es dürfen auch keine Frameworks verwendet werden ausser die Aufgabenstellung verlangt dies.
- Aufbau
  <br>
    Der Aufbau von unserem Projekt sieht wiefolgt aus:

    Das Projekt wird in verschiedene Dateien unterteilt. Die erste Datei kümmert sich um die Datenbank verbindung. Danach folgt je eine PHP Datei für jede Funktion der API. Das auslesen, bearbeiten, erstellen und löschen der Daten werden auf 4 verschiedene PHP Dateien unterteilt. Damit können wir die Aufgaben jeweils unterteilen und haben damit auch eine bessere Übersicht über das Projekt.

## Thema 1 Native SQL Statements
Bei diesem Thema müssen wir ein WebAPI erstellen mit der Architektur die in der Dokumentation definiert wurden ist.
- Use Case's
  <br>
  Hier ist die Liste von unseren Use Case's für die API:
    - [x] Ein Transfer sollte per TransferId aus der Datenbank geholt werden
    - [x] Wenn man mehrere TransferIds angibt, dann sollten auch mehrere Resultate angezeigt werden.
    - [ ] Wenn "all" angegeben wird, dann sollen alle Resultate angezeigt werden.
    - [x] Man sollte Transfers aus der Datenbank ändern können.
    - [x] Man sollte neue Transfers erfassen können.
    - [x] Man sollte Transfers in der Datenbank löschen können.
    - [ ] Beim Aufrufen von einer Funktion sollte im Fehler fall eine Fehlermeldung angezeigt werden.
- ERM

