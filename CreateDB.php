<?php


class CreateDb
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;


    // class constructor
    public function __construct(
        $dbname = "Newdb",
        $tablename = "Productdb",
        $servername = "localhost",
        $username = "root",
        $password = ""
    )
    {
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->username = $username;
        $this->password = $password;

        // create connection
        $this->con = mysqli_connect($servername, $username, $password);

        // Check connection
        if (!$this->con) {
            die("Connection failed : " . mysqli_connect_error());
        }

        // query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        // execute query
        if (mysqli_query($this->con, $sql)) {

            $this->con = mysqli_connect($servername, $username, $password, $dbname);

            // sql to create new table
            $sql = " CREATE TABLE IF NOT EXISTS $tablename
                            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                             product_name VARCHAR (25) NOT NULL,
                             product_price FLOAT,
                             product_image VARCHAR (100),
                             product_cat VARCHAR (25)
                            );";

            if (!mysqli_query($this->con, $sql)) {
                echo "Error creating table : " . mysqli_error($this->con);
            }

        } else {
            return false;
        }
    }

    // get product from the database
    public function getData()
    {
        $sql = "SELECT * FROM $this->tablename";

        $result = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

    public function getData1()
    {
        $sql = "SELECT * FROM $this->tablename WHERE product_cat = 'Bread'";

        $result = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

    public function getData2()
    {
        $sql = "SELECT * FROM $this->tablename WHERE product_cat = 'Drink'";

        $result = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

    public function getData3()
    {
        $sql = "SELECT * FROM $this->tablename WHERE product_cat = 'Snack'";

        $result = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

    public function getData4()
    {
        $sql = "SELECT * FROM $this->tablename WHERE product_cat = 'Candy'";

        $result = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

    public function getData5()
    {
        $sql = "SELECT * FROM $this->tablename WHERE product_cat = 'Credit'";

        $result = mysqli_query($this->con, $sql);

        if (mysqli_num_rows($result) > 0) {
            return $result;
        }
    }

}