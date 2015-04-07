<?php
/**
 * Created by PhpStorm.
 * User: laring
 * Date: 06.04.15
 * Time: 16:08
 */

class Application_Model_Films extends Zend_Db_Table_Abstract

{
    // Имя таблицы, с которой будем работать
    protected $_name = 'films';

    // Метод для получения записи по id
    public function getFilm($id)
    {
        // Получаем id как параметр
        $id = (int)$id;

        // Используем метод fetchRow для получения записи из базы.
        // В скобках указываем условие выборки (привычное для вас where)
        $row = $this->fetchRow('id = ' . $id);

        // Если результат пустой, выкидываем исключение
        if(!$row) {
            throw new Exception("Нет записи с id - $id");
        }
        // Возвращаем результат, упакованный в массив
        return $row->toArray();
    }

    // Метод для добавления новой записи
    public function addFilm($name, $year, $country, $genre, $director)
    {
        // Формируем массив вставляемых значений
        $data = array(
            'name' => $name,
            'year' => $year,
            'country' => $country,
            'genre' => $genre,
            'director' => $director,
        );

        // Используем метод insert для вставки записи в базу
        $this->insert($data);
    }

    // Метод для обновления записи
    public  function updFilm($id, $name, $year, $country, $genre, $director)
    {
        // Формируем массив значений
        $data = array(
            'name' => $name,
            'year' => $year,
            'country' => $country,
            'genre' => $genre,
            'director' => $director,
        );

        // Используем метод update для обновления записи
        // В скобках указываем условие обновления (привычное для вас where)
        $this->update($data, 'id = ' . (int)$id);
    }

    // Метод для удаления записи
    public function delFilm($id)
    {
        // В скобках указываем условие удаления (привычное для вас where)
        $this->delete('id = ' . (int)$id);
    }
}
