<?php

namespace RefactoringGuru\Builder\Conceptual;

/**
 * Интерфейс Строителя объявляет создающие методы для различных частей объектов
 * Продуктов.
 */
interface Builder
{
    public function producePartA(): void;
    public function producePartB(): void;
    public function producePartC(): void;
}

/**
 * Классы Конкретного Строителя следуют интерфейсу Строителя и предоставляют
 * конкретные реализации шагов построения.
 */
class ConcreteBuilder1 implements Builder
{
    private $product;

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): void
    {
        $this->product = new Product1();
    }

    public function producePartA(): void
    {
        $this->product->parts[] = "ЧастьA1";
    }

    public function producePartB(): void
    {
        $this->product->parts[] = "ЧастьB1";
    }

    public function producePartC(): void
    {
        $this->product->parts[] = "ЧастьC1";
    }

    public function getProduct(): Product1
    {
        $result = $this->product;
        $this->reset();
        return $result;
    }
}

class Product1
{
    public $parts = [];

    public function listParts(): void
    {
        echo "Части продукта: " . implode(', ', $this->parts) . "<br>";
    }
}

/**
 * Директор отвечает за выполнение шагов построения в определённой
 * последовательности.
 */
class Director
{
    private $builder;

    public function setBuilder(Builder $builder): void
    {
        $this->builder = $builder;
    }

    public function buildMinimalViableProduct(): void
    {
        $this->builder->producePartA();
    }

    public function buildFullFeaturedProduct(): void
    {
        $this->builder->producePartA();
        $this->builder->producePartB();
        $this->builder->producePartC();
    }
}

/**
 * Клиентский код
 */
function clientCode(Director $director)
{
    $builder = new ConcreteBuilder1();
    $director->setBuilder($builder);

    echo "Стандартная базовая версия продукта:<br>";
    $director->buildMinimalViableProduct();
    $builder->getProduct()->listParts();

    echo "Стандартная полная версия продукта:<br>";
    $director->buildFullFeaturedProduct();
    $builder->getProduct()->listParts();

    echo "Пользовательская версия продукта:<br>";
    $builder->producePartA();
    $builder->producePartC();
    $builder->getProduct()->listParts();
}

$director = new Director();
clientCode($director);