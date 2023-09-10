<?php

include_once("../Services/ContactService.php");
include_once("../Models/Contacts.php");
include_once("../utils/Regex.php");

class ContactsController
{
  private $service;
  private $regex;

  public function __construct()
  {
    $this->service = new ContactsService();
    $this->regex = new Regex();
  }

  public function handleRequest()
  {
    switch ($_SERVER['REQUEST_METHOD']) {
      case 'GET':

        //obtener id en case de solo mostrar un usuario
        if (isset($_GET['id'])) {
          $id = $_GET['id'];
        } else {
          $id = null;
        }

        // Transformar array Contactos a JSON e enviarlo
        echo json_encode($this->service->getContacts($id));
        break;


      case 'POST':
        $_POST = json_decode(file_get_contents('php://input'), true);

        // Validaciones de campos con  los metodos de la clase Regex
        if (!isset($_POST['firstName']) || !isset($_POST['lastName']) || !isset($_POST['email']) || !isset($_POST['phone'])) {
          http_response_code(400);
          $result = json_encode([
            "status" => 400,
            "message" => "Todos los campos son requeridos"
          ]);
          echo $result;
          break;
        }

        if (!$this->regex->validateName($_POST['firstName']) || !$this->regex->validateName($_POST['lastName'])) {
          http_response_code(400);
          $result = json_encode([
            "status" => 400,
            "message" => "El nombre y apellido solo pueden contener letras y espacio, y deben tener entre 1 y 60 caracteres"
          ]);
          echo $result;
          break;
        }

        if (!$this->regex->validateEmail($_POST['email'])) {
          http_response_code(400);
          $result = json_encode([
            "status" => 400,
            "message" => "El email no es valido y debe tener entre 1 y 120 caracteres"
          ]);
          echo $result;
          break;
        }

        if (!$this->regex->validatePhone($_POST['phone'])) {
          http_response_code(400);
          $result = json_encode([
            "status" => 400,
            "message" => "El telefono no es valido y debe tener 12 caracteres"
          ]);
          echo $result;
          break;
        }

        if (isset($_POST['extraPhone']) && !$this->regex->validatePhone($_POST['extraPhone'])) {
          http_response_code(400);
          $result = json_encode([
            "status" => 400,
            "message" => "El telefono extra no es valido y debe tener 12 caracteres"
          ]);
          echo $result;
          break;
        }


        // Si pasa todas las validaciones, se crea el contacto
        $contact = new Contacts($_POST);
        http_response_code(201);
        echo json_encode($this->service->createContact($contact));
        break;

      case 'PUT':
        $_PUT = json_decode(file_get_contents('php://input'), true);

        // Validaciones de campos con  los metodos de la clase Regex
        if (!isset($_PUT['id']) || !isset($_PUT['firstName']) || !isset($_PUT['lastName']) || !isset($_PUT['email']) || !isset($_PUT['phone']) || !isset($_PUT['extraPhone'])) {
          http_response_code(400);
          $result = json_encode([
            "status" => 400,
            "message" => "Todos los campos son requeridos (Incluyendo el id y telefono extra si se desea actualizar)"
          ]);
          echo $result;
          break;
        }

        if (!$this->regex->validateName($_PUT['firstName']) || !$this->regex->validateName($_PUT['lastName'])) {
          http_response_code(400);
          $result = json_encode([
            "status" => 400,
            "message" => "El nombre y apellido solo pueden contener letras y espacio, y deben tener entre 1 y 60 caracteres"
          ]);
          echo $result;
          break;
        }

        if (!$this->regex->validateEmail($_PUT['email'])) {
          http_response_code(400);
          $result = json_encode([
            "status" => 400,
            "message" => "El email no es valido y debe tener entre 1 y 120 caracteres"
          ]);
          echo $result;
          break;
        }

        if (!$this->regex->validatePhone($_PUT['phone'])) {
          http_response_code(400);
          $result = json_encode([
            "status" => 400,
            "message" => "El telefono no es valido y debe tener 12 caracteres"
          ]);
          echo $result;
          break;
        }

        if (!$this->regex->validatePhone($_PUT['extraPhone'])) {
          http_response_code(400);
          $result = json_encode([
            "status" => 400,
            "message" => "El telefono extra no es valido y debe tener 12 caracteres"
          ]);
          echo $result;
          break;
        }

        $contact = new Contacts($_PUT);
        http_response_code(200);
        echo json_encode($this->service->updateContact($contact));


        break;
        case 'DELETE':
          // Obtener el ID del parámetro de la URL
          $id = isset($_GET['id']) ? $_GET['id'] : null;
      
          if ($id === null || !$this->regex->validateId($id)) {
              http_response_code(400);
              echo json_encode([
                  "status" => 400,
                  "message" => "El ID es requerido y solo se permiten numeros"
              ]);
              break;
          }
          
          http_response_code(200);
          echo json_encode($this->service->deleteContact($id));
          break;

      default:
        echo 'Esta API solo maneja los metodos GET, POST, PUT y DELETE';
        break;
    }
  }
}

$controller = new ContactsController();
$controller->handleRequest();
