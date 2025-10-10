<?php
/*
 * So kannst du diese Datei in anderen Skripten verwenden:
 *
 *     require_once __DIR__ . '/../db/database.php';
 *     $pdo = dbcon(); // Verbindung aufbauen
 */

// 🔧 Verbindungseinstellungen — bitte ggf. anpassen!
const DB_HOST = '10.101.105.110';
const DB_NAME = 'mycompany';
const DB_USER = 'codingstorm';
const DB_PW   = 'passwort';

/**
 * Stellt eine Verbindung zur Datenbank her (nur einmal).
 *
 * @param string $host
 * @param string $dbname
 * @param string $dbuser
 * @param string $dbpass
 * @return PDO
 */
function dbcon(
    string $host = DB_HOST,
    string $dbname = DB_NAME,
    string $dbuser = DB_USER,
    string $dbpass = DB_PW
): PDO {
    static $conn = null;

    if ($conn === null) {
        $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
        $conn = new PDO($dsn, $dbuser, $dbpass, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,     // Fehlermeldungen aktivieren
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Arrays statt Objekte
        ]);
    }

    return $conn;
}

/* =======================================================
   🧩 CRUD-FUNKTIONEN (Beispiel: Tabelle `department`)
   ======================================================= */

/**
 * Liest alle Einträge aus der Tabelle `department`
 *
 * @return array
 */
function findAll(): array
{
    $pdo = dbcon();
    $stmt = $pdo->query("SELECT * FROM department ORDER BY id");
    return $stmt->fetchAll();
}

/**
 * Findet eine Abteilung anhand der ID
 *
 * @param int $id
 * @return array
 */
function findById(int $id): array
{
    $pdo = dbcon();
    $stmt = $pdo->prepare("SELECT * FROM department WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: [];
}

/**
 * Erstellt eine neue Abteilung
 *
 * @param string $name
 * @param bool $hiring
 * @param string $work_mode
 * @return bool
 */
function create(string $name, bool $hiring, string $work_mode): bool
{
    $pdo = dbcon();
    $stmt = $pdo->prepare("
        INSERT INTO department (department_name, hiring, work_mode)
        VALUES (?, ?, ?)
    ");
    return $stmt->execute([$name, $hiring, $work_mode]);
}

/**
 * Aktualisiert eine bestehende Abteilung
 *
 * @param int $id
 * @param string $name
 * @param bool $hiring
 * @param string $work_mode
 * @return bool
 */
function update(int $id, string $name, bool $hiring, string $work_mode): bool
{
    $pdo = dbcon();
    $stmt = $pdo->prepare("
        UPDATE department
        SET department_name = ?, hiring = ?, work_mode = ?
        WHERE id = ?
    ");
    return $stmt->execute([$name, $hiring, $work_mode, $id]);
}

/**
 * Löscht eine Abteilung anhand der ID
 *
 * @param int $id
 * @return bool
 */
function remove(int $id): bool
{
    $pdo = dbcon();
    $stmt = $pdo->prepare("DELETE FROM department WHERE id = ?");
    return $stmt->execute([$id]);
}
