<?php

namespace RefactoringGuru\Flyweight\Conceptual;

/**
 * Паттерн Легковес
 *
 * Назначение: Позволяет вместить больше объектов в отведённую оперативную память,
 * разделяя общее состояние объектов между собой.
 */
class Flyweight
{
    private $sharedState;

    public function __construct($sharedState)
    {
        $this->sharedState = $sharedState;
    }

    public function operation($uniqueState): void
    {
        $s = json_encode($this->sharedState);
        $u = json_encode($uniqueState);
        echo "Легковес: Отображаем общее состояние ($s) и уникальное состояние ($u).<br>";
    }
}

/**
 * Фабрика Легковесов создает и управляет объектами-Легковесами.
 */
class FlyweightFactory
{
    private $flyweights = [];

    public function __construct(array $initialFlyweights)
    {
        foreach ($initialFlyweights as $state) {
            $this->flyweights[$this->getKey($state)] = new Flyweight($state);
        }
    }

    private function getKey(array $state): string
    {
        ksort($state);
        return implode("_", $state);
    }

    public function getFlyweight(array $sharedState): Flyweight
    {
        $key = $this->getKey($sharedState);

        if (!isset($this->flyweights[$key])) {
            echo "Фабрика Легковесов: Не найден существующий легковес, создаю новый.<br>";
            $this->flyweights[$key] = new Flyweight($sharedState);
        } else {
            echo "Фабрика Легковесов: Использую существующий легковес.<br>";
        }

        return $this->flyweights[$key];
    }

    public function listFlyweights(): void
    {
        $count = count($this->flyweights);
        echo "<br>Фабрика Легковесов: Всего $count легковесов:<br>";
        foreach ($this->flyweights as $key => $flyweight) {
            echo $key . "<br>";
        }
    }
}

// Инициализация фабрики с начальным набором легковесов
$factory = new FlyweightFactory([
    ["Chevrolet", "Camaro2018", "розовый"],
    ["Mercedes Benz", "C300", "черный"],
    ["Mercedes Benz", "C500", "красный"],
    ["BMW", "M5", "красный"],
    ["BMW", "X6", "белый"],
]);
$factory->listFlyweights();

/**
 * Добавляет автомобиль в полицейскую базу данных
 */
function addCarToPoliceDatabase(
    FlyweightFactory $ff, $plates, $owner,
    $brand, $model, $color
) {
    echo "\nКлиент: Добавляю автомобиль в базу данных.<br>";
    $flyweight = $ff->getFlyweight([$brand, $model, $color]);
    $flyweight->operation([$plates, $owner]);
}

// Добавление автомобилей в базу данных
addCarToPoliceDatabase($factory,
    "CL234IR",
    "Джеймс Доу",
    "BMW",
    "M5",
    "красный"
);

addCarToPoliceDatabase($factory,
    "CL234IR",
    "Джеймс Доу",
    "BMW",
    "X1",
    "красный"
);

// Вывод списка всех легковесов после добавления
$factory->listFlyweights();