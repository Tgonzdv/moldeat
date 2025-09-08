<?php
// Recibe items y masa por POST y llama a OpenAI para generar la historia
header('Content-Type: application/json');
require_once 'constants.php';

$debug = isset($_GET['debug']) || isset($_POST['debug']);








// Cambiado a Groq - Necesitas obtener tu API key gratis en groq.com
$apiKey = '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';







$items = isset($_POST['items']) ? $_POST['items'] : [];
$masa = isset($_POST['masa']) ? $_POST['masa'] : '';

 

if (!is_array($items)) {
    $items = explode(',', $items);
}

$itemNames = MoldeatConstants::processItemNames($items);







//Promp que se envía a Groq (Llama3)
$prompt = "Crea una historia corta y creativa en español de máximo 150 palabras sobre un personaje hecho de plastilina que tiene estos objetos mágicos: " . implode(', ', $itemNames) . ". La historia debe ser divertida, imaginativa y explicar cómo cada objeto le ayuda en una aventura. Usa un tono narrativo similar a un cuento infantil pero con un toque de fantasía épica. La historia debe comenzar con 'Cada mañana, te despiertas junto al mar' y debe ser coherente con el mundo de plastilina moldeada.";







 

$url = 'https://api.groq.com/openai/v1/chat/completions';
$data = [
    'model' => 'llama-3.1-8b-instant', // Modelo actualizado de Groq
    'messages' => [
        [
            'role' => 'user',
            'content' => $prompt
        ]
    ],
    'max_tokens' => 200,
    'temperature' => 0.8
];

$options = [
    'http' => [
        'header'  => "Content-Type: application/json\r\nAuthorization: Bearer $apiKey\r\n",
        'method'  => 'POST',
        'content' => json_encode($data),
        'timeout' => 20
    ]
];
$context  = stream_context_create($options);
$result = @file_get_contents($url, false, $context);

if ($debug) {
    echo "Respuesta HTTP de Groq:\n";
    if ($result === FALSE) {
        echo "ERROR: No se pudo conectar con Groq\n";
        echo "Headers HTTP: " . print_r($http_response_header ?? [], true) . "\n";
    } else {
        echo "Respuesta completa: " . $result . "\n\n";
    }
}

if ($result === FALSE) {
    // Fallback
    $story = MoldeatConstants::getFallbackStory($itemNames);
    echo json_encode(['story' => $story, 'fallback' => true]);
    exit;
}

$response = json_decode($result, true);
if (isset($response['choices'][0]['message']['content'])) {
    $story = trim($response['choices'][0]['message']['content']);
    if ($debug) {
        echo "Historia generada por Groq (Llama3):\n" . $story . "\n\n";
        echo "Respuesta JSON final:\n";
    }
    echo json_encode(['story' => $story, 'fallback' => false]);
} else {
    if ($debug) {
        echo "ERROR: No se encontró contenido en la respuesta de Groq\n";
        echo "Estructura de respuesta: " . print_r($response, true) . "\n";
        echo "Usando historia de fallback\n\n";
    }
    // Fallback
    $story = MoldeatConstants::getFallbackStory($itemNames);
    echo json_encode(['story' => $story, 'fallback' => true]);
}
