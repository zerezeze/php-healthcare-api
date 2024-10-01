<?php
header("Content-Type: application/json; charset=UTF-8");

// Função para ler o arquivo JSON
function lerArquivoJSON() {
    $jsonString = file_get_contents('pacientes.json');
    return json_decode($jsonString, true);
}

// Função para escrever no arquivo JSON
function escreverArquivoJSON($data) {
    $jsonString = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('pacientes.json', $jsonString);
}

// Função para obter o próximo ID disponível
function proximoId($pacientes) {
    $ids = array_column($pacientes, 'id');
    return max($ids) + 1;
}

// Roteamento básico
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];
$uri = explode('/', trim($uri, '/'));

$pacientesData = lerArquivoJSON();
$pacientes = $pacientesData['pacientes'];

switch ($method) {
    case 'GET':
        if (isset($uri[1])) {
            // Buscar paciente específico
            $id = intval($uri[1]);
            $paciente = array_filter($pacientes, function($p) use ($id) {
                return $p['id'] === $id;
            });
            echo json_encode(array_values($paciente)[0] ?? ['erro' => 'Paciente não encontrado']);
        } else {
            // Listar todos os pacientes
            echo json_encode($pacientes);
        }
        break;

    case 'POST':
        // Criar novo paciente
        $novoPaciente = json_decode(file_get_contents('php://input'), true);
        $novoPaciente['id'] = proximoId($pacientes);
        $pacientes[] = $novoPaciente;
        $pacientesData['pacientes'] = $pacientes;
        escreverArquivoJSON($pacientesData);
        echo json_encode(['mensagem' => 'Paciente criado com sucesso', 'paciente' => $novoPaciente]);
        break;

    case 'PUT':
        // Atualizar paciente existente
        if (isset($uri[1])) {
            $id = intval($uri[1]);
            $dadosAtualizados = json_decode(file_get_contents('php://input'), true);
            foreach ($pacientes as &$paciente) {
                if ($paciente['id'] === $id) {
                    $paciente = array_merge($paciente, $dadosAtualizados);
                    $pacientesData['pacientes'] = $pacientes;
                    escreverArquivoJSON($pacientesData);
                    echo json_encode(['mensagem' => 'Paciente atualizado com sucesso', 'paciente' => $paciente]);
                    return;
                }
            }
            echo json_encode(['erro' => 'Paciente não encontrado']);
        }
        break;

    case 'DELETE':
        // Excluir paciente
        if (isset($uri[1])) {
            $id = intval($uri[1]);
            $pacientes = array_filter($pacientes, function($p) use ($id) {
                return $p['id'] !== $id;
            });
            $pacientesData['pacientes'] = array_values($pacientes);
            escreverArquivoJSON($pacientesData);
            echo json_encode(['mensagem' => 'Paciente excluído com sucesso']);
        }
        break;

    default:
        http_response_code(405);
        echo json_encode(['erro' => 'Método não permitido']);
        break;
}
