<?php
namespace Core;
class Model{
    private $table;
    public function __construct($table=''){
        if($table!=''){
            $this->table=$table;
        }else{
           $this->table=substr(basename(get_class($this)),0,-5);
        }
        echo $this->table.'<br>';
    }
}

namespace Model;
class ProductsModel extends \Core\Model{
    
}
namespace Controller\Admin;
new \Core\Model('news');
new \Model\ProductsModel();
?>