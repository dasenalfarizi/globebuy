<?php

/**
 * File: config/database.php
 * Deskripsi: Koneksi database MySQL menggunakan PDO dan Prepared Statement
 */

class Database
{
    private $host = "localhost";
    private $db_name = "fashion_store";
    private $username = "root"; // Sesuaikan dengan config XAMPP Anda
    private $password = "";     // Sesuaikan dengan config XAMPP Anda
    public $conn;

    public function getConnection()
    {
        $this->conn = null;
        try {
            // DSN string
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8mb4";

            // Opsi PDO untuk keamanan dan error handling yang baik
            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false, // Hindari SQL injection
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $exception) {
            // Catat error ke log internal, jangan tampilkan detail ke user
            error_log("Connection error: " . $exception->getMessage());
            die("Maaf, terjadi masalah koneksi pada database. Silakan coba beberapa saat lagi.");
        }

        return $this->conn;
    }
}
