<?php

enum SqlOrderType: string {
    case ASC = "ASC";
    case DESC = "DESC";
}

class BaseModel {
    const TABLE_NAME = "";
    public int $id;
    private mysqli $db;

    function __construct()
    {
        global $_db;
        $this->db = $_db;
    }

    private function get_table_name(): string 
    {
        return $this::TABLE_NAME;
    }

    public function insert(): void 
    {
        $vars = get_object_vars($this);
        unset($vars['db']);

        $field_names = array_keys($vars);
        $fields = implode(",", $field_names);
        $values = implode("', '", $vars);
        $table_name = $this->get_table_name();

        $sql = "INSERT INTO $table_name ($fields) VALUES ('$values')";
        if ($this->db->query($sql) === TRUE) {
            $this->id = $this->db->insert_id;
        }
    }

    public function save(): void 
    {
        $vars = get_object_vars($this);
        unset($vars['db']);
        unset($vars['id']);

        $params = "";
        foreach ($vars as $key => $value) {
            $params .= "$key='$value', ";
        }
        $params = rtrim($params, ', ');
        $table_name = $this->get_table_name();

        $sql = "UPDATE $table_name SET $params WHERE id = $this->id";
        $this->db->query($sql);
    }

    public function delete(): void 
    {
        $table_name = $this->get_table_name();
        $sql = "DELETE FROM $table_name WHERE id = $this->id";
        $this->db->query($sql);
    }

    public static function delete_all(): void 
    {
        global $_db;
        $table_name = static::TABLE_NAME;
        $sql = "DELETE FROM $table_name";
        $_db->query($sql);
    }

    /**
     * @return static[]
     */
    public static function select_many(
        string|null $condition = null, 
        string|null $order_field = null, 
        SqlOrderType $order_type = SqlOrderType::ASC,
        int|null $limit = null
    ): array 
    {
        global $_db;

        $table_name = static::TABLE_NAME;
        $sort = $order_type->value;
        
        $sql = "SELECT * FROM $table_name";
        if ($condition != null) $sql .= " WHERE $condition";
        if ($order_field != null) $sql .= " ORDER BY $order_field $sort";
        if ($limit != null) $sql .= " LIMIT $limit";

        $result = $_db->query($sql);
        $objects = [];
        $class_name = get_called_class();
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $obj_id = $row['id'];
                unset($row['id']);
                $object = new $class_name(...array_values($row));
                $object->id = $obj_id;
                $objects[] = $object;
            }
        }
        
        return $objects;
    }

    /**
     * @return static
     */
    public static function select_one(string|null $condition = null): static 
    {
        $class_name = get_called_class();
        $objs = $class_name::select_many(condition: $condition, limit: 1);
        if (array_key_exists(0, $objs)) return $objs[0];
        else return null;
    }

    /**
     * @return static[]
     */
    public static function all(): array 
    {
        $class_name = get_called_class();
        $objs = $class_name::select_many();
        return $objs;
    }

    /**
     * @return static
     */
    public static function get(int $id): static|null
    {
        $class_name = get_called_class();
        $objs = $class_name::select_many(condition: "id = $id", limit: 1);
        if (array_key_exists(0, $objs)) return $objs[0];
        else return null;
    }

}

?>