<?php
header('Content-Type: application/json');
require '../config/database.php';

$method = $_SERVER['REQUEST_METHOD'];
$cep    = $_GET['cep'] ?? null;
$body   = json_decode(
    file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        $cep = preg_replace('/\D/', '', $cep);
        $stmt = $pdo->prepare(
            'SELECT * FROM endereco
            WHERE REPLACE(cep, "-", "")=?'
        );
        $stmt->execute([$cep]);
        $result = $stmt->fetch();
        echo json_encode($result ?: ['erro' => 'CEP não encontrado']);
        break;

    case 'POST':
        $cep        = preg_replace('/\D/', '', $body['cep'] ?? '');
        $logradouro = $body['logradouro'] ?? null;
        $bairro     = $body['bairro']     ?? null;
        $cidade     = $body['cidade']     ?? null;
        $estado     = $body['estado']     ?? null;
        $pais       = $body['pais']       ?? 'Brasil';

        if (strlen($cep) !== 8) {
            http_response_code(400);
            echo json_encode(['erro' => 'CEP inválido']);
            break;
        }

        $stmt = $pdo->prepare(
            'INSERT INTO endereco (cep, logradouro, bairro, cidade, estado, pais)
             VALUES (?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([$cep, $logradouro, $bairro, $cidade, $estado, $pais]);
        http_response_code(201);
        echo json_encode(['mensagem' => 'CEP cadastrado com sucesso', 'id' => $pdo->lastInsertId()]);
        break;

    case 'PUT':
        $cep        = preg_replace('/\D/', '', $body['cep'] ?? '');
        $logradouro = $body['logradouro'] ?? null;
        $bairro     = $body['bairro']     ?? null;
        $cidade     = $body['cidade']     ?? null;
        $estado     = $body['estado']     ?? null;
        $pais       = $body['pais']       ?? null;

        if (strlen($cep) !== 8) {
            http_response_code(400);
            echo json_encode(['erro' => 'CEP inválido']);
            break;
        }

        $stmt = $pdo->prepare(
            'UPDATE endereco
             SET logradouro=?, bairro=?, cidade=?, estado=?, pais=?
             WHERE REPLACE(cep, "-", "")=?'
        );
        $stmt->execute([$logradouro, $bairro, $cidade, $estado, $pais, $cep]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['erro' => 'CEP não encontrado']);
            break;
        }
        echo json_encode(['mensagem' => 'CEP atualizado com sucesso']);
        break;

    case 'DELETE':
        $cep = preg_replace('/\D/', '', $cep ?? ($body['cep'] ?? ''));

        if (strlen($cep) !== 8) {
            http_response_code(400);
            echo json_encode(['erro' => 'CEP inválido']);
            break;
        }

        $stmt = $pdo->prepare(
            'DELETE FROM endereco
             WHERE REPLACE(cep, "-", "")=?'
        );
        $stmt->execute([$cep]);

        if ($stmt->rowCount() === 0) {
            http_response_code(404);
            echo json_encode(['erro' => 'CEP não encontrado']);
            break;
        }
        echo json_encode(['mensagem' => 'CEP removido com sucesso']);
        break;
}
