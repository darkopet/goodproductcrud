<?php
    namespace app;
    use PDO;
    use app\models\Product;

    class Database
    {
        public \PDO $pdo;
        public static Database $db;
        public function __construct() # CONSTRUCT the database connection
        {
            # DSN string = defines the connection string of the database
            $this->pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=products_crud', 'phpmyadmin', 'phpmyadmindb00+--+');
            # If the connection to the database is not succesfull:
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            self::$db = $this;
        }

        public function getProducts($search = '') # GET PRODUCTS from the database via quering to select & fetching the database content
        {
            $search = $_GET['search'] ?? '';
            if($search) {
                # Query in the database in order to select products depending on searched word:
                $statement = $this->pdo->prepare('SELECT * FROM products_good WHERE title LIKE :title ORDER BY create_date ASC');
                $statement->bindValue(':title', "%$search%");
            } else {
                # Query in the database in order to select products:
                $statement = $this->pdo->prepare('SELECT * FROM products_good ORDER BY create_date ASC');
            }

            # Make the query 
            $statement->execute();
            # Fetching
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }
    

        public function getProductById($id)
        {
            $statement = $this->pdo->prepare('SELECT * FROM products_good WHERE id = :id');
            $statement->bindValue(':id',$id);
            $statement->execute();
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        public function createProduct(Product $product)
        {
            # Make an insert to the database of the superglobal $_POST data
            $statement = $this->pdo->prepare("INSERT INTO products_good (title, image, description, price, create_date) 
                                              VALUES (:title, :image, :description, :price, :date)");
                # Make the change in the database
                $statement->bindValue(':title', $product->title);
                $statement->bindValue(':image', $product->imagePath);  
                $statement->bindValue(':description', $product->description);
                $statement->bindValue(':price', $product->price);
                $statement->bindValue(':date', date('Y-m-d H:i:s'));
                $statement->execute();
        }

        public function updateProduct(Product $product)
        {
                # Make an insert to the database of the superglobal $_POST data
                $statement = $this->pdo->prepare("UPDATE products_good SET title=:title, image=:image, description=:description, price=:price WHERE id = :id");
                # Make the change in the database
                $statement->bindValue(':title', $product->title);
                $statement->bindValue(':image', $product->imagePath);
                $statement->bindValue(':description', $product->description);
                $statement->bindValue(':price', $product->price);
                $statement->bindValue(':id', $product->id);
                $statement->execute();
        }

        public function deleteProduct($id)
        {
            $statement = $this->pdo->prepare('DELETE FROM products_good WHERE id=:id');
            $statement->bindValue(':id',$id);
            $statement->execute();
        }
    }   