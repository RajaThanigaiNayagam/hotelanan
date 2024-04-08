<?php 
    /*//Recup des info de Connection CLEARDB
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"],1);
    $active_group = 'default';
    $query_builder = TRUE;
    // Connect to DB
    
    try
    {
        $dbh = new PDO("mysql:host=".$cleardb_server.";dbname=".$cleardb_db,$cleardb_username, $cleardb_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }*/

    //Recup des info de Connection JAWSDB
    $Database_url = parse_url(getenv("JAWSDB_URL"));
    $Database_server = $Database_url["host"];
    $Database_username = $Database_url["user"];
    $Database_password = $Database_url["pass"];
    $Database_db = substr($Database_url["path"],1);
    $active_group = 'default';
    $query_builder = TRUE;
    // Connect to DB
    
    try
    {
        $dbh = new PDO("mysql:host=".$Database_server.";dbname=".$Database_db,$Database_username, $Database_password,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    }
    catch (PDOException $e)
    {
        exit("Error: " . $e->getMessage());
    }
?>