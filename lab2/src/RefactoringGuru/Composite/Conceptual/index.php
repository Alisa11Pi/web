<?php

namespace RefactoringGuru\Composite\Conceptual;

/**
 * Паттерн Компоновщик
 *
 * Назначение: Позволяет сгруппировать объекты в древовидную структуру, а затем
 * работать с ними так, как будто это единичный объект.
 */
abstract class Component
{
    protected $parent;

    public function setParent(?Component $parent)
    {
        $this->parent = $parent;
    }

    public function getParent(): Component
    {
        return $this->parent;
    }

    public function add(Component $component): void { }
    public function remove(Component $component): void { }

    public function isComposite(): bool
    {
        return false;
    }

    abstract public function operation(): string;
}

/**
 * Класс Лист представляет конечные объекты структуры.
 */
class Leaf extends Component
{
    public function operation(): string
    {
        return "Лист";
    }
}

/**
 * Класс Контейнер содержит сложные компоненты, которые могут иметь вложенные компоненты.
 */
class Composite extends Component
{
    protected $children;

    public function __construct()
    {
        $this->children = new \SplObjectStorage();
    }

    public function add(Component $component): void
    {
        $this->children->attach($component);
        $component->setParent($this);
    }

    public function remove(Component $component): void
    {
        $this->children->detach($component);
        $component->setParent(null);
    }

    public function isComposite(): bool
    {
        return true;
    }

    public function operation(): string
    {
        $results = [];
        foreach ($this->children as $child) {
            $results[] = $child->operation();
        }

        return "Ветка(" . implode("+", $results) . ")";
    }
}

/**
 * Клиентский код работает со всеми компонентами через базовый интерфейс.
 */
function clientCode(Component $component)
{
    echo "РЕЗУЛЬТАТ: " . $component->operation();
}

// Работа с простым компонентом-листом
$simple = new Leaf();
echo "Клиент: У меня есть простой компонент:<br>";
clientCode($simple);
echo "<br>";

// Работа с сложной древовидной структурой
$tree = new Composite();
$branch1 = new Composite();
$branch1->add(new Leaf());
$branch1->add(new Leaf());
$branch2 = new Composite();
$branch2->add(new Leaf());
$tree->add($branch1);
$tree->add($branch2);
echo "Клиент: Теперь у меня составное дерево:<br>";
clientCode($tree);
echo "<br>";

// Дополнительный клиентский код для демонстрации управления деревом
function clientCode2(Component $component1, Component $component2)
{
    if ($component1->isComposite()) {
        $component1->add($component2);
    }
    echo "РЕЗУЛЬТАТ: " . $component1->operation();
}

echo "Клиент: Мне не нужно проверять классы компонентов даже при управлении деревом:<br>";
clientCode2($tree, $simple);