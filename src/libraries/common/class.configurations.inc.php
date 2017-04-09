<?php
namespace common;

/**
 * category, name, value fields
 */
class configurations
{
	/**
	 * Binds to specific category only
	 *
     * @var string
     */
	private $category;

    /**
     * @var \PDO Connection
     */
	private $connection;

    /**
     * configurations constructor.
     *
     * configurations constructor.
     * @param string $category
     * @throws \Exception
     */
	public function __construct(string $category)
	{
        $this->category = $this->namify($category);

        /**
         * Where is the database file?
         * Do not keep it in publicly accessible area
         */
        $database_file = preg_replace("/\\\\/", "/", dirname(__FILE__)."/configurations.db");
        if($this->database_file($database_file))
        {
            $this->connection = new \PDO("sqlite:{$database_file}"); // success
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }
        else
        {
            throw new \Exception("Install the database first.");
        }
	}

    /**
     * @param string $database_file
     * @return string
     * @throws \Exception
     */
	private function database_file(string $database_file): string
	{
		if(!is_file($database_file))
		{
            // install
            // create?
            $this->install_database($database_file);

            // or,
            // throw new \Exception("Missing database file.");
		}
		
		return realpath($database_file);
	}

    /**
     * @param string $database_file
     */
	private function install_database(string $database_file)
	{
		// create file
		// create table
		// insert sample data
        touch($database_file);
	}
	
	/**
	 * Convert into valid names
	 *
     * @param string $name
     * @return string
     */
	private function namify(string $name): string
	{
		$name = strtoupper($name);
		$name = preg_replace("/[^A-Z0-9]/", "", $name);
		
		return $name;
	}

    /**
     * @param string $name
     * @return string
     */
	public function read(string $name): string
	{
		$name = $this->namify($name);
		
		$sql="SELECT category category, name name, value value FROM configurations WHERE category=:category AND name=:name LIMIT 1;";
		#echo $sql;
		$replacement = array(
			":category" => $this->category, 
			":name" => $name, 
		);
		
		$result = $this->query($sql, $replacement, true);
        #print_r($result);
        return $result[0]["value"]??null;
	}

	/**
	 * @see http://sqlite.org/lang_conflict.html
	 *
     * @param string $name
     * @param $value
     * @return bool
     */
	public function write(string $name, string $value): bool
	{
		if($this->exists($name))
		{
			$this->update($name, $value);
		}
		else
		{
			$this->insert($name, $value);
		}
		
		return true;
	}

    /**
     * Clean up all configurations
     * Do NOT use on live
     */
	public function cleanup()
    {
        $sql="DELETE FROM configurations;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();

        $sql=" VACUUM;";
        $statement = $this->connection->prepare($sql);
        $statement->execute();
    }

    /**
     * @param string $sql
     * @param array $key_value_pair
     * @param bool $return
     * @return array|null
     */
	private function query(string $sql, array $key_value_pair, bool $return)
	{
        $statement = $this->connection->prepare($sql);
		foreach($key_value_pair as $key => $value)
		{
		    #echo "\r\nBinding == {$key} -- {$value}";
			$statement->bindValue($key, $value); // , PDO::PARAM_STR);
		}
        #print_r($key_value_pair);
        #echo $sql, "\r\n";
		$statement->execute();
		
		$result = null;
		if($return)
		{
			$result = $statement->fetchAll(\PDO::FETCH_ASSOC); // PDOStatement
            #print_r($result);
		}

		return $result;
	}

    /**
     * @param string $name
     * @return bool
     */
	private function exists(string $name): bool
	{
		$name = $this->namify($name);

		$sql="SELECT COUNT(*) total FROM configurations WHERE category=:category AND name=:name;";
		$replacement = array(
			":category" => $this->category,
			":name" => $name,
		);
		
		$result = $this->query($sql, $replacement, true);
        #print_r($result);

		# MUST be ONE Record only (1)
		$found = isset($result[0]["total"])?$result[0]["total"] >= 1:false;
        echo "Found? ", $found?"true":"false";
		
		return $found;
	}

    /**
     * @param string $name
     * @param $value
     */
	private function update(string $name, string $value)
	{
		$name = $this->namify($name);

		$sql="UPDATE configurations SET value=:value WHERE category=:category AND name=:name;";
		$replacement = array(
            ":category" => $this->category,
            ":name" => $name,
            ":value" => $value,
		);
		
		$this->query($sql, $replacement, false);
	}

    /**
     * @param string $name
     * @param $value
     */
	private function insert(string $name, $value)
	{
		$name = $this->namify($name);
		
		$sql="INSERT OR REPLACE INTO configurations (category, name, value) VALUES (:category, :name, :value);";
		$replacement = array(
			":category" => $this->category, 
			":name" => $name, 
			":value" => $value, 
		);
		
		$this->query($sql, $replacement, false);
	}
}
