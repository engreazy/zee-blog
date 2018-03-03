<?php
/**
 * This class stores all the url variables,
 * The controller and action to be called
 * Created by PhpStorm.
 * User: easy Israel
 * Date: 2/23/2018
 * Time: 7:54 AM
 */
namespace Controllers;
use Models\DatabaseAlgorithm;

class ZeeRoutes implements IRoutes
{
    private $postTable;
    private $categoryTable;
    private $usersTable;
    private $authenticator;

    /**
     * ZeeRoutes constructor.
     */
    public function __construct()
    {
        $this->postTable = new DatabaseAlgorithm('post','id','\Models\Entity\Post',[&$this->usersTable,&$this->categoryTable]);
        $this->categoryTable = new DatabaseAlgorithm('category','id','\Models\Entity\Category',[&$this->postTable]);
        $this->usersTable = new DatabaseAlgorithm('users','id','\Models\Entity\User',[&$this->postTable]);
        $this->authenticator = new Authenticator($this->usersTable,'email','password');
    }

    /**
     *returns the url variable and controller
     * upon the type of request made to the server
     */
    public function getRoutes()
    {
        // TODO: Implement getRoutes() method.
        $articleController = new ArticleController($this->postTable,$this->categoryTable,$this->authenticator);
        $categoryController = new CategoryController($this->categoryTable);
        $registerController = new Register($this->usersTable);
        $loginController = new Login($this->authenticator);

        $routes = [
            'zee/home'=>[
                'GET'=>[
                    'controller'=>$articleController,
                    'action'=>'home'
                ]
            ],
            'article/edit'=>[
                'GET'=>[
                    'controller'=>$articleController,
                    'action'=>'editArticle'
                ],
                'POST'=>[
                    'controller'=>$articleController,
                    'action'=>'insertArticle'
                ],
                'login'=>true
            ],
            'article/delete'=>[
                'POST'=>[
                    'controller'=>$articleController,
                    'action'=>'removeArticle'
                ]
            ],
            'article/blog'=>[
                'GET'=>[
                    'controller'=>$articleController,
                    'action'=>'articleList'
                ]
            ],
            'article/list'=>[
                'GET'=>[
                    'controller'=>$articleController,
                    'action'=>'editList'
                ],
                'login'=>true
            ],
            'post/content'=>[
                'GET'=>[
                    'controller'=>$articleController,
                    'action'=>'articlePage'
                ]
            ],
            'category/create'=>[
                'GET'=>[
                    'controller'=>$categoryController,
                    'action'=>'editCategory'
                ],
                'POST'=>[
                    'controller'=>$categoryController,
                    'action'=>'insertData'
                ],
                'login'=>true,
                'permissions'=>\Models\Entity\User::EDIT_CATEGORIES
            ],
            'category/view'=>[
                'GET'=>[
                    'controller'=>$categoryController,
                    'action'=>'categoryList'
                ],
                'login'=>true,
                'permissions'=> \Models\Entity\User::LIST_CATEGORIES
            ],
            'category/delete'=>[
                'POST'=>[
                    'controller'=>$categoryController,
                    'action'=>'removeData'
                ],
                'login'=>true,
                'permissions'=>\Models\Entity\User::REMOVE_CATEGORIES
            ],
            'register/create'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'addUser'
                ],
                'POST'=>[
                    'controller'=>$registerController,
                    'action'=>'registerUser'
                ],
                'login'=>true
            ],
            'account/success'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'accountSuccess'
                ],
                'login'=>true
            ],
            'user/dashboard'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'dashBoard'
                ],
                'login'=>true
            ],
            'client/contact'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'sendMessage'
                ],
                'POST'=>[
                    'controller'=>$registerController,
                    'action'=>'sendMail'
                ]
            ],
            'login/error'=>[
                'GET'=>[
                    'controller'=>$loginController,
                    'action'=>'loginError'
                ]
            ],
            'login'=>[
                'GET'=>[
                    'controller'=>$loginController,
                    'action'=>'loginForm'
                ],
                'POST'=>[
                    'controller'=>$loginController,
                    'action'=>'processLogin'
                ]
            ],
            'user/logout'=>[
                'GET'=>[
                    'controller'=>$loginController,
                    'action'=>'logout'
                ]
            ],
            'user/permissions'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'permissions'
                ],
                'POST'=>[
                    'controller'=>$registerController,
                    'action'=>'savePermissions'
                ],
                'login'=>true,
                'permissions'=>\Models\Entity\User::EDIT_CATEGORIES
            ],
            'user/view'=>[
                'GET'=>[
                    'controller'=>$registerController,
                    'action'=>'userList'
                ],
                'login'=>true,
                'permissions'=>\Models\Entity\User::EDIT_CATEGORIES
            ],
            'user/delete'=>[
                'POST'=>[
                    'controller'=>$registerController,
                    'action'=>'removeUser'
                ]
            ]

        ];
        return $routes;
    }

    /**
     *returns the authenticator object
     * which checks if the current page requires
     * a log-in check or public access view from visitors/users
     */
    public function getAuthenticator()
    {
        // TODO: Implement getAuthenticator() method.
        return $this->authenticator;
    }

    /**
     * checks if the current user has the right permission
     * to access a given page
     * @param $permission
     * @return bool
     */
    public function checkPermission($permission)
    {
        // TODO: Implement checkPermission() method.
        $user = $this->authenticator->getUser();
        return $user[0] && $user[0]->hasPermission($permission) ? true : false;

    }
}