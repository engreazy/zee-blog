<?php
/**
 * This controller is responsible
 * for all the category management
 * on zee blog
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 7:42 PM
 */
namespace Controllers;
use Models\DatabaseAlgorithm;
class CategoryController extends Validator
{
    private $categoryTable;

    /**
     * CategoryController constructor.
     * @param DatabaseAlgorithm $categoryTable
     */
    public function __construct(DatabaseAlgorithm $categoryTable)
    {
        $this->categoryTable = $categoryTable;
    }

    /**
     * gets category data to be updated
     * @return array
     */
    public function editCategory()
    {
        $parameters = ['id'=> isset($_GET['id'])?$_GET['id']:''];
        $category = $this->categoryTable->findDataById($parameters);
        $title = 'Edit Category';
        return ['template'=>'category.html.php','title'=>$title,
            'variables'=>[
                'msg'=>'',
                'class'=>'',
                'category'=>isset($category)?$category:null
            ]
            ];
    }

    /**
     * adds/updates a category on the blog
     * @return array
     */
    public function insertData()
    {
        $category = $_POST;
        $title = 'Add Category';
        if (empty($this->formValidator($category)))
        {
            if(!$category['id'])
            {
                $this->categoryTable->dataEntry($category);
                $category['msg'] = 'new category added successfully';
                $category['class'] = 'success';
                return['template'=>'category.html.php','title'=>$title,'variables'=>$category];
            }else{
                $this->updateData($category);
            }
        }else{
            $category['msg'] = $this->formValidator($category).' cannot be blank';
            $category['class'] = 'warning';
            return ['template'=>'category.html.php','title'=>$title,'variables'=>$category];
        }
    }

    /**
     * displays all categories on the blog
     * @return array
     */
    public function categoryList()
    {
        $page = isset($_GET['page'])?$_GET['page']:1;
        //calculate the number of pages to offset
        $offset =($page - 1)*10;
        $categories = $this->categoryTable->displayData('id DESC',10,$offset);
        $title = 'Categories';
        $totalPost = $this->categoryTable->total();
        //calculate the number of pages
        $numPages = ceil($totalPost/10);
        return ['template'=>'categories.html.php',
            'title'=>$title,'variables'=> [
                    'categories'=>$categories,
                    'totalPost'=>$totalPost,
                    'numPages'=>$numPages,
                    'currentPage'=>$page
                ]
        ];
    }

    /**
     *updates a  category data
     */
    public function updateData()
    {
        $data = $_POST;
        $this->categoryTable->updateData($data);
        header('location:index.php?route=category/view');
    }

    /**
     *deletes an category
     */
    public function removeData()
    {
        $parameters = ['id'=>$_POST['id']];
        $this->categoryTable->removeData($parameters);
        header("Location:?route=category/view");
    }
}