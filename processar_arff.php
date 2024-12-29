<?php
// Habilitar exibição de erros
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Caminho para o arquivo ARFF
$arffFilePath = 'C:\\w\\Bio.arff';

// Caminho para o arquivo JAR do Weka
$wekaJarPath = 'C:\\Program Files\\Weka-3-8-6\\weka.jar';

// Verificar se os caminhos estão corretos
if (!file_exists($arffFilePath)) {
    die("Arquivo ARFF não encontrado: " . $arffFilePath);
}
if (!file_exists($wekaJarPath)) {
    die("Arquivo JAR do Weka não encontrado: " . $wekaJarPath);
}

// Comando para executar o Weka
$command = 'java -classpath ' . escapeshellarg($wekaJarPath) . ' weka.classifiers.trees.J48 -t ' . escapeshellarg($arffFilePath);

// Executa o comando e captura a saída e o código de retorno
exec($command . ' 2>&1', $output, $return_var);

// Exibe a saída do comando e o código de retorno
echo "<pre>Comando: $command\n\nSaída:\n" . print_r($output, true) . "\n\nCódigo de Retorno: $return_var</pre>";
?>
