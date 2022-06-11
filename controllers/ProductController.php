<?php

    namespace app\controllers;
    use app\models\Product;
    use app\Router;
    use app\Database;

    /** Class CONTROLLER */

    class ProductController
    {
        public function index(Router $router)
        {
            // echo "Index page".'<br>';
            
            // echo '<pre>';
            // var_dump($products);
            // echo '</pre>';
        
            $search = $_GET['search'] ?? '';
            $products = $router->db->getProducts($search); 

            $router->renderView('products/index', 
            [
                'products' => $products,
                'search' =>  $search
            ]);
        }

        public function create(Router $router)
        {   
            $errors = [];
            $productData = [
                'title' => '',
                'description' => '',
                'image' => '',
                'price' => '',
            ];

            # Loading data from the $_POST and $_FILES via the controller
            if ($_SERVER['REQUEST_METHOD'] ==='POST') 
            {
                $productData['title'] = $_POST['title'];
                $productData['description'] = $_POST['description'];
                $productData['price'] = (float)$_POST['price'];
                $productData['imageFile'] = $_FILES['image'] ?? null;

                # Instance of the class Product created before
                $product = new Product();
                # Loading into the model
                $product->load($productData);
                $errors = $product->save();
                if(empty($errors))
                {
                header('Location: /products');
                exit;
                }
            }

            $router->renderView('products/create', [
                'product' => $productData,
                'errors' => $errors
            ]);
        }

        public function update(Router $router)
        {
            $id = $_GET['id'] ?? null;
            if(!$id){ header('Location: /products'); exit; }
            $errors = []; 
            $productData = $router->db->getProductById($id);

            if($_SERVER['REQUEST_METHOD'] === 'POST')
            {
                $productData['title'] = $_POST['title'];
                $productData['description'] = $_POST['description'];
                $productData['price'] = (float)$_POST['price'];
                $productData['imageFile'] = $_FILES['image'] ?? null;
                
                # Instance of the class Product created before
                $product = new Product();
                # Loading into the model
                $product->load($productData);
                $errors = $product->save();
                if(empty($errors))
                {
                header('Location: /products');
                exit;
                }
            }

            $router->renderView('products/update', [
                'product'=> $productData,
                'errors' => $errors
            ]);
            # echo "Update page".'<br>';
        }

        public function delete(Router $router)
        {
            $id = $_POST['id'] ?? null;
            if(!$id) { header('Location: /products'); exit; }
            $router->db->deleteProduct($id);
            header('Location: /products');
            # echo "Delete page".'<br>';
        }
    }