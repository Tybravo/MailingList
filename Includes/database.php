<?php
require_once("initialize.php");
require_once("config.php");


class MySQLDatabase {

    private mysqli $connection;
    public string $last_query = '';

    public function __construct() {
        $this->open_connection();
    }

    public function open_connection(): void {
        $this->connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);

        if ($this->connection->connect_error) {
            $this->handle_connection_error("Connection failed: " . $this->connection->connect_error);
        }
    }

    public function close_connection(): void {
        if (isset($this->connection)) {
            $this->connection->close();
            unset($this->connection);
        }
    }

    public function query(string $sql): mysqli_result|false {
        $this->last_query = $sql;
        $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;
    }

    public function escape_value(string $value): string {
        return $this->connection->real_escape_string($value);
    }

    public function insert_id(): int|string {
        return $this->connection->insert_id;
    }

    public function affected_rows(): int {
        return $this->connection->affected_rows;
    }

    public function fetch_array(mysqli_result $result_set): array|null {
        return $result_set->fetch_array(MYSQLI_ASSOC);
    }

    public function num_rows(mysqli_result $result_set): int {
        return $result_set->num_rows;
    }

    private function confirm_query(mysqli_result|false $result): void {
        if (!$result) {
            $this->handle_connection_error("Database query failed.");
        }
    }

    private function handle_connection_error(string $message): void {
        $output = "<div style='margin: auto; margin-top: 60px; width: 900px; border: 1px solid #ddf; background: #eef; min-height: 550px;'>";
        $output .= "<div style='font-size: 14px; background: #2A5779; color: #ffffff; font-size:20px; width: 900px; height: 20px; padding: 6px;'> Connection fail</div>";
        $output .= "<p style='font-size: 12px; padding:10px;'>Please try again later.</p></div>";
        die($output);
    }
}

$database = new MySQLDatabase();
$db = $database;
?>

