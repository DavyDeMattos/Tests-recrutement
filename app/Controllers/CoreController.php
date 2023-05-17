<?php 

namespace App\Controllers;

abstract class CoreController {

    public $router;

    /** 
    * __construct of CoreCOntroller is automatically lunch when every child is instanced. On every pages, constructor could be execute
    */
    public function __construct($routeName, $router)
    {
    // On range le router reçu d'altodispatcher dans la propriété $this->router. Ainsi, dans tous nos controllers on pourra accéder à cette propriété router et utilise ses outils comme generate
    $this->router = $router;

    /* $acl = [
        
       //! à redéfinir 'main-home' => ['admin', 'catalog-manager']
    ];

    // On vérifie si la route actuelle fait partie des routes protégées (donc si c'est une des clés du tableau)
    if(isset($acl[$routeName])) {

        // On récupère dans le tableau la liste des roles autorisés
        $roles = $acl[$routeName];
    
        // On appele la méthode checkAuthorization qui vérifie que l'utilisateur courant possède bien les roles autorisés
        $this->checkAuthorization($roles);

    }*/

}

    /**
     * Method to show HTML code with views
     *
     * @param string $viewName File vue's name
     * @param array $viewData Array of datas to send to vues
     * @return void
     */
    protected function show(string $viewName, $viewData = [])
    {
        $router = $this->router;
        $viewData['currentPage'] = $viewName;

        // Absolute URL for assets
        $viewData['assetsBaseUri'] = $_SERVER['BASE_URI'] . 'assets/';
        // Absolute URL for assets for website
        // /!\ != here public/
        $viewData['baseUri'] = $_SERVER['BASE_URI'];
    
        // Array to variable
        extract($viewData);
        
        // $viewData is now avaible on each vue file
        require_once __DIR__ . '/../views/layout/header.tpl.php';
        require_once __DIR__ . '/../views/' . $viewName . '.tpl.php';
        require_once __DIR__ . '/../views/layout/footer.tpl.php';
    }

 /**
     * Method to redirect to every page on this application
     *
     * @param string $routeName
     * @return void
     */
    protected function redirect($routeName)
    {
        $url = $this->router->generate($routeName);
        header('Location: ' . $url);
        exit;
    }
}