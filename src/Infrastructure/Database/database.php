<?php 
    
    //funciones de conexion
    function connectSqlite($dbname){
        try{
            $db=new PDO('sqlite:'.__DIR__.'/db/'.$dbname);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);

        }catch(PDOEXception $e){
            die($e->getMessage());
        }
        return $db;
    }

    function connectMysql($dsn,$dbuser,$dbpassword){
        try{
           
            $db=new PDO($dsn,$dbuser,$dbpassword);
            $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
        }

        catch(PDOException $e){
            die($e->getMessage());
        }
        return $db;
    }

    //funcion de consulta

    function query(PDO $db,string $query,array $data=null){
        $stmt=$db->prepare($query);
        if($data){
            if(is_array($data)){
                $stmt->execute($data);
            }
        }
        else{
            $stmt->execute();
        }
        $items=$stmt->fetchAll();
        return $items;
    
    }

    function insert($db,$table,$data){
       
       if(is_array($data)){
            $columns=array_keys($data);
            $values=array_values($data); 
            $lista_campos=implode(',',$columns);
          
            $array_parms=[];
            for($i=0;$i<count($data);$i++){
                    $array_parms[]='?';
            }
            $lista_parms=implode(',',$array_parms);
            $sql="INSERT INTO {$table}({$lista_campos}) VALUES({$lista_parms})";
            try{
                $stmt=$db->prepare($sql);
                if($stmt->execute($values)){
                    return true;
                }
                return false;
            }catch(PDOException $e){
                die($e->getMessage());
            }
        }
        else{
            throw new Exception("Exception: No data to insert");
        }
    }
    
    function update(PDO $db,string $table,int $id,array $data){
         
       if(is_array($data)){
        $lista_assign=[];
        foreach($data as $key=>$value){
            $lista_assign[]=$key.'=?';
        }
        $lista_assign=implode(',',$lista_assign);
        $sql="UPDATE  {$table} SET {$lista_assign} WHERE id={$id}";
        try{ 
            $stmt=$db->prepare($sql);
           
            if($stmt->execute(array_values($data))){
                return true;
            }
            return false;
        }catch(PDOException $e){
            die($e->getMessage());
        }
    }
    else{
        throw new Exception("Exception: No data to modify");
    }
}
      
    

    function delete(PDO $db,string $table,int $id){
       
        $sql="DELETE FROM {$table} WHERE id=?";
        try{
                $stmt=$db->prepare($sql);
            if($stmt->execute([$id])){
                return true;
            }
            else return false;
        }catch(PDOException $e){
            return false;
        }
       
    }

