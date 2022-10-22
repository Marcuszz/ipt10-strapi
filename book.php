<?php
require "vendor/autoload.php";

use GuzzleHttp\Client;

function getBooks() {
    $token = '668e7fb48dfbcd8dcc63c92fffe284df8d0b8e4b65c97e9843ce5f5a82bda14dd349ac4cef3bb31ccfbd61257df4850ced85d7db5084a7be750f1657f2a3c8c051d6d2a130eb59119075e1ea438d0d648570098cb364e47e19348c0769ca04edfc2b92929356faa30746cd4776792fecd2e094adff0422abca2dae54639f2feb';

    try {
        $client = new Client([
            'base_uri' => 'http://localhost:1337/api/'
        ]);
    
        $headers = [
            'Authorization' => 'Bearer ' . $token,        
            'Accept'        => 'application/json',
      ];
  
      $response = $client->request('GET', 'books?pagination[pageSize]=66', [
            'headers' => $headers
      ]);
    
        $body = $response->getBody();
        $decoded_response = json_decode($body);
        return $decoded_response;
    } catch (Exception $e) {
        error_log($e->getMessage());
        echo '<pre>';
        var_dump($e);
    }
    return null; 
}

$books = getBooks();
?>

<html>
    <head>
        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <title>Bible Books</title>
    </head>
    <body>
        <div class = "container">
            <h1 style = "padding-bottom: 20px;">Books List</h1>
            <div class = "row">
                <div class = "col-10">
                    <table class = "table">
                        <tr class = "table-info">
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Author</th>
                            <th scope="col">Category</th>
                        </tr>
                        <?php
                            foreach ($books->data as $bookData) {
                            $book = $bookData->attributes;
                        ?>
                        <tr>
                            <th scope="row"><?php echo $bookData->id; ?></td>
                            <td><?php echo $book->name; ?></td>
                            <td><?php echo $book->author; ?></td>
                            <td><?php echo $book->category; ?></td>
                        </tr>
                        <?php
                        }
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>