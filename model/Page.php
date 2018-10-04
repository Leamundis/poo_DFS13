<?php
namespace Model;
use Model\Model as Model;

class Page extends Model
{
    protected $table = "pages"; 
    function __construct()
    {
        parent::__construct();
    }


    public function getAllTitle()
    {
        $sql = 'SELECT title FROM pages WHERE title NOT IN ("error")';
        $request = $this->dbConnec->prepare($sql);
        $request->execute();
        $result = $request->fetchAll();
        if ($result !== null) {
            return $result;
        } else {
            return false;
        }
    }

    public function savePage()
    {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        //$sql = 'UPDATE pages SET title =' . $title . ', content=' . $content . ' WHERE id= :id';
        $sql = 'UPDATE pages SET title =:title, content=:content WHERE id= :id';
        
        //var_dump($sql); die;

        $request = $this->dbConnec->prepare($sql);
        $request->execute(['id' => $id, 'title' => $title, 'content' => $content]);
        header('Location: /home');
    }
}