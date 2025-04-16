<?php
namespace MVC\Controllers;

use MVC\Views\MarkdownView;

class Controller
{
    protected $view;
    protected $model;

    public function __construct(string $route)
    {
        // Здесь должна быть логика определения модели и представления
        $this->view = new MarkdownView();
        $this->model = $this->getModel($route);
    }

    public function render(): string
    {
        $data = $this->model->getData(); // Предполагаем метод getData() в модели
        return $this->view->render($data);
    }

    protected function getModel(string $route)
    {
        // Логика выбора модели по маршруту
        return new UsersModel(); // Пример
    }
}