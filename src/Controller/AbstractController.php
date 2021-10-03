<?php

declare(strict_types=1);

namespace App\Controller;

use App\View;
use App\Database;
use App\Request;
use App\Exception\ConfigurationException;

require_once("src/Utils/debug.php");

session_start();

abstract class AbstractController
{
    protected const DEFAULT_ACTION = 'list';
    protected const MAX_FILE_SIZE = 1024*1024*3;
    protected const SUPPORTED_TYPES = "application/pdf";

    private static array $configuration = [];
    
    protected View $view;
    protected Request $request;
    protected Database $database;
    
    public function __construct(Request $request)
    {
        if (empty(self::$configuration['db'])) {
            throw new ConfigurationException('Configuration error');
        }

        $this->database = new Database(self::$configuration['db']);
        $this->request = $request;
        $this->view = new View();  

    }

    public static function initConfiguration(array $configuration): void
    {
        self::$configuration = $configuration;
    }

    final public function run(): void
    {
        $action = $this->action() . 'Action';
        if(!method_exists($this, $action)) {
            $action = self::DEFAULT_ACTION . 'Action';
        }
        $this->$action();
    }

    final protected function redirect(string $to, array $params): void
    {
        $location = $to;
        if (count($params)) {
            $queryParams = [];
            foreach ($params as $key => $value) {
                $queryParams[] = urlencode($key) . '=' . urlencode($value);
            }
            $queryParams = implode('&', $queryParams);
            $location .= '&' . $queryParams;
        }
        
        header("Location: $location");
        exit;
    }

    final private function action(): string
    {
        return $this->request->getParam('action', self::DEFAULT_ACTION);
    }
}