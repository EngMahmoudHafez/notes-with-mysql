<?php

class Connection
{
    public PDO $pdo;
    public function __construct()
    {
        $this->pdo =new PDO('mysql:server=localhost;dbname=notes','root','');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    }
    public function getNotes(){
        $statment=$this->pdo->prepare("SELECT * FROM notes ORDER BY create_date Desc ");
        $statment->execute();
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }
    public function addNote($note)
    {
        $statment=$this->pdo->prepare("INSERT INTO notes (tittle,description)  
                                            VALUES (:tittle,:description)");
        $statment->bindValue('tittle',$note['title'],PDO::PARAM_STR);
        $statment->bindValue('description',$note['description'],PDO::PARAM_STR);

        return $statment->execute();
    }
    public function getNoteById($id){
        $statment=$this->pdo->prepare("SELECT * FROM notes WHERE id = $id");
        $statment->execute();
        return $statment->fetchAll(PDO::FETCH_ASSOC);
    }
    public function updateNote($id,$post){
        $statment=$this->pdo->prepare("UPDATE notes SET tittle=:tittle ,description=:description WHERE id=:id");
        $statment->bindValue('id',$id,PDO::PARAM_STR);
        $statment->bindValue('tittle',$post['title'],PDO::PARAM_STR);
        $statment->bindValue('description',$post['description'],PDO::PARAM_STR);

        return $statment->execute();
    }
    public function removeNote($id)
    {
        $statment=$this->pdo->prepare("DELETE FROM notes WHERE id=:id");
        $statment->bindValue('id',$id,PDO::PARAM_STR);

        return $statment->execute();
    }
}
return new Connection();