<?php 
namespace App\Controller;


use Core\Database\QueryBuilder;

/**
 *@package DemoController
 *@http://blog.loc/index.php?p=demo.index
*/
class DemoController  extends AppController
{
 
        public function index()
        {

            require ROOT . '/Query.php';
            
            echo \Query::select('id', 'title', 'content')
                       ->where('id = 1')
                       ->where('Post.category_id = 1')
                       ->where('Post.date > NOW()')
                       ->from('articles', 'Post');
        }

}