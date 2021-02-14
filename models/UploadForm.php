<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\Inflector;
use yii\helpers\FileHelper;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $uploadedFiles;
   
    public function rules()
    {
        return [
            [['uploadedFiles'], 'file', 'skipOnEmpty' => false, 'maxFiles' => 5],
        ];
    }
    
    private function transliterate($input){
        $gost = array(
            "а"=>"a","б"=>"b","в"=>"v","г"=>"g","д"=>"d",
            "е"=>"e", "ё"=>"yo","ж"=>"j","з"=>"z","и"=>"i",
            "й"=>"i","к"=>"k","л"=>"l", "м"=>"m","н"=>"n",
            "о"=>"o","п"=>"p","р"=>"r","с"=>"s","т"=>"t",
            "у"=>"y","ф"=>"f","х"=>"h","ц"=>"c","ч"=>"ch",
            "ш"=>"sh","щ"=>"sh","ы"=>"i","э"=>"e","ю"=>"u",
            "я"=>"ya",
            "А"=>"a","Б"=>"b","В"=>"v","Г"=>"g","Д"=>"d",
            "Е"=>"e","Ё"=>"yo","Ж"=>"J","З"=>"z","И"=>"i",
            "Й"=>"i","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
            "О"=>"o","П"=>"P","p"=>"r","С"=>"S","Т"=>"t",
            "У"=>"y","Ф"=>"f","Х"=>"h","Ц"=>"c","Ч"=>"ch",
            "Ш"=>"sh","Щ"=>"sh","Ы"=>"i","Э"=>"e","Ю"=>"u",
            "Я"=>"ya",
            "ь"=>"","Ь"=>"","ъ"=>"","Ъ"=>"",
            "ї"=>"j","і"=>"i","ґ"=>"g","є"=>"ye",
            "Ї"=>"j","І"=>"i","Ґ"=>"g","Є"=>"ye",
            "A" => "a", "B" => "b", "C" => "c",
            "D" => "d", "E" => "e", "F" => "f",
            "G" => "g", "H" => "h", "I" => "i",
            "J" => "j", "K" => "k", "L" => "l",
            "M" => "m", "N" => "n", "O" => "o",
            "P" => "p", "Q" => "q", "R" => "r",
            "S" => "s", "T" => "t", "U" => "u",
            "V" => "v", "W" => "w", "X" => "x",
            "Y" => "y", "Z" => "z" 
        );
        return strtr($input, $gost);
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $uploadDatetime = date("Y-m-d H:i:s"); // 2001-03-10 17:16:18 (формат MySQL DATETIME)
            // echo \Yii::$app->basePath;
            // Уникальное имя папки
            $folderSuffix = date("YmdHis");
            $folderName = 'uploads/upload' . $folderSuffix . '/';
            $folderPath = \Yii::$app->basePath . '/web/uploads/';
            FileHelper::createDirectory($folderName);

            // Запись папки в таблицу
            $sql = 'INSERT folders_t(folder_name, folder_path) VALUES (:folder_name, :folder_path);';
            \Yii::$app->db->createCommand($sql)
                ->bindValue(':folder_name', $folderName)
                ->bindValue(':folder_path', $folderPath)
                ->execute();
            $folderID = \Yii::$app->db->getLastInsertID();

            $sql = 'INSERT files_t(file_name, upload_datetime, folder_id) VALUES (:file_name, :upload_datetime, :folder_id);';

            $command = \Yii::$app->db->createCommand($sql);
                
            foreach ($this->uploadedFiles as $file) {
                //Транслитерация и нижний регистр
                // $transLowerName = Inflector::slug($file->baseName, '-', true);
                // $lowerName = strtolower($file->baseName);
                $fileName = $this->transliterate($file->baseName)  . '.' . $file->extension;
                
                $file->saveAs($folderName . $fileName);
                
                // Запись в бд
                $command
                    ->bindValue(':file_name', $fileName)
                    ->bindValue(':upload_datetime', $uploadDatetime)
                    ->bindValue(':folder_id', $folderID)
                    ->execute();
            }
            return true;
        } else {
            return false;
        }
    }
}