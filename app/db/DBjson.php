<?php

declare(strict_types=1);

namespace App\db;

use App\db\interfaces\DB;
use App\php\utils\hashing\Hash;


class DBjson implements DB
{
    //в нормальной разработке я не буду грузить всю бд в переменную конечно.
    private $db = [];

    public function __construct()
    {
        $this->load();
    }

    public function load(): void
    {
        $this->db = [];

        $dbString = file_get_contents(ROOT . "/db/db.json");

        $this->db = json_decode($dbString, true);
    }

    public function save(): bool
    {
        $str = json_encode($this->db);
        $result = file_put_contents(ROOT . "/db/db.json", $str);
        if (!$result) return false;
        return true;
    }

    public function addItem(array $items = []): bool
    {
        $id = bin2hex(random_bytes(8));
        $items['id'] = $id;
        $hashKey = $items["email"] . "|" . $items["login"];
        $items['password'] = Hash::hash('md5', $items['password'], SALT);



        try {
            $this->db[$hashKey] = $items;
            return $this->save();
        } catch (\Throwable $e) {
            return false;
        }
    }

    public function isRecordExists(string $email = '', string $login = ''): bool
    {
        $hashKey = $email . "|" . $login;

        if (isset($this->db[$hashKey])) {
            return true;
        }
        return false;
    }


    public function checkRecordField(string $type = "", string $valueToCkech = '', string $email = '', string $login = ''): bool
    {
        $hashKey = $email . "|" . $login;
        if ($type == 'password') {
            $valueToCkech = Hash::hash('md5', $valueToCkech, SALT);
        }
        if ($this->db[$hashKey][$type] !== $valueToCkech) {
            return false;
        }

        return true;
    }
}
