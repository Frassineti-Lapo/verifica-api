<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController
{
  public function index(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM alunni");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function view(Request $request, Response $response, $args)
  {
  $id = $args['id'];
  $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
  $result = $mysqli_connection->query("SELECT * FROM alunni WHERE id=$id");
  $results = $result->fetch_all(MYSQLI_ASSOC);

  $response->getBody()->write(json_encode($results));
  return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function create(Request $request, Response $response, $args)
  {
    $body = json_decode($request->getBody());
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $query = "INSERT INTO alunni (nome, cognome) VALUES ('$body->nome', '$body->cognome');";
    $mysqli_connection->query($query) or die ('Unable to execute query. '. mysqli_error($query));
    $response->getBody()->write(json_encode(array("msg" => "ok")));
    return $response->withStatus(201);
  }

  public function update(Request $request, Response $response, $args)
  {
    $id = $args['id'];
    $body = json_decode($request->getBody());
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $query = "UPDATE alunni SET nome = '$body->nome', cognome= '$body->cognome' WHERE id = $id;";
    $mysqli_connection->query($query) or die ('Unable to execute query. '. mysqli_error($query));
    return $response->withStatus(204);
  }

  public function delete(Request $request, Response $response, $args)
  {
    $id = $args['id'];
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $mysqli_connection->query("DELETE FROM alunni WHERE id='$id';") or die ('Unable to execute query. '. mysqli_error($query));
    return $response->withStatus(204);
  }

}