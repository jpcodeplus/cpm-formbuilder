<?php

namespace App\core;

/**
 * Router-Klasse, verantwortlich für das Routing von HTTP-Anfragen.
 */
class Router
{
    private $routes = [];
    private $basePath;

    public function __construct($basePath = 'http://localhost:3001/public')
    {
        $this->basePath = rtrim($basePath, '/');
    }

    /**
     * Fügt eine Route hinzu.
     *
     * @param string $method HTTP-Methode
     * @param string $path Pfad der Route
     * @param callable $callback Callback-Funktion
     */
    public function addRoute($method, $path, callable $callback)
    {
        // Normalisiert den Pfad vor dem Hinzufügen
        $path = $this->normalizePath($path);
        $this->routes[$method][$path] = $callback;
    }

    /**
     * Normalisiert den Pfad.
     *
     * @param string $path Der Pfad
     * @return string Der normalisierte Pfad
     */
    private function normalizePath($path)
    {
        // Entfernt den abschließenden Schrägstrich, falls vorhanden, außer der Pfad ist nur ein Schrägstrich
        $path = $path !== '/' ? rtrim($path, '/') : $path;
        return $path;
    }

    /**
     * Verarbeitet die aktuelle Anfrage.
     */
    public function dispatch()
    {
        // Entfernt den Basispfad aus der REQUEST_URI und normalisiert den resultierenden Pfad
        $requestUri = strtok($_SERVER['REQUEST_URI'], '?');
        $pathRelativeToBase = '/' . ltrim(str_replace($this->getBasePathForComparison(), '', $requestUri), '/');
        $path = $this->normalizePath($pathRelativeToBase);

        $method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
        $callback = $this->routes[$method][$path] ?? null;

        if (is_callable($callback)) {
            call_user_func($callback);
        } else {
            // Wenn keine Route gefunden wurde, gib einen 404 Fehler aus
            header("HTTP/1.0 404 Not Found");
            echo 'SEITE NICHT GEFUNDEN';
        }
    }

    /**
     * Bereitet den Basispfad für den Vergleich vor, um relative Pfade korrekt zu ermitteln.
     * 
     * @return string Bereinigter Basispfad
     */
    private function getBasePathForComparison()
    {
        $schemeAndHttpHost = 'http://' . $_SERVER['HTTP_HOST'];
        $basePathForComparison = str_replace($schemeAndHttpHost, '', $this->basePath);
        return rtrim($basePathForComparison, '/');
    }
}
