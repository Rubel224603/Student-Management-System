<?php


namespace App\Repository;


use App\Models\Student;
use App\StudentRepositoryInterface;

class StudentRepository implements StudentRepositoryInterface
    {
        public function all(){
            return Student::all();
        }
        public function find($id){
            return Student::find($id);
        }
        public function store($request){
            return Student::addNewStudent($request);
        }
        public function update($id,$request){
            return Student::updateStudent($id,$request);
        }

        public function delete($id){
            return Student::deleteStudent($id);

        }
}
