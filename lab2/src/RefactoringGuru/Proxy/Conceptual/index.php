<?php

namespace RefactoringGuru\Proxy\Conceptual;

/**
 * Интерфейс Субъекта объявляет общие операции для Реального Субъекта и Заместителя.
 */
interface Subject
{
    public function request(): void;
}

/**
 * Реальный Субъект содержит основную бизнес-логику.
 */
class RealSubject implements Subject
{
    public function request(): void
    {
        echo "РеальныйСубъект: Обработка запроса.<br>";
    }
}

/**
 * Заместитель имеет тот же интерфейс, что и Реальный Субъект.
 */
class Proxy implements Subject
{
    private $realSubject;

    public function __construct(RealSubject $realSubject)
    {
        $this->realSubject = $realSubject;
    }

    public function request(): void
    {
        if ($this->checkAccess()) {
            $this->realSubject->request();
            $this->logAccess();
        }
    }

    private function checkAccess(): bool
    {
        echo "Заместитель: Проверка доступа перед выполнением запроса.<br>";
        return true;
    }

    private function logAccess(): void
    {
        echo "Заместитель: Логирование времени запроса.<br>";
    }
}

/**
 * Клиентский код работает с субъектами через интерфейс Subject.
 */
function clientCode(Subject $subject)
{
    $subject->request();
}

echo "Клиент: Выполнение кода с реальным субъектом:<br>";
$realSubject = new RealSubject();
clientCode($realSubject);

echo "<br>";

echo "Клиент: Выполнение того же кода с заместителем:<br>";
$proxy = new Proxy($realSubject);
clientCode($proxy);