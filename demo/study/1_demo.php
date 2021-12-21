<?php
class Person {
    public function show(){
        echo '这是父类<br>';
    }
}
class Student extends Person{
    public function show(){
        echo '这是子类';
    }
}
$stu = new Student;
$stu->show();
?>