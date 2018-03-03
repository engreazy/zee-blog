<?php
/**
 * This controller is responsible
 * for all the article management
 * on zee blog
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 10:59 AM
 */
namespace Controllers;
use Models\DatabaseAlgorithm;

class ArticleController extends  Validator
{
    private $postTable;
    private $categoryTable;
    private $authenticator;

    /**
     * ArticleController constructor.
     * @param DatabaseAlgorithm $postTable
     * @param DatabaseAlgorithm $categoryTable
     * @param Authenticator $authenticator
     */
    public function __construct(DatabaseAlgorithm $postTable, DatabaseAlgorithm $categoryTable, Authenticator $authenticator)
    {
        $this->postTable = $postTable;
        $this->categoryTable = $categoryTable;
        $this->authenticator = $authenticator;
    }

    /**
     * @return array
     */
    public function home()
    {
        $title = 'Zee Blog';
        return ['template'=>'home.html.php','title'=>$title];
    }

    /**
     * adds/updates articles on the blog
     * @return array
     */
    public function insertArticle()
    {
        $article = $_POST;
        $title = 'Add Post';
        if (empty($this->formValidator($article)))
        {
            if(!$_POST['id']){
                $user = $this->getUser();
                $user->addPost($article);
                header('location:?route=article/list');
            }else{
                $this->updatePost($article);
            }
        }else{
            $msg = $this->formValidator($article).' cannot be blank';
            $class = 'warning';
            $categories = $this->categoryTable->displayData();
            return ['template'=>'article.html.php','title'=>$title,
                'variables'=>[
                    'msg'=>$msg,
                    'class'=>$class,
                    'categories'=>$categories
                ]
            ];
        }
    }

    /**
     * displays all articles to the page
     * @return array
     */
    public function articleList()
    {
        $page = isset($_GET['page'])?$_GET['page']:1;
        //calculate the number of pages to offset
        $offset =($page - 1)*10;
        $posts = $this->postTable->displayData('dateposted DESC',10,$offset);
        $title = 'Zee blog';
        $user = $this->getUser();
        $totalPost = $this->postTable->total();
        //calculate the number of pages
        $numPages = ceil($totalPost/10);
        return ['template'=>'blog.html.php','title'=>$title,
            'variables'=>[
                'totalPost'=>$totalPost,
                'posts'=>$posts,
                'user'=>$user,
                'numPages'=>$numPages,
                'currentPage'=>$page
            ]
        ];

    }


    /**
     * gets article data to be updated
     * @return array
     */
    public function editArticle()
    {
        $title = 'Edit Article';
        $user = $this->getUser();
        $categories = $this->categoryTable->displayData();

        $parameters = ['id'=>isset($_GET['id'])?$_GET['id']:''];
        $post = $this->postTable->findDataById($parameters);

        return ['template'=>'article.html.php','title'=>$title,
            'variables'=>[
                'msg'=>'',
                'class'=>'',
                'user'=>$user,
                'post'=>$post,
                'categories'=>$categories
            ]
        ];
    }

    /**
     * This is Page view for an article.
     * displays an article on a single page
     * @return array
     */
    public function articlePage()
    {
        $categories = $this->categoryTable->displayData();

        $parameters = ['id'=>isset($_GET['id'])?$_GET['id']:''];
        $post = $this->postTable->findDataById($parameters);
        $title = $post->title;

        return ['template'=>'content.html.php','title'=>$title,
            'variables'=>[
                'msg'=>'',
                'class'=>'',
                'post'=>$post,
                'categories'=>$categories
            ]
        ];
    }

    /**
     * gets article data to be updated
     * @return array
     */
    public function editList()
    {

        $page = isset($_GET['page'])?$_GET['page']:1;
        //calculate the number of pages to offset
        $offset =($page - 1)*10;
        $posts = $this->postTable->displayData('dateposted DESC',10,$offset);

        $title = 'Zee blog';
        $user = $this->getUser();
        $categories = $this->categoryTable->displayData();
        $totalPost = $this->postTable->total();

        //calculate the number of pages
        $numPages = ceil($totalPost/10);
        return ['template'=>'editList.html.php','title'=>$title,
            'variables'=>[
                'totalPost'=>$totalPost,
                'posts'=>$posts,
                'user'=>$user,
                'categories'=>$categories,
                'numPages'=>$numPages,
                'currentPage'=>$page
            ]
        ];
    }

    /**
     * updates a  blog article/post
     * @param $data
     */
    private function updatePost($data)
    {
        $postId = ['id',$data['id']];
        $posts = $this->postTable->findData($postId);
        $user = $this->getUser();

        if ($user->id !== $posts[0]->userid ){
            header("location:?route=zee/home");
            exit();
        }else{
            $user->addPost($data);
            header('location:?route=article/blog');
        }

    }

    /**
     *deletes an article/post from the blog
     */
    public function removeArticle()
    {
        $parameters = ['id'=>$_POST['id']];
        $post = $this->postTable->findDataById($parameters);
        $user = $this->getUser();

        if ($user->id !== $post->userid && !$user->hasPermission(\Models\Entity\User::DELETE_POST)){
            header('location:?route=zee/home');
            exit();
        }else{
            $this->postTable->removeData($parameters);
            header('location:?route=article/list');
        }
    }


    /**
     * gets the current logged in user data
     * @return mixed
     */
    private function getUser()
    {
        $user = $this->authenticator->getUser();
        return $user[0];
    }

}